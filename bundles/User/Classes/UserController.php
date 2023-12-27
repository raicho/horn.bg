<?php

namespace User\Classes;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use FormProtector\Classes\FormProtector;
use User\Models\PasswordResetModel;
use User\Models\UserModel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \User\Mail\ForgotPassword as MailForgotPassword;
class UserController extends Controller
{

    public function resetPassword($token, Request $request)
    {
        // TODO:
        $resetPasswordResult = PasswordResetModel::where('token', $token)->first();
        dd($resetPasswordResult->email);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function forgotPasswordUser(Request $request): View|Factory|Application
    {
        $data['errors'] = [];
        if($request->isMethod('POST')) {
            $rules = array(
                'email' => 'email',
            );

            $validator = Validator::make($request->all(), $rules);
            if (count($validator->messages()) == 0) {
                $email = $request->get('email');
                $userResult = UserModel::where('email', $email)->first();

                if ($userResult) {
                    $userResult->token = Str::random(60);
                    $forgotPassword = new MailForgotPassword($userResult->toArray());
                    $forgotPassword->subject(__('mails.forgot_password.subject'));
                    PasswordResetModel::where('email', $email)->delete();
                    $passwordResetModel = new PasswordResetModel();
                    $passwordResetModel->email = $userResult->email;
                    $passwordResetModel->token = $userResult->token;
                    $passwordResetModel->created_at = now();
                    $passwordResetModel->save();
                    Mail::to($email)->send($forgotPassword);
                }
            } else {
                $data['errors'] = $validator->errors()->toArray();
            }
        }
        return view('user::forgot_password', $data);
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect('/');
    }
    public function homeUser()
    {
        return view('user::home');
    }
    public function loginUser(Request $request)
    {
        $data['errors'] = [];
        $userdata = array(
            'email' => $request->email,
            'password' => $request->password
        );

        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );

        $validator = Validator::make($request->all() , $rules);

        if (!$validator->fails()) {
            if (Auth::attempt($userdata)) {
                return redirect()->route('user_home');
            }

            $data['errors']['not_logged'] = [
                'error' => __('validation.custom.user.not_logged')
            ];
        }
        return view('user::login', $data);
    }
    public function registerUser(Request $request)
    {
        $data = [];
        $data['errors'] = [];
        if($request->isMethod('POST')) {
            $errors = [];
            $validator = Validator::make($request->all(), [
                // rules
                'name' => 'required|min:6',
                'email' => 'required|max:255|email|unique:users',
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6',
                'terms_of_service'  => 'required',
                'protector_hash' => 'required|min:1',
                'code' => 'required|min:'.config('protector.randomStringLength')
            ],
            [
                // messages
                'name.required' => __('validation.required'),
                'name.min:6' => __('validation.min.string'),
                'email.required' => __('validation.required'),
                'email.min:6' => __('validation.min.string'),
                'email' => __('validation.email'),
                'email.unique' => __('validation.unique'),
                'terms_of_service.required'  =>  __('validation.custom.termsOfService.required'),
            ]);

            $formProtector = new FormProtector();
            $isValidFormProtector = json_decode($formProtector->isValidCode($request->protector_hash, $request->code)->content());

            if(!$isValidFormProtector->isValid) {
               $errors['code']['failed'] = __('validation.custom.form_protector.failed');
            }

            foreach($validator->errors()->messages() as $field => $message) {
                $errors[$field] = $message;
            }

            $data['errors'] = $errors;
            if(count($data['errors']) == 0) {
                $user = UserModel::create(request(['name', 'email', 'password']));
                Auth::login($user);
                return redirect()->route('user_home');
            }
        }

        return view('user::register', $data);
    }
}

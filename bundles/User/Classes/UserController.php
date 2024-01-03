<?php

namespace User\Classes;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use FormProtector\Classes\FormProtector;
use User\Mail\PasswordChanged;
use User\Mail\SuccessfulRegistration;
use User\Mail\VerificationLink;
use User\Models\PasswordResetModel;
use User\Models\UserModel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \User\Mail\ForgotPassword as MailForgotPassword;
use User\Models\UserVerification;
use User\Models\UserVerificationModel;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function requestNewVerificationCode(Request $request)
    {
        $data['errors'] = 0;
        $user = UserModel::where('email', $request->email)->first();


        if($user && $user->is_verified != 1) {
            $user->code = Str::random(60);
            $userVerificationModel = new UserVerificationModel();
            $userVerificationModel->user_id = $user->id;
            $userVerificationModel->code = $user->code;
            $userVerificationModel->created_at = now();
            $userVerificationModel->save();
            $mailVerificationLink = new VerificationLink($user->toArray());
            $mailVerificationLink->subject(__('mails.verification_link.subject'));
            Mail::to($user->email)->send($mailVerificationLink);
        }
        if($user) {
            if($user->is_verified == 1) {
                $data['errors'] = 2;
            }
        } else {
            $data['errors'] = 1;
        }

        return view('user::resend_verification_link', $data);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function confirmedEmail(Request $request)
    {
        $codeResult = UserVerificationModel::where('code', $request->code)->first();
        if($codeResult) {
            $userResult = UserModel::where('id', $codeResult->user_id)->first();
            if($userResult) {
                $userResult->is_verified = true;
                $userResult->email_verified_at = now();
                $userResult->save();
                $codeResult->delete();
                return view('user::verification_successful');
            }
        }
        return view('user::not_found_verification_code');
    }

    /**
     * @param $token
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function resetPassword($token, Request $request)
    {
        $data['errors'] = [];
        $data['token'] = $token;
        $resetPasswordResult = PasswordResetModel::where('token', $token)->first();

        if($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'password' => 'min:6|required_with:repeat_password|same:repeat_password',
                'password_confirmation' => 'min:6',
            ]);

            if(count($validator->errors()) == 0) {
                PasswordResetModel::where('token', $token)->delete();
                $user = UserModel::where('email', $resetPasswordResult->email)->first();
                $user->setPasswordAttribute($request->get('password'));
                $user->save();
                $mail = new PasswordChanged($user->toArray());
                $mail->subject(__('mails.updated_password.subject'));
                Mail::to($user->email)->send($mail);
                $flashMessage = __('pages.reset_password.alert_msg');
                return redirect()->route('login_page')->with('flash-message', ['type' => 'success', 'content' => $flashMessage]);
            }

            $data['errors'] = $validator->errors()->toArray();
        }

        if(!$resetPasswordResult) {
            return view('user::not_valid_token_reset_password');
        }

        return view('user::reset_password', $data);
    }

    /**
     * @param Request $request
     * @return View|Factory|Application|RedirectResponse
     */
    public function forgotPasswordUser(Request $request): View|Factory|Application|RedirectResponse
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
                    $flashMessage = __('pages.forgot_password.alert_msg');
                    return redirect()->route('login_page')->with('flash-message', ['type' => 'success', 'content' => $flashMessage]);
                }
            } else {
                $data['errors'] = $validator->errors()->toArray();
            }
        }
        return view('user::forgot_password', $data);
    }

    /**
     * @return Application|RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutUser()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * @return Application|Factory|View
     */
    public function homeUser()
    {
        return view('user::dashboard');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function loginUser(Request $request)
    {
        $data['errors'] = [];
        if($request->isMethod('POST')) {
            $userdata = array(
                'email' => $request->email,
                'password' => $request->password
            );
            $rules = array(
                'email' => 'required|email',
                'password' => 'required'
            );
            $validator = Validator::make($request->all() , $rules);
            $data['errors']['not_logged'] = [
                'error' => __('validation.custom.user.not_logged')
            ];

            if (!$validator->fails()) {
                //TODO: Verification code by mail or sms
                if (Auth::attempt($userdata)) {
                    $flashMessage = __('pages.login.welcomeBack', ['user' => Auth::user()->name]);
                    return redirect()->route('user_home')->with('flash-message', ['type' => 'success', 'content' => $flashMessage]);
                }
            }
        }

        return view('user::login', $data);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
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
                $mailSuccessfulRegistration = new SuccessfulRegistration($user->toArray());
                $mailSuccessfulRegistration->subject(__('mails.successful_registration.subject'));
                Mail::to($user->email)->send($mailSuccessfulRegistration);

                if(config('user.verification_link')) {
                    $user->code = Str::random(60);
                    $userVerificationModel = new UserVerificationModel();
                    $userVerificationModel->user_id = $user->id;
                    $userVerificationModel->code = $user->code;
                    $userVerificationModel->created_at = now();
                    $userVerificationModel->save();
                    $mailVerificationLink = new VerificationLink($user->toArray());
                    $mailVerificationLink->subject(__('mails.verification_link.subject'));
                    Mail::to($user->email)->send($mailVerificationLink);
                }

                $flashMessage = __('pages.register.alert_msg', ['user' => Auth::user()->name]);
                return redirect()->route('user_home')->with('flash-message', ['type' => 'success', 'content' => $flashMessage]);
            }
        }

        return view('user::register', $data);
    }
}

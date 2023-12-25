<?php

namespace User\Classes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use FormProtector\Classes\FormProtector;
use User\Models\UserModel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{

    public function logoutUser()
    {
        session_destroy();
        return redirect('/');
    }
    public function homeUser()
    {
        return view('user::home');
    }
    public function loginUser(Request $request)
    {
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
          if(Auth::attempt($userdata, true)) {
              $_SESSION['userId'] = Auth::user()->id;
              return redirect()->route('user_home');
          }
      }
        return view('user::login');
    }
    public function registerUser(Request $request)
    {
        $data = [];
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
                UserModel::create(request(['name', 'email', 'password']));
                return redirect()->route('user_home');
            }
        }

        return view('user::register', $data);
    }
}

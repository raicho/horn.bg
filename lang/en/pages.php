<?php

use Illuminate\Support\Facades\Auth;

return [
    'welcome' => [
      'title' => 'Welcome'
    ],
    'register' => [
        'title' => 'Registration',
        'alert_msg' => 'Hello, :user, welcome aboard!'
    ],
    'login' => [
        'title' => 'Login',
        'welcomeBack' => "👋 Hello, :user, welcome back!",
        'forgot_password_link_text' => 'Forgot password?',
        'dont_have_an_account_link_text' => "Don't have an account? Sign up now",
        'go_to_login_page_link' => 'To log in, visit the login page'
    ],
    'forgot_password' => [
        'alert_msg' => '📧 We have sent a password reset link to your email address.'
    ],
    'reset_password' => [
        'alert_msg' => 'Your password was changed.'
    ],
    'not_valid_token_password' => [
        'alert_msg' => 'I apologize for the inconvenience. The link you used has expired and is no longer valid. Please use the following link to submit a new request for a password change.'
    ],
    'not_found_verification_code' => [
        'title' => 'Invalid verification code',
        'content' => "The verification code provided in the email is invalid or has expired. Please ensure that you're copying the code correctly from the email.  If the issue persists, you may request a new verification code."
    ],
    'verification_successful' => [
        'title' => 'Account successfully verified',
        'content' => "Congratulations! Your account has been successfully verified. Welcome to our community! Feel free to explore all the features and services available. If you have any questions or need assistance, don't hesitate to contact us."
    ],
    'resend_verification_link' => [
        'title' => 'New verification code',
        'content' => 'We have sent you a new email verification link. Please check your inbox.',
        'error' => 'The user you are looking for does not exist. Please ensure you have entered the correct email address',
        'error_user_verification_exist' => 'Sorry, but this email is already associated with a confirmed account in our system.',
    ]
];

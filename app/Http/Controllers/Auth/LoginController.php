<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->{$this->username()},
            'password' => $request->password,
            'status' => 'active',
        ];
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    /**
     * Get username property.
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

//    public function login(Request $request) {
//        $this->validateLogin($request);
//        if ($this->hasTooManyLoginAttempts($request)) {
//            $this->fireLockoutEvent($request);
//            return $this->sendLockoutResponse($request);
//        }
//
//        // This section is the only change
//        if ($this->guard()->validate($this->credentials($request))) {
//            $user = $this->guard()->getLastAttempted();
//            // Make sure the user is active
//            if ($user->status && $this->attemptLogin($request)) {
//                // Send the normal successful login response
//                return $this->sendLoginResponse($request);
//            } else {
//                // Increment the failed login attempts and redirect back to the
//                // login form with an error message.
//                $this->incrementLoginAttempts($request);
//                return redirect()
//                    ->back()
//                    ->withInput($request->only($this->username(), 'remember'))
//                    ->withErrors(['status' => 'You must be active to login.']);
//            }
//        }
//        // If the login attempt was unsuccessful we will increment the number of attempts
//        // to login and redirect the user back to the login form. Of course, when this
//        // user surpasses their maximum number of attempts they will get locked out.
//        $this->incrementLoginAttempts($request);
//        return $this->sendFailedLoginResponse($request);
//    }
}

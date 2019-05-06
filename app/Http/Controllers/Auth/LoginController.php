<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * @var string
     */
        protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user) {
        if ($user->isManager =='yes') {
            return redirect('/');
        }
        return redirect('/home');
    }

    public function loginWithUsername() {
        $login = request()->input('login');
        $field = filter_var($login,FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        request()->merge([$field=>$login]);
        return $field;
    }
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->loginWithUsername(), 'password');
        $credentials['is_active'] = 'yes';
        return $credentials;
    }
}

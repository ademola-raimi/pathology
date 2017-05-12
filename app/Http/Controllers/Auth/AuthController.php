<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use Alert;
use Validator;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    // use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * This method displays the signup page.
     *
     * @return signup page
     */
    public function getSignupForm()
    {
        return view('auth.signup-form');
    }

    /**
     * This method displays the login page.
     *
     * @return login page
     */
    public function getLoginForm()
    {
        return view('auth.login-form');
    }

    /**
     * This method displays the login page for patient.
     *
     * @return login page
     */
    public function getPatientLoginForm()
    {
        return view('auth.patient-login-form');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return User
     */
    public function create(SignupRequest $request)
    {
        User::create([
            'last_name'     => $request['last_name'],
            'first_name'    => $request['first_name'],
            'email'         => $request['email'],
            'password'      => bcrypt($request['password']),
            'avatar'        => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);

        alert()->success('Thanks, you will need to be given an admin access to see your dashboard', 'success');

        Auth::attempt($request->only(['email', 'password']));

        return redirect()->route('index');
    }

    /**
     * Create a new user instance after a valid staff login.
     *
     * @param  Request  $request
     * @return User
     */
    public function postLogin(LoginRequest $request)
    {
        $authStatus = Auth::attempt($request->only(['email', 'password']), $request->has('remember'));

        if (!$authStatus) {
            Alert::error('Invalid Email or Password', 'Error');

            return redirect()->back();
        }

        $user = Auth::user()->role_id;
        
        if ($user === 1) {
            alert()->success('You will need to be given an admin access to see your dashboard', 'success');

            return redirect()->route('index');
        }

        alert()->success('You are now signed in', 'Success');

        return redirect()->intended('/admin');
    }

    /**
     * logs user out.
     *
     * @return home
     */
    public function logOut()
    {
        Auth::logout();
        
        alert()->success('You have successully log out from your account', 'Good bye!');

        return redirect()->route('index');
    }
}

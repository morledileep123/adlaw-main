<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = User::select('id', 'email', 'password')->where('email', '=', $email)->first();

        if ($user) {
            if (!Hash::check($password, $user->password)) {
                return redirect()->back()->withInput()->with('success', 'Email and password do not match');
            } else {
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    if (Auth::user()->user_type_id == "X") {
                        return redirect('/dashboard')->with('success', 'Wellcome to the admin dashboard');
                    }else{
                        return redirect('/dashboard')->with('success', 'Wellcome to the user dashboard');
                    }
                }else{
                    return redirect()->back()->with('success', 'Enter credential does not match');
                }
            }
        } else {
            return redirect()->back()->with('success', 'Entere Email and password does not exists');
        }
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You are logged out successfully');
    }
}

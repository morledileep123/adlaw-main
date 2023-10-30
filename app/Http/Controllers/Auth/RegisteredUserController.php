<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserTypeMast;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Notifications\EmailVerificationNotificationController;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $userType = UserTypeMast::all();
        return view('auth.register', compact('userType'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

  
    public function store(Request $request)
    {
        
          $request->validate([
            'user_type_id' => 'required',
            'user_name' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'user_type_id' => $request->user_type_id,
            'user_name' => $request->user_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        event(new Registered($user));
        Auth::login($user);
       return redirect()->route('login');
        // return redirect(RouteServiceProvider::HOME);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function register_page()
    {
        // dd(Auth::id());
        //to access the user
        //to logout
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request-> validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8' ,'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8']
        ]);
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);;
        // Auth::login($user);
        return redirect()->route('login')->with('success', 'Registration successful!');
    }
public function login_page(Request $request){
    return view('auth.login');

}
public function login(Request $request){
    $request->validate([
    'email'=> ['required','email'],
    'password'=> ['required', ''],
]);
     $credentials = $request->only('email','password');

   if (Auth::attempt($credentials))
   {
    return redirect()->intended('urls')->with('success', 'Login successful!');
   }

//    $this->login($request);
}
public function logout(Request $request){
    auth()->logout();
    return redirect()->route('home')->with('success','Logged Out Successfully');
}
}

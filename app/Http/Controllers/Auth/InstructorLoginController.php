<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class InstructorLoginController extends Controller
{

    public function __construct(){
        $this->middleware('guest:instructor', ['except'=>['logout']]);
    }

    public function showLoginForm(){
        return view('auth.instructor-login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password'=>'required|min:6',
        ]);
        
        if (Auth::guard('instructor')->attempt([
         'email'=>$request->email,
        'password'=>$request->password  
        ], $request->remember)){

        return redirect()->intended(route('instructor.dashboard'));

    }
    return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('instructor')->logout();

        return redirect('/');
    }
}

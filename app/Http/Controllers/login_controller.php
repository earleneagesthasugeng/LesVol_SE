<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class login_controller extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = \App\Models\User::where('email', '=', $validated['email'])->first();
        if($user == NULL||$user->password!==$validated['password']){
            return back()->with('error','Error! data is invalid!');
        }

        $request->session()->put('user',$user);

         return redirect('/home')->with('success', 'Logged in!');
    }
}

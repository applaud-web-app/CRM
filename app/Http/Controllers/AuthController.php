<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function checkLogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $remeber = false;
        if(isset($request->remember)){
            $remeber = true;
        } 

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password,'status'=> 1],$remeber)){
            return redirect(route('dashboard'))->with('success','Login Successfully!! 😀');
        }

        return redirect(route('login'))->with('error','Invalid Credentials 🥴');

    }

    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect(route('login'))->with('success','Logout Successfully!! 😀');
    }
}

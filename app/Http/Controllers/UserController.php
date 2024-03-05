<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
   public function accountSetting(){
    $id = Auth::id();
    $user = User::find($id);
    return view('user.account-setting',compact('user'));
   }

   public function updateAccountSetting(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);
   }

   public function updateUserpassword(){
        $request->validate([
            'new_password'=>'required',
            'confirm_password'=>'required|same:new_password'
        ]);
   }

}

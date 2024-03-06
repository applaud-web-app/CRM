<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Imports\BulkEnquiry;
use Auth;
use Excel;

class UserController extends Controller
{
   public function accountSetting(){
    $id = Auth::id();
    $user = User::find($id);
    return view('user.account-setting',compact('user'));
   }

   public function updateAccountSetting(Request $request){

        $request->validate([
            'firstname'=>'required',
            'email'=>'required | email',
            'number'=>'required | size:10',
            'gender'=>'required',
            'profile_image'=>'mimes:jpg,jpeg,png'
        ]);

        $id = Auth::id();
        $checkEmail = User::where('email',$request->email)->where('id','!=',$id)->first();
        if($checkEmail){
            return redirect()->back()->with('error','This Email Already Exists');
        }

        $checkPhone = User::where('phone',$request->number)->where('id','!=',$id)->first();
        if($checkPhone){
            return redirect()->back()->with('error','This Number Already Exists');
        }

        $user = User::find($id);
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;

        if($request->has('profile_image')){
            $file = $request->file('profile_image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = "USER".time().rand().'.'.$extenstion;
            $file->move('uploads/users/', $filename);
            $user->profile_img = $filename;
        }
        $user->email  = $request->email;
        $user->phone = $request->number;
        $user->gender = $request->gender;
        $user->save();

        return redirect()->back()->with('success','Account Setting Updated Successfully!! 😋');
   }

   public function userpassword(){
    return view('user.change-password');
   }

   public function updateUserpassword(Request $request){
        $request->validate([
            'new_password'=>'required',
            'confirm_password'=>'required|same:new_password'
        ]);
        $id = Auth::id();
        $user = User::find($id);
        $user->password = \Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success','Password Updated Successfully!! 😋');
   }

   

}

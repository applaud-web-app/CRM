<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(){

        if(Auth::check()){
            return redirect('dashboard');
        }
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
        // Cache::flush();
        $response =  redirect(route('login'))->with('success','Logout Successfully!! 😀');
        
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
        
    }

    public function forgetPassword(){
        if(Auth::check()){
            return redirect('dashboard');
        }
        return view('auth.forget-password');
    }

    public function postforgetPassword(Request $request){
        $request->validate([
            'username'=>'required'
        ]);

        $checkUser = User::where('username',$request->username)->first();
        if($checkUser){
            $newpass = rand()*50;
            $checkUser->password = \Hash::make($newpass);
            $checkUser->save();

            // SEND NEW PASSWORD ON USER EMAIL
            $username = $checkUser->name;
            $email = $checkUser->email;
            $mailContent = "Your Password : ".$newpass;
            Mail::raw($mailContent, function ($message) use($username, $email){
                $message->from('tdevansh099@gamil.com', 'Devansh Thakur');
                $message->to($email, $username);
            });

            return redirect(route('login'))->with('success','New Password Send To Your Mail 🔐');
        }

        return redirect()->back()->with('error','Email Doesn\'t Match !! 😀');

    }

}

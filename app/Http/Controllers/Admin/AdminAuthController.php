<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use Mail;
use Laravel\Socialite\Two\FacebookProvider;
use Socialite;
use Laravel\Socialite\Two\GoogleProvider;
use Cache;
use Carbon\Carbon;
use App\Mail\AdminForgetPassword;
use App\Mail\AgentLoginOtp;

class AdminAuthController extends Controller
{
    







/** 
*   Description : / route load login or dashboard
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function first_route(){
        // dd(Auth::user());
        if(@Auth::user()->id){
             return redirect()->route("admin.dashboard");
        }else{
            return redirect()->route("admin.login.view");
        }
    }







/** 
*   Description :login page load 
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function login_page(){
        return view("admin.Auth.login");
    }








/** 
*   Description : customer dashboard load 
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function dashboard(){
        return view("admin.Dashboard.dashboard");
    }











/** 
*   Description : login 
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function login(Request $request){
       //for customer
        // dd($request->all());
      
            $userDataEmail=User::where('email',$request->email)->where("role_id",1)->first();
            // dd($userDataEmail);
            if ($userDataEmail) {
               if (!\Hash::check($request->password, $userDataEmail->password)) {
                    return redirect()->back()->with('error','Incorrect Password');
                }

                Auth::login($userDataEmail);
                return redirect()->route('admin.dashboard');
            }else{
                 return back()->with("error","Admin Credential is wrong");
            }
        
    }








/** 
*   Description : logout
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function logout(Request $request) {
      Auth::logout();
      return redirect()->route('admin.login.view');
    }











/** 
*   Description : forget password page load 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function forgetpassword_enter_mail_page(){
       return view('admin.fgp.enter_mail');
    }









/** 
*   Description : fgp part 1 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function code_gen(Request $request){
     // dd($request->all());
      $srch=User::where('email',$request->email)->where('role_id',1)->first();
      if($srch){
          $code=mt_rand(100000,999999);
          $upd=User::where('id',$srch->id)->update(['email_vcode'=>$code]);
            $data = [
                  'email'=>$srch->email,
                  'name'=>$srch->name,
                  'email_vcode'=>$code,
                  'id'=>$srch->id,
                  'type'=>'admin'
              ];
            Mail::send(new AdminForgetPassword($data));
              return back()->with('success','A reset password link send to your email');

      }else{
          return back()->with('error','Email is wrong');
      }
    }










/** 
*   Description : fgp part 2 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
   public function resetPassowrd($id,$vcode){
       $data = User::where('email_vcode',$vcode)->where('id',$id)->first();
       // dd($data);
       if ($data===null) {
          return redirect()->route('admin.login.view')->with('error','Link expired');
       }
       return view('admin.fgp.newpass',compact('data'));
    }











/** 
*   Description : fgp part 3 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function newPassword(Request $request){
        // dd($request->all());
        $password = $request->input('password'); 
        $updatepassword = User::where('id',$request->id)->update([
            'password'=>Hash::make($password),
            'email_vcode'=>''
        ]); 
        return redirect()->route('admin.login.view')->with('success','Password changed successfully');
    }









































}

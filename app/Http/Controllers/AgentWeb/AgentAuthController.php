<?php

namespace App\Http\Controllers\AgentWeb;

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
use App\Mail\AgentForgetPassword;
use App\Mail\AgentLoginOtp;

class AgentAuthController extends Controller
{
  






/** 
*   Description : Agent reg page load
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function registration_page(){
        return view('Agent.Auth.registration');
    }






/** 
*   Description : Agent reg of customer
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function registration(Request $request){
       $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);

       //check that email already exist or not
       $chk1=User::where('email',$request->email)->first();
       if($chk1){
        return back()->with('error','Email already exists');
       }
       //check that mobile already exist or not
       $chk2=User::where('mobile',$request->mobile)->first();
       if($chk2){
        return back()->with('error','Mobile number already exists');
       }

       $user=new User;
       $user->name=$request->name;
       $user->email=$request->email;
       $user->password=Hash::make($request->password);
       $user->mobile=$request->mobile;
       $user->platform_type="web";
       $user->role_id=4;
       $user->status="U";
       $user->is_agent="Y";
       $user->save();

       $userDetails=User::where('id',$user->id)->first();
       
        Auth::login($userDetails);
        return redirect()->route('agent.dashboard');


    }









/** 
*   Description : / route load login or dashboard
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function first_route(){
        // dd(Auth::user());
        if(@Auth::user()->id){
             return redirect()->route("agent.dashboard");
        }else{
            return redirect()->route("agent.login.view");
        }
    }







/** 
*   Description :login page load 
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function login_page(){
        return view("Agent.Auth.login");
    }








/** 
*   Description : customer dashboard load 
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function dashboard(){
        return view("Agent.Dashboard.dashboard");
    }











/** 
*   Description : login 
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function login(Request $request){
       //for customer
        if($request->user_type=="customer"){
            $userDataEmail=User::where('email',$request->email)->whereIn("role_id",[4,2])->where('is_agent','Y')->first();
            // dd($userDataEmail);
            if ($userDataEmail) {
               if (!\Hash::check($request->password, $userDataEmail->password)) {
                    return redirect()->back()->with('error','Incorrect Password');
                }

                // if (@$userDataEmail->status=="I") {
                //    return redirect()->back()->with('error','User status is correnty inactive');
                // }
                // if (@$userDataEmail->status=="U") {
                //    return redirect()->back()->with('error','User status is correnty unverified.');
                // }
                
                Auth::login($userDataEmail);
                return redirect()->route('agent.dashboard');
            }else{
                 return back()->with("error","Agent Credential is wrong");
            }
        }
    }








/** 
*   Description : logout
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function logout(Request $request) {
      Auth::logout();
      return redirect()->route('agent.login.view');
    }











/** 
*   Description : forget password page load 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function forgetpassword_enter_mail_page(){
       return view('Agent.fgp.enter_mail');
    }









/** 
*   Description : fgp part 1 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function code_gen(Request $request){
     // dd($request->all());
      $srch=User::where('email',$request->email)->whereIn('role_id',[2,4])->where('is_agent','Y')->first();
      if($srch){
          $code=mt_rand(100000,999999);
          $upd=User::where('id',$srch->id)->update(['email_vcode'=>$code]);
            $data = [
                  'email'=>$srch->email,
                  'name'=>$srch->name,
                  'email_vcode'=>$code,
                  'id'=>$srch->id,
              ];
            Mail::send(new AgentForgetPassword($data));
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
       if ($data===null) {
          return redirect()->route('agent.login.view')->with('error','Link expired');
       }
       return view('Agent.fgp.newpass',compact('data'));
    }











/** 
*   Description : fgp part 3 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function newPassword(Request $request){
        $password = $request->input('password'); 
        $updatepassword = User::where('id',$request->id)->update([
            'password'=>Hash::make($password),
            'email_vcode'=>''
        ]); 
        return redirect()->route('agent.login.view')->with('success','Password changed successfully');
    }













/** 
*   Description : social logins part 1 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
//social login
      public function redirectToProvider($user_type,$provider_type)
    {
        if($provider_type =='facebook'){
            // dd(10);
            $config = [
                'client_id' => env('FACEBOOK_CLIENT_ID'),
                'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
                'redirect' => route('login.social.callback', ['user_type' => $user_type, 'provider_type' => $provider_type]),
            ];

            $provider = Socialite::buildProvider(
                FacebookProvider::class,
                $config
            );
        }
        else if($provider_type=='google'){

            $config = [
                'client_id' => env('GOOGLE_CLIENT_ID'),
                'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                'redirect' => route('login.social.callback', ['user_type' => $user_type, 'provider_type' => $provider_type]),
            ];

            $provider = Socialite::buildProvider(
                GoogleProvider::class,

                $config
            );

        }


        return $provider->redirect();
    }
















/** 
*   Description : social login part 2 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
     public function handleProviderCallback($user_type,$provider_type)
    {
        if ($provider_type == 'facebook') {
            $config = [
                'client_id' => env('FACEBOOK_CLIENT_ID'),
                'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
                'redirect' => route('login.social.callback', ['user_type' => $user_type, 'provider_type' => $provider_type]),
            ];

            $provider = Socialite::buildProvider(
                FacebookProvider::class,
                $config
            );
        } else if ($provider_type == 'google') {
            $config = [
                'client_id' => env('GOOGLE_CLIENT_ID'),
                'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                'redirect' => route('login.social.callback', ['user_type' => $user_type, 'provider_type' => $provider_type]),
            ];

            $provider = Socialite::buildProvider(
                GoogleProvider::class,

                $config
            );
        }

        //userDeatils from social sites
        $user = $provider->user();

        //for customer login and registration
        if($user_type=="user"){
            if($provider_type=="facebook"){
                //search that email and id exisst or not
                $srch=User::where('platform_id',$user->id)->where('platform_type','facebook')->where('role_id',2)->first();
                if($srch){
                    //login
                    Auth::login($srch);
                    return redirect()->route('cust.dashboard')->with('success','facebook login successful'); 
                }else{
                    //registration
                   $userIns=new User;
                   $userIns->name=$user->name;
                   $userIns->email=$user->email;
                   $userIns->password="123456";
                   $userIns->mobile=@$user->mobile;
                   $userIns->platform_type="facebook";
                   $userIns->platform_id=$user->id;
                   $userIns->role_id=2;
                   $userIns->save();

                   $userDetails=User::where('id',$userIns->id)->first();
                   
                    Auth::login($userDetails);
                    return redirect()->route('cust.dashboard')->with('success','reg and login successful using fb');
                }

            }// if fb
            else{
            //for google
                 //search that email and id exisst or not
                $srch=User::where('platform_id',$user->id)->where('platform_type','google')->where('role_id',2)->first();
                if($srch){
                    //login
                    Auth::login($srch);
                    return redirect()->route('cust.dashboard')->with('success','google login successful'); 
                }else{
                    //registration
                   $userIns=new User;
                   $userIns->name=$user->name;
                   $userIns->email=$user->email;
                   $userIns->password="123456";
                   $userIns->mobile=@$user->mobile;
                   $userIns->platform_type="google";
                   $userIns->platform_id=$user->id;
                   $userIns->role_id=2;
                   $userIns->save();

                   $userDetails=User::where('id',$userIns->id)->first();
                   
                    Auth::login($userDetails);
                    return redirect()->route('cust.dashboard')->with('success','reg and login successful using google');
                }

            }


        }
        dd($user,$user_type,$provider_type);

    }
















/** 
*   Description : login through otp - enter mail page load
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
public function login_otp_enter_mail(){
   return view('Agent.Auth.otp_one');
}








/** 
*   Description : login through otp - otp sent
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
public function login_sent_otp(Request $request){
    $request->validate([
        'credential' => 'required',
    ]);

    $srch=User::where('email',$request->credential)->orWhere('mobile',$request->credential)->first();
      if($srch){
          $code=mt_rand(100000,999999);
          $upd=User::where('id',$srch->id)->update(['otp'=>$code]);
            $data = [
                  'email'=>$srch->email,
                  'name'=>$srch->name,
                  'otp'=>$code,
                  'id'=>$srch->id,
              ];
            Mail::send(new AgentLoginOtp($data));
            return redirect()->route('agent.login.enter.otp.page')->with('success','otp send to your email');
              // return back()->with('success','otp send to your email');

      }else{
          return back()->with('error','user not found.');
      }
   
}










/** 
*   Description : login through otp - load enter otp page
*   Author      : JEET
*   Date        : 2022-02-06
**/
public function login_enter_otp_page(){
    return view('Agent.Auth.otp_two');
}







/** 
*   Description : login through otp - login after otp submit
*   Author      : JEET
*   Date        : 2022-02-06
**/
public function login_enter_otp_submit(Request $request){
     $request->validate([
        'otp' => 'required',
    ]);
     // dd($request->otp);
     $srch=User::where('otp',$request->otp)->whereIn('role_id',[2,4])->where('is_agent','Y')->first();
     if(!$srch){
        return back()->with('error','otp is wrong');
     }else{
        $userDetails=User::where('otp',$request->otp)->whereIn('role_id',[2,4])->where('is_agent','Y')->first();
        $updatepassword = User::where('id',$userDetails->id)->update([
            'otp'=>null
        ]); 
        Auth::login($userDetails);
         return redirect()->route('agent.dashboard');
     }
}













}

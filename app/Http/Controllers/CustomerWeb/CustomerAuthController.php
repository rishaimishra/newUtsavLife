<?php

namespace App\Http\Controllers\CustomerWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use Mail;
use App\Mail\CustomerForgetPassword;
use Laravel\Socialite\Two\FacebookProvider;
use Socialite;
use Laravel\Socialite\Two\GoogleProvider;
use Cache;
use Carbon\Carbon;
use App\Mail\CustomerLoginOtp;
use Location;
use App\Models\VandorShopAddress;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Models\Package;



class CustomerAuthController extends Controller
{





/**
*   Description : reg page load
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function registration_page(){
        return view('Customer.Auth.registration');
    }






/**
*   Description : reg of customer
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function registration(Request $request){
        // dd($request->all());
        // dd($request->session()->get('randmon_number'));
       $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);


        if($request->agent_id && $request->agent_email){
        //search_valid_agent
        $srchAgent=User::where('id',$request->agent_id)->where('role_id',4)->where('email',$request->agent_email)->first();
          // dd($srchAgent);
            if(!$srchAgent){
                return back()->with('error','Invalid Agest');
            }
        }

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
       $user->role_id=2;
       $user->save();
       $userId=$user->id;


      // // $ip = $request->ip();
        // $ip = '116.193.141.116'; /* Static IP address */
        // $currentUserInfo = Location::get($ip);
       //  // dd($currentUserInfo, $ip);

         $upd=[];
         // $upd['country']=$currentUserInfo->countryName;
         // $upd['state']=$currentUserInfo->regionName;
         // $upd['city']=$currentUserInfo->cityName;
         // $upd['zip']=$currentUserInfo->zipCode;
         // $update=User::where('id',$user->id)->update($upd);



        $upd['reg_by_agent_id']=$request->agent_id;
        $update=User::where('id',$userId)->update($upd);

         if($request->agent_id && $request->agent_email){
            return redirect()->route('agent.reg.list')->with('success','Please Login on customer panel with that given credential while register.');
         }


              //  if cart table has its own system mac no
                // $MAC = exec('getmac');
                // Storing 'getmac' value in $MAC
                // $MAC2 = strtok($MAC, ' ');
                // $MAC2=$request->ip();

               // if there is any session and cart table has that session
           if($request->session()->has('randmon_number')){
               $MAC2= $request->session()->get('randmon_number');

                $srchCart=Cart::where('system_id',$MAC2)->get();
                if(count($srchCart)>0){
                    //update those data with user id
                    $update=Cart::where('system_id',$MAC2)->update(['user_id'=>$user->id,'system_id'=>0]);
                }
                 $request->session()->forget('randmon_number');
            }


       $userDetails=User::where('id',$user->id)->first();
        Auth::login($userDetails);
        return redirect()->route('cust.dashboard');


    }









/**
*   Description : / route load login or dashboard
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function first_route(){
        // dd(Auth::user());
        if(@Auth::user()->id){
             return redirect()->route("cust.dashboard");
        }else{
            // return redirect()->route("cust.login.view");
            return redirect()->route("cust.dashboard");
        }
    }







/**
*   Description :login page load
*   Author      : JEET
*   Date        : 2022-02-06
**/
      public function login_page(Request $request){
         // Get the previous page Url
        $previousUrl = URL::previous();


        //  // Remove the "GO-Party/" part from the previous URL
        $cleanedPreviousUrl = str_replace('GO-Party/', '', $previousUrl);

        // // Match the previous URL with the routes and get the route name
        $prevRutNm = Route::getRoutes()->match(app('request')->create($cleanedPreviousUrl))->getName();

        // // dd($prevRutNm,1);
        $check=0;
        if( $prevRutNm== "cust.registration.view"
         || $prevRutNm== "cust.login.view"
         || $prevRutNm== "cust.fgp.enter.mail.page"
         || $prevRutNm== "cust.forget.password.email.verify"
         || $prevRutNm== "cust.login.otp.enter.mail"
         || $prevRutNm== "cust.login.enter.otp.page"

         ){
            $check=1;
        }

        if (str_contains($prevRutNm, 'agent')) {
          $check = 1;
        }

        if (str_contains($prevRutNm, 'vandor')) {
          $check = 1;
        }


        //if check=1 then redirect to customer dashboard else redirect to prev route

        // if(url()->previous()!="http://localhost/GO-Party/customer/login"){
        if( $check==0){
             // dd(url()->previous());
          $data['prev_url']=url()->previous();
          if (@Auth::user())
            {
                // dd(1);
                return redirect()->route('cust.dashboard');
            }
            else
            {
                // dd(2);
                   return view("Customer.Auth.login")->with($data);
            }
        }


        if (@Auth::user())
        {
            // dd(1);
            return redirect()->route('cust.dashboard');
        }
        else
        {
            // dd(2);
               return view("Customer.Auth.login");
        }
        // return view("Customer.Auth.login");
    }








/**
*   Description : customer dashboard load
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function dashboard(Request $request){
        // dd(1);

        // if(@Auth::user()->id && @Auth::user()->role_id==3){
        //     return redirect()->route('vandor.dashboard');
        // }

        // if(@Auth::user()->id && @Auth::user()->role_id==4){
        //     return redirect()->route('agent.dashboard');
        // }


        if(@Auth::user()->id && @Auth::user()->role_id==2){
            //first check past data and delete those.
            $allPastData=Cart::where('order_date','<',Date('Y-m-d'))->where('user_id',Auth::user()->id)->orderBy('id','desc')->pluck('id')->toArray();
            // dd($allPastData);
            if(count($allPastData)>0){
                // dd(1);
                //delete
                $allPastData=Cart::where('order_date','<',Date('Y-m-d'))->whereIn('id',$allPastData)->where('user_id',Auth::user()->id)->orderBy('id','desc')->delete();
           }
        }
        $hpData = CustomerHomeController::HomePage(@Auth::user()->id, $request);
        $packages = Package::where('status','!=','D')->OrderBy('id','DESC')->get();

        return view("Customer.Dashboard.dashboard")->with(compact('hpData','packages'));
    }











/**
*   Description : login
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function login(Request $request){
       //for customer
        if($request->user_type=="customer"){

            // dd(url()->previous());
            $userDataEmail=User::where('email',$request->email)->where("role_id",2)->first();
            if ($userDataEmail) {
               if (!\Hash::check($request->password, $userDataEmail->password)) {
                    return redirect()->back()->with('error','Incorrect Password');
                }

                //if cart table has its own system mac no
                // $MAC = exec('getmac');
                // Storing 'getmac' value in $MAC
                // $MAC2 = strtok($MAC, ' ');
                // $MAC2=$request->ip();


           // if there is any session and cart table has that session
           if($request->session()->has('randmon_number')){
               $MAC2= $request->session()->get('randmon_number');
                $srchCart=Cart::where('system_id',$MAC2)->get();
                if(count($srchCart)>0){
                    //update those data with user id
                    $update=Cart::where('system_id',$MAC2)->update(['user_id'=>$userDataEmail->id,'system_id'=>0]);
                }
                 $request->session()->forget('randmon_number');
            }




                // if (@$userDataEmail->status=="I") {
                //    return redirect()->back()->with('error','User status is correnty inactive');
                // }
                // if (@$userDataEmail->status=="U") {
                //    return redirect()->back()->with('error','User status is correnty unverified.');
                // }

                Auth::login($userDataEmail);
                // return redirect()->route('cust.dashboard');
                if(@$request->prev_url!=""){
                  return redirect()->to($request->prev_url);
                 }
                 return redirect()->route('cust.dashboard');
            }else{
                 return back()->with("error","Customer Credential is wrong");
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
      return redirect()->route('cust.login.view');
    }











/**
*   Description : forget password page load
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function forgetpassword_enter_mail_page(){
       return view('Customer.fgp.enter_mail');
    }









/**
*   Description : fgp part 1
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function code_gen(Request $request){
     // dd($request->all());
      $srch=User::where('email',$request->email)->where('role_id',2)->first();
      if($srch){
          $code=mt_rand(100000,999999);
          $upd=User::where('id',$srch->id)->update(['email_vcode'=>$code]);
            $data = [
                  'email'=>$srch->email,
                  'name'=>$srch->name,
                  'email_vcode'=>$code,
                  'id'=>$srch->id,
              ];
            Mail::send(new CustomerForgetPassword($data));
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
          return redirect()->route('cust.login.view')->with('error','Link expired');
       }
       return view('Customer.fgp.newpass',compact('data'));
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
         return redirect()->route('cust.login.view')->with('success','Password changed successfully');
    }













/**
*   Description : social logins part 1
*   Author      : JEET
*   Date        : 2022-02-06
**/
//social login
      public function redirectToProvider($user_type,$provider_type, Request $request)
    {
        // dd($request->all());
        if($request->prev_url!=""){
        $request->session()->put('prev_url',$request->prev_url);
        }

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
     public function handleProviderCallback($user_type,$provider_type,Request $request)
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


        // //checking that id is exist or not
        // $checkingId=User::where('platform_id',$user->id)->first();
        // if

        //for customer login and registration
        if($user_type=="user"){
            if($provider_type=="facebook"){
                //search that email and id exisst or not
                $srch=User::where('platform_id',$user->id)->where('platform_type','facebook')->where('role_id',2)->first();
                if($srch){

                        //if cart table has its own system mac no
                        // $MAC = exec('getmac');
                        // Storing 'getmac' value in $MAC
                        // $MAC2 = strtok($MAC, ' ');
                         // $MAC2=$request->ip();

                    if($request->session()->has('randmon_number')){
                        $MAC2= $request->session()->get('randmon_number');

                        $srchCart=Cart::where('system_id',$MAC2)->get();
                        if(count($srchCart)>0){
                            //update those data with user id
                            $update=Cart::where('system_id',$MAC2)->update(['user_id'=>$srch->id,'system_id'=>0]);
                        }
                         $request->session()->forget('randmon_number');
                   }


                    //login
                    Auth::login($srch);
                    //if prev url presesnt in session
                    if ($request->session()->has('prev_url')){
                        $prev_url=$request->session()->get('prev_url');
                        $request->session()->forget('prev_url');
                        return redirect()->to($prev_url);
                    }
                    return redirect()->route('cust.dashboard')->with('success','facebook login successful');
                }else{


                     $checkingId=User::where('platform_id',$user->id)->first();
                     if($checkingId){
                        // dd("1");
                        return redirect()->route('cust.login.view')->with('error','this account already linked ');
                    }

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

                   // $ip = $request->ip();
                    // $ip = '116.193.141.116'; /* Static IP address */
                    // $currentUserInfo = Location::get($ip);
                    //  // dd($currentUserInfo, $ip);

                    //  $upd=[];
                    //  $upd['country']=$currentUserInfo->countryName;
                    //  $upd['state']=$currentUserInfo->regionName;
                    //  $upd['city']=$currentUserInfo->cityName;
                    //  $upd['zip']=$currentUserInfo->zipCode;
                    //  $update=User::where('id',$userIns->id)->update($upd);

                   $userDetails=User::where('id',$userIns->id)->first();



                    //if cart table has its own system mac no
                    // $MAC = exec('getmac');
                    // Storing 'getmac' value in $MAC
                    // $MAC2 = strtok($MAC, ' ');
                     // $MAC2=$request->ip();

                if($request->session()->has('randmon_number')){
                    $MAC2= $request->session()->get('randmon_number');

                    $srchCart=Cart::where('system_id',$MAC2)->get();
                    if(count($srchCart)>0){
                        //update those data with user id
                        $update=Cart::where('system_id',$MAC2)->update(['user_id'=>$userIns->id,'system_id'=>0]);
                    }
                     $request->session()->forget('randmon_number');
                }

                    Auth::login($userDetails);
                    return redirect()->route('cust.dashboard')->with('success','reg and login successful using fb');
                }

            }// if fb
            else{
            //for google
                 //search that email and id exisst or not
                $srch=User::where('platform_id',$user->id)->where('platform_type','google')->where('role_id',2)->first();
                if($srch){

                    //if cart table has its own system mac no
                    // $MAC = exec('getmac');
                    // Storing 'getmac' value in $MAC
                    // $MAC2 = strtok($MAC, ' ');
                     // $MAC2=$request->ip();


                if($request->session()->has('randmon_number')){
                    $MAC2= $request->session()->get('randmon_number');

                    $srchCart=Cart::where('system_id',$MAC2)->get();
                    if(count($srchCart)>0){
                        //update those data with user id
                        $update=Cart::where('system_id',$MAC2)->update(['user_id'=>$srch->id,'system_id'=>0]);
                    }
                    $request->session()->forget('randmon_number');
                }

                    //login
                    Auth::login($srch);
                     //if prev url presesnt in session
                    if ($request->session()->has('prev_url')){
                        $prev_url=$request->session()->get('prev_url');
                        $request->session()->forget('prev_url');
                        return redirect()->to($prev_url);
                    }
                    return redirect()->route('cust.dashboard')->with('success','google login successful');
                }else{


                     $checkingId=User::where('platform_id',$user->id)->first();
                     if($checkingId){
                        // dd("1");
                        return redirect()->route('cust.login.view')->with('error','this account already linked ');
                    }
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

                    // $ip = $request->ip();
                    // $ip = '116.193.141.116'; /* Static IP address */
                    // $currentUserInfo = Location::get($ip);
                    //  // dd($currentUserInfo, $ip);

                    //  $upd=[];
                    //  $upd['country']=$currentUserInfo->countryName;
                    //  $upd['state']=$currentUserInfo->regionName;
                    //  $upd['city']=$currentUserInfo->cityName;
                    //  $upd['zip']=$currentUserInfo->zipCode;
                    //  $update=User::where('id',$userIns->id)->update($upd);


                     //if cart table has its own system mac no
                        // $MAC = exec('getmac');
                        // Storing 'getmac' value in $MAC
                        // $MAC2 = strtok($MAC, ' ');
                         // $MAC2=$request->ip();
                    if($request->session()->has('randmon_number')){
                        $MAC2= $request->session()->get('randmon_number');

                        $srchCart=Cart::where('system_id',$MAC2)->get();
                        if(count($srchCart)>0){
                            //update those data with user id
                            $update=Cart::where('system_id',$MAC2)->update(['user_id'=>$userIns->id,'system_id'=>0]);
                        }
                         $request->session()->forget('randmon_number');
                    }

                   $userDetails=User::where('id',$userIns->id)->first();

                    Auth::login($userDetails);
                    return redirect()->route('cust.dashboard')->with('success','reg and login successful using google');
                }

            }


        }
        // vandor
        elseif($user_type=="vandor"){
            if($provider_type=="facebook"){
                //search that email and id exisst or not
                $srch=User::where('platform_id',$user->id)->where('platform_type','facebook')->where('role_id',3)->first();
                if($srch){
                    //search that vandor has the shop address
                    $srchAddress=VandorShopAddress::where('vandor_id',$srch->id)->first();
                    if(!$srchAddress){
                         return redirect()->route('vandor.shop.address.page',[$srch->id,$srch->email])->with('success','Please fill up following information to complete the sign up process.');
                    }
                    //login
                    Auth::login($srch);
                    return redirect()->route('vandor.dashboard')->with('success','facebook login successful for vandor');
                }else{
                    // //checking that id is exist or not
                    $checkingId=User::where('platform_id',$user->id)->first();
                     if($checkingId){
                        // dd("1");
                        return redirect()->route('vandor.login.view')->with('error','this account already linked ');
                    }


                    //registration
                   $userIns=new User;
                   $userIns->name=$user->name;
                   $userIns->email=$user->email;
                   $userIns->password="123456";
                   $userIns->mobile=@$user->mobile;
                   $userIns->platform_type="facebook";
                   $userIns->platform_id=$user->id;
                   $userIns->role_id=3;
                   $userIns->status='U';
                   $userIns->save();


                    // $ip = $request->ip();
                    // $ip = '116.193.141.116'; /* Static IP address */
                    // $currentUserInfo = Location::get($ip);
                    //  // dd($currentUserInfo, $ip);

                    //  $upd=[];
                    //  $upd['country']=$currentUserInfo->countryName;
                    //  $upd['state']=$currentUserInfo->regionName;
                    //  $upd['city']=$currentUserInfo->cityName;
                    //  $upd['zip']=$currentUserInfo->zipCode;
                    //  $update=User::where('id',$userIns->id)->update($upd);

                   // $userDetails=User::where('id',$userIns->id)->first();
                    // Auth::login($userDetails);

                    return redirect()->route('vandor.shop.address.page',[$userIns->id,$user->email])->with('success','Please fill up following information to complete the sign up process.');
                }

            }// if fb
            else{
            //for google
                 //search that email and id exisst or not
                $srch=User::where('platform_id',$user->id)->where('platform_type','google')->where('role_id',3)->first();
                if($srch){
                    //search that vandor has the shop address
                    $srchAddress=VandorShopAddress::where('vandor_id',$srch->id)->first();
                    if(!$srchAddress){
                         return redirect()->route('vandor.shop.address.page',[$srch->id,$srch->email])->with('success','Please fill up following information to complete the sign up process.');
                    }
                    //login
                    Auth::login($srch);
                    return redirect()->route('vandor.dashboard')->with('success','google login successful for vandor');
                }else{

                     $checkingId=User::where('platform_id',$user->id)->first();
                     if($checkingId){
                        // dd("1");
                        return redirect()->route('vandor.login.view')->with('error','this account already linked ');
                    }

                    //registration
                   $userIns=new User;
                   $userIns->name=$user->name;
                   $userIns->email=$user->email;
                   $userIns->password="123456";
                   $userIns->mobile=@$user->mobile;
                   $userIns->platform_type="google";
                   $userIns->platform_id=$user->id;
                   $userIns->role_id=3;
                   $userIns->status='U';
                   $userIns->save();



                    // $ip = $request->ip();
                   //  $ip = '116.193.141.116'; /* Static IP address */
                   //  $currentUserInfo = Location::get($ip);
                   //   // dd($currentUserInfo, $ip);

                   //   $upd=[];
                   //   $upd['country']=$currentUserInfo->countryName;
                   //   $upd['state']=$currentUserInfo->regionName;
                   //   $upd['city']=$currentUserInfo->cityName;
                   //   $upd['zip']=$currentUserInfo->zipCode;
                   //   $update=User::where('id',$userIns->id)->update($upd);

                   // $userDetails=User::where('id',$userIns->id)->first();

                   //  Auth::login($userDetails);
                   //  return redirect()->route('vandor.dashboard')->with('success','reg and login successful using google for vandor');

                   return redirect()->route('vandor.shop.address.page',[$userIns->id,$user->email])->with('success','Please fill up following information to complete the sign up process.');
                }

            }


        }

        //Agent
         else{
            if($provider_type=="facebook"){
                //search that email and id exisst or not
                $srch=User::where('platform_id',$user->id)->where('platform_type','facebook')->whereIn('role_id',[2,4])->first();
                if($srch){
                    //login
                    Auth::login($srch);
                    return redirect()->route('agent.dashboard')->with('success','facebook login successful for agent');
                }else{

                     // //checking that id is exist or not
                    $checkingId=User::where('platform_id',$user->id)->first();
                    if($checkingId){
                        // dd("1");
                        return redirect()->route('agent.login.view')->with('error','this account already linked ');
                    }


                    //registration
                   $userIns=new User;
                   $userIns->name=$user->name;
                   $userIns->email=$user->email;
                   $userIns->password="123456";
                   $userIns->mobile=@$user->mobile;
                   $userIns->platform_type="facebook";
                   $userIns->platform_id=$user->id;
                   $userIns->role_id=4;
                    $userIns->status='U';
                     $userIns->is_agent="Y";
                   $userIns->save();


                    // $ip = $request->ip();
                    // $ip = '116.193.141.116'; /* Static IP address */
                    // $currentUserInfo = Location::get($ip);
                    //  // dd($currentUserInfo, $ip);

                    //  $upd=[];
                    //  $upd['country']=$currentUserInfo->countryName;
                    //  $upd['state']=$currentUserInfo->regionName;
                    //  $upd['city']=$currentUserInfo->cityName;
                    //  $upd['zip']=$currentUserInfo->zipCode;
                    //  $update=User::where('id',$userIns->id)->update($upd);

                   $userDetails=User::where('id',$userIns->id)->first();

                    Auth::login($userDetails);
                    return redirect()->route('agent.dashboard')->with('success','reg and login successful using fb for agent');
                }

            }// if fb
            else{
            //for google
                 //search that email and id exisst or not
                $srch=User::where('platform_id',$user->id)->where('platform_type','google')->whereIn('role_id',[2,4])->first();
                if($srch){
                    //login
                    Auth::login($srch);
                    return redirect()->route('agent.dashboard')->with('success','google login successful for agent');
                }else{

                    // //checking that id is exist or not
                    $checkingId=User::where('platform_id',$user->id)->first();
                    if($checkingId){
                        // dd("1");
                        return redirect()->route('agent.login.view')->with('error','this account already linked ');
                    }

                    //registration
                   $userIns=new User;
                   $userIns->name=$user->name;
                   $userIns->email=$user->email;
                   $userIns->password="123456";
                   $userIns->mobile=@$user->mobile;
                   $userIns->platform_type="google";
                   $userIns->platform_id=$user->id;
                   $userIns->role_id=4;
                    $userIns->status='U';
                     $userIns->is_agent="Y";
                   $userIns->save();


                    // $ip = $request->ip();
                    // $ip = '116.193.141.116'; /* Static IP address */
                    // $currentUserInfo = Location::get($ip);
                    //  // dd($currentUserInfo, $ip);

                    //  $upd=[];
                    //  $upd['country']=$currentUserInfo->countryName;
                    //  $upd['state']=$currentUserInfo->regionName;
                    //  $upd['city']=$currentUserInfo->cityName;
                    //  $upd['zip']=$currentUserInfo->zipCode;
                    //  $update=User::where('id',$userIns->id)->update($upd);

                   $userDetails=User::where('id',$userIns->id)->first();

                    Auth::login($userDetails);
                    return redirect()->route('agent.dashboard')->with('success','reg and login successful using google for agent');
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
   return view('Customer.Auth.otp_one');
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
            Mail::send(new CustomerLoginOtp($data));
            return redirect()->route('cust.login.enter.otp.page')->with('success','otp send to your email');
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
    return view('Customer.Auth.otp_two');
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
     $srch=User::where('otp',$request->otp)->where('role_id',2)->first();
     if(!$srch){
        return back()->with('error','otp is wrong');
     }else{
        $userDetails=User::where('otp',$request->otp)->where('role_id',2)->first();
        $updatepassword = User::where('id',$userDetails->id)->update([
            'otp'=>null
        ]);
        Auth::login($userDetails);
         return redirect()->route('cust.dashboard');
     }
}













}

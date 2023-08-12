<?php

namespace App\Http\Controllers\CustomerWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\CustomerBankDetailsModel;
use Mail;
use App\Mail\CustomerLoginOtp;

class CustomerProfileController extends Controller
{
    


/** 
*   Description : customer profile page
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function profile_page(){
        if(@Auth::user()->id && @Auth::user()->role_id==3){
            return redirect()->route('vandor.dashboard');
        }

        if(@Auth::user()->id && @Auth::user()->role_id==4){
            return redirect()->route('agent.dashboard');
        }
        $data['bankDetails']=CustomerBankDetailsModel::where('customer_id',Auth()->user()->id)->first();
        $data['userDetails']=User::where('id',Auth()->user()->id)->first();
       return view('Customer.profile.edit_profile_view')->with($data);
    }


    public function profile_page_edit(){
         if(@Auth::user()->id && @Auth::user()->role_id==3){
            return redirect()->route('vandor.dashboard');
        }

        if(@Auth::user()->id && @Auth::user()->role_id==4){
            return redirect()->route('agent.dashboard');
        }
         $data['bankDetails']=CustomerBankDetailsModel::where('customer_id',Auth()->user()->id)->first();
        $data['userDetails']=User::where('id',Auth()->user()->id)->first();
       return view('Customer.profile.edit_profile')->with($data);
    }





    public function my_dashboard(){
         if(@Auth::user()->id && @Auth::user()->role_id==3){
            return redirect()->route('vandor.dashboard');
        }

        if(@Auth::user()->id && @Auth::user()->role_id==4){
            return redirect()->route('agent.dashboard');
        }
        return view('Customer.profile.all_profile_tabs');
    }







/** 
*   Description : customer profile page update
*   Author      : JEET
*   Date        : 2022-02-06
**/ 

    public function profile_update(Request $request){
        // dd($request->all());
         $request->validate([
            'name' => 'required',
            // 'bank_name' => 'required',
            // 'acc_no' => 'required',
            // 'ifsc_no' => 'required',
            // 'holder_name' => 'required',
            // 'country' => 'required',
            // 'state' => 'required',
            // 'city' => 'required',
            // 'zip' => 'required',
        ]);

         $upd=[];
         $upd['name']=$request->name;
         // $upd['country']=$request->country;
         // $upd['state']=$request->state;
         // $upd['city']=$request->city;
         // $upd['zip']=$request->zip;
        if($request->img){
          $image = $request->img;
          $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
          $image->move("storage/app/public/customer",$filename);

          $upd['avatar']=$filename;
        }
        $updateProfile=User::where('id',Auth()->user()->id)->update($upd);



        //update Bank details
        $srchBank=CustomerBankDetailsModel::where('customer_id',Auth()->user()->id)->first();
        if($srchBank){
            //update
            $upd2=[];
            $upd2['bank_name']=$request->bank_name;
            $upd2['acc_no']=$request->acc_no;
            $upd2['ifsc_no']=$request->ifsc_no;
            $upd2['holder_name']=$request->holder_name;

            $updateBank=CustomerBankDetailsModel::where('customer_id',Auth()->user()->id)->update($upd2);

        }else{
            //add
            $bankIns=new CustomerBankDetailsModel;
            $bankIns->customer_id=Auth()->user()->id;
            $bankIns->bank_name=$request->bank_name;
            $bankIns->acc_no=$request->acc_no;
            $bankIns->ifsc_no=$request->ifsc_no;
            $bankIns->holder_name=$request->holder_name;
            $bankIns->save();
        }

        return back()->with('success','Updated');

    }








/** 
*   Description : next 4 function is mobile number update part
*   Author      : JEET
*   Date        : 2022-02-06
**/ 

public function update_mobile_page(){
    return view('Customer.profile.update_mobile');
}





public function update_mobile_otp_page(){
 return view('Customer.profile.update_mobile_otp');   
}






public function update_mobile_otp_sent(Request $request){
    // dd($request->all());
    $request->validate([
            'mobile' => 'required',
    ]);

    $chk=User::where('mobile',$request->mobile)->where('id','!=',Auth()->user()->id)->first();
    if($chk){
        return back()->with('error','This number already exists');
    }

     $code=mt_rand(100000,999999);
      $upd=User::where('id',Auth()->user()->id)->update(['temp_mobile'=>$request->mobile,'otp'=>$code]);
      //sent msg

     return redirect()->route('cust.mobile.update.otp.page')->with('success','enter otp sent to your mobile');
}








public function update_mobile_otp_verify(Request $request){
     $request->validate([
        'otp' => 'required',
    ]);

     $check=User::where('id',Auth()->user()->id)->where('otp',$request->otp)->first();
     if(!$check){
       return redirect()->route('cust.mobile.update.otp.page')->with('error','enter otp is wrong');
     }else{
        $newMobile=$check->temp_mobile;
        $upd=[];
        $upd['temp_mobile']=null;
        $upd['otp']=null;
        $upd['mobile']= $newMobile;
        $update=User::where('id',Auth()->user()->id)->update($upd);

        return redirect()->route('cust.update.mobile.page')->with('success','mobile number updated');
     }
}




















/** 
*   Description : next 4 function is email number update part
*   Author      : JEET
*   Date        : 2022-02-06
**/ 

public function update_email_page(){
    return view('Customer.profile.update_email');
}





public function update_email_otp_page(){
 return view('Customer.profile.update_email_otp');   
}






public function update_email_otp_sent(Request $request){
    // dd($request->all());
    $request->validate([
            'email' => 'required',
    ]);

    $chk=User::where('email',$request->email)->where('id','!=',Auth()->user()->id)->first();
    if($chk){
        return back()->with('error','This number already exists');
    }

     $code=mt_rand(100000,999999);
      $upd=User::where('id',Auth()->user()->id)->update(['temp_email'=>$request->email,'otp'=>$code]);
       $data = [
                  'email'=>$request->email,
                  'name'=>Auth()->user()->name,
                  'otp'=>$code,
              ];
       Mail::send(new CustomerLoginOtp($data));

     return redirect()->route('cust.email.update.otp.page')->with('success','enter otp sent to your email');
}








public function update_email_otp_verify(Request $request){
     $request->validate([
        'otp' => 'required',
    ]);

     $check=User::where('id',Auth()->user()->id)->where('otp',$request->otp)->first();
     if(!$check){
       return redirect()->route('cust.email.update.otp.page')->with('error','enter otp is wrong');
     }else{
        $newemail=$check->temp_email;
        $upd=[];
        $upd['temp_email']=null;
        $upd['otp']=null;
        $upd['email']= $newemail;
        $update=User::where('id',Auth()->user()->id)->update($upd);

        return redirect()->route('cust.update.email.page')->with('success','email number updated');
     }
}






public function about_us(){
    return view('Customer.static.aboutus');
}


public function contact_us(){
     return view('Customer.static.contactus');
}




}

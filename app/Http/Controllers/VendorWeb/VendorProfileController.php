<?php

namespace App\Http\Controllers\VendorWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Vendor_services;
use App\Models\Services;
use App\Models\VendorBankDetailsModel;
use Mail;
use App\Mail\VendorLoginOtp;
use App\Models\VandorShopAddress;
use App\Models\VandorDetailsModel;

class VendorProfileController extends Controller
{
    




/** 
*   Description : vandor profile page
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function profile_page(){
        $data['bankDetails']=VendorBankDetailsModel::where('vandor_id',Auth()->user()->id)->first();
        $data['userDetails']=User::where('id',Auth()->user()->id)->first();
        $data['address']=VandorShopAddress::where('vandor_id',Auth()->user()->id)->first();
       return view('vandor.profile.edit_profile_view')->with($data);
    }




    public function profile_edit_page(){
         $data['bankDetails']=VendorBankDetailsModel::where('vandor_id',Auth()->user()->id)->first();
        $data['userDetails']=User::where('id',Auth()->user()->id)->first();
        $data['address']=VandorShopAddress::where('vandor_id',Auth()->user()->id)->first();
       return view('vandor.profile.edit_profile')->with($data);
    }







/** 
*   Description : vandor profile page update
*   Author      : JEET
*   Date        : 2022-02-06
**/ 

    public function profile_update(Request $request){
        // dd($request->all());
         $request->validate([
              'name' => 'required',
              // "pan_card" => "required",
              // "kyc_type" => "required",
              // "kyc_no" => "required",
              "pin_code" => "required",
              "house_no" => "required",
              "area" => "required",
              "landmark" => "required",
              "city" => "required",
              "state" => "required",
              // "calling_no" => "required",
              // "gst_no" => "required",
        ]);

         $upd=[];
         $upd['name']=$request->name;
         $updateProfile=User::where('id',Auth()->user()->id)->update($upd);

         $upd2=[];
          // $upd2['pan_card'] = @$request->pan_card;
          // $upd2['kyc_type'] =  $request->kyc_type;
          // $upd2['kyc_no'] =  $request->kyc_no;
          $upd2['pin_code'] =  $request->pin_code;
          $upd2['house_no'] =  $request->house_no;
          $upd2['area'] =  $request->area;
          $upd2['landmark'] =  $request->landmark;
          $upd2['city'] =  $request->city;
          $upd2['state'] =  $request->state;
          $upd2['calling_no'] =  $request->calling_no;
          $upd2['gst_no'] =  $request->gst_no;

          $updateDetails=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->update($upd2);



        // if($request->img){
        //   $image = $request->img;
        //   $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
        //   $image->move("storage/app/public/vandor/vendor_image",$filename);

        //   $upd['avatar']=$filename;
        // }
        


        //update Bank details
        // $srchBank=VendorBankDetailsModel::where('vandor_id',Auth()->user()->id)->first();
        // if($srchBank){
        //     //update
        //     $upd2=[];
        //     $upd2['bank_name']=$request->bank_name;
        //     $upd2['acc_no']=$request->acc_no;
        //     $upd2['ifsc_no']=$request->ifsc_no;
        //     $upd2['holder_name']=$request->holder_name;

        //     $updateBank=VendorBankDetailsModel::where('vandor_id',Auth()->user()->id)->update($upd2);

        // }else{
        //     //add
        //     $bankIns=new VendorBankDetailsModel;
        //     $bankIns->vandor_id=Auth()->user()->id;
        //     $bankIns->bank_name=$request->bank_name;
        //     $bankIns->acc_no=$request->acc_no;
        //     $bankIns->ifsc_no=$request->ifsc_no;
        //     $bankIns->holder_name=$request->holder_name;
        //     $bankIns->save();
        // }
        return back()->with('success','Vandor Profile Details Updated');

    }









// office_address_update 
    public function office_address_update(Request $request){
        // dd($request->all());
         $request->validate([
              "office_pincode" => "required",
              "office_house_no" => "required",
              "office_area" => "required",
              "office_landmark" => "required",
              "office_city" => "required",
              "office_state" => "required",
        ]);



         $updOfficeAddress=[];
          $updOfficeAddress['office_pincode'] = $request->office_pincode;
          $updOfficeAddress['office_house_no'] =  $request->office_house_no;
          $updOfficeAddress['office_area'] =  $request->office_area;
          $updOfficeAddress['office_landmark'] =  $request->office_landmark;
          $updOfficeAddress['office_city'] =  $request->office_city;
          $updOfficeAddress['office_state'] =  $request->office_state;;

          $updateDetails=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->update($updOfficeAddress);
          return back()->with('success','Vandor office address Details Updated');
    }









// driver_details_update
public function driver_details_update(Request $request){  //--- NOT REQ
    // dd($request->all());
     $request->validate([
              "driver_name" => "required",
              "driver_mobile_no" => "required",
              "driver_kyc_type" => "required",
              "dricer_kyc_no" => "required",
              "driver_licence_no" => "required",
        ]);



         $updDriverDetails=[];
          $updDriverDetails['driver_name'] = $request->driver_name;
          $updDriverDetails['driver_mobile_no'] =  $request->driver_mobile_no;
          $updDriverDetails['driver_kyc_type'] =  $request->driver_kyc_type;
          $updDriverDetails['dricer_kyc_no'] =  $request->dricer_kyc_no;
          $updDriverDetails['driver_licence_no'] =  $request->driver_licence_no;;

          $updateDetails=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->update($updDriverDetails);
          return back()->with('success','Vandor Driver Details Updated');
}








// driver_address_update
public function driver_address_update(Request $request){    //--- NOT REQ
    // dd($request->all());
     $request->validate([
              "driver_pincode" => "required",
              "driver_house_no" => "required",
              "driver_area" => "required",
              "driver_landmark" => "required",
              "driver_city" => "required",
              "driver_state" => "required",
        ]);



         $updDriverAddress=[];
          $updDriverAddress['driver_pincode'] = $request->driver_pincode;
          $updDriverAddress['driver_house_no'] =  $request->driver_house_no;
          $updDriverAddress['driver_area'] =  $request->driver_area;
          $updDriverAddress['driver_landmark'] =  $request->driver_landmark;
          $updDriverAddress['driver_city'] =  $request->driver_city;
          $updDriverAddress['driver_state'] =  $request->driver_state;;

          $updateDetails=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->update($updDriverAddress);
          return back()->with('success','Vandor driver address Details Updated');
}








// all_images_update

public function all_images_update(Request $request){
    // dd($request->all());
    $upd=[];
     if($request->img1){
          $image = $request->img1;
          $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
          $image->move("storage/app/public/vandor/pan_image",$filename);

          //unlink image
          $findImage=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->first();
          $path = "storage/app/public/vandor/pan_image/".$findImage->pan_image;
          unlink($path);

          $upd['pan_image']=$filename;
        }

         if($request->img2){
          $image = $request->img2;
          $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
          $image->move("storage/app/public/vandor/kyc_image",$filename);

          //unlink image
          $findImage=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->first();
          $path = "storage/app/public/vandor/kyc_image/".$findImage->kyc_image;
          unlink($path);

          $upd['kyc_image']=$filename;
        }

         if($request->img3){
          $image = $request->img3;
          $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
          $image->move("storage/app/public/vandor/vendor_image",$filename);

          //unlink image
          $findImage=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->first();
          $path = "storage/app/public/vandor/vendor_image/".$findImage->vendor_image;
          unlink($path);

          $upd['vendor_image']=$filename;
          //also update the user table
          User::where('id',$request->vandor_id)->update(['avatar'=>$filename]);
        }

         if($request->img4){
          $image = $request->img4;
          $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
          $image->move("storage/app/public/vandor/gst_image",$filename);

          //unlink image
          $findImage=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->first();
          $path = "storage/app/public/vandor/gst_image/".$findImage->gst_image;
          unlink($path);

          $upd['gst_image']=$filename;
        }

        //  if($request->img5){   //--- NOT REQ
        //   $image = $request->img5;
        //   $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
        //   $image->move("storage/app/public/vandor/dl_image",$filename);

        //   //unlink image
        //   $findImage=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->first();
        //   $path = "storage/app/public/vandor/dl_image/".$findImage->dl_image;
        //   unlink($path);

        //   $upd['dl_image']=$filename;
        // }

        //  if($request->img6){      //--- NOT REQ
        //   $image = $request->img6;
        //   $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
        //   $image->move("storage/app/public/vandor/driver_image",$filename);

        //   //unlink image
        //   $findImage=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->first();
        //   $path = "storage/app/public/vandor/driver_image/".$findImage->driver_image;
        //   unlink($path);

        //   $upd['driver_image']=$filename;
        // }

       $update=VandorDetailsModel::where('vandor_id',Auth()->user()->id)->update($upd);
         return back()->with('success','Vandor all image Updated');
}
















/** 
*   Description : next 4 function is mobile number update part
*   Author      : JEET
*   Date        : 2022-02-06
**/ 

public function update_mobile_page(){
    return view('vandor.profile.update_mobile');
}





public function update_mobile_otp_page(){
 return view('vandor.profile.update_mobile_otp');   
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

     return redirect()->route('vandor.mobile.update.otp.page')->with('success','enter otp sent to your mobile');
}








public function update_mobile_otp_verify(Request $request){
     $request->validate([
        'otp' => 'required',
    ]);

     $check=User::where('id',Auth()->user()->id)->where('otp',$request->otp)->first();
     if(!$check){
       return redirect()->route('vandor.mobile.update.otp.page')->with('error','enter otp is wrong');
     }else{
        $newMobile=$check->temp_mobile;
        $upd=[];
        $upd['temp_mobile']=null;
        $upd['otp']=null;
        $upd['mobile']= $newMobile;
        $update=User::where('id',Auth()->user()->id)->update($upd);

        return redirect()->route('vandor.update.mobile.page')->with('success','mobile number updated');
     }
}




















/** 
*   Description : next 4 function is email number update part
*   Author      : JEET
*   Date        : 2022-02-06
**/ 

public function update_email_page(){
    return view('vandor.profile.update_email');
}





public function update_email_otp_page(){
 return view('vandor.profile.update_email_otp');   
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
       Mail::send(new VendorLoginOtp($data));

     return redirect()->route('vandor.email.update.otp.page')->with('success','enter otp sent to your email');
}








public function update_email_otp_verify(Request $request){
     $request->validate([
        'otp' => 'required',
    ]);

     $check=User::where('id',Auth()->user()->id)->where('otp',$request->otp)->first();
     if(!$check){
       return redirect()->route('vandor.email.update.otp.page')->with('error','enter otp is wrong');
     }else{
        $newemail=$check->temp_email;
        $upd=[];
        $upd['temp_email']=null;
        $upd['otp']=null;
        $upd['email']= $newemail;
        $update=User::where('id',Auth()->user()->id)->update($upd);

        return redirect()->route('vandor.update.email.page')->with('success','email number updated');
     }
}









}

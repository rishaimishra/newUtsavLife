<?php

namespace App\Http\Controllers\VendorWeb;

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
use App\Mail\VandorForgetPassword;
use App\Mail\VendorLoginOtp;
use Location;
use App\Models\VandorShopAddress;
use App\Models\VandorDetailsModel;
use App\Models\Services;
use App\Models\Vendor_services;
use App\Models\Category_Crud;
use App\Models\Service_Crud;
use App\Models\VendorBankDetailsModel;
use App\Models\Order;


class VenderAuthController extends Controller
{
   




/** 
*   Description : vendor reg page load
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function registration_page(){
        // dd(1);
        if(@Auth::user()->id){
             return redirect()->route('vandor.dashboard');
         }
        else{
        return view('vandor.Auth.registration_main');
        }
    }





// reg before login which is main
    public function registration_main(Request $request){
        // dd($request->all());
          $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
           
            // 'address_address' => 'required',

            // "distance_cover"=>'required',
        ]);

       //check that email already exist or not
       $chk1=User::where('email',$request->email)->where('reg_complete','Y')->first();
       if($chk1){
        return back()->with('error','Email already exists');
       }
       //check that mobile already exist or not
       $chk2=User::where('mobile',$request->mobile)->where('reg_complete','Y')->first();
       if($chk2){
        return back()->with('error','Mobile number already exists');
       }

        //check that email already exist or not
       $chk3=User::where('email',$request->email)->whereIn('role_id',[1,2,4])->first();
       if($chk3){
        return back()->with('error','Email already exists');
       }
       //check that mobile already exist or not
       $chk4=User::where('mobile',$request->mobile)->whereIn('role_id',[1,2,4])->first();
       if($chk4){
        return back()->with('error','Mobile number already exists');
       }


       $user=new User;
       $user->name=$request->name;
       $user->email=$request->email;
       $user->password=Hash::make($request->password);
       $user->mobile=$request->mobile;
       $user->platform_type="web";
       $user->role_id=3;
       $user->status='U';
       $user->save();

        $vandorId=$user->id;



        // insert address to vandor shop address table
       $shopAddress=new VandorShopAddress;
       $shopAddress->vandor_id=$vandorId;
       $shopAddress->lat=@$request->address_latitude;
       $shopAddress->lng=@$request->address_longitude;
       $shopAddress->address_address=@$request->address_address;
       $shopAddress->distance_cover=500;  //$request->distance_cover
       $shopAddress->save();

     

        $userDetails=User::where('id',$user->id)->first();
       
        Auth::login($userDetails);
        return redirect()->route('vandor.registration.get');
        // vandor.dashboard


    }










// part one view

    public function registration_part_one_get(){
         $find=User::where('id',Auth::user()->id)->where('reg_complete','N')->where('role_id',3)->first();
        if(!$find){
             return redirect()->route('vandor.dashboard')->with('error','Already Registraion Completed');
        }
        $data['data']=$find;
        return view('vandor.Auth.registration')->with($data);
    }





/** 
*   Description : vandor reg of vandor after login
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function registration(Request $request){
        // dd($request->all());

       if($request->next){
       $request->validate([
            // 'name' => 'required',
            // 'email' => 'required',
            // 'mobile' => 'required',
            // 'password' => 'required',
            "pan_card" => "required",
              "kyc_type" => "required",
              "kyc_no" => "required",
              "pin_code" => "required",
              "house_no" => "required",
              "area" => "required",
              "landmark" => "required",
              "city" => "required",
              "state" => "required",
            // 'address_address' => 'required',
        ]);
        }

       // //check that email already exist or not
       // $chk1=User::where('email',$request->email)->where('reg_complete','Y')->first();
       // if($chk1){
       //  return back()->with('error','Email already exists');
       // }
       // //check that mobile already exist or not
       // $chk2=User::where('mobile',$request->mobile)->where('reg_complete','Y')->first();
       // if($chk2){
       //  return back()->with('error','Mobile number already exists');
       // }

       //  //check that email already exist or not
       // $chk3=User::where('email',$request->email)->whereIn('role_id',[1,2,4])->first();
       // if($chk3){
       //  return back()->with('error','Email already exists');
       // }
       // //check that mobile already exist or not
       // $chk4=User::where('mobile',$request->mobile)->whereIn('role_id',[1,2,4])->first();
       // if($chk4){
       //  return back()->with('error','Mobile number already exists');
       // }


      //find vandor whose reg is not completed
      $findVandor=User::where('id',Auth::user()->id)->where('reg_complete','N')->first();
              $vandorId=$findVandor->id;
   //    if($findVandor){
   //        $vandorId=$findVandor->id;
   //        $updt=[];

   //         $updt['name']=$request->name;
   //         $updt['password']=Hash::make($request->password);
   //         $updt['mobile']=$request->mobile;
   //         $updateUser=User::where('id',$vandorId)->update($updt);

   //    }else{
   //     $user=new User;
   //     $user->name=$request->name;
   //     $user->email=$request->email;
   //     $user->password=Hash::make($request->password);
   //     $user->mobile=$request->mobile;
   //     $user->platform_type="web";
   //     $user->role_id=3;
   //     $user->status='U';
   //     $user->save();

   //     $vandorId=$user->id;
   // }


       // // insert address to vandor shop address table
       // $shopAddress=new VandorShopAddress;
       // $shopAddress->vandor_id=$vandorId;
       // $shopAddress->lat=$request->address_latitude;
       // $shopAddress->lng=$request->address_longitude;
       // $shopAddress->address_address=$request->address_address;
       // $shopAddress->distance_cover=$request->distance_cover;
       // $shopAddress->save();

       //insert data in to vandor_details table
       $findVandorDetails=VandorDetailsModel::where('vandor_id',$vandorId)->first();
       if($findVandorDetails){
        //edit
        $upd=[];
          $upd['pan_card'] = @$request->pan_card;
          $upd['kyc_type'] = @$request->kyc_type;
          $upd['kyc_no'] = @$request->kyc_no;
          $upd['pin_code'] = @$request->pin_code;
          $upd['house_no'] = @$request->house_no;
          $upd['area'] = @$request->area;
          $upd['landmark'] = @$request->landmark;
          $upd['country'] = @$request->country;
          $upd['city'] = @$request->city;
          $upd['state'] = @$request->state;
          $update=VandorDetailsModel::where('vandor_id',$vandorId)->update($upd);
       }

       else{
        //insert
        $insone=new VandorDetailsModel;
        $insone->vandor_id = @$vandorId;
          $insone->pan_card = @$request->pan_card;
          $insone->kyc_type = @$request->kyc_type;
          $insone->kyc_no = @$request->kyc_no;
          $insone->pin_code = @$request->pin_code;
          $insone->house_no = @$request->house_no;
          $insone->area = @$request->area;
          $insone->landmark = @$request->landmark;
          $insone->country = @$request->country;
          $insone->city = @$request->city;
          $insone->state = @$request->state;
          $insone->save();
       }
      

         $data['data']=User::where('id',$vandorId)->first();
         $data['success']="Details updated & saved successfully. Please contact support team if not done by you.";
    
       if($request->btn=="save"){
         return view('vandor.Auth.registration')->with($data);
       }
       else{
        return redirect()->route('vandor.reg.two.get',["email"=>Auth::user()->email,'id'=>$vandorId])->with('success','Part 1 registration has completed , please type next to proceed');
       }


       //------ auto address--------//
        // $ip = $request->ip();
        // $ip = '116.193.141.116'; /* Static IP address */
        // $currentUserInfo = Location::get($ip);
        //  // dd($currentUserInfo, $ip);

        //  $upd=[];
        //  $upd['country']=$currentUserInfo->countryName;
        //  $upd['state']=$currentUserInfo->regionName;
        //  $upd['city']=$currentUserInfo->cityName;
        //  $upd['zip']=$currentUserInfo->zipCode;
        //  $update=User::where('id',$user->id)->update($upd);


       // $userDetails=User::where('id',$user->id)->first();
       
       //  Auth::login($userDetails);
       //  return redirect()->route('vandor.dashboard');
    }
















// reg part 2 view page load
    public function reg_part_two_get($email,$id){
        // dd($email,$id);
        $find=User::where('email',$email)->where('id',$id)->where('reg_complete','N')->where('role_id',3)->first();
        if(!$find){
            return back()->with('error','user is not found');
        }
        $data['id']=$id;
        $data['email']=$email;
        $data['category']=Category_Crud::where('category_status',1)->get(); //nt req

        $data['vandorService']=Vendor_services::where('vendor_user_id',$id)->orderBy('id','asc')->first();
        $data['allService']=Services::where('status','A')->get();

        // $data['vandorServiceCount']=Vendor_services::where('vendor_user_id',$id)->count();
        // if($data['vandorServiceCount']>0){
        //     //all service under the category
        //     $cat=$data['vandorService']->category;
        //     $findservice=Service_Crud::where('category_id',$cat)->pluck('service_id')->toArray();
        //     $data['allService']=Services::whereIn('id',$findservice)->get();
        // }
        $data['data']=$find;
       return view('vandor.Auth.registration_two')->with($data);
    }














public function vandor_get_addess_ajax(Request $request){
    $vandorDeatails=VandorDetailsModel::where('vandor_id',$request->vandor_id)->first();
    return response()->json(['data'=>$vandorDeatails]);
}



public function vandor_get_details_ajax(Request $request){
     $vandorDeatails=User::where('id',$request->vandor_id)->with('VandorDetails')->first();
    return response()->json(['data'=>$vandorDeatails]);

}















//part 2 registration post 
 public function reg_part_two_post(Request $request){
    // dd($request->all());
     if($request->next){
     $request->validate([
         // "category_id" => "required",
          "service_id" => "required",
          "service_desc" => "required",
          "price" => "required",

          // "calling_no" => "required",
          // "gst_no" => "required",

          // "driver_name" => "required",
          // "driver_mobile_no" => "required",
          // "driver_kyc_type" => "required",
          // "dricer_kyc_no" => "required",
          // "driver_licence_no" => "required",

          // "driver_pincode" => "required",
          // "driver_house_no" => "required",
          // "driver_area" => "required",
          // "driver_landmark" => "required",
          // "driver_city" => "required",
          // "driver_state" => "required",

          "office_pincode" => "required",
          "office_house_no" => "required",
          "office_area" => "required",
          "office_landmark" => "required",
          "office_city" => "required",
          "office_state" => "required",
           "office_mobile" => "required",
        ]);
       }

       //check total no of product image
       if($request->productImages){
        $imageCount=count($request->productImages);
        // dd($imageCount);
        if($imageCount>5 || $imageCount<3){
            // dd(1);
            return back()->with('error','Image must be 3 to 5');
        }
       }
     
     //insert service part 1
     $find=Vendor_services::where('vendor_user_id',$request->vandor_id)->first();
    if(!$find){
        //   if(@$request->img7){
        //   $image = @$request->img7;
        //   $fileSizeMb=filesize($image)/1024*0.0009765625;
        //   if($fileSizeMb>2){
        //     return back()->with('error','product Image is more than 2 Mb');
        //   }
        //   $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
        //   $image->move("storage/app/public/vandor/product_image",$filename);
        // }

        if($request->productImages) {
            foreach($request->file('productImages') as $key=> $file) {
                if($key==0){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 1 is more than 2 Mb');
                      }
                    $filename_PI_1 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_1);
                 }


                 elseif($key==1){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 2 is more than 2 Mb');
                      }

                    $filename_PI_2 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_2);
                 }


                 elseif($key==2){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 3 is more than 2 Mb');
                      }

                    $filename_PI_3 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_3);
                 }


                 elseif($key==3){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 4 is more than 2 Mb');
                      }

                    $filename_PI_4 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_4);
                 }


                 elseif($key==4){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 5 is more than 2 Mb');
                      }

                    $filename_PI_5 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_5);
                 }
            }
        }

        if(@$request->img6){
          $image2 = @$request->img6;
          $fileSizeMb=filesize($image2)/1024*0.0009765625;
          if($fileSizeMb>2){
            return back()->with('error','Driver Image is more than 2 Mb');
          }
          $filename2 = time() . '-' . rand(1000, 9999) . '.' . $image2->getClientOriginalExtension();
          $image2->move("storage/app/public/vandor/driver_image",$filename2);
        }

        if(@$request->img5){
          $image3 = @$request->img5;
          $fileSizeMb=filesize($image3)/1024*0.0009765625;
          if($fileSizeMb>2){
            return back()->with('error','Dl Image is more than 2 Mb');
          }
          $filename3 = time() . '-' . rand(1000, 9999) . '.' . $image3->getClientOriginalExtension();
          $image3->move("storage/app/public/vandor/dl_image",$filename3);
        }

        $insService=new Vendor_services;
        // $insService->category=@$request->category_id;
        $insService->service_id=@$request->service_id;
        $insService->vendor_user_id=@$request->vandor_id;
        $insService->service_desc=@$request->service_desc;
        $insService->price=@$request->price;
        
        $insService->driver_name = @$request->driver_name;
        $insService->driver_mobile_no = @$request->driver_mobile_no;
        $insService->driver_kyc_type = @$request->driver_kyc_type;
        $insService->dricer_kyc_no = @$request->dricer_kyc_no;
        $insService->driver_licence_no = @$request->driver_licence_no;

        $insService->driver_pincode = @$request->driver_pincode;
        $insService->driver_house_no = @$request->driver_house_no;
        $insService->driver_area = @$request->driver_area;
        $insService->driver_landmark = @$request->driver_landmark;
        $insService->driver_city = @$request->driver_city;
        $insService->driver_state = @$request->driver_state;
        $insService->driver_image = @$filename2;
        $insService->dl_image = @$filename3;

        $insService->image=@$filename_PI_1;
        $insService->image2=@$filename_PI_2;
        $insService->image3=@$filename_PI_3;
        $insService->image4=@$filename_PI_4;
        $insService->image5=@$filename_PI_5;
        $insService->save();
    }
    else{
        $updt=[];
        // $updt['category']=@$request->category_id;
        $updt['service_id']=@$request->service_id;
        $updt['vendor_user_id']=@$request->vandor_id;
        $updt['service_desc']=@$request->service_desc;
        $updt['price']=@$request->price;

        $updt["driver_name"] = @$request->driver_name;
        $updt["driver_mobile_no"] = @$request->driver_mobile_no;
        $updt["driver_kyc_type"] = @$request->driver_kyc_type;
        $updt["dricer_kyc_no"] = @$request->dricer_kyc_no;
        $updt["driver_licence_no"] = @$request->driver_licence_no;

        $updt["driver_pincode"] = @$request->driver_pincode;
        $updt["driver_house_no"] = @$request->driver_house_no;
        $updt["driver_area"] = @$request->driver_area;
        $updt["driver_landmark"] = @$request->driver_landmark;
        $updt["driver_city"] = @$request->driver_city;
        $updt["driver_state"] = @$request->driver_state;



        // if(@$request->img7){
        //   $image = @$request->img7;
        //   $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
        //   $image->move("storage/app/public/vandor/product_image",$filename);
        //   $updt['image']=$filename;
        // }

           if($request->productImages) {
            foreach($request->file('productImages') as $key=> $file) {
                if($key==0){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 1 is more than 2 Mb');
                      }

                    $filename_PI_1 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_1);
                      $updt['image']=$filename_PI_1;
                 }


                 elseif($key==1){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 2 is more than 2 Mb');
                      }

                    $filename_PI_2 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_2);
                      $updt['image2']=$filename_PI_2;
                 }


                 elseif($key==2){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 3 is more than 2 Mb');
                      }

                    $filename_PI_3 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_3);
                      $updt['image3']=$filename_PI_3;
                 }


                 elseif($key==3){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 4 is more than 2 Mb');
                      }

                    $filename_PI_4 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_4);
                      $updt['image4']=$filename_PI_4;
                 }


                 elseif($key==4){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 5 is more than 2 Mb');
                      }

                    $filename_PI_5 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_5);
                      $updt['image5']=$filename_PI_5;
                 }

            }
        }


        if(@$request->img6){
          $image2 = @$request->img6;
          $fileSizeMb=filesize($image2)/1024*0.0009765625;
              if($fileSizeMb>2){
                return back()->with('error','Driver Image is more than 2 Mb');
              }
          $filename2 = time() . '-' . rand(1000, 9999) . '.' . $image2->getClientOriginalExtension();
          $image2->move("storage/app/public/vandor/driver_image",$filename2);

          $updt['driver_image']=$filename2;
        }

         if(@$request->img5){
          $image3 = @$request->img5;
          $fileSizeMb=filesize($image3)/1024*0.0009765625;
              if($fileSizeMb>2){
                return back()->with('error','Dl Image is more than 2 Mb');
              }
          $filename3 = time() . '-' . rand(1000, 9999) . '.' . $image3->getClientOriginalExtension();
          $image3->move("storage/app/public/vandor/dl_image",$filename3);

          $updt['dl_image']=$filename3;
        }

        $u=Vendor_services::where('vendor_user_id',@$request->vandor_id)->where('id',@$request->vendor_service_id)->update($updt);
    }



        //update vendor details table
        $upd=[];
          $upd["calling_no"] = @$request->calling_no;
          $upd["gst_no"] = @$request->gst_no;

         
          $upd["office_pincode"] = @$request->office_pincode;
          $upd["office_house_no"] = @$request->office_house_no;
          $upd["office_area"] = @$request->office_area;
          $upd["office_landmark"] = @$request->office_landmark;
           $upd["office_country"] = @$request->office_country;
          $upd["office_city"] = @$request->office_city;
          $upd["office_state"] = @$request->office_state;
           $upd["office_mobile"] = @$request->office_mobile;

        $update=VandorDetailsModel::where('vandor_id',@$request->vandor_id)->update($upd);

          $data['data']=User::where('id',@$request->vandor_id)->first();
          
    
       if(@$request->btn=="save"){
        $data['success']="Details updated & saved successfully. Please contact support team if not done by you.";

        $data['category']=Category_Crud::where('category_status',1)->get();//not req

        $data['vandorService']=Vendor_services::where('vendor_user_id',@$request->vandor_id)->first();
        $data['allService']=Services::where('status','A')->get();

        // $data['vandorServiceCount']=Vendor_services::where('vendor_user_id',@$request->vandor_id)->count();
        // if($data['vandorServiceCount']>0){
        //     //all service under the category
        //     $cat=$data['vandorService']->category;
        //     $serviceFind=Service_Crud::where('category_id',$cat)->pluck('service_id')->toArray();
        //     $data['allService']=Services::whereIn('id',$serviceFind)->get();
        // }
        $data['id']=@$request->vandor_id;
        $data['email']=@$request->email;
        return view('vandor.Auth.registration_two')->with($data);
       }
       elseif($request->btn=="prev"){
         // $data['success']="Part 2 registration has done,please type next to proceed";
         return redirect()->route('vandor.registration.get')->with('success','Please Go forward to complete registration');
       }
       else{
        return redirect()->route('vandor.reg.three.get',["email"=>$data['data']->email,'id'=>$data['data']->id]);
       }

 }   


















//reg part 3 view
//bank details
 public function reg_part_three_get($email,$id){
    // dd($email,$id);
     $find=User::where('email',$email)->where('id',$id)->where('reg_complete','N')->where('role_id',3)->first();
        if(!$find){
            return back()->with('error','user is not found');
        }

        $VandorBank=VendorBankDetailsModel::where('vandor_id',$find->id)->first();
        if($VandorBank){
            $data['bankDetails']=$VandorBank;
        }
        $data['id']=$id;
        $data['email']=$email;
        $data['data']=$find;
       return view('vandor.Auth.reg_bank_details')->with($data);
 }















 //reg 3 post
 //bank details
 public function reg_part_three_post(Request $request){
    // dd($request->all());
     if($request->next){
     $request->validate([
            'bank_name' => 'required',
            'acc_no' => 'required',
            'ifsc_no' => 'required',
            'holder_name' => 'required',
            'branch_name' => 'required',
            'acc_type' => 'required',
            'img1'  =>'required',
        ]);
        }
          //update Bank details
        $srchBank=VendorBankDetailsModel::where('vandor_id',$request->vandor_id)->first();

        if($srchBank){
            //update
            $upd2=[];
            $upd2['bank_name']=@$request->bank_name;
            $upd2['acc_no']=@$request->acc_no;
            $upd2['ifsc_no']=@$request->ifsc_no;
            $upd2['holder_name']=@$request->holder_name;
            $upd2['branch_name']=@$request->branch_name;
            $upd2['acc_type']=@$request->acc_type;

            if($request->img1){
              $image = $request->img1;
              $fileSizeMb=filesize($image)/1024*0.0009765625;
              if($fileSizeMb>2){
                return back()->with('error','Image is more than 2 Mb');
              }
              // dd(filesize($image)/1024*0.0009765625);
              $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
              $image->move("storage/app/public/vandor/checkbookOrPassbookImage",$filename);

              $upd2['checkbookOrPassbookImage']=$filename;
            }

            $updateBank=VendorBankDetailsModel::where('vandor_id',@$request->vandor_id)->update($upd2);

        }else{
            //add

             if($request->img1){
              $image = $request->img1;
              $fileSizeMb=filesize($image)/1024*0.0009765625;
              if($fileSizeMb>2){
                return back()->with('error','Image is more than 2 Mb');
              }
              // dd(filesize($image)/1024*0.0009765625);
              $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
              $image->move("storage/app/public/vandor/checkbookOrPassbookImage",$filename);
            }


            $bankIns=new VendorBankDetailsModel;
            $bankIns->vandor_id=@$request->vandor_id;
            $bankIns->bank_name=@$request->bank_name;
            $bankIns->acc_no=@$request->acc_no;
            $bankIns->ifsc_no=@$request->ifsc_no;
            $bankIns->holder_name=@$request->holder_name;
            $bankIns->branch_name=@$request->branch_name;
            $bankIns->acc_type=@$request->acc_type;

            $bankIns->checkbookOrPassbookImage=@$filename;
            $bankIns->save();
        }


        if(@$request->btn=="save"){
        $data['success']="Details updated & saved successfully. Please contact support team if not done by you.";

        $data['id']=@$request->vandor_id;
        $data['email']=@$request->email;
        $data['bankDetails']=VendorBankDetailsModel::where('vandor_id',@$request->vandor_id)->first();
        // dd($data);
        return view('vandor.Auth.reg_bank_details')->with($data);
       }
       elseif(@$request->btn=="prev"){
         $data['success']="Part 3 registration has completed , please type next to proceed";
         return redirect()->route('vandor.reg.two.get',['id'=>@$request->vandor_id,'email'=>@$request->email])->with('success','Please Go forward to complete registration');
       }
       else{
        return redirect()->route('vandor.reg.four.get',["id"=>@$request->vandor_id,'email'=>@$request->email]);
       }
 }
















//4th page load
 public function reg_part_four_get($email,$id){
    // dd($id,$email);
      $find=User::where('email',$email)->where('id',$id)->where('reg_complete','N')->where('role_id',3)->first();
      // dd($find);
        if(!$find){
            return back()->with('error','user is not found');
        }
        $data['id']=$id;
        $data['email']=$email;
        $data['data']=$find;
       return view('vandor.Auth.registration_four_image_upload')->with($data);
 }













//4th step post
public function reg_part_four_post(Request $request){
    // dd($request->all());
     

    $upd=[];
     if($request->img1){
          $image = $request->img1;
          $fileSizeMb=filesize($image)/1024*0.0009765625;
          if($fileSizeMb>2){
            return back()->with('error','Pan Card Image is more than 2 Mb');
          }
          // dd(filesize($image)/1024*0.0009765625);
          $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
          $image->move("storage/app/public/vandor/pan_image",$filename);

          $upd['pan_image']=$filename;
        }

         if($request->img2){
          $image = $request->img2;
           $fileSizeMb=filesize($image)/1024*0.0009765625;
          if($fileSizeMb>2){
            return back()->with('error','Kyc Image is more than 2 Mb');
          }
          $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
          $image->move("storage/app/public/vandor/kyc_image",$filename);

          $upd['kyc_image']=$filename;
        }

         if($request->img3){
          $image = $request->img3;
           $fileSizeMb=filesize($image)/1024*0.0009765625;
          if($fileSizeMb>2){
            return back()->with('error','Vandor Image is more than 2 Mb');
          }
          $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
          $image->move("storage/app/public/vandor/vendor_image",$filename);

          $upd['vendor_image']=$filename;
          //also update the user table
          User::where('id',$request->vandor_id)->update(['avatar'=>$filename]);
        }

         if($request->img4){
          $image = $request->img4;
           $fileSizeMb=filesize($image)/1024*0.0009765625;
          // if($fileSizeMb>2){
          //   return back()->with('error','Pan Card Image is more than 2 Mb');
          // }
          $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
          $image->move("storage/app/public/vandor/gst_image",$filename);

          $upd['gst_image']=$filename;
        }

         

         

       $update=VandorDetailsModel::where('vandor_id',$request->vandor_id)->update($upd);


        if($request->btn=="save" ){
        $data['success']="Details updated & saved successfully. Please contact support team if not done by you.";

        $data['id']=$request->vandor_id;
        $data['email']=$request->email;
        $find=User::where('email',$request->email)->where('id',$request->vandor_id)->where('reg_complete','N')->first();
         $data['data']=$find;
        // dd($data);
        return view('vandor.Auth.registration_four_image_upload')->with($data);
       }
       elseif($request->btn=="prev"){
         $data['success']="Your details has been successfully submitted. Kindly wait for verification. It may take 48 - 72 Hours.";
         return redirect()->route('vandor.reg.three.get',['id'=>$request->vandor_id,'email'=>$request->email])->with('success','Please Go forward to complete reg');
       }
       else{
        return redirect()->route('vandor.dashboard')->with('success','Your details has been successfully submitted. Kindly wait for verification. It may take 48 - 72 Hours.');
       }

}


















/** 
*   Description : / route load login or dashboard
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function first_route(){
        // dd(Auth::user());
        if(@Auth::user()->id){
             return redirect()->route("vandor.dashboard");
        }else{
            return redirect()->route("vandor.login.view");
        }
    }







/** 
*   Description :login page load 
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function login_page(){
        if(@Auth::user()->id){
             return redirect()->route('vandor.dashboard');
         }
        else{
         return view("vandor.Auth.login");
        }
    }








/** 
*   Description : vendor dashboard load 
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function dashboard(){
        //total service
         $data['service']=Vendor_services::where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->count();

        //total upcomming order
        $data['upcomming']=Order::where('vendor_user_id',Auth()->user()->id)->where('payment_status','S')->where('order_status',1)->whereIn('vandor_order_status',['PN','AP'])->count();

        //total deliverd order
         $data['deliverd']=Order::where('vendor_user_id',Auth()->user()->id)->where('payment_status','S')->where('order_status',3)->count();

        return view("vandor.Dashboard.dashboard")->with($data);
    }











/** 
*   Description : login 
*   Author      : JEET
*   Date        : 2022-02-06
**/  
    public function login(Request $request){
       //for customer
        if($request->user_type=="customer"){
            $userDataEmail=User::where('email',$request->email)->where("role_id",3)->first();
            if ($userDataEmail) {
               if (!\Hash::check($request->password, $userDataEmail->password)) {
                    return redirect()->back()->with('error','Incorrect Password');
                }

                if (@$userDataEmail->status=="I") {
                   return redirect()->back()->with('error','User status is currenty inactive');
                }
                if (@$userDataEmail->status=="D") {
                   return redirect()->back()->with('error','User status is currenty Deleted.');
                }
                
                Auth::login($userDataEmail);
                return redirect()->route('vandor.dashboard');
            }else{
                 return back()->with("error","vandor Credential is wrong");
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
      return redirect()->route('vandor.login.view');
    }











/** 
*   Description : forget password page load 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function forgetpassword_enter_mail_page(){
       return view('vandor.fgp.enter_mail');
    }









/** 
*   Description : fgp part 1 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function code_gen(Request $request){
     // dd($request->all());
      $srch=User::where('email',$request->email)->where('role_id',3)->first();
      if($srch){
          $code=mt_rand(100000,999999);
          $upd=User::where('id',$srch->id)->update(['email_vcode'=>$code]);
            $data = [
                  'email'=>$srch->email,
                  'name'=>$srch->name,
                  'email_vcode'=>$code,
                  'id'=>$srch->id,
              ];
            Mail::send(new VandorForgetPassword($data));
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
          return redirect()->route('vandor.login.view')->with('error','Link expired');
       }
       return view('vandor.fgp.newpass',compact('data'));
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
        return redirect()->route('vandor.login.view')->with('success','Password changed successfully');
    }













/** 
*   Description : social logins part 1 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
//social login
      public function redirectToProvider($user_type,$provider_type)  //nq
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
     public function handleProviderCallback($user_type,$provider_type)   //nq
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

                   

                    // $ip = $request->ip();
                    $ip = '116.193.141.116'; /* Static IP address */
                    $currentUserInfo = Location::get($ip);
                     // dd($currentUserInfo, $ip);

                     $upd=[];
                     $upd['country']=$currentUserInfo->countryName;
                     $upd['state']=$currentUserInfo->regionName;
                     $upd['city']=$currentUserInfo->cityName;
                     $upd['zip']=$currentUserInfo->zipCode;
                     $update=User::where('id',$userIns->id)->update($upd);



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



                    // $ip = $request->ip();
                    $ip = '116.193.141.116'; /* Static IP address */
                    $currentUserInfo = Location::get($ip);
                     // dd($currentUserInfo, $ip);

                     $upd=[];
                     $upd['country']=$currentUserInfo->countryName;
                     $upd['state']=$currentUserInfo->regionName;
                     $upd['city']=$currentUserInfo->cityName;
                     $upd['zip']=$currentUserInfo->zipCode;
                     $update=User::where('id',$userIns->id)->update($upd);


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
   return view('vandor.Auth.otp_one');
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
            Mail::send(new VendorLoginOtp($data));
            return redirect()->route('vandor.login.enter.otp.page')->with('success','otp send to your email');
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
    return view('vandor.Auth.otp_two');
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
     $srch=User::where('otp',$request->otp)->where('role_id',3)->first();
     if(!$srch){
        return back()->with('error','otp is wrong');
     }else{
        $userDetails=User::where('otp',$request->otp)->where('role_id',3)->first();
        $updatepassword = User::where('id',$userDetails->id)->update([
            'otp'=>null
        ]); 
        Auth::login($userDetails);
         return redirect()->route('vandor.dashboard');
     }
}










public function get_address_page($id,$email){
    //check that id and email
    $srchVandor=User::where('id',$id)->where('role_id',3)->where('email',$email)->first();
      // dd($srchVandor);
        if(!$srchVandor){
            return back()->with('error','Invalid vandor');
        }
        $data['id']=$id;
        return view('vandor.Auth.get_address')->with($data);
}







public function insert_shop_address(Request $request){

    $request->validate([
        'address_address' => 'required',
    ]);

   // dd($request->all());
    //check that id
    $srchVandor=User::where('id',$request->id)->where('role_id',3)->first();
      // dd($srchVandor);
    if(!$srchVandor){
        return back()->with('error','Invalid vandor');
    }
        

    //insert address to vandor shop address table
   $shopAddress=new VandorShopAddress;
   $shopAddress->vandor_id=$request->id;
   $shopAddress->lat=$request->address_latitude;
   $shopAddress->lng=$request->address_longitude;
   $shopAddress->address_address=$request->address_address;
   $shopAddress->distance_cover=500;
   $shopAddress->save();

   $userDetails=User::where('id',$request->id)->first();                  
    Auth::login($userDetails);
    return redirect()->route('vandor.dashboard')->with('success','reg and login successful for vandor');
}






}

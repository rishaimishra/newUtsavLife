<?php

namespace App\Http\Controllers\VendorWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Vendor_services;
use App\Models\Services;
use App\Models\Category_Crud;
use App\Models\Service_Crud;


class VendorServiceController extends Controller
{
    
    //Service crud




/** 
*   Description : vendor service list
*   Author      : JEET
*   Date        : 2022-02-06
**/
public function list(){
    $find=Vendor_services::where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->count();
    if($find<1){
        return back()->with('error','Please complete all the registartion process to add more service.');
    }
    $data['list']=Vendor_services::where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->get();
    return view('vandor.service.service_list')->with($data);
}





/** 
*   Description : vendor service add
*   Author      : JEET
*   Date        : 2022-02-06
**/
public function add(){
    $allServices=Services::pluck('id')->toArray();
    $usedService=Vendor_services::where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->pluck('service_id')->toArray();

     $unique_services = array_merge(array_diff($allServices, $usedService), array_diff($usedService, $allServices));

    // dd($allServices,$usedService, $unique_services);

     $data['services']=Services::whereIn('id', $unique_services)->where('status','A')->get();
      $data['category']=Category_Crud::where('category_status',1)->get();
     return view('vandor.service.service_add')->with($data);
}







/** 
*   Description : vendor service insert
*   Author      : JEET
*   Date        : 2022-02-06
**/
public function insert(Request $request){
    // dd($request->all());
       $request->validate([
           // 'category_id'=> 'required',
            'service_id' => 'required',
            'address' => 'required',
            'service_desc' => 'required',
            'material_desc' => 'required',
            'price' => 'required',
        ]);

        //check total no of product image
       if($request->productImages){
        $imageCount=count($request->productImages);
        // dd($imageCount);
        if($imageCount>5 || $imageCount<3){
            // dd(1);
            return back()->with('error','Image must be 3 to 5');
        }
       }

        $srch=Vendor_services::where('service_id',$request->service_id)->where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->first();
      if($srch){
          return back()->with("error",'This sevice already added');
      }

        //chk 2 base price
       // $basePrice=Service_Crud::where('category_id',$request->category_id)->where('service_id',$request->service_id)->first();
       // if((int)$basePrice->service_price > (int)$request->price){
       //    return back()->with("error",'Price can not be less than base price set by admin '.(int)$basePrice->service_price);
       // }

       //insert
        // if($request->img7){
        //   $image = $request->img7;
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



          if($request->img6){
          $image2 = $request->img6;
           $fileSizeMb=filesize($image2)/1024*0.0009765625;
              if($fileSizeMb>2){
                return back()->with('error','Driver Image is more than 2 Mb');
              }
          $filename2 = time() . '-' . rand(1000, 9999) . '.' . $image2->getClientOriginalExtension();
          $image2->move("storage/app/public/vandor/driver_image",$filename2);
        }

         if($request->img5){
          $image3 = $request->img5;
          $fileSizeMb=filesize($image3)/1024*0.0009765625;
              if($fileSizeMb>2){
                return back()->with('error','Dl Image is more than 2 Mb');
              }
          $filename3 = time() . '-' . rand(1000, 9999) . '.' . $image3->getClientOriginalExtension();
          $image3->move("storage/app/public/vandor/dl_image",$filename3);
        }

       $insService=new Vendor_services;
        // $insService->category=$request->category_id;
       $insService->service_id=$request->service_id;
       $insService->vendor_user_id=Auth()->user()->id;
       $insService->company_name=@$request->company_name;
       $insService->address=$request->address;
       $insService->service_desc=$request->service_desc;
       $insService->material_desc=$request->material_desc;
       $insService->price=$request->price;
        // $insService->image=$filename;

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

       return back()->with('success','Service added successfully.');
}






/** 
*   Description : vendor service active
*   Author      : JEET
*   Date        : 2022-02-06
**/
  public function active($id){
        // dd($id);
       $srch=Vendor_services::where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->where('id',$id)->first();
       if(!$srch){
        return back()->with('error','id not exists');
       }
        $obj=Vendor_services::where('id','=',$id)->update(['status'=>'A']);
        return back()->with("success",'Sevice successfully activated');
    }





/** 
*   Description : vendor service deactive
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function deactive($id){
        // dd($id);
        $srch=Vendor_services::where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->where('id',$id)->first();
       if(!$srch){
        return back()->with('error','id not exists');
       }
        $obj=Vendor_services::where('id','=',$id)->update(['status'=>'I']);
        return back()->with("success",'Sevice successfully deactivated');
    }







/** 
*   Description : vendor service delete
*   Author      : JEET
*   Date        : 2022-02-06
**/
      public function delete($id){
        // dd($id);
        $srch=Vendor_services::where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->where('id',$id)->first();
        if(!$srch){
        return back()->with('error','id not exists');
        }
        $obj=Vendor_services::where('id','=',$id)->update(['status'=>'D']);
        return back()->with("success",'Sevice successfully deleted');
    }







/** 
*   Description : vendor service edit page
*   Author      : JEET
*   Date        : 2022-02-06
**/
      public function edit($id){
        // dd($id);
        $srch=Vendor_services::where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->where('id',$id)->first();
        if(!$srch){
        return back()->with('error','id not exists');
        }


        $allServices=Services::pluck('id')->toArray();
        $usedService=Vendor_services::where('vendor_user_id',Auth()->user()->id)->where('status','!=','D')->where('id','!=',$id)->pluck('service_id')->toArray();

         $unique_services = array_merge(array_diff($allServices, $usedService), array_diff($usedService, $allServices));

        // dd($allServices,$usedService, $unique_services);
            $serviceUnderCategory=Service_Crud::where('category_id',$srch->category)->pluck('service_id')->toArray();

        $data['services']=Services::whereIn('id',$unique_services)->where('status','A')->get();
        // dd($data['services']);
        $data['service_details']=$srch;
     

        $data['category']=Category_Crud::where('category_status',1)->get();
        return view('vandor.service.service_edit')->with($data);
    }









/** 
*   Description : vendor service edit page
*   Author      : JEET
*   Date        : 2022-02-06
**/
public function update(Request $request){
    $request->validate([
            // 'category_id' => 'required',
            'service_id' => 'required',
            'address' => 'required',
            'service_desc' => 'required',
            'material_desc' => 'required',
            'price' => 'required',
    ]);

      $upd=[];
      //search that same cate and service availave or not
      $srch=Vendor_services::where('id','!=',$request->id)/*->where('category',$request->category_id)*/->where('service_id',$request->service_id)->where('status','!=','D')->where('vendor_user_id',Auth()->user()->id)->first();
      if($srch){
          return back()->with("error",'This sevice already added');
      }

      //chk 2 base price
       // $basePrice=Service_Crud::where('category_id',$request->category_id)->where('service_id',$request->service_id)->first();
       // if((int)$basePrice->service_price > (int)$request->price){
       //    return back()->with("error",'Price can not be less than base price set by admin '.(int)$basePrice->service_price);
       // }

      // $upd['category']=$request->category_id;
      $upd['service_id']=$request->service_id;
      $upd['company_name']=@$request->company_name;
      $upd['address']=$request->address;
      $upd['service_desc']=$request->service_desc;
      $upd['material_desc']=$request->material_desc;
      $upd['price']=$request->price;

       $upd["driver_name"] = $request->driver_name;
        $upd["driver_mobile_no"] = $request->driver_mobile_no;
        $upd["driver_kyc_type"] = $request->driver_kyc_type;
        $upd["dricer_kyc_no"] = $request->dricer_kyc_no;
        $upd["driver_licence_no"] = $request->driver_licence_no;

        $upd["driver_pincode"] = $request->driver_pincode;
        $upd["driver_house_no"] = $request->driver_house_no;
        $upd["driver_area"] = $request->driver_area;
        $upd["driver_landmark"] = $request->driver_landmark;
        $upd["driver_city"] = $request->driver_city;
        $upd["driver_state"] = $request->driver_state;

      // if($request->img7){
      //     $image = $request->img7;
      //     $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
      //     $image->move("storage/app/public/vandor/product_image",$filename);
      //     $upd['image']=$filename;
      //   }

         if($request->productImages){
            $imageCount=count($request->productImages);
            // dd($imageCount);
            if($imageCount>5 || $imageCount<3){
                // dd(1);
                return back()->with('error','Image must be 3 to 5');
            }
           }

   if($request->productImages) {
            foreach($request->file('productImages') as $key=> $file) {
                if($key==0){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 1 is more than 2 Mb');
                      }

                    $filename_PI_1 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_1);
                      $upd['image']=$filename_PI_1;
                 }


                 elseif($key==1){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 2 is more than 2 Mb');
                      }

                    $filename_PI_2 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_2);
                      $upd['image2']=$filename_PI_2;
                 }


                 elseif($key==2){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 3 is more than 2 Mb');
                      }

                    $filename_PI_3 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_3);
                      $upd['image3']=$filename_PI_3;
                 }


                 elseif($key==3){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 4 is more than 2 Mb');
                      }

                    $filename_PI_4 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_4);
                      $upd['image4']=$filename_PI_4;
                 }


                 elseif($key==4){
                    $fileSizeMb=filesize($file)/1024*0.0009765625;
                      if($fileSizeMb>2){
                        return back()->with('error','Product Image 5 is more than 2 Mb');
                      }

                    $filename_PI_5 = time() . '_' . $file->getClientOriginalName();
                     $file->move("storage/app/public/vandor/product_image",$filename_PI_5);
                      $upd['image5']=$filename_PI_5;
                 }
                 
            }
        }

        if($request->img6){
          $image2 = $request->img6;
            $fileSizeMb=filesize($image2)/1024*0.0009765625;
              if($fileSizeMb>2){
                return back()->with('error','Driver Image is more than 2 Mb');
              }
          $filename2 = time() . '-' . rand(1000, 9999) . '.' . $image2->getClientOriginalExtension();
          $image2->move("storage/app/public/vandor/driver_image",$filename2);

          $upd['driver_image']=$filename2;
        }

         if($request->img5){
          $image3 = $request->img5;
          $fileSizeMb=filesize($image3)/1024*0.0009765625;
              if($fileSizeMb>2){
                return back()->with('error','Dl Image is more than 2 Mb');
              }

          $filename3 = time() . '-' . rand(1000, 9999) . '.' . $image3->getClientOriginalExtension();
          $image3->move("storage/app/public/vandor/dl_image",$filename3);

          $upd['dl_image']=$filename3;
        }

       $update=Vendor_services::where('id','=',$request->id)->update($upd);
       return back()->with("success",'Sevice successfully updated');
}





public function get_service(Request $request){
    $find=Service_Crud::where('category_id',$request->category_id)->pluck('service_id')->toArray();
         // return response()->json(['msg'=>$find]);
    
    if($request->type=="add"){
    $usedService=Vendor_services::where('vendor_user_id',@Auth()->user()->id)->where('category',$request->category_id)->where('status','A')->pluck('service_id')->toArray();
    $unique_services = array_diff($find, $usedService);
    $data['allService']=Services::whereIn('id',$unique_services)->where('status','A')->get();
        $data['category_id']=$request->category_id;
        return view('vandor.service.get_service')->with($data);
    }else{
        $data['allService']=Services::whereIn('id',$find)->where('status','A')->get();
        $data['category_id']=$request->category_id;
        return view('vandor.service.get_service')->with($data);
    }


        
}


//admin base amount
 public function baseAmount(Request $request){
    $basePrice=Service_Crud::where('category_id',$request->category_id)->where('service_id',$request->service_id)->first();
    return json_encode($basePrice->service_price);
 }


}

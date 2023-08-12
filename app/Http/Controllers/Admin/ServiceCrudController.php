<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category_Crud;
use App\Models\Service_Crud;
use App\Models\Services;


class ServiceCrudController extends Controller
{

       public function list(){
        $data['services']=Services::where('status','!=','D')->orderBy('id','desc')->get();
        return view('admin.service.service_list')->with($data);

        // $allServiceWithSameName=Services::where('status','!=','D')->pluck('id')->toArray();
        // foreach($allServiceWithSameName as $key =>$val){
        //     $cateIds=Service_Crud::where('service_id',$val)->pluck('category_id')->toArray();
        //     foreach($cateIds as $val2){
        //         $CatNames=Category_Crud::whereIn()
        //     }
        // }


        // dd($allServiceWithSameName);
    }



    public function add_page(){
         $data['cat']=Category_Crud::where('category_status','!=','D')->orderBy('id','desc')->get();
        return view('admin.service.service_add')->with($data);
    }



    public function insert(Request $request){
            $request->validate([
            'category_id' => 'required',
            'service' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'price_basis'=>'required',
            'image' => 'required'
        ]);
        // dd($request->all());
            //check1 that same name exist or not
            $chk1=Services::where('service',$request->service)->where('status','!=','D')->first();
            if($chk1){
                return back()->with('error','This Service name is already exists');
            }

            if ($request->has('profile_picture')) {
                $destinationPath = storage_path('app/public/service/');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $img_front = str_replace('data:image/png;base64,', '', $request->profile_picture);
                $img_front = str_replace(' ', '+', $img_front);
                $image_base64 = base64_decode($img_front);
                $img1 = time() . '-' . rand(1000, 9999) . '.png';
                $file = $destinationPath . $img1;

                file_put_contents($file, $image_base64);
                chmod($file, 0644);
            }

            if ($request->has('images')) {

                foreach ($request->file('images') as $image) {
                    $destinationPath = storage_path('app/public/service/');

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }
                    $images = time() . '-' . rand(1000, 9999) .'.'. $image->extension();
                    $image->move($destinationPath, $images);
                    $additional_images[] = $images;
                }
                $additional_images = implode(",",$additional_images);
                $ins_service->additional_images = $additional_images;
            }
            //1st insert to service main table before mapping
               $ins_service=new Services;
                $ins_service->service=$request->service;
                $ins_service->description=$request->description;
                $ins_service->price=$request->price;
                $ins_service->discount_price=$request->discount_price;
                $ins_service->price_basis=$request->price_basis;
                $ins_service->status="A";
                $ins_service->image = $img1;
                $ins_service->video_url = count($request->video_url) > 0 ? implode(",",$request->video_url) : null;
                $ins_service->save();



            // add that service under all the category
            $allCategory=Category_Crud::where('category_status','!=','D')->orderBy('id','desc')->pluck('id')->toArray();

            foreach(@$allCategory as $val){
                $ins_service2=new Service_Crud;
                $ins_service2->service_id= $ins_service->id;
                $ins_service2->category_id=$val;
                $ins_service2->service_price=$request->discount_price;
                $ins_service2->save();
            }


                 // foreach($request->category_id as $val){

                  // if ($request->profile_picture) {
                  //       $destinationPath = "storage/app/public/service/";
                  //       $img_front = str_replace('data:image/png;base64,', '', @$request->profile_picture);
                  //       $img_front = str_replace(' ', '+', $img_front);
                  //       $image_base64 = base64_decode($img_front);
                  //       $img1 = time() . '-' . rand(1000, 9999) . '.png';
                  //       $file = $destinationPath . $img1;
                  //       file_put_contents($file, $image_base64);
                  //       chmod($file, 0755);
                  //      // $bracelet->design_picture = $img;
                  //   }

                    // //search that same combination exist or not
                    // $srchAllServiceNameId=Services::where('service',$request->service)->where('status','!=','D')->pluck('id')->toArray();
                    // // $allCategoryIds=Category_Crud::where('category_status','!=','D')->pluck('id')->toArray();

                    // $srchServiceToCat=Service_Crud::whereIn('service_id',$srchAllServiceNameId)->where('category_id',$val)->first();
                    // if(!$srchServiceToCat){


                    // $ins_service=new Services;
                    // $ins_service->service=$request->service;
                    // $ins_service->description=$request->description;
                    // $ins_service->price=$request->price;
                    // $ins_service->discount_price=$request->discount_price;
                    // $ins_service->price_basis=$request->price_basis;
                    // $ins_service->status="A";
                    // $ins_service->image=$img1;
                    // $ins_service->save();


                    // $ins_service2=new Service_Crud;
                    // $ins_service2->service_id= $ins_service->id;
                    // $ins_service2->category_id=$val;
                    // $ins_service2->service_price=$request->discount_price;
                    // $ins_service2->save();

                    // }

            // }





        return back()->with('success','Service added successfully');
    }





    public function active($id){
        // dd($id);
        $obj=Services::where('id','=',$id)->update(['status'=>'A']);
        return back()->with("success",'Service successfully activated');
    }


    public function deactive($id){
        // dd($id);
        $obj=Services::where('id','=',$id)->update(['status'=>'I']);
        return back()->with("success",'Service successfully deactivated');
    }


      public function delete($id){
        // dd($id);
        $obj=Services::where('id','=',$id)->update(['status'=>'D']);
        return back()->with("success",'Service successfully deleted');
    }






    public function edit($id){
        $data['cat']=Category_Crud::where('category_status','!=','D')->orderBy('id','desc')->get();
        $data['service']=Services::where('id',$id)->first();
        return view('admin.service.service_edit')->with($data);
    }




    public function update(Request $request){
        // dd($request->all());
           $request->validate([
            // 'category_id' => 'required',
            'service' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'price_basis'=>'required',
        ]);


            $chk1=Services::where('service',$request->service)->where('id','!=',$request->id)->where('status','!=','D')->first();
            if($chk1){
                return back()->with('error','This Service name is already exists');
            }
            $ins_service=[];
            $cur_service = Services::where('id',$request->id)->first();

            if(!empty($request->profile_picture))
            {
                if ($request->has('profile_picture')) {
                    $destinationPath = storage_path('app/public/service/');

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    $img_front = str_replace('data:image/png;base64,', '', $request->profile_picture);
                    $img_front = str_replace(' ', '+', $img_front);
                    $image_base64 = base64_decode($img_front);
                    $img1 = time() . '-' . rand(1000, 9999) . '.png';
                    $file = $destinationPath . $img1;

                    file_put_contents($file, $image_base64);
                    chmod($file, 0644);
                    $ins_service['image'] = $img1;
                }
            }
            else
            {
                $ins_service['image'] = $cur_service->image;
            }

            $additional_images = null;
            if(!empty($request->images))
            {
                if ($request->has('images')) {

                    foreach ($request->file('images') as $image) {
                        $destinationPath = storage_path('app/public/service/');

                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0755, true);
                        }
                        $images = time() . '-' . rand(1000, 9999) .'.'. $image->extension();
                        $image->move($destinationPath, $images);
                        $additional_images[] = $images;
                    }
                }
                $ins_service['additional_images']=implode(",",$additional_images);
            }
            else
            {
                $ins_service['additional_images'] = $cur_service->additional_images;
            }

            // if(!empty($request->image)) {
            //     if ($request->has('image')) {
            //         $imageNames = [];

            //         foreach ($request->file('image') as $image) {
            //             $destinationPath = storage_path('app/public/service/');

            //             if (!file_exists($destinationPath)) {
            //                 mkdir($destinationPath, 0755, true);
            //             }
            //             $img1 = time() . '-' . rand(1000, 9999) .'.'. $image->extension();
            //             $image->move($destinationPath, $img1);
            //             $imageNames[] = $img1;
            //         }
            //     }
            //     $ins_service['image']=implode(",",$imageNames);
            // }
            // else
            // {
            //     $ins_service['image'] = $cur_service->image;
            // }

            //update only service information not mapping

                $ins_service['service']=$request->service;
                $ins_service['description']=$request->description;
                $ins_service['price']=$request->price;
                $ins_service['discount_price']=$request->discount_price;
                $ins_service['price_basis']=$request->price_basis;
                $ins_service['video_url'] = count($request->video_url) > 0 ? implode(",",$request->video_url) : null;

                $u=Services::where('id',$request->id)->update($ins_service);
                return back()->with("success",'Service successfully updated');

            //search that same combination exist or not
           //  $srchAllServiceNameId=Services::where('service',$request->service)->where('id','!=',$request->id)->where('status','!=','D')->pluck('id')->toArray();
           //  // $allCategoryIds=Category_Crud::where('category_status','!=','D')->pluck('id')->toArray();

           //  $srchServiceToCat=Service_Crud::whereIn('service_id',$srchAllServiceNameId)->where('category_id',$request->category_id)->first();
           //  if(!$srchServiceToCat){


           //      $ins_service=[];
           //      // $ins_service['service']=$request->service;
           //      $ins_service['description']=$request->description;
           //      $ins_service['price']=$request->price;
           //      $ins_service['discount_price']=$request->discount_price;
           //      $ins_service['price_basis']=$request->price_basis;


           //      $ins_service2=[];
           //       $ins_service2['service_id']=$request->id;
           //      $ins_service2['category_id']=$request->category_id;
           //      $ins_service2['service_price']=$request->discount_price;

           //        if ($request->profile_picture) {
           //              $srch=Services::where('id',$request->id)->first();
           //              //dd($srch);
           //              @unlink('storage/app/public/service/' . $srch->image);
           //              $destinationPath = "storage/app/public/service/";
           //              $img_front = str_replace('data:image/png;base64,', '', @$request->profile_picture);
           //              $img_front = str_replace(' ', '+', $img_front);
           //              $image_base64 = base64_decode($img_front);
           //              $img1 = time() . '-' . rand(1000, 9999) . '.png';
           //              $file = $destinationPath . $img1;
           //              file_put_contents($file, $image_base64);
           //              chmod($file, 0755);
           //              $ins_service['image'] = $img1;
           //          }



           //          $u=Services::where('id',$request->id)->update($ins_service);
           //          $u2=Service_Crud::where('service_id',$request->id)->update($ins_service2);
           //           return back()->with("success",'Service successfully updated');
           // }else{
           //   return back()->with("error",'Same combination exists');
           // }


    }


}

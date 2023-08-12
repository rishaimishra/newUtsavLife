<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category_Crud;
use App\Models\Service_Crud;
use App\Models\Services;

class CategoryCrudController extends Controller
{
    

     public function list(){
        $data['cat']=Category_Crud::where('category_status','!=','D')->orderBy('id','desc')->get();
        return view('admin.category.cat_list')->with($data);
    }



    public function add_page(){
        return view('admin.category.cat_add');
    }
    


    public function insert(Request $request){
        // dd($request->all());
            $request->validate([
            'category_description' => 'required',
            'category_name' => 'required',
        ]);

        if ($request->profile_picture) {
            $destinationPath = "storage/app/public/category/";
            $img_front = str_replace('data:image/png;base64,', '', @$request->profile_picture);
            $img_front = str_replace(' ', '+', $img_front);
            $image_base64 = base64_decode($img_front);
            $img1 = time() . '-' . rand(1000, 9999) . '.png';
            $file = $destinationPath . $img1;
            file_put_contents($file, $image_base64);
            chmod($file, 0755);
           // $bracelet->design_picture = $img;
        }


        $ins_cat=new Category_Crud;
        $ins_cat->category_description=$request->category_description;
        $ins_cat->category_name=$request->category_name;
        $ins_cat->category_status="A";
        $ins_cat->image=$img1;
        $ins_cat->save();


        // add and map that category id with existing service
        $allServices=Services::where('status','!=','D')->pluck('id')->toArray();
        foreach($allServices as $val){
            //insert mapping

            //discount price
            $dp=Services::where('id',$val)->first();
            
            $ins_mapping=new Service_Crud;
            $ins_mapping->service_id= $val;
            $ins_mapping->category_id=$ins_cat->id;
            $ins_mapping->service_price=$dp->discount_price;
            $ins_mapping->save();
        }

        return back()->with('success','Category added successfully');
    }





    public function active($id){
        // dd($id);
        $obj=Category_Crud::where('id','=',$id)->update(['category_status'=>'A']);
        return back()->with("success",'Category successfully activated');
    }


    public function deactive($id){
        // dd($id);
        $obj=Category_Crud::where('id','=',$id)->update(['category_status'=>'I']);
        return back()->with("success",'Category successfully deactivated');
    }


      public function delete($id){
        // dd($id);
        $obj=Category_Crud::where('id','=',$id)->update(['category_status'=>'D']);
        return back()->with("success",'Category successfully deleted');
    }






    public function edit($id){
        $data['cat']=Category_Crud::where('id',$id)->first();
        return view('admin.category.cat_edit')->with($data);
    }




    public function update(Request $request){
        //dd($request->all());
          $request->validate([
            'category_description' => 'required',
            'category_name' => 'required',
        ]);

            if ($request->profile_picture) {
                $srch=Category_Crud::where('id',$request->id)->first();
                //dd($srch);
                @unlink('storage/app/public/category/' . $srch->image);
                $destinationPath = "storage/app/public/category/";
                $img_front = str_replace('data:image/png;base64,', '', @$request->profile_picture);
                $img_front = str_replace(' ', '+', $img_front);
                $image_base64 = base64_decode($img_front);
                $img1 = time() . '-' . rand(1000, 9999) . '.png';
                $file = $destinationPath . $img1;
                file_put_contents($file, $image_base64);
                chmod($file, 0755);
                $upd['image'] = $img1;
            }


            $upd['category_description']=$request->category_description;
            $upd['category_name']=$request->category_name;
            
           
            $u=Category_Crud::where('id',$request->id)->update($upd);
             return back()->with("success",'Category successfully updated');
    }



}

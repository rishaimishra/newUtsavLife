<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Models\Category_Crud;
use App\Models\PackageToService;
use App\Http\Controllers\Controller;

class PackagesController extends Controller
{
    public function index()
    {
        $packages = Package::where('status','!=','D')->OrderBy('id','DESC')->get();
        return view('admin.packages.index')->with(compact('packages'));
    }

    public function create()
    {
        $cat=Services::where('status','!=','D')->orderBy('id','desc')->get();
        return view("admin.packages.create")->with(compact('cat'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'service_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'price_basis'=>'required',
            'image' => 'required'
        ]);
        $pkg=Package::where('name',$request->name)->where('status','!=','D')->first();
        if($pkg){
            return back()->with('error','This Package name is already exists');
        }

        $package = new Package;
        $package->name = $request->name;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->discount_price = $request->discount_price;
        $package->unit = $request->price_basis;
        $package->video_url = count($request->video_url) > 0 ? implode(",",$request->video_url) : null;
        if ($request->has('profile_picture')) {
            $destinationPath = storage_path('app/public/packages/');

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

        $additional_images = null;
        if ($request->has('images')) {

            foreach ($request->file('images') as $image) {
                $destinationPath = storage_path('app/public/packages/');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $images = time() . '-' . rand(1000, 9999) .'.'. $image->extension();
                $image->move($destinationPath, $images);
                $additional_images[] = $images;
                $additional_images = implode(",",$additional_images);
            }
        }
        $package->image = $img1;
        $package->additional_images = $additional_images;
        $package->save();

        foreach($request->service_id as $service)
        {
            $package_to_service = new PackageToService;
            $package_to_service->package_id = $package->id;
            $package_to_service->service_id = $service;
            $package_to_service->save();
        }
        return back()->with('success','Package added successfully');
    }

    public function active($id){
        // dd($id);
        $obj=Package::where('id','=',$id)->update(['status'=>'A']);
        return back()->with("success",'Package successfully activated');
    }


    public function deactive($id){
        // dd($id);
        $obj=Package::where('id','=',$id)->update(['status'=>'I']);
        return back()->with("success",'Package successfully deactivated');
    }

    public function delete($id){
        // dd($id);
        $obj=Package::where('id','=',$id)->update(['status'=>'D']);
        return back()->with("success",'Package successfully deleted');
    }

    public function edit($id)
    {
        $cat=Services::where('status','!=','D')->orderBy('id','desc')->get();
        $package = Package::findOrFail($id);
        $services = [];
        foreach($package->packagesToService as $packagesToService)
        {
            $service = Services::where('id', $packagesToService->service_id)->first()->id;
            $services[] = $service;
        }

        return view("admin.packages.edit")->with(compact('cat','services','package'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'service_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'price_basis'=>'required',
        ]);
        $pkg=Package::where('id','!=',$request->id)->where('name',$request->name)->where('status','!=','D')->first();
        if($pkg){
            return back()->with('error','This Package name is already exists');
        }

        $package = Package::findOrFail($request->id);
        $package->name = $request->name;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->discount_price = $request->discount_price;
        $package->unit = $request->price_basis;
        $package->video_url = count($request->video_url) > 0 ? implode(",",$request->video_url) : null;
        // if ($request->has('image')) {
        //     $image = $request->file('image');
        //     $destinationPath = storage_path('app/public/packages/');
        //     if (!file_exists($destinationPath)) {
        //         mkdir($destinationPath, 0755, true);
        //     }
        //     $img1 = time() . '-' . rand(1000, 9999) .'.'. $image->extension();
        //     $image->move($destinationPath, $img1);
        //     $package->image = $img1;
        // }
        // else
        // {
        //     $package->image = $package->image;
        // }
        if(!empty($request->profile_picture))
        {
            if ($request->has('profile_picture')) {
                $destinationPath = storage_path('app/public/packages/');

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
                $package->image = $img1;
            }
        }
        else
        {
            $package->image = $package->image;
        }

        $additional_images = null;
        if(!empty($request->images))
        {
            if ($request->has('images')) {

                foreach ($request->file('images') as $image) {
                    $destinationPath = storage_path('app/public/packages/');

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }
                    $images = time() . '-' . rand(1000, 9999) .'.'. $image->extension();
                    $image->move($destinationPath, $images);
                    $additional_images[] = $images;
                }
            }
            $package->additional_images = implode(",",$additional_images);
        }
        else
        {
            $package->additional_images = $package->additional_images;
        }
        $package->save();
        PackageToService::where('package_id',$package->id)->delete();

        foreach($request->service_id as $service)
        {
            $package_to_service = new PackageToService;
            $package_to_service->package_id = $package->id;
            $package_to_service->service_id = $service;
            $package_to_service->save();
        }
        return back()->with('success','Package updated successfully');
    }
}

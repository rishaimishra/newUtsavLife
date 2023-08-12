<?php

namespace App\Http\Controllers\VendorWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VandorShopAddress;
use Auth;
use App\Models\User;

class VendorAddressController extends Controller
{
    



    public function address_list(){
        $data['list']=VandorShopAddress::where('vandor_id',Auth()->user()->id)->where('status','!=','D')->get();
        return view('vandor.address.address_list')->with($data);
    }






    public function address_add(){
        return view('vandor.address.address_add');
    }




    public function address_ins(Request $request){
         $request->validate([
            'address_address' => 'required',
            // 'distance_cover' => 'required',
        ]);

        //insert address to vandor shop address table
       $shopAddress=new VandorShopAddress;
       $shopAddress->vandor_id=Auth()->user()->id;
       $shopAddress->lat=$request->address_latitude;
       $shopAddress->lng=$request->address_longitude;
       $shopAddress->address_address=$request->address_address;
       $shopAddress->distance_cover=500;   //$request->distance_cover;
        $shopAddress->country=@$request->country;
       $shopAddress->save();
       return redirect()->route('vandor.address.list')->with('success','Address added');

    }




    public function address_edit($id){
         $srch=VandorShopAddress::where('vandor_id',Auth()->user()->id)->where('id',$id)->first();
        if(!$srch){
        return back()->with('error','id not exists');
        }
        $data['address']=$srch;
        $data['id']=$id;
        return view('vandor.address.address_edit')->with($data);
    }






    public function address_update(Request $request){
          $request->validate([
            'address_address' => 'required',
            // 'distance_cover' => 'required',
        ]);

        //update address to vandor shop address table
          $upd=[];
      
       $upd['lat']=$request->address_latitude;
       $upd['lng']=$request->address_longitude;
       $upd['address_address']=$request->address_address;
       $upd['distance_cover']=500;  //$request->distance_cover;
        $upd['country']=@$request->country;

        $uA=VandorShopAddress::where('vandor_id',Auth()->user()->id)->where('id',$request->id)->update($upd);
        return back()->with('success','Address updated');
    }








    public function address_del($id){
        $srch=VandorShopAddress::where('vandor_id',Auth()->user()->id)->where('status','!=','D')->where('id',$id)->first();
       if(!$srch){
        return back()->with('error','id not exists');
       }
        $obj=VandorShopAddress::where('id','=',$id)->update(['status'=>'D']);
        return back()->with("success",'Address successfully deleted');
    }












}

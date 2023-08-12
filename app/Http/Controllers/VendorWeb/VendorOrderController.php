<?php

namespace App\Http\Controllers\VendorWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use Mail;
use App\Mail\AdminOrderMail;
use App\Models\VandorRejectOrder;
use App\Models\User;

class VendorOrderController extends Controller
{
    

/** 
*   Description : vendor upcomming_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function upcomming_orders(){
        $data['data']=Order::where('vendor_user_id',Auth()->user()->id)->where('payment_status','S')->where('order_status',1)->whereIn('vandor_order_status',['PN','AP'])->get();
        return view('vandor.orders.upcomming_order')->with($data);
    }







/** 
*   Description : vendor delivered_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
     public function delivered_orders(){
        $data['data']=Order::where('vendor_user_id',Auth()->user()->id)->where('payment_status','S')->where('order_status',3)->get();
        return view('vandor.orders.delivered_order')->with($data);
    }







/** 
*   Description : vendor cancel_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
     public function cancel_orders(){
        $cancelOrderIds=VandorRejectOrder::where('vandor_id',Auth()->user()->id)->pluck('order_id')->toArray();
        $data['data']=Order::whereIn('id',$cancelOrderIds)->get();
         return view('vandor.orders.cancle_order')->with($data);
    }






/** 
*   Description : vendor all_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    //  public function all_orders(){
    //     $data['data']=Order::where('vendor_user_id',Auth()->user()->id)->get();
    //     return view('vandor.orders.all_order')->with($data);
    // }







public function approve_orders($id){
  $srch=Order::where('vendor_user_id',Auth()->user()->id)->where('payment_status','S')->whereIn('vandor_order_status',['PN','RJ'])->where('order_status',1)->where('id',$id)->first();
  // dd($srch);
  if(!$srch){
    return back()->with('error','id not matching');
  }
  $up=Order::where('vendor_user_id',Auth()->user()->id)->whereIn('vandor_order_status',['PN','RJ'])->where('order_status',1)->where('id',$id)->update(['vandor_order_status'=>"AP"]);

        $data = [
          'vandor_email'=>$srch->VandorDetails->email,
          'vandor_name'=>$srch->VandorDetails->name,
          'order_id'=>$srch->id,
          "type"=>"AP",
          "admin_mail"=>"jeetbasak54@gmail.com",

        ];
        // dd($data);
        Mail::send(new AdminOrderMail($data));


   return back()->with('success','Order Approved');

}






public function reject_orders(Request $request,$id){
    // dd($request->all(),$id);
 $srch=Order::where('vendor_user_id',Auth()->user()->id)->whereIn('vandor_order_status',['PN','RJ'])->where('order_status',1)->where('id',$id)->first();
  // dd($srch);
  if(!$srch){
    return back()->with('error','id not matching');
  }
  $up=Order::where('vendor_user_id',Auth()->user()->id)->whereIn('vandor_order_status',['PN','RJ'])->where('order_status',1)->where('id',$id)->update(['vandor_order_status'=>"RJ"]);

  //insert VandorRejectOrder table
  $ins=new VandorRejectOrder;
  $ins->vandor_id=Auth()->user()->id;
  $ins->order_id=$id;
  if($request->reason1=="oth"){
    $ins->reason=@$request->reason2;
  }else{
    $ins->reason=@$request->reason1;
  }
  $ins->save();


   $data = [
          'vandor_email'=>$srch->VandorDetails->email,
          'vandor_name'=>$srch->VandorDetails->name,
          'order_id'=>$srch->id,
          "type"=>"RJ",
          "admin_mail"=>"jeetbasak54@gmail.com",
          "reason"=>$ins->reason,

        ];
        // dd($data);
        Mail::send(new AdminOrderMail($data));
   return back()->with('success','Order Rejected');
}








public function delivered_orders_status($id){
    $srch=Order::where('vendor_user_id',Auth()->user()->id)->where('payment_status','S')->where('order_status',1)->where('vandor_order_status','AP')->where('id',$id)->first();
  // dd($srch);
  if(!$srch){
    return back()->with('error','id not matching');
  }
  // dd($srch);

  //check that delivered date is less than order date or not
  if(date('Y-m-d') < $srch->event_end_date){
     return back()->with('error','Vendors can not update status of the order as delivered before event end date: '.$srch->event_end_date);
  }
   //update to delivered
    $u=Order::where('vendor_user_id',Auth()->user()->id)->where('payment_status','S')->where('order_status',1)->where('vandor_order_status','AP')->where('id',$id)->update(['order_status'=>3]);
    return back()->with('success','Order delivered successfully');

}













    public function get_vendor(){
        //get order's service_id // that id will be dynamic
        $OrderDetails=Order::where('id',1)->first();
        $delivary_lat=$OrderDetails->lat;
        $delivary_long=$OrderDetails->long;
        $service_id= $OrderDetails->services;
        // dd( $service_id);



        //get the list of vendor who is giving that service from vendorToService table
        $all_vendors_of_that_service=\DB::table('vendor_services')->where('service_id',(int)$service_id)->pluck('vendor_user_id')->toArray();
         // dd( $all_vendors_of_that_service);



       //distance calculate
        $dis= \DB::table('vandor_shop_address')->whereIn('vandor_id',$all_vendors_of_that_service)->select("id","vandor_id",\DB::raw("6371 * acos(cos(radians(" . $delivary_lat . ")) 
                        * cos(radians(lat)) 
                        * cos(radians(lng) - radians(" . $delivary_long . ")) 
                        + sin(radians(" .$delivary_lat. ")) 
                        * sin(radians(lat))) AS distance"))->get()->toArray();
        // dd(($dis));


        // sorting by distance
         usort($dis, function ($fun1, $fun2) {
            return $fun1->distance > $fun2->distance ? -1 : 1;
         });
         $shorted_array = array_reverse($dis);
         // dd("vendors with shortes distance ", $shorted_array);




        //final distance cover filter array of vandior
        $finalArryOfVendor=[];
        foreach($shorted_array as $value){
            $distanceMeasure=\DB::table('vandor_shop_address')->where('id',$value->id)->first();
            if($distanceMeasure->distance_cover>=$value->distance){
                array_push($finalArryOfVendor,$value);
            }
        }
        dd($finalArryOfVendor);







            // $unique_vendors=array_unique(array_column($shorted_array, 'vandor_id'));
            // dd("vendors with shortes distance ", $shorted_array,$unique_vendors);






        // usort($dis,function($a, $b) {return strcmp($a->distance , $b->distance);});
        // dd($dis);
        // // function my_sort_function($a, $b)
        // // {
        // //     return $a->distance < $b->distance;
        // // }






         //now calculate the nearest vendor using order table and vandor shop address table  //nrq
         // $Vandor_locations=[];
         // foreach($all_vendors_of_that_service as $val){
         //    $locationOfShop=\DB::table('vandor_shop_address')->where('vandor_id',$val)->get();
         //    if(count($locationOfShop)>0){
         //        foreach($locationOfShop as $val2){
         //            //calculate the distance between vandor shop to order delivary place lat longs
         //            $shop_lat=$val2->lat;
         //            $shop_long=$val2->lng;

         //            //distance
         //            // $distance=

         //        }
         //    }
         // }
    }



    public function all(){
        $a=User::vendor()->orderBy('created_at')->first();
        dd($a);
    }




}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Order;
use App\Models\User;
use App\Models\VandorRejectOrder;
use Mail;
use App\Mail\VandorOrderMail;


class OrderController extends Controller
{

    //-----=== order status: 1-upcomming_orders,   2-cancel_orders,  3-delivered_orders

   public function upcomming_orders(){
        $data['data']=Order::orderby('id','desc')->where('payment_status','S')->where('order_status',1)->get();
        return view('admin.orders.upcomming_order')->with($data);
    }







/** 
*   Description : vendor delivered_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
     public function delivered_orders(){
        $data['data']=Order::orderby('id','desc')->where('payment_status','S')->where('payment_status','S')->where('order_status',3)->get();
        return view('admin.orders.delivered_order')->with($data);
    }







/** 
*   Description : vendor cancel_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
     public function cancel_orders(){
        $data['data']=Order::orderby('id','desc')->where('payment_status','S')->where('order_status',2)->get();
         return view('admin.orders.cancle_order')->with($data);
    }






/** 
*   Description : vendor all_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
     public function all_orders(){
        $data['data']=Order::orderby('id','desc')->get();
        return view('admin.orders.all_order')->with($data);
    }







public function vendor_cancel_list($id){
    // dd($id);
    $data['id']=$id;
    $data['data']=VandorRejectOrder::where('order_id',$id)->with('venodrDetails')->get();
    return view('admin.orders.cancel_vendor_list')->with($data);

}











public function assign_vandor_page($id){
      //get order's service_id // that id will be dynamic
        $OrderDetails=Order::where('id',$id)->where('order_status',1)->first();
        if(!$OrderDetails){
            return back()->with('error','id not match');
        }
        $delivary_lat=$OrderDetails->lat;
        $delivary_long=$OrderDetails->long;
        $service_id= $OrderDetails->services;  // this is is service id.. not service category map id
        // $category_id= $OrderDetails->category_id;  // this is is category id.. not service category map id
        // dd( $service_id);
        // dd($delivary_lat,$delivary_long);



        //get the list of vendor who is giving that service from vendorToService table
        $all_vendors_of_that_service=\DB::table('vendor_services')->where('service_id',(int)$service_id)/*->where('category',(int)$category_id)*/->pluck('vendor_user_id')->toArray();
         // dd( $all_vendors_of_that_service); // correct 1



       //distance calculate
        $dis= \DB::table('vandor_shop_address')->whereIn('vandor_id',$all_vendors_of_that_service)->where('status','A')->select("id","vandor_id",\DB::raw("6371 * acos(cos(radians(" . $delivary_lat . ")) 
                        * cos(radians(lat)) 
                        * cos(radians(lng) - radians(" . $delivary_long . ")) 
                        + sin(radians(" .$delivary_lat. ")) 
                        * sin(radians(lat))) AS distance"))->get()->toArray();
        // dd(($dis)); //correct 2


        // sorting by distance
         usort($dis, function ($fun1, $fun2) {
            return $fun1->distance > $fun2->distance ? -1 : 1;
         });
         $shorted_array = array_reverse($dis);
         // dd("vendors with shortes distance ", $shorted_array);  //correct 3




        //final distance cover filter array of vandior
        $finalArryOfVendor=[];
        foreach($shorted_array as $value){
            $distanceMeasure=\DB::table('vandor_shop_address')->where('id',$value->id)->first();
            if($distanceMeasure->distance_cover>=$value->distance){  //$distanceMeasure->distance_cover ->500
                array_push($finalArryOfVendor,$value);
            }
        }
        // dd($finalArryOfVendor); //correct 4

        $vandorIds=[];
         foreach($finalArryOfVendor as $value){
               array_push($vandorIds,$value->vandor_id); 
        }

        $unique_vandors=array_unique($vandorIds);
        // dd($unique_vandors);

        $rejectedThatOrderVandors=VandorRejectOrder::where('order_id',$id)->pluck('vandor_id')->toArray();
        $RemainingVandors=array_diff($unique_vandors, $rejectedThatOrderVandors);
        // dd($RemainingVandors);

         $data['allVandors']=User::whereIn('id',$RemainingVandors)->get();


        // $data['allVandors']=User::whereIn('id',$unique_vandors)->get();
         $data['orderDetails']=$OrderDetails;
       return view('admin.orders.assign_vandor')->with($data);
}





public function assign_vandor_update(Request $request){
    // dd($request->all());
    //vandor panel get notification about that order
      $upd=Order::where('id',$request->id)->where('order_status',1)->update(['vendor_user_id'=> $request->vandor_id,'vandor_order_status'=>'PN']);
      //mail to vandor
      $vandorDetails=User::where('id',$request->vandor_id)->first();
        $data = [
                  'email'=>$vandorDetails->email,
                  'name'=>$vandorDetails->name,
                  'order_id'=>$request->id,
              ];
            Mail::send(new VandorOrderMail($data));
      return redirect()->route('admin.all.orders')->with('success','vandor assigned for order id '.$request->id);
}














































    function upcoming_order(Request $r){
        $data=['type' => 'Upcoming Order'];
        return redirect('admin/orders?type=upcoming');
    }

    function canceled_order(Request $r){

        $data=['type' => 'Canceled Order'];
        return redirect('admin/orders?type=canceled');
    }

    function completed_order(Request $r){
        $data=['type' => 'Completed Order'];
        // return view('Admin.order_type')->with($data);
        return redirect('admin/orders?type=completed');
    }
    
    function get_tot_price(Request $r){
        $s_id = explode(',',$r->s_id);
        $tot_price = 0;
        foreach($s_id as $i){
            $x = Services::where('id',$i)->first();
            $tot_price += $x['price'];
        }
        return response()->json(['tot_price' => $tot_price]);
    }

}

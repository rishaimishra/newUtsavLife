<?php

namespace App\Http\Controllers\CustomerWeb;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{


/**
*   Description : Customer upcomming_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function upcomming_orders(){
        $data['data']=Order::where('customer_user_id',Auth()->user()->id)->where('payment_status','S')->where('order_status',1)->where('event_end_date','>=',date("Y-m-d"))->OrderBy('id','DESC')->get();
        return view('Customer.orders.upcomming_order')->with($data);
    }







/**
*   Description : Customer delivered_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/
     public function delivered_orders(){
        $data['data']=Order::where('customer_user_id',Auth()->user()->id)->where('payment_status','S')->OrderBy('id','DESC')
        // ->where('order_status',3)
        ->where('event_end_date','<',date("Y-m-d"))
        ->get();
        return view('Customer.orders.delivered_order')->with($data);
    }







/**
*   Description : Customer cancel_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/
     public function cancel_orders(){
        $data['data']=Order::where('customer_user_id',Auth()->user()->id)->where('payment_status','S')->OrderBy('id','DESC')->where('order_status',2)->get();
         return view('Customer.orders.cancle_order')->with($data);
    }






/**
*   Description : Customer all_orders
*   Author      : JEET
*   Date        : 2022-02-06
**/
    public function all_orders(){
        $data['data']=Order::where('customer_user_id',Auth()->user()->id)->where('payment_status','S')->OrderBy('id','DESC')->get();
        return view('Customer.orders.all_order')->with($data);
    }


    public function delete_order($id)
    {
        $order = Order::find($id);
        if(!$order)
        {
            return back();
        }
        $order->order_status = 2;
        $order->save();
        return back()->with('success','Order cancelled successfully');
    }

}

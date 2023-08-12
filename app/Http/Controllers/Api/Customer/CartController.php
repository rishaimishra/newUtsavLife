<?php

namespace App\Http\Controllers\Api\Customer;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Models\UserToAddress;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Category_Crud;
use App\Models\Service_Crud;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

       $validator = Validator::make($request->all(), [
            'service_id' => 'required',
           'cart_category' => 'required',
           'end_date' => 'required',
           'date' => 'required',
           'quantity' => 'required',
           'days' => 'required',
           'time' => 'required',
        ]);

       if ($validator->fails())
       {
            return response()->json(['error'=>$validator->errors()], 401);
        }

       if(@Auth::user()->id)
       {
        $flag =  Services::where('id',$request->service_id)->first();
        if(!$flag)
        {
            return response()->json(['error'=>'Service not Found'], 401);
        }
        $ins = [];
        $ins['service_id'] = $request->service_id;
        $ins['category_id'] = $request->cart_category;
        $ins['price'] = $flag->discount_price;
        $ins['quantity'] =$request->quantity;
        $ins['days'] =$request->days;
        $ins['total_price'] = $ins['price']*$ins['quantity']*$ins['days'];
        $ins['time'] = $request->time;
        $ins['order_date'] = date("Y-m-d",strtotime($request->date));
        $ins['order_end_date'] = date("Y-m-d",strtotime($request->end_date));
        $ins['user_id'] = auth()->user()->id;
        $result = Cart::create($ins);
        if($result)
        {
            return response()->json([
                'success'=> true,
                'message' => 'Product Has Been Added in cart successfully',
                'data' => $result
            ], 200);
        }

       }else{
    //         if($request->session()->has('randmon_number')){
    //          $MAC2= $request->session()->get('randmon_number');
    //        } else{
    //            $random_number=rand(10000,99999);
    //            $request->session()->put('randmon_number',$random_number);
    //            $MAC2=$random_number;
    //         }

    //     $flag =  Services::where('id',$request->service_id)->first();
    //     if(!$flag)
    //     {
    //         return response()->json(['error'=>'Service not Found'], 401);
    //     }
    //        $ins = [];
    //        $ins['service_id'] = $request->service_id;
    //        $ins['category_id'] = $request->cart_category;
    //        $ins['price'] = $flag->discount_price;
    //        $ins['quantity'] = $request->quantity;
    //        $ins['days'] =$request->days;
    //        $ins['total_price'] =  $ins['price']*$ins['quantity']*$ins['days'];
    //        $ins['time'] = $request->time;
    //        $ins['order_date'] = $request->date;
    //        $ins['order_end_date'] = $request->end_date;
    //        $ins['user_id'] = null;
    //        $ins['system_id'] = $MAC2;
    //    Cart::create($ins);

    }
   }

   public function showCart()
   {
    if(@Auth()->user()->id  && @Auth::user()->role_id==2){
		$data = [];
		//first check past data and delete those.
		$allPastData=Cart::where('order_date','<',Date('Y-m-d'))->where('user_id',Auth::user()->id)->orderBy('id','desc')->pluck('id')->toArray();
        
		
		if(count($allPastData)>0){
			$allPastData=Cart::where('order_date','<',Date('Y-m-d'))->whereIn('id',$allPastData)->where('user_id',Auth::user()->id)->orderBy('id','desc')->delete();
		}
		$data['cart'] = Cart::with('serviceDetails','categoryDetails')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
		$data['total_price'] = Cart::where('user_id',Auth::user()->id)->sum('total_price');
        return response()->json([
            'status' =>true,
            'data' =>$data
        ]);
	}
   }

   public function updateCartQty(Request $request)
   {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required',
            'qty' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $cart = Cart::find($request->cart_id);
        if(!$cart)
        {
            return response()->json(['error'=>'Cart Not Found'], 401);
        }
        $db_price = $cart->price;
        $db_total_price = $cart->total_price;
        
        $price = $db_price * $request->qty;
        $total_price = $db_total_price * $request->qty;
        
        $cart->quantity = $request->qty;
        $cart->price = $price;
        $cart->total_price = $total_price;
        $cart->save();

        return response()->json([
            'status' =>true,
            'message' => 'Cart updated Successfully',
            'data' =>$cart
        ]);
   }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()], 401);
        }
            if(@Auth()->user()->id)
            {

                $dlt = Cart::where('user_id',Auth::user()->id)->orderBy('id','desc')->where('id',$request->id)->first();
                if($dlt){
                    Cart::where('user_id',Auth::user()->id)->orderBy('id','desc')->where('id',$request->id)->delete();
                    return response()->json([
                        'status' =>true,
                        'message' => 'Cart Item deleted successfully'
                    ],200);
                }
                else{
                    return response()->json([
                        'status' =>false,
                        'message' => 'Record not found'
                    ],401);
                }
            }
    }

    public function insert_address(Request $request){
        $validator = Validator::make($request->all(), [
            'city' => 'required',
                'state' => 'required',
                'house_number' => 'required',
                'billing_name' => 'required',
                'billing_mobile' => 'required',
                'for_address' => 'required',
    
                'address' => 'required',
                'address_latitude' => 'required',
                'address_longitude' => 'required',
                'landmark' => 'required',
                'area' => 'required',
                'pin_code' => 'required',
                'address_type' => 'required',
        ]);

       if ($validator->fails())
       {
            return response()->json(['error'=>$validator->errors()], 401);
        }
          if($request->address_latitude==0 || $request->address_longitude==0){
            return response()->json([
                'status' =>false,
                'message' => 'Latitude or longtitude can not be 0'
            ],401);
         }
    
        if($request->default_address=="Y"){
            $chk=UserToAddress::where('user_id',Auth::user()->id)->where('default_address','Y')->first();
            if($chk){
                $up=UserToAddress::where('user_id',Auth::user()->id)->where('default_address','Y')->update(['default_address'=>"N"]);
            }
        }
    
           $ins=new UserToAddress;
             $ins->user_id=Auth::user()->id;
             $ins->country=@$request->country;
            $ins->city=$request->city;
             $ins->default_address=$request->default_address;
             $ins->state=$request->state;
             $ins->house_number=$request->house_number;
             $ins->billing_name=$request->billing_name;
             $ins->billing_mobile=$request->billing_mobile;
             $ins->for_address=$request->for_address;
    
             $ins->address=$request->address;
             $ins->lat=$request->address_latitude;
             $ins->long=$request->address_longitude;
             $ins->landmark=$request->landmark;
             $ins->area=$request->area;
             $ins->pin_code=$request->pin_code;
             $ins->address_type=$request->address_type;
             $ins->save();

             return response()->json([
                'status' =>true,
                'message' => 'New address Added',
                'address_id' => $ins->id
            ],200);
    }

    public function viewAddress()
    {
        if(@Auth()->user()->id && @Auth::user()->role_id==2){
            $find=UserToAddress::where('user_id',Auth::user()->id)->first();
		    if($find){
                // $data['all_address']=UserToAddress::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
                $data['all_address'] = UserToAddress::where('user_id', Auth::user()->id)
                ->orderBy('id', 'DESC')
                ->join('tbl_countries', 'user_to_address.country', '=', 'tbl_countries.id')
                ->select('user_to_address.*', 'tbl_countries.name as country_name')
                ->get();
                return response()->json([
                    'status' =>true,
                    'data'  => $data
                ],200);
            }
            else
            {
                return response()->json([
                    'status' =>false,
                    'message' => 'No Record Found'
                ],401);
            }
        }
    }

    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
            'address_id' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $orderId=mt_rand(10000,99999);
        $allCartDataUnderThatUser=Cart::where('user_id',Auth()->user()->id)->get();
        if(count($allCartDataUnderThatUser)<1){
            return response()->json([
                'status'=> false,
                'error'=>'No Record Found'
            ], 401);
        }
        if(count($allCartDataUnderThatUser) > 0)
        {
            $addressDetails=UserToAddress::where('user_id',Auth::user()->id)->where('id',$request->address_id)->first();
            if(!$addressDetails)
            {
                return response()->json([
                    'status'=> false,
                    'messgae'=>'Address Not Found'
                ], 200);
            }
            
            // dd($addressDetails,$allCartData);
            $updt=Cart::where('user_id',Auth::user()->id)->update([
                'address'=>$addressDetails->address,
                'lat'=>$addressDetails->lat,
                'lng'=>$addressDetails->long,

                'event_city'=>$addressDetails->city,
                'state'=>$addressDetails->state,
                'house_number'=>$addressDetails->house_number,
                'billing_name'=>$addressDetails->billing_name,
                'billing_mobile'=>$addressDetails->billing_mobile,
                'for_address'=>$addressDetails->for_address,

                'landmark'=>$addressDetails->landmark,
                'area'=>$addressDetails->area,
                'pin_code'=>$addressDetails->pin_code,
                'address_type'=>$addressDetails->address_type,
                'order_id'=>$orderId
                ]);
        }

        if($request->payment_method == "cod")
        {
            
            foreach($allCartDataUnderThatUser as $val){
                $order_ins=new Order;
                $order_ins->customer_user_id=Auth()->user()->id;
                $order_ins->payment_type="COD";
                $order_ins->address=$val->address;
                $order_ins->lat=$val->lat;
                $order_ins->long=$val->lng;

                $order_ins->event_city=$val->event_city;
                $order_ins->state=$val->state;
                $order_ins->house_number=$val->house_number;
                $order_ins->billing_name=$val->billing_name;
                $order_ins->billing_mobile=$val->billing_mobile;
                $order_ins->for_address=$val->for_address;


                $order_ins->landmark=$val->landmark;
                $order_ins->area=$val->area;
                $order_ins->pin_code=$val->pin_code;
                $order_ins->address_type=$val->address_type;

                $order_ins->customer_email=@Auth()->user()->email;
                $order_ins->customer_phone=@Auth()->user()->mobile;

                $order_ins->services=$val->service_id;
                $order_ins->category_id=$val->category_id;

                $order_ins->discount=0;
                $order_ins->price=$val->price;
                $order_ins->quantity=$val->quantity;
                $order_ins->total_price=$val->total_price;
                $order_ins->payment_status='S';

                $order_ins->time=$val->time;
                $order_ins->event_date=$val->order_date;
                $order_ins->event_end_date=$val->order_end_date;
                $order_ins->days=$val->days;
                $order_ins->event_address=$val->address;
                $order_ins->event_pin=$val->pin_code;
                $order_ins->is_customized=0;

                $order_ins->txn_no="";
                $order_ins->order_id=$orderId;
                $order_ins->order_status=1; //upcomming
                $order_ins->save();
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'txn_id' => 'required'
            ]);
    
            if ($validator->fails())
            {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            foreach($allCartDataUnderThatUser as $val){
                $order_ins=new Order;
                $order_ins->customer_user_id=Auth()->user()->id;
                $order_ins->payment_type="ONLINE";
                $order_ins->address=$val->address;
                $order_ins->lat=$val->lat;
                $order_ins->long=$val->lng;

                $order_ins->event_city=$val->event_city;
                $order_ins->state=$val->state;
                $order_ins->house_number=$val->house_number;
                $order_ins->billing_name=$val->billing_name;
                $order_ins->billing_mobile=$val->billing_mobile;
                $order_ins->for_address=$val->for_address;


                $order_ins->landmark=$val->landmark;
                $order_ins->area=$val->area;
                $order_ins->pin_code=$val->pin_code;
                $order_ins->address_type=$val->address_type;

                $order_ins->customer_email=@Auth()->user()->email;
                $order_ins->customer_phone=@Auth()->user()->mobile;

                $order_ins->services=$val->service_id;
                $order_ins->category_id=$val->category_id;

                $order_ins->discount=0;
                $order_ins->price=$val->price;
                $order_ins->quantity=$val->quantity;
                $order_ins->total_price=$val->total_price;
                $order_ins->payment_status='S';

                $order_ins->time=$val->time;
                $order_ins->event_date=$val->order_date;
                $order_ins->event_end_date=$val->order_end_date;
                $order_ins->days=$val->days;
                $order_ins->event_address=$val->address;
                $order_ins->event_pin=$val->pin_code;
                $order_ins->is_customized=0;

                $order_ins->txn_no=$request->txn_id;
                $order_ins->order_id=$orderId;
                $order_ins->order_status=1; //upcomming
                $order_ins->save();
            }

        }
        $DelallCartDataUnderThatUser=Cart::where('user_id',Auth()->user()->id)->delete();

        return response()->json([
            'status'=> true,
            'messgae'=>'Order placed successfully'
        ], 200); 
    }

    public function allOrders(){
        $data=Order::where('customer_user_id',Auth()->user()->id)->where('payment_status','S')->OrderBy('id','DESC')->get();
        if(count($data) > 0)
        {
            return response()->json([
                'status' =>true,
                'message' => 'All Order',
                'data' => $data
            ],200);
        }
        else
        {
            return response()->json([
                'status' =>false,
                'message' => 'No Record Found'
            ],401);
        }
    }

    public function getCountry()
    {
        $allCountry=DB::table('tbl_countries')->get();

        return response()->json([
            'status' =>true,
            'data' => $allCountry
        ],200);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $data = (object)[];
        $data->category =[];
        $data->services =[];
        $categoryFilterservices = [];
        
        $query = new Services;
        $query->with('serviceCategoryDetails')->where('status','!=','D');
        if(!empty($request->search))
        {
            $query = $query->where('service','like','%'.$request->search.'%');
        }
        if(!empty($request->start_price) AND !empty($request->end_price))
        {
            if (!empty($request->start_price) && !empty($request->end_price)) {
                $query = $query->whereBetween('price', [$request->start_price, $request->end_price]);
            }
        }
        

        if (!empty($request->discount_percentage)) {
            $allServices = $query->get();
            $filteredServices = [];
            foreach ($allServices as $service) {
                $discountPercentage = ($service->price - $service->discount_price) / $service->price * 100;
                
                if ($discountPercentage <= $request->discount_percentage) {
                    $filteredServices[] = $service;
                }
            }
            $services = collect($filteredServices);
        } else {
            $services = $query->get();
        }
        
        if($request->category != null)
        {
            $categories = array_unique($request->category);

            foreach ($categories as $row) {
                $servicesCrud = Service_Crud::where('category_id', $row)->get();
                
                if (!$servicesCrud->isEmpty()) {
                    foreach ($servicesCrud as $item) {
                        $existingItemKey = array_search($item->service_id, array_column($data->services, 'service_id'));
                        
                        if ($existingItemKey === false) {

                            $curService = Services::where('id',$item->service_id)->where('status','!=','D')->first();
                            if($curService)
                            {
                                $categoryFilterservices[] = $curService;   
                            }
                        }
                    }
                }
            }
            if (count($categoryFilterservices) > 0) {
                $newServiceArray = [];
                $servicesArray = $services->pluck('id')->toArray();
                
                foreach ($categoryFilterservices as $loopService) {
                    if (in_array($loopService->id, $servicesArray)) {
                        $newServiceArray[] = $loopService;
                    }
                }
                
                $services = collect($newServiceArray);
                return $services;
            }
        }

        if(count($services) > 0)
        {
            return response()->json([
                'status' =>true,
                'data' => $services
            ], 200);
        }
        else
        {
            return response()->json([
                'status' =>false,
                'message' => 'No Record Found'
            ], 401);
        }
    }
}

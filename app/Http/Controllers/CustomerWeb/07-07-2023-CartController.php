<?php

namespace App\Http\Controllers\CustomerWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerWeb;
use App\Models\User;
use App\Models\Ordermaster;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Addressbook;
use Mail;
use App\Mail\OrderMail;
use App\Mail\VendorOrder;
use App\Mail\Stock;
use App\Mail\OutOfStock;
use App\Models\Cart;
use App\Models\Service_Crud;
use App\Models\Services;
use App\Models\Category_Crud;
use Illuminate\Support\Facades\Auth;
use App\Models\UserToAddress;



class CartController extends Controller
{
    public function addToCart(Request $request)
    {
    	if(Auth::user()->id){
		$check = Cart::where('service_id',$request->cart_services)->where('category_id',$request->cart_category)->where('user_id',Auth::user()->id)->first();
		// $product = Product::where('id',$request->service_id)->where('status','A')->where('admin_status','A')->where('available','Y')->first();
		// $normal_product_details = Product::where('id',$request->service_id)->first();
		// $shop_details = User::where('id',$normal_product_details->user_id)->first();

		// if (@$product=="") {
		// 	return redirect()->back()->with('error','Product Currently Not Available');
		// }

		// if (@$shop_details->status!="A") {
		// 	return redirect()->back()->with('error','Product Currently Not Available');
		// }

		// if (@$check) {
		
		// 	return redirect()->back()->with('error','Product Already To Cart');
    	// }
		$flag =  Service_Crud::where('service_id',$request->cart_services)->where('category_id',$request->cart_category)->first();
		
		$ins = [];
    	// $ins['vendor_id'] = $request->vendor_id;
    	$ins['service_id'] = $request->cart_services;
		$ins['category_id'] = $request->cart_category;
		if($flag==null){
			$ins['price'] = 0;

		}else{
			$ins['price'] = $flag->service_price;
		}
    	$ins['quantity'] = 1;
    	$ins['total_price'] = $ins['price']*$ins['quantity'];
		$ins['time'] = $request->time;
    	$ins['order_date'] = $request->date;
    	$ins['user_id'] = auth()->user()->id;
		// dd($ins);
		Cart::create($ins);
		return redirect()->back()->with('success','Product Added To Cart Successfully');  
		}else{
			dd(1);
		}  	
	}








/** 
*   Description : cart 
*   Author      : JEET
*   Date        : 2022-02-06
**/ 

	public function addToCartNew(Request $request){
		 // dd($request->all());
		 $request->validate([
            'service_id' => 'required',
            'cart_category' => 'required',
            'time' => 'required',
            'date' => 'required',
             // 'quantity' => 'required',
        ]);


		if(@Auth::user()->id){
		 
		// $flag =  Service_Crud::where('service_id',$request->service_id)->where('category_id',$request->cart_category)->first();
		$flag =  Services::where('id',$request->service_id)->first();
		$ins = [];
    	// $ins['vendor_id'] = $request->vendor_id;
    	$ins['service_id'] = $request->service_id;
		$ins['category_id'] = $request->cart_category;
    	// $ins['price'] = $flag->service_price;
    	$ins['price'] = $flag->discount_price;
    	$ins['quantity'] =$request->quantity;
    	$ins['days'] =$request->days;
    	$ins['total_price'] = $ins['price']*$ins['quantity']*$ins['days'];
		$ins['time'] = $request->time;
    	$ins['order_date'] = $request->date;
    	$ins['order_end_date'] = $request->end_date;
    	$ins['user_id'] = auth()->user()->id;
		// dd($ins);
		Cart::create($ins);
		if($request->btn=="add"){
		return redirect()->back()->with('success','Product Added To Cart Successfully'); 
		}else{
			return redirect()->route('cust.service.address.page');
		}   

		}else{
			// $mac = system('ipconfig/all');
			// dd($mac);
			//// PHP code to get the MAC address of Server
			// $MAC = exec('getmac');
			// dd($MAC );
			//// Storing 'getmac' value in $MAC
			// $MAC2 = strtok($MAC, ' ');
			// $MAC2=$request->ip();
			// dd($MAC ,$MAC2,$request->ip());

			 if($request->session()->has('randmon_number')){
			 	 // echo 'data in the session';
              $MAC2= $request->session()->get('randmon_number');
               // dd(10,$random_number);
            } else{
            	$random_number=rand(10000,99999);
            	$request->session()->put('randmon_number',$random_number);
            	$MAC2=$random_number;
                // echo 'No data in the session';
                // dd(2,$random_number);
             }
             // $request->session()->forget('randmon_number');
             // return $request->session()->get('randmon_number');



			// $flag =  Service_Crud::where('service_id',$request->service_id)->where('category_id',$request->cart_category)->first();
            $flag =  Services::where('id',$request->service_id)->first();

			$ins = [];
	    	$ins['service_id'] = $request->service_id;
			$ins['category_id'] = $request->cart_category;
	    	// $ins['price'] = $flag->service_price;
	    	$ins['price'] = $flag->discount_price;
	    	$ins['quantity'] = $request->quantity;
	    	$ins['days'] =$request->days;
	    	$ins['total_price'] =  $ins['price']*$ins['quantity']*$ins['days'];
			$ins['time'] = $request->time;
	    	$ins['order_date'] = $request->date;
	    	$ins['order_end_date'] = $request->end_date;
	    	$ins['user_id'] = null;
	    	$ins['system_id'] = $MAC2;
		// dd($ins);
		Cart::create($ins);
		if($request->btn=="add"){
		return redirect()->back()->with('success','Product Added To Cart Successfully without login'); 
		}else{
			return redirect()->route('cust.service.address.page');
		}       
		} 	
	}

















	public function showCart(Request $request)
	{
		// dd(1);
		 if(@Auth::user()->id && @Auth::user()->role_id==3){
            return redirect()->route('vandor.dashboard');
        }

        if(@Auth::user()->id && @Auth::user()->role_id==4){
            return redirect()->route('agent.dashboard');
        }


		if(@Auth()->user()->id  && @Auth::user()->role_id==2){
		$data = [];
		// $data['cart'] = Cart::where('user_id',auth()->user()->id)->where('status','A')->where('admin_status','A')->where('shop_status','A')->get();
		// $data['cart'] = Cart::join('services','services.id','=','carts.service_id')
		// ->join('category__cruds','category__cruds.id','=','carts.category_id')
		// ->where('carts.user_id',Auth::user()->id)->get();

		//first check past data and delete those.
		$allPastData=Cart::where('order_date','<',Date('Y-m-d'))->where('user_id',Auth::user()->id)->orderBy('id','desc')->pluck('id')->toArray();
		// dd($allPastData);
		if(count($allPastData)>0){
			// dd(1);
			//delete
			$allPastData=Cart::where('order_date','<',Date('Y-m-d'))->whereIn('id',$allPastData)->where('user_id',Auth::user()->id)->orderBy('id','desc')->delete();
		}

		$data['cart'] = Cart::with('serviceDetails','categoryDetails')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
		$data['total_price'] = Cart::where('user_id',Auth::user()->id)->sum('total_price');

		// $data['grand_total'] = $data['cart']->sum('total_price');
		return view('Customer.orders.cart_page',$data);
	   }else{
	   	// PHP code to get the MAC address of Server
			// $MAC = exec('getmac');
			// Storing 'getmac' value in $MAC
			// $MAC2 = strtok($MAC, ' ');
			 // $MAC2=$request->ip();
			// dd($MAC2);
	   	// dd(1);

         	$data = [];
	   	 if($request->session()->has('randmon_number')){
              $MAC2= $request->session()->get('randmon_number');
              // dd($MAC2);

		   	$data = [];
			$data['cart'] = Cart::with('serviceDetails','categoryDetails')->where('system_id',$MAC2)->orderBy('id','desc')->get();
			$data['total_price'] = Cart::where('system_id',$MAC2)->sum('total_price');

			// $data['grand_total'] = $data['cart']->sum('total_price');
			// dd($data['cart']);
		
	    }else{
	    	$data['cart'] = [];

	    }


	    	return view('Customer.orders.cart_page',$data);
	   
	   }
	}







	public function buy(Request $request){
		// dd($request->all());
		$blank=[];

		foreach($request->cart_id as $key=> $val){
			$blank[$key]['cart_id']=$val;
		}
		foreach($request->base_price as $key=> $val){
			$blank[$key]['base_price']=$val;
		}
		foreach($request->quantity as $key=> $val){
			$blank[$key]['quantity']=$val;
		}
		foreach($request->total_price_input as $key=> $val){
			$blank[$key]['total_price_input']=$val;
		}
		foreach($request->days as $key=> $val){
			$blank[$key]['days']=$val;
		}
		
		
		// dd($request->all(),$blank);

		//loop that blank arry and update the cart
		foreach ($blank as $key => $value) {
			//update Cart Table
			$upd=Cart::where('id',$value['cart_id'])->update(['days'=>$value['days'],'quantity'=>$value['quantity'],'total_price'=>$value['total_price_input'] ]);
		}
		// dd($blank);
		//now load address page
		return redirect()->route('cust.service.address.page');
	}







public function service_address(){
	 if(@Auth::user()->id && @Auth::user()->role_id==3){
            return redirect()->route('vandor.dashboard');
        }

        if(@Auth::user()->id && @Auth::user()->role_id==4){
            return redirect()->route('agent.dashboard');
        }


	if(@Auth()->user()->id && @Auth::user()->role_id==2){
		//condition if no adress the cart addes page else new crud address page
		$find=UserToAddress::where('user_id',Auth::user()->id)->first();
		if($find){
			$data['all_address']=UserToAddress::where('user_id',Auth::user()->id)->get();
			 return view('Customer.orders.cart_address_list_page')->with($data);
		}else{
		 return view('Customer.orders.cart_address_page');
		}
	}else{
		return redirect()->route('cust.login.view')->with('success','Please Login For Go ahead');
	}
}








public function cust_cart_address_ins(Request $request){
 // dd($request->all());
	 $request->validate([
            'city' => 'required',
            'state' => 'required',
            'house_number' => 'required',
            'billing_name' => 'required',
            'billing_mobile' => 'required',
            'for_address' => 'required',

            'address_address' => 'required',
            'address_latitude' => 'required',
            'address_longitude' => 'required',
            'landmark' => 'required',
            'area' => 'required',
            'pin_code' => 'required',
            'address_type' => 'required',
        ]);
	 // dd(1);
	 // lat and long can not be 0
	 if($request->address_latitude==0 || $request->address_longitude==0){
	 	return back()->with('error','Latitude or longtitude can not be 0');
	 }


 if(@Auth()->user()->id){

 	//default address
 	$findAddress=UserToAddress::where('user_id',Auth::user()->id)->first();
 	if(!$findAddress){
 		$ins=new UserToAddress;
 		$ins->user_id=Auth::user()->id;
 		$ins->default_address="Y";
        
        $ins->country=@$request->country;
 		$ins->city=$request->city;
 		$ins->state=$request->state;
 		$ins->house_number=$request->house_number;
 		$ins->billing_name=$request->billing_name;
 		$ins->billing_mobile=$request->billing_mobile;
 		$ins->for_address=$request->for_address;

 		$ins->address=$request->address_address; 
 		$ins->lat=$request->address_latitude;
 		$ins->long=$request->address_longitude;
 		$ins->landmark=$request->landmark;
 		$ins->area=$request->area;
 		$ins->pin_code=$request->pin_code;
 		$ins->address_type=$request->address_type;
 		$ins->save();
 	}
 	// dd($request->all(),$findAddress);

 	// if($request->default_address=="yes"){
 	// 	// dd(1);
 	// 	//delete prev address and add the new one
 	// 	// $del=UserToAddress::where('user_id',Auth::user()->id)->delete();

 	// 	//new insert
 	// 	$ins=new UserToAddress;
 	// 	$ins->user_id=Auth::user()->id; 

 	// 	$ins->city=$request->city;
 	// 	$ins->state=$request->state;
 	// 	$ins->house_number=$request->house_number;
 	// 	$ins->billing_name=$request->billing_name;
 	// 	$ins->billing_mobile=$request->billing_mobile;
 	// 	$ins->for_address=$request->for_address;


 	// 	$ins->address=$request->address_address; 
 	// 	$ins->lat=$request->address_latitude;
 	// 	$ins->long=$request->address_longitude;
 	// 	$ins->landmark=$request->landmark;
 	// 	$ins->area=$request->area;
 	// 	$ins->pin_code=$request->pin_code;
 	// 	$ins->address_type=$request->address_type;
 	// 	$ins->save();
 	// }

		
			$allCartData = Cart::where('user_id',Auth::user()->id)->get();
			$rand_num=mt_rand(10000,999999999);

			if(count($allCartData)>0){
				$updt=Cart::where('user_id',Auth::user()->id)->update([
					'address'=>$request->address_address, 
					'lat'=>$request->address_latitude,
					'lng'=>$request->address_longitude,

					'event_city'=>$request->city,
					'state'=>$request->state,
					'house_number'=>$request->house_number,
					'billing_name'=>$request->billing_name,
					'billing_mobile'=>$request->billing_mobile,
					'for_address'=>$request->for_address,

					'landmark'=>$request->landmark,
					'area'=>$request->area,
					'pin_code'=>$request->pin_code,
					'address_type'=>$request->address_type,
				    'order_id'=>$rand_num
				 ]);
				// dd("address updated done with login, payment module will next");
				// return view('Customer.Payment.payment_one');
				return redirect()->route('cust.payment.page');
				
			}
			else{
				return back()->with('error','no data');
			}
	   }


	   else{
	   	
		   	if($request->session()->has('randmon_number')){
	             $MAC2= $request->session()->get('randmon_number');
	             // dd($MAC2);
				$allCartData= Cart::where('system_id',$MAC2)->get();
					if(count($allCartData)>0){
						$updt=Cart::where('system_id',$MAC2)->update([
							'address'=>$request->address_address, 
							'lat'=>$request->address_latitude,
							'lng'=>$request->address_longitude,

							'event_city'=>$request->city,
							'state'=>$request->state,
							'house_number'=>$request->house_number,
							'billing_name'=>$request->billing_name,
							'billing_mobile'=>$request->billing_mobile,
							'for_address'=>$request->for_address,

							'landmark'=>$request->landmark,
							'area'=>$request->area,
							'pin_code'=>$request->pin_code,
							'address_type'=>$request->address_type
						]);
						// echo "address updated done without login";
						return redirect()->route('cust.login.view')->with('success','Please Login For Go ahead');
					}
					else{
						return back()->with('error','no data');
					}

		    }
	   
	   }
}






public function cust_find_address(Request $request){
	$findAddress=UserToAddress::where('id',$request->address_id)->first();
	return response()->json(["data"=>$findAddress]);
}






public function address_delete($id){
	$findAddress=UserToAddress::where('id',$id)->delete();
	return back()->with('success','Address Deleted');
}












// ================================== details page for service and category========================//


public function details_service($id){
	// dd($id);
	$srch=Services::where('id',$id)->first();
	if(!@$srch){
		return back()->with('error','Id not found.');
	}

	$data['service']=Services::where('id',$id)->first();
	$categoryId=Service_Crud::where('service_id',$srch->id)->first();

	$data['category']=Category_Crud::where('id',$categoryId->category_id)->first();

    // dd($data);
	return view('Customer.Dashboard.service_details')->with($data);
}





public function category_to_service($id){
	$srch=Category_Crud::where('id',$id)->first();
	if(!@$srch){
		return back()->with('error','Id not found.');
	}

	$allServiceUnderThisCategory=Service_Crud::where('category_id',$id)->pluck('service_id')->toArray();
	$data['allService']=Services::whereIn('id',$allServiceUnderThisCategory)->where('status','A')->get();
	$data['category_details']=Category_Crud::where('id',$id)->first();
	return view('Customer.Dashboard.category_details')->with($data);
}





public function all_category(){
   $data['category']=Category_Crud::where('category_status','A')->get();
  // dd($data);
  return view('Customer.Dashboard.all_category')->with($data);
}





public function all_services(){
  $allServices=Services::where('status','A')->pluck('service')->toArray();
  $uniqueNames=array_unique($allServices);
  $unique_ids=[];
  foreach($uniqueNames as $val){
     $find=Services::where('status','A')->where('service',$val)->first();
     array_push($unique_ids,$find->id);
  }
 
  // dd($uniqueNames,$unique_ids);
  $data['services']=Services::where('status','A')->whereIn('id',$unique_ids)->get();

  return view('Customer.Dashboard.all_service')->with($data);
}





public function delete_cart($id,Request $request){
		if(@Auth()->user()->id){
		
			$dlt = Cart::where('user_id',Auth::user()->id)->orderBy('id','desc')->where('id',$id)->first();
			if($dlt){
				Cart::where('user_id',Auth::user()->id)->orderBy('id','desc')->where('id',$id)->delete();
				return back()->with('success','deleted');
			}
			else{
				return back()->with('error','id not match');
			}
	   }


	   else{
	   	
		   	if($request->session()->has('randmon_number')){
	             $MAC2= $request->session()->get('randmon_number');
	             // dd($MAC2);
				$dlt= Cart::where('system_id',$MAC2)->where('id',$id)->first();
					if($dlt){
						Cart::where('system_id',$MAC2)->where('id',$id)->delete();
						return back()->with('success','deleted');
					}
					else{
						return back()->with('error','id not match');
					}

		    }
	   
	   }
}
























// ========================== customer address crud ===================================//

public function add_address(){
 return view('Customer.orders.add_address');
}



public function insert_address(Request $request){
	// dd($request->all());
	 $request->validate([
            'city' => 'required',
            'state' => 'required',
            'house_number' => 'required',
            'billing_name' => 'required',
            'billing_mobile' => 'required',
            'for_address' => 'required',

            'address_address' => 'required',
            'address_latitude' => 'required',
            'address_longitude' => 'required',
            'landmark' => 'required',
            'area' => 'required',
            'pin_code' => 'required',
            'address_type' => 'required',
        ]);
	 // dd(1);
	  if($request->address_latitude==0 || $request->address_longitude==0){
	 	return back()->with('error','Latitude or longtitude can not be 0');
	 }

	//if default address comes Y then check pre default address ad make it N
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

 		$ins->address=$request->address_address; 
 		$ins->lat=$request->address_latitude;
 		$ins->long=$request->address_longitude;
 		$ins->landmark=$request->landmark;
 		$ins->area=$request->area;
 		$ins->pin_code=$request->pin_code;
 		$ins->address_type=$request->address_type;
 		$ins->save();
 		return redirect()->route('cust.service.address.page')->with('success','New address Added');
}



public function edit_address($id){
  $find=UserToAddress::where('user_id',Auth::user()->id)->where('id',$id)->first();
  if(!$find){
  	return back()->with('error','Address id not matche');
  }
  $data['data']=$find;
  return view('Customer.orders.edit_address')->with($data);

}




public function update_address(Request $request){

	// dd($request->all());
	 $request->validate([
            'city' => 'required',
            'state' => 'required',
            'house_number' => 'required',
            'billing_name' => 'required',
            'billing_mobile' => 'required',
            'for_address' => 'required',

            'address_address' => 'required',
            'address_latitude' => 'required',
            'address_longitude' => 'required',
            'landmark' => 'required',
            'area' => 'required',
            'pin_code' => 'required',
            'address_type' => 'required',
        ]);
	 // dd(1);
	  if($request->address_latitude==0 || $request->address_longitude==0){
	 	return back()->with('error','Latitude or longtitude can not be 0');
	 }
    
     //if default address comes Y then check pre default address ad make it N
	//if default address comes Y then check pre default address ad make it N
	if($request->default_address=="Y"){
		$chk=UserToAddress::where('user_id',Auth::user()->id)->where('default_address','Y')->first();
		if($chk){
			$up=UserToAddress::where('user_id',Auth::user()->id)->where('default_address','Y')->update(['default_address'=>"N"]);
		}
	}

     $upd=[];
     $upd['default_address']=$request->default_address;
     	$upd['country']=@$request->country;
 		$upd['city']=$request->city;
 		$upd['state']=$request->state;
 		$upd['house_number']=$request->house_number;
 		$upd['billing_name']=$request->billing_name;
 		$upd['billing_mobile']=$request->billing_mobile;
 		$upd['for_address']=$request->for_address;

 		$upd['address']=$request->address_address; 
 		$upd['lat']=$request->address_latitude;
 		$upd['long']=$request->address_longitude;
 		$upd['landmark']=$request->landmark;
 		$upd['area']=$request->area;
 		$upd['pin_code']=$request->pin_code;
 		$upd['address_type']=$request->address_type;
 		 $find=UserToAddress::where('user_id',Auth::user()->id)->where('id',$request->id)->update($upd);
 		
 		return redirect()->route('cust.service.address.page')->with('success',' Address Updated');
}






public function delete_address($id){
$find=UserToAddress::where('user_id',Auth::user()->id)->where('id',$id)->first();
  if(!$find){
  	return back()->with('error','Address id not matche');
  }
  $find=UserToAddress::where('user_id',Auth::user()->id)->where('id',$id)->delete();
  return redirect()->route('cust.service.address.page')->with('success','Address deleted');
}











public function cust_cart_address_ins_two(Request $request){
	// dd($request->all());
		$allCartData = Cart::where('user_id',Auth::user()->id)->get();
			$rand_num=mt_rand(10000,999999999);

			if(count($allCartData)>0){
				//find address details from id
				$addressDetails=UserToAddress::where('user_id',Auth::user()->id)->where('id',$request->address_id)->first();
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
				    'order_id'=>$rand_num
				 ]);
				// dd("address updated done with login, payment module will next");
				// return view('Customer.Payment.payment_one');
				return redirect()->route('cust.payment.page');
				
			}
			else{
				return back()->with('error','no data');
			}
}







public function be_our_agent(){
	if(@Auth::user()->id){
		$up=User::where('id',Auth::user()->id)->update(['is_agent'=>'Y']);
		return back()->with('success','Now you are our agent for utsavlive');

	}else{
		return back()->with('error','No data found');
	}
}





































































	public function updateCart(Request $request)
	{

		$response = [];
		$details = Cart::where('id',$request->id)->first();
		$check = Product::where('id',$details->service_id)->first();
		// return $check;
		if ($request->quantity > $check->stocks) {
			$response['success'] = false;
			$response['message'] = 'This much quantity is not available in stock.Please decrese the quantity';
			return  $response;
		}
		
		$total_price = $details->price * $request->quantity;
		
		Cart::where('id',$request->id)->update(['quantity'=>$request->quantity,'total_price'=>$total_price]);
		$allcart = Cart::where('user_id',auth()->user()->id)->get();
		$response['success'] = true;
 		$response['grand_total'] = $allcart->sum('total_price');
		$response['total_price'] = $total_price;
		return $response;
	}










	public function deleteProduct($id)
	{
		Cart::where('id',$id)->delete();
		return redirect()->back()->with('success','Product Deleted From Cart Successfully');
	}










	public function checkOut()
	{
		$data = [];
		$data['cart'] = Cart::where('user_id',auth()->user()->id)->where('status','A')->where('admin_status','A')->where('shop_status','A')->get();
		if (count($data['cart'])==0) {
			return redirect()->route('products.lsiting');
		}
		$data['grand_total'] = $data['cart']->sum('total_price');
		$data['addressBook'] = Addressbook::where('user_id',auth()->user()->id)->get();
		return view('cart.checkout',$data);
	}


















	public function placeOrder(Request $request)
	{

	   $allCartData = Cart::where('user_id',auth()->user()->id)->where('status','A')->where('admin_status','A')->where('shop_status','A')->get();

	    $ins = [];
		$ins['name'] = $request->name;
		$ins['email'] = $request->email;
		$ins['mobile'] = $request->mobile;
	   		   	if (@$request->address_book) {
	   	  $addressBook = Addressbook::where('id',$request->address_book)->first();
	   	  $ins['state'] = $addressBook->state;
		  $ins['city'] = $addressBook->city;
		  $ins['pincode'] = $addressBook->pincode;
		  $ins['landmark'] = $addressBook->landmark;
		  $ins['address'] = $addressBook->address;	

	   	}else{
		   	$ins['state'] = $request->state;
			$ins['city'] = $request->city;
			$ins['pincode'] = $request->pincode;
			$ins['landmark'] = $request->landmark;
			$ins['address'] = $request->address;

			 // address-book

        $check = Addressbook::where('user_id',auth()->user()->id)->where('state',$request->state)->where('city',$request->city)->where('pincode',$request->pincode)->where('landmark',$request->landmark)->where('address',$request->address)->first();
		if ($check=='') {
			$insAdd = [];
			$insAdd['user_id'] = auth()->user()->id;
			$insAdd['state'] = $request->state;
			$insAdd['city'] = $request->city;
			$insAdd['pincode'] = $request->pincode;
			$insAdd['landmark'] = $request->landmark;
			$insAdd['address'] = $request->address;
			Addressbook::create($insAdd);
		}

	   	}
		
		$ins['payment_type'] = $request->payment_type;
		$ins['user_id'] = auth()->user()->id;


		





		if (@$request->payment_type=="COD") {
			$ins['payment_status'] = 'P';
		}else{
			$ins['payment_status'] = 'IP';
		}
		
		$ins['date'] = date('Y-m-d');
		$ins['order_total'] = $allCartData->sum('total_price');
		$createBooking= Ordermaster::create($ins);

		// generate-code

		$code='';
		$idlength=strlen($createBooking->id);
		if($idlength>4)
		{
			$code=$createBooking->id;
		}
		else
		{
			for($i=0;$i<(4-$idlength);$i++)
			{
				$code.='0';
			}
			$code=$code.$createBooking->id;
		}
        $upd=[];
		$upd['order_id']='I'.date('y').date('m').date('d').$code;
        Ordermaster::where('id', $createBooking->id)->update($upd);

       





        // save-cart-details 

        if ($request->payment_type=="COD") {
        

        $insCart=[];

        

        foreach ($allCartData as $key => $value) {
        	$insCart['ordermaster_id'] = $createBooking->id;
        	$insCart['service_id'] = $value->service_id;
        	$insCart['vendor_id'] = $value->vendor_id;
        	$insCart['quantity'] = $value->quantity;
        	$insCart['price'] = $value->price;
        	$insCart['total_price'] = $value->total_price;
        	$insCart['user_id'] = auth()->user()->id;
        	OrderDetails::create($insCart);

        	// product-inventory related work 
        	$product = Product::where('id',$value->service_id)->first();
        	$now_quantity = $product->stocks - $value->quantity;
        	Product::where('id',$value->service_id)->update(['stocks'=>$now_quantity]);
        	$now_product = Product::where('id',$value->service_id)->first();
        	$shop_details = User::where('id',$value->vendor_id)->first();
            // send alert mail 		
        	if ($now_product->stock_notification >$now_product->stocks || $now_product->stock_notification==$now_product->stocks) {
        		$data = [
        			'name'=>$shop_details->name,
        			'product_name'=>$product->name,
        			'shop_name'=>$shop_details->store_name,
        			'email'=>$shop_details->email,
        		];	
        		Mail::send(new Stock($data));
        	}

        	if ($now_product->stocks==0 || $now_product->stocks<0) {
        		$data = [
        			'name'=>$shop_details->name,
        			'product_name'=>$product->name,
        			'shop_name'=>$shop_details->store_name,
        			'email'=>$shop_details->email,
        		];	
        		Product::where('id',$value->service_id)->update(['available'=>'N']);
        		Mail::send(new OutOfStock($data));
        	}

        }

        $details = Ordermaster::where('id',$createBooking->id)->first();

        // send-mail-customer

        $data = [
        	'order_id'=>$details->order_id,
        	'email'=>$request->email,
        	'order_total'=>$details->order_total,
        	'name'=>$request->name,
        ];
        
        Mail::send(new OrderMail($data));

        // send-mail-shop-owners

        $OrderDetails = OrderDetails::where('ordermaster_id',$createBooking->id)->get();
        foreach ($OrderDetails as $key => $value) {
        	$vendor = User::where('id',$value->vendor_id)->first();
        	$data = [
        		'email'=>$vendor->email,
        		'name'=>$vendor->name,
        		'shop_name'=>$vendor->store_name,
        	];
        	Mail::send(new VendorOrder($data));

        }

        Cart::where('user_id',auth()->user()->id)->delete();
        return redirect()->route('my.order')->with('success','Order Placed Successfully'); 
    }else{
    	return redirect()->route('payment.razorpay',['id'=>$createBooking->id]);
    }


 	}



}

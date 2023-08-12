<?php

namespace App\Http\Controllers\CustomerWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use App\Models\Order;

class PaymentController extends Controller
{


   function encrypt($plainText,$key)
{
    $key = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    $encryptedText = bin2hex($openMode);
    return $encryptedText;
}

/*
* @param1 : Encrypted String
* @param2 : Working key provided by CCAvenue
* @return : Plain String
*/
// function decrypt($encryptedText,$key)
// {
//     $key = hextobin(md5($key));
//     $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
//     $encryptedText = hextobin($encryptedText);
//     $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
//     return $decryptedText;
// }

// function hextobin($hexString)
//  {
//     $length = strlen($hexString);
//     $binString="";
//     $count=0;
//     while($count<$length)
//     {
//         $subString =substr($hexString,$count,2);
//         $packedString = pack("H*",$subString);
//         if ($count==0)
//         {
//             $binString=$packedString;
//         }

//         else
//         {
//             $binString.=$packedString;
//         }

//         $count+=2;
//     }
//         return $binString;
//   }






public function payment(){
    $data['cart_details']=Cart::where('user_id',Auth()->user()->id)->first();

    if($data['cart_details']){
        $data['cart'] = Cart::with('serviceDetails','categoryDetails')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $data['total_price']=Cart::where('user_id',Auth()->user()->id)->sum('total_price');
      return view('Customer.Payment.payment_one')->with($data);
    }else{
        return back();
    }
}






    public function ccavRequestHandler(Request $request){
        // dd($request->all());
        return view('Customer.Payment.payment_two');
    }







    public function ccavResponseHandler(Request $request){
        // dd($request->all());
        // dd($request->all());
        function decrypt($encryptedText,$key)
        {
            $key = hextobin(md5($key));
            $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
            $encryptedText = hextobin($encryptedText);
            $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
            return $decryptedText;
        }



        function hextobin($hexString)
         {
            $length = strlen($hexString);
            $binString="";
            $count=0;
            while($count<$length)
            {
                $subString =substr($hexString,$count,2);
                $packedString = pack("H*",$subString);
                if ($count==0)
                {
                    $binString=$packedString;
                }

                else
                {
                    $binString.=$packedString;
                }

                $count+=2;
            }
                return $binString;
          }








   // --------------------------- MAIN PART START ------------------------------//

    error_reporting(0);

    $workingKey='71C601249EB02EF527619F404F6536F6';     //Working Key should be provided here.
    $encResponse=$request->encResp;         //This is the response sent by the CCAvenue Server
    $rcvdString=decrypt($encResponse,$workingKey);
      //Crypto Decryption used as per the specified working key.
    // dd($rcvdString);
    $order_status="";
    $orderId="";
    $trackingId="";
    $decryptValues=explode('&', $rcvdString);
    $dataSize=sizeof($decryptValues);
    echo "<center>";

    for($i = 0; $i < $dataSize; $i++)
    {
        $information=explode('=',$decryptValues[$i]);
        if($i==3)   $order_status=$information[1];
    }




   // order id and tracking is
     for($i = 0; $i < $dataSize; $i++)
    {
        $information=explode('=',$decryptValues[$i]);
        if($i==0){
            $orderId=$information[1];
        }
        if($i==1){
            $trackingId=$information[1];
        }
    }





    // dd($orderId,$trackingId);
    // login user and get user id from cart table
    $userid=Cart::where('order_id',$orderId)->first();
    $userLoginId=$userid->user_id;
    // dd($userLoginId);
    $userDetails=User::where('id',$userLoginId)->first();
    Auth::login($userDetails);
    // dd(Auth::user()->id);






    if($order_status==="Success")
    {
          //code for success
            //get all cart data
            $allCartDataUnderThatUser=Cart::where('user_id',Auth()->user()->id)->get();
            // dd( $allCartDataUnderThatUser,Auth()->user()->id);
            foreach($allCartDataUnderThatUser as $val){
                // dd($val['address'],Auth()->user()->id);
                //insert to order table
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
                // $order_ins->event_city=$val->event_city;
                $order_ins->event_address=$val->address;
                $order_ins->event_pin=$val->pin_code;
                $order_ins->is_customized=0;

                $order_ins->txn_no=$trackingId;
                $order_ins->order_id=$orderIds;
                $order_ins->order_status=1; //upcomming
                $order_ins->save();
            }

            //delete from cart table
             $DelallCartDataUnderThatUser=Cart::where('user_id',Auth()->user()->id)->delete();


        echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";

    }


    else if($order_status==="Aborted")
    {


        echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";

    }
    else if($order_status==="Failure")
    {
        //code for success
            //get all cart data
            $allCartDataUnderThatUser=Cart::where('user_id',Auth()->user()->id)->get();
            // dd( $allCartDataUnderThatUser,Auth()->user()->id);
            foreach($allCartDataUnderThatUser as $val){
                // dd($val['address'],Auth()->user()->id);
                //insert to order table
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
                $order_ins->payment_status='F';

                $order_ins->time=$val->time;
                $order_ins->event_date=$val->order_date;
                $order_ins->event_end_date=$val->order_end_date;
                $order_ins->days=$val->days;
                // $order_ins->event_city=$val->event_city;
                $order_ins->event_address=$val->address;
                $order_ins->event_pin=$val->pin_code;
                $order_ins->is_customized=0;

                $order_ins->txn_no=$trackingId;
                $order_ins->order_id=$orderIds;
                $order_ins->order_status=1; //upcomming
                $order_ins->save();
            }

            //delete from cart table
             $DelallCartDataUnderThatUser=Cart::where('user_id',Auth()->user()->id)->delete();

        echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
    }
    else
    {
        echo "<br>Security Error. Illegal access detected";

    }







    echo "<br><br>";

    echo "<table cellspacing=4 cellpadding=4>";
    for($i = 0; $i < $dataSize; $i++)
    {
        $information=explode('=',$decryptValues[$i]);
            echo '<tr><td>'.$information[0].'</td><td>'.urldecode($information[1]).'</td></tr>';
    }

    echo "</table><br>";
    echo "</center>";
    }








public function cod_order_confirm(){

    $orderId=mt_rand(10000,99999);

     //code for success
            //get all cart data
            $allCartDataUnderThatUser=Cart::where('user_id',Auth()->user()->id)->get();
            if(count($allCartDataUnderThatUser)<1){
                return back();
            }
            // dd( $allCartDataUnderThatUser,Auth()->user()->id);
            foreach($allCartDataUnderThatUser as $val){
                // dd($val['address'],Auth()->user()->id);
                //insert to order table
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
                $order_ins->package_id = $val->package_id;
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
                // $order_ins->event_city=$val->event_city;
                $order_ins->event_address=$val->address;
                $order_ins->event_pin=$val->pin_code;
                $order_ins->is_customized=0;

                $order_ins->txn_no="";
                $order_ins->order_id=$orderId;
                $order_ins->order_status=1; //upcomming
                $order_ins->save();
            }

            //delete from cart table
             $DelallCartDataUnderThatUser=Cart::where('user_id',Auth()->user()->id)->delete();

             return redirect()->route('cust.dashboard')->with('success','Order Confirm');

}











}

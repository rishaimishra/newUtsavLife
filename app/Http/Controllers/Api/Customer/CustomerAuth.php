<?php

namespace App\Http\Controllers\Api\Customer;

use Auth;
use Hash;
use JWTAuth;
use Response;
use Validator;
use App\Models\User;
use App\Models\Order;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Models\Category_Crud;
use App\Mail\CustomerLoginOtp;
use App\Models\Vendor_services;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;

class CustomerAuth extends Controller
{

    public function customerRegistration(Request $request)
    {
        $response = [];
        try {
            
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }


        //check that email already exist or not
       $chk1=User::where('email',$request->email)->first();
       if($chk1){
        return response()->json(['error'=>'Email already exists'], 401);
       }
       //check that mobile already exist or not
       $chk2=User::where('mobile',$request->mobile)->first();
       if($chk2){
        return response()->json(['error'=>'Mobile number already exists'], 401);
       }

       $user=new User;
       $user->name=$request->name;
       $user->email=$request->email;
       $user->password=Hash::make($request->password);
       $user->mobile=$request->mobile;
       $user->platform_type="app";
       $user->role_id=2;
       $user->save();
       $token = JWTAuth::fromUser($user);
       $response['success'] = true;
       $response['message'] = 'Registration Successfully';
       $response['token'] = $token;
       return $response;


        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return Response::json($response); 
        }
    }

    public function login(Request $request)
    {
        $response = [];
        try {
        $validator = Validator::make($request->all(), [ 
            'email'=>'required',
            'password'=>'required',
        ]);

        $userDataEmail=User::where('email',$request->email)->where("role_id",2)->first();
        if ($userDataEmail) {
            if (!\Hash::check($request->password, $userDataEmail->password)) {
            return response()->json(['error'=>'Incorrect Password'], 401); 
        }  


                 $token = JWTAuth::fromUser($userDataEmail);

                 $response['result']['code'] = "200";
                 $response['result']['message'] = "successfull login";
                 $response['result']['token'] = $token;
                 return Response::json($response);
        



        }else{
                return response()->json(['error'=>'Unauthorised'], 401); 
         }

        }catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return Response::json($response); 
        }
    }


    public function me()
    {
        $response = [];
        $response['success'] = true;
        $response['data'] = Auth::user();
        return $response;
    }

    public function upcomingOrder()
    {
        $response = [];
        try {
            $response['status'] = true;
            $orders = Order::with('categoryDetails','serviceDetails')->where('customer_user_id',auth()->user()->id)->with('VandorDetails')->where('payment_status','S')->where('order_status',1)->get();
            
            $response['data'] = $orders;
            return $response;
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return Response::json($response); 
        }
    }

    public function deliverOrder()
    {
        $response = [];
        try {
            $response['status'] = true;
            $response['data'] = Order::with('categoryDetails','serviceDetails')->where('customer_user_id',Auth()->user()->id)->with('VandorDetails')->where('payment_status','S')->where('order_status',3)->get();
            return $response;
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return Response::json($response); 
        }
    }

    public function allCategory()
    {
        $response = [];
        try {
            $response['success']=true;
            $response['category']=Category_Crud::where('category_status',1)->get();
            return $response;

        }catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return Response::json($response); 
        }
    }

    public function allService()
    {
        $response = [];
        try {
            $response['success']=true;
            $response['services']=Services::with('serviceCategoryDetails')->where('status','!=','D')->get();
            return $response;

        }catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return Response::json($response); 
        }
    }

    public function singleService($id)
    {
        $response = [];
        try {
            $response['success']=true;
            $response['services']=Services::with('serviceCategoryDetails')->where('id',$id)->where('status','!=','D')->first();
            return $response;

        }catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return Response::json($response); 
        }
    }

    public function updateCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user = User::find($request->user_id);
        if(!$user)
        {
            return response()->json(['error'=>'User Not Found'], 401);
        }
        $response = [];

        if(!empty($request->email))
        {
            $chk=User::where('email',$request->email)->where('id','!=',Auth()->user()->id)->first();
            if($chk){
                return response()->json(['error'=>'This Email already exists'], 401);
            }

            $code=mt_rand(100000,999999);
            $upd=User::where('id',Auth()->user()->id)->update(['temp_email'=>$request->email,'otp'=>$code]);
            $data = [
                        'email'=>$request->email,
                        'name'=>Auth()->user()->name,
                        'otp'=>$code,
                    ];
            Mail::send(new CustomerLoginOtp($data));

            return response()->json([
                'status'=>true,
                'messgae' => 'Token has been sent to your email address',
                'data'=>$data
            ], 200);
        }

        if(!empty($request->mobile))
        {
            $chk=User::where('mobile',$request->mobile)->where('id','!=',Auth()->user()->id)->first();
            if($chk){
                return response()->json(['error'=>'This Number already exists'], 401);
            }

            $code=mt_rand(100000,999999);
            $upd=User::where('id',Auth()->user()->id)->update(['temp_mobile'=>$request->mobile,'otp'=>$code]);
            $data = [
                'mobile'=>$request->mobile,
                'name'=>Auth()->user()->name,
                'otp'=>$code,
            ];

            return response()->json([
                'status'=>true,
                'messgae' => 'Token has been generated',
                'data'=>$data
            ], 200);
        }

        if(!empty($request->name))
        {
            $user->name = $request->name;
        }

        if($request->image){
            $image = $request->image;
            $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move("storage/app/public/customer",$filename);
  
            $user->avatar=$filename;
          }

        $result = $user->save();
        if($request)
        {
            $response['result']['code'] = "200";
            $response['result']['message'] = "Update successfull login";
        }
        else
        {
            $response['result']['code'] = "401";
            $response['result']['message'] = "Error";
        }
        
        return Response::json($response);
        
    }

    public function updateEmailOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'otp'   => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $userFound = User::where('id',$request->user_id)->first();
        if(!$userFound)
        {
            return response()->json([
                'status'=>false,
                'message'=>'No Records Found'
            ], 401);
        }
        $check=User::where('id',Auth()->user()->id)->where('otp',$request->otp)->first();
        if(!$check){
            return response()->json([
                'status'=>false,
                'message'=>'Entered OTP is wrong'
            ], 401);
        }else{
            $newemail=$check->temp_email;
            $upd=[];
            $upd['temp_email']=null;
            $upd['otp']=null;
            $upd['email']= $newemail;
            $update=User::where('id',Auth()->user()->id)->update($upd);
            if($update)
            {
                return response()->json([
                    'status'=>true,
                    'message'=>'Email Updated successfully'
                ], 200);
            }
        }
    }

    public function updateMobileOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'otp'   => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $userFound = User::where('id',$request->user_id)->first();
        if(!$userFound)
        {
            return response()->json([
                'status'=>false,
                'message'=>'No Records Found'
            ], 401);
        }
        $check=User::where('id',Auth()->user()->id)->where('otp',$request->otp)->first();
        if(!$check){
            return response()->json([
                'status'=>false,
                'message'=>'Entered OTP is wrong'
            ], 401);
        }else{
            $newMobile=$check->temp_mobile;
            $upd=[];
            $upd['temp_mobile']=null;
            $upd['otp']=null;
            $upd['mobile']= $newMobile;
            $update=User::where('id',Auth()->user()->id)->update($upd);

            if($update)
            {
                return response()->json([
                    'status'=>true,
                    'message'=>'Mobile Updated successfully'
                ], 200);
            }
        }
    }
}

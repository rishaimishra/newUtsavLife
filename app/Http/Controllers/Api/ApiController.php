<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use App\Mail\CustomerLoginOtp;
use Mail;
use Response;

class ApiController extends Controller
{








 /**
*   Purpose     :User Registrtion 
*   Description :User Registrtion 
*   Author      : JEET
**/ 
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 2,
            'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
 










 /**
*   Purpose     :  User login 
*   Description :  User login 
*   Author      : JEET
**/ 
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
        return $credentials;
            return response()->json([
                    'success' => false,
                    'message' => 'Could not create token.',
                ], 500);
        }
    
        //Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
 







 /**
*   Purpose     : User logout 
*   Description : User logout 
*   Author      : JEET
**/ 
    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
 










/**
*   Purpose     :User details 
*   Description :User details 
*   Author      : JEET
**/ 

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }













/**
*   Purpose     : otp login part 1
*   Description : otp login part 1 (enter mail or mobile)
*   Author      : JEET
**/ 
    public function otp_login_enter_mail(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'credential' => 'required'
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $srch=User::where('email',$request->credential)->orWhere('mobile',$request->credential)->first();
              if($srch){
                  $code=mt_rand(100000,999999);
                  $upd=User::where('id',$srch->id)->update(['otp'=>$code]);
                    $data = [
                          'email'=>$srch->email,
                          'name'=>$srch->name,
                          'otp'=>$code,
                          'id'=>$srch->id,
                      ];
                    Mail::send(new CustomerLoginOtp($data));
                
                      $response['result']['code'] = "200";
                      $response['result']['message'] = "otp send to your email";
                      $response['result']['otp'] = $code;
                      return Response::json($response);

              }else{
                  $response['result']['code'] = "500";
                  $response['result']['message'] = "User not found";
                  return Response::json($response);
              }

        } catch (\Throwable $th) {
            $response['result'] = ERRORS['-32705'];
            $response['result']['message'] = $th->getMessage();
            return Response::json($response);
        } catch (JWTException $e) {
            $response['result'] = ERRORS['-33010'];
            return response()->json($response);
        }
    }














    public function otp_login_enter_otp(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'otp' => 'required'
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

             $srch=User::where('otp',$request->otp)->where('role_id',2)->first();

             if(!$srch){
                  $response['result']['code'] = "500";
                  $response['result']['message'] = "otp is wrong";
                  return Response::json($response);
             }else{
                $userDetails=User::where('otp',$request->otp)->where('role_id',2)->first();

                $updatepassword = User::where('id',$userDetails->id)->update([
                    'otp'=>null
                ]); 

                $token = JWTAuth::fromUser($userDetails);

                  $response['result']['code'] = "200";
                  $response['result']['message'] = "successfull login";
                   $response['result']['token'] = $token;
                  return Response::json($response);
             }

         } catch (\Throwable $th) {
            $response['result'] = ERRORS['-32705'];
            $response['result']['message'] = $th->getMessage();
            return Response::json($response);
        } catch (JWTException $e) {
            $response['result'] = ERRORS['-33010'];
            return response()->json($response);
        }

    }
















}

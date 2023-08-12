<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Customer\CustomerAuth;
use App\Http\Controllers\Api\Customer\CartController;
use App\Http\Controllers\Api\Vendor\ServiceController;
use App\Http\Controllers\Api\Vendor\VendorAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [ApiController::class, 'authenticate'])->name('api.login');
Route::post('register', [ApiController::class, 'register'])->name('api.register');

//Vendor Routes
Route::post('/vendor/login', [VendorAuthController::class, 'login'])->name('vendor.api.login');
Route::post('/vendor/register', [VendorAuthController::class, 'registration'])->name('vendor.api.register');
Route::post('/vendor/forget-password',[VendorAuthController::class, 'forgetPassword']);
Route::post('/vendor/reset-password',[VendorAuthController::class, 'resetPassword']);

//Customer login through otp
Route::post('customer/otp-login-enter-credential', [ApiController::class, 'otp_login_enter_mail']);
Route::post('customer/otp-login-enter-otp', [ApiController::class, 'otp_login_enter_otp']);
Route::post('customer-login',[CustomerAuth::class,'login']);

// customer
Route::post('customer-registration',[CustomerAuth::class,'customerRegistration']);
Route::get('customer-all-category',[CustomerAuth::class,'allCategory']);
Route::get('customer-all-service',[CustomerAuth::class,'allService']);
Route::get('customer-single-service/{id}',[CustomerAuth::class,'singleService']);

Route::group(['middleware' => ['jwt.verify']], function(){

  Route::get('manage-vendor/active', [VendorAuthController::class, 'vandor_active']);
Route::get('manage-vendor/inactive', [VendorAuthController::class, 'vandor_deactive']);
Route::get('manage-vendor/delete', [VendorAuthController::class, 'vandor_delete']);


  // vendor-register-part-one
  Route::get('vendor-register-part-one-get-details',[VendorAuthController::class,'registration_part_one_get']);
  Route::post('vedor-register-part-registration',[VendorAuthController::class,'registration_part_one']);

  // vendor-register-part-two
  Route::get('vendor-register-part-two-get-details',[VendorAuthController::class,'registration_part_two_get']);
  Route::post('vendor-register-part-two-registration',[VendorAuthController::class,'registration_part_two']);

  // vendor-register-part-three
  Route::get('vendor-register-part-three-get-details',[VendorAuthController::class,'registration_part_three_get']);
  Route::post('vendor-register-part-three-registration',[VendorAuthController::class,'registration_part_three']);

  // vendor-register-part-four
  Route::get('vendor-register-part-four-get-details',[VendorAuthController::class,'registration_part_four_get']);
  Route::post('vendor-register-part-four-registration',[VendorAuthController::class,'registration_part_four']);

  Route::post('update-terms-condition-register-status',[VendorAuthController::class,'seventStatus']);

  Route::post('refresh', [VendorAuthController::class,'refresh']);
  Route::get('logout', [ApiController::class, 'logout']);
  Route::get('get_user', [ApiController::class, 'get_user']);
  Route::get('me',[VendorAuthController::class,'me']);
  // upcoming-order-vendor-sayan///////////////////////////////////
  Route::get('upcoming-order',[VendorAuthController::class,'upComingOrder']);
  Route::get('rejected-order',[VendorAuthController::class,'rejectedOrder']);
  Route::get('history-order',[VendorAuthController::class,'historyOrder']);
  Route::get('details-order/{id}',[VendorAuthController::class,'detailsOrder']);

  Route::get('vendor-approve-order/{id}',[VendorAuthController::class,'approveOrder']);
  Route::post('vendor-reject-order',[VendorAuthController::class,'rejectOrder']);

  // profile-update
  Route::post('vendor-profile-update',[VendorAuthController::class,'profile_update']);
  Route::post('vendor-office-address-update',[VendorAuthController::class,'office_address_update']);
  Route::post('vendor-all-images-update',[VendorAuthController::class,'all_images_update']);

  // service-crud
  Route::get('service-list-vendor',[ServiceController::class,'list']);
  Route::get('service-list-add-view',[ServiceController::class,'addView']);
  Route::post('service-insert',[ServiceController::class,'insert']);
  Route::get('service-active/{id}',[ServiceController::class,'active']);
  Route::get('service-deactive/{id}',[ServiceController::class,'deactive']);
  Route::get('service-delete/{id}',[ServiceController::class,'delete']);
  Route::get('service-edit/{id}',[ServiceController::class,'edit']);
  Route::post('service-update',[ServiceController::class,'update']);
  Route::post('category-dependency',[ServiceController::class,'dependency']);

  // cancel-reasons-fetch
  Route::get('get-resons',[VendorAuthController::class,'getReasons']);
  Route::get('get-resons',[VendorAuthController::class,'getReasons']);

  // customer-api///////////////////////////////////////////////////////
  
  Route::get('customer-details',[CustomerAuth::class,'me']);
  Route::get('customer-upcoming-order',[CustomerAuth::class,'upcomingOrder']);
  Route::get('customer-delivered-order',[CustomerAuth::class,'deliverOrder']);
  Route::post('customer-update',[CustomerAuth::class,'updateCustomer']);
  
  Route::post('customer/add-to-cart',[CartController::class,'addToCart']);
  Route::get('customer/show-cart',[CartController::class,'showCart']);
  Route::post('customer/update-cart-qty',[CartController::class,'updateCartQty']);
  Route::post('customer/delete-cart-item',[CartController::class,'delete']);
  Route::get('customer/get-countries',[CartController::class,'getCountry']);
  Route::post('customer/add-address',[CartController::class,'insert_address']);
  Route::get('customer/view-address',[CartController::class,'viewAddress']);
  Route::post('customer/payment',[CartController::class,'payment']);
  Route::get('customer/all-orders',[CartController::class,'allOrders']);

  Route::post('customer-email-otp-update',[CustomerAuth::class,'updateEmailOTP']);
  Route::post('customer-mobile-otp-update',[CustomerAuth::class,'updateMobileOTP']);
});
Route::post('customer/search',[CartController::class,'search']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AllLeadController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\CustomerWeb\CartController;
use App\Http\Controllers\Admin\AdminReasonController;
use App\Http\Controllers\Admin\AllUserListController;
use App\Http\Controllers\Admin\ServiceCrudController;
use App\Http\Controllers\Admin\CategoryCrudController;
use App\Http\Controllers\AgentWeb\AgentAuthController;

use App\Http\Controllers\AgentWeb\AgentLeadsController;
use App\Http\Controllers\CustomerWeb\PaymentController;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

use App\Http\Controllers\VendorWeb\VenderAuthController;
use App\Http\Controllers\AgentWeb\AgentProfileController;



//admin
use App\Http\Controllers\VendorWeb\VendorOrderController;
use App\Http\Controllers\VendorWeb\VendorAddressController;
use App\Http\Controllers\VendorWeb\VendorProfileController;
use App\Http\Controllers\VendorWeb\VendorServiceController;
use App\Http\Controllers\CustomerWeb\CustomerAuthController;
use App\Http\Controllers\CustomerWeb\CustomerHomeController;
use App\Http\Controllers\CustomerWeb\CustomerOrderController;

//wallet
use App\Http\Controllers\CustomerWeb\CustomerProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\VendorWeb\VendorAvalibilityController;
use App\Http\Controllers\AgentWeb\AgentToUserRegisterController;

Route::get('/', function () {
    // return view('welcome');
  return redirect()->route('cust.first.route');
  // return view('Customer.Payment.payment_one');
});

Route::get('/get-tot-price/{s_id}', [OrderController::class, 'get_tot_price']);
// Route::group(['prefix' => 'admin'], function () {
//     Voyager::routes();

//     // Route::get('/canceled-order', [VoyagerBaseController::class, 'index'])->name('canceled.order');


//     Route::get('/agent-list', [UserController::class, 'agent_list'])->name('agent.list');
//     Route::get('/customer-list', [UserController::class, 'customer_list'])->name('customer.list');
//     Route::get('/vendor-list', [UserController::class, 'vendor_list'])->name('vendor.list');
//     Route::get('/canceled-order', [OrderController::class, 'canceled_order'])->name('canceled.order');
//     Route::get('/completed-order', [OrderController::class, 'completed_order'])->name('completed.order');
//     Route::get('/upcoming-order', [OrderController::class, 'upcoming_order'])->name('upcoming.order');

// });









//---------ADMIN PANEL---------------//
Route::group(['prefix' => 'admin'], function () {


  Route::get('/', [AdminAuthController::class, 'first_route'])->name('admin.first.route');
  Route::get('/login', [AdminAuthController::class, 'login_page'])->name('admin.login.view');
  Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
  Route::any('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


//----------Forget password ------------------//
Route::get('/forget-password', [AdminAuthController::class, 'forgetpassword_enter_mail_page'])->name('admin.fgp.enter.mail.page');

Route::post('forget-password/code-generated', [AdminAuthController::class, 'code_gen'])->name('admin.email.entered.code.generate');

Route::get('forget-password/email-verify/{id}/{vcode}',[AdminAuthController::class, 'resetPassowrd'])->name('admin.forget.password.email.verify');

Route::post('forget-password/new-password',[AdminAuthController::class, 'newPassword'])->name('admin.reset.new.password');








Route::group(['middleware' => ['isAdmin']], function() {
Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');




//category crud
Route::get('/manage-event',[CategoryCrudController::class, 'list'])->name('admin.category.list');
Route::get('/manage-event/add',[CategoryCrudController::class, 'add_page'])->name('admin.category.add.page');
Route::post('/manage-event/insert',[CategoryCrudController::class, 'insert'])->name('admin.insert.category');
Route::get('manage-event/active/{id}', [CategoryCrudController::class, 'active'])->name('admin.category.active');
Route::get('manage-event/inactive/{id}', [CategoryCrudController::class, 'deactive'])->name('admin.category.deactive');
Route::get('manage-event/delete/{id}', [CategoryCrudController::class, 'delete'])->name('admin.category.delete');
Route::get('manage-event/edit/{id}', [CategoryCrudController::class, 'edit'])->name('admin.category.edit');
Route::post('manage-event/update', [CategoryCrudController::class, 'update'])->name('admin.update.category');




//service crud
Route::get('/manage-service',[ServiceCrudController::class, 'list'])->name('admin.service.list');
Route::get('/manage-service/add',[ServiceCrudController::class, 'add_page'])->name('admin.service.add.page');
Route::post('/manage-service/insert',[ServiceCrudController::class, 'insert'])->name('admin.insert.service');
Route::get('manage-service/active/{id}', [ServiceCrudController::class, 'active'])->name('admin.service.active');
Route::get('manage-service/inactive/{id}', [ServiceCrudController::class, 'deactive'])->name('admin.service.deactive');
Route::get('manage-service/delete/{id}', [ServiceCrudController::class, 'delete'])->name('admin.service.delete');
Route::get('manage-service/edit/{id}', [ServiceCrudController::class, 'edit'])->name('admin.service.edit');
Route::post('manage-service/update', [ServiceCrudController::class, 'update'])->name('admin.update.service');

//packages crud
Route::get('/manage-packages',[PackagesController::class, 'index'])->name('admin.packages.list');
Route::get('/manage-packages/create',[PackagesController::class, 'create'])->name('admin.packages.create');
Route::post('/manage-packages/store',[PackagesController::class, 'store'])->name('admin.packages.store');
Route::get('manage-packages/edit/{id}', [PackagesController::class, 'edit'])->name('admin.packages.edit');
Route::post('/manage-packages/update',[PackagesController::class, 'update'])->name('admin.packages.update');
Route::get('manage-packages/active/{id}', [PackagesController::class, 'active'])->name('admin.packages.active');
Route::get('manage-packages/inactive/{id}', [PackagesController::class, 'deactive'])->name('admin.packages.deactive');
Route::get('manage-packages/delete/{id}', [PackagesController::class, 'delete'])->name('admin.packages.delete');



//vandor list with all operations
Route::get('/manage-vendor',[AllUserListController::class, 'vandor_list'])->name('admin.vandor.list');
Route::get('manage-vendor/active/{id}', [AllUserListController::class, 'vandor_active'])->name('admin.vandor.active');
Route::get('manage-vendor/inactive/{id}', [AllUserListController::class, 'vandor_deactive'])->name('admin.vandor.deactive');
Route::get('manage-vendor/delete/{id}', [AllUserListController::class, 'vandor_delete'])->name('admin.vandor.delete');
Route::get('manage-vendor/view/{id}', [AllUserListController::class, 'vandor_view'])->name('admin.vandor.view');
Route::get('manage-vendor/orders/{id}', [AllUserListController::class, 'vandor_orders'])->name('admin.vandor.orders');

//Wallet list with all operations
Route::get('/manage-vendor-wallet',[WalletController::class, 'vandor_list_wallet'])->name('admin.wallet.list');
Route::get('manage-wallet/view/{id}', [WalletController::class, 'vandor_wallet_view'])->name('admin.wallet.view');
Route::get('manage-wallet/approve/{id}', [WalletController::class, 'vandor_wallet_withdraw_approve'])->name('admin.wallet.withdraw.approve');
Route::get('manage-wallet/disapprove/{id}', [WalletController::class, 'vandor_wallet_withdraw_disapprove'])->name('admin.wallet.withdraw.disapprove');
Route::get('manage-wallet/transactions-admin/{id}', [WalletController::class, 'TransactionListAdmin'])->name('admin.wallet.transactions');


//vandor edit bank details
Route::get('/manage-vendor/bank-details/edit/{id}', [AllUserListController::class, 'bank_edit_page'])->name('admin.vandor.bank.edit');
Route::post('/manage-vendor/bank-details/update', [AllUserListController::class, 'bank_update'])->name('admin.vandor.bank.update');

//all 3 edit get and post
//
Route::get('/manage-vendor/vendor-details/edit/{id}', [AllUserListController::class, 'edit_one_get'])->name('admin.vandor.details.edit');
Route::post('/manage-vendor/vendor-details/update', [AllUserListController::class, 'edit_one_post'])->name('admin.vandor.details.update');

//
Route::get('/manage-vendor/address/edit/{id}', [AllUserListController::class, 'edit_two_get'])->name('admin.vandor.address.edit');
Route::post('/manage-vendor/address/update', [AllUserListController::class, 'edit_two_post'])->name('admin.vandor.address.update');

//
Route::get('/manage-vendor/office-address/edit/{id}', [AllUserListController::class, 'edit_three_get'])->name('admin.vandor.office.edit');
Route::post('/manage-vendor/office-address/update', [AllUserListController::class, 'edit_three_post'])->name('admin.vandor.office.update');




//user list with all operations
Route::get('/manage-customers',[AllUserListController::class, 'customer_list'])->name('admin.customer.list');
Route::get('manage-customers/active/{id}', [AllUserListController::class, 'customer_active'])->name('admin.customer.active');
Route::get('manage-customers/inactive/{id}', [AllUserListController::class, 'customer_deactive'])->name('admin.customer.deactive');
Route::get('manage-customers/delete/{id}', [AllUserListController::class, 'customer_delete'])->name('admin.customer.delete');
Route::get('manage-customers/view/{id}', [AllUserListController::class, 'customer_view'])->name('admin.customer.view');






//user list with all operations
Route::get('/manage-agents',[AllUserListController::class, 'agent_list'])->name('admin.agent.list');
Route::get('manage-agents/active/{id}', [AllUserListController::class, 'agent_active'])->name('admin.agent.active');
Route::get('manage-agents/inactive/{id}', [AllUserListController::class, 'agent_deactive'])->name('admin.agent.deactive');
Route::get('manage-agents/delete/{id}', [AllUserListController::class, 'agent_delete'])->name('admin.agent.delete');
Route::get('manage-agents/view/{id}', [AllUserListController::class, 'agent_view'])->name('admin.agent.view');







//lead list
Route::get('/manage-leads',[AllLeadController::class, 'lead_list'])->name('admin.lead.list');
Route::get('manage-leads/view/{id}', [AllLeadController::class, 'lead_active'])->name('admin.lead.active');


//orders part

Route::get('/manage-orders/upcomming', [OrderController::class, 'upcomming_orders'])->name('admin.upcomming.orders');
  Route::get('/manage-orders/delivered', [OrderController::class, 'delivered_orders'])->name('admin.delivered.orders');
  Route::get('/manage-orders/cancel', [OrderController::class, 'cancel_orders'])->name('admin.cancel.orders');
  Route::get('/manage-orders/all', [OrderController::class, 'all_orders'])->name('admin.all.orders');

Route::get('/manage-orders/assign-vendor/{id}', [OrderController::class, 'assign_vandor_page'])->name('admin.assign.vandor.page');
Route::post('/manage-orders/assign-vendor-for-order', [OrderController::class, 'assign_vandor_update'])->name('admin.assign.vandor.update');
Route::get('/manage-orders/cancel-vendor-order/{id}', [OrderController::class, 'vendor_cancel_list'])->name('admin.vendor.cancle.orders');



//reason
//service crud
Route::get('/manage-reason',[AdminReasonController::class, 'list'])->name('admin.reason.list');
Route::get('/manage-reason/add',[AdminReasonController::class, 'add_page'])->name('admin.reason.add.page');
Route::post('/manage-reason/insert',[AdminReasonController::class, 'insert'])->name('admin.insert.reason');
Route::get('manage-reason/active/{id}', [AdminReasonController::class, 'active'])->name('admin.reason.active');
Route::get('manage-reason/inactive/{id}', [AdminReasonController::class, 'deactive'])->name('admin.reason.deactive');
Route::get('manage-reason/delete/{id}', [AdminReasonController::class, 'delete'])->name('admin.reason.delete');
Route::get('manage-reason/edit/{id}', [AdminReasonController::class, 'edit'])->name('admin.reason.edit');
Route::post('manage-reason/update', [AdminReasonController::class, 'update'])->name('admin.update.reason');



});


});
































//------SOCIAL LOGIN ROUTE-------------//
Route::any('login/{user_type}/{provider_type}', [CustomerAuthController::class, 'redirectToProvider'])->name('login.social');
Route::get('login/{user_type}/{provider_type}/callback', [CustomerAuthController::class, 'handleProviderCallback'])->name('login.social.callback');






















//-----------------------for customers--------------------------------------
Route::group(['prefix' => 'customer'], function () {
  Route::get('/', [CustomerAuthController::class, 'first_route'])->name('cust.first.route');

  Route::get('/login', [CustomerAuthController::class, 'login_page'])->name('cust.login.view');
  Route::post('/login', [CustomerAuthController::class, 'login'])->name('cust.login.post');
  Route::get('/registration', [CustomerAuthController::class, 'registration_page'])->name('cust.registration.view');
  Route::post('/registration', [CustomerAuthController::class, 'registration'])->name('cust.registration.post');
  Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('cust.logout');

  //----------Forget password ------------------//
Route::get('/forget-password', [CustomerAuthController::class, 'forgetpassword_enter_mail_page'])->name('cust.fgp.enter.mail.page');

Route::post('forget-password/code-generated', [CustomerAuthController::class, 'code_gen'])->name('cust.email.entered.code.generate');

Route::get('forget-password/email-verify/{id}/{vcode}',[CustomerAuthController::class, 'resetPassowrd'])->name('cust.forget.password.email.verify');

Route::post('forget-password/new-password',[CustomerAuthController::class, 'newPassword'])->name('cust.reset.new.password');



 Route::get('/login-otp-entermail', [CustomerAuthController::class, 'login_otp_enter_mail'])->name('cust.login.otp.enter.mail');

 Route::post('/login-otp-entermail', [CustomerAuthController::class, 'login_sent_otp'])->name('cust.login.sent.otp');

 Route::get('/login-otp-enterotp', [CustomerAuthController::class, 'login_enter_otp_page'])->name('cust.login.enter.otp.page');


 Route::post('/login-otp-enterotp', [CustomerAuthController::class, 'login_enter_otp_submit'])->name('cust.login.enter.otp.submit');













Route::get('/about-us', [CustomerProfileController::class, 'about_us'])->name('about.us');
Route::get('/contact-us', [CustomerProfileController::class, 'contact_us'])->name('contact.us');

//for both not loggedin and login users
  Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])->name('cust.dashboard');
  Route::get('/details/{id}', [CartController::class, 'details_service'])->name('cust.single.product');
  Route::get('/event-details/{id}', [CartController::class, 'category_to_service'])->name('cust.single.category');
  Route::get('/all-events', [CartController::class, 'all_category'])->name('cust.all.category');
  Route::get('/all-services', [CartController::class, 'all_services'])->name('cust.all.service');

  Route::get('/package/details/{id}', [CartController::class, 'details_package'])->name('cust.signle_package');



  Route::get('/details', [CustomerHomeController::class, 'detailPage'])->name('cust.details');
  Route::post('/add_to_cart', [CartController::class, 'addToCart'])->name('cust.add_to_cart');
  Route::post('/add_to_cart/new', [CartController::class, 'addToCartNew'])->name('cust.add_to_cart.new');
  Route::get('/cart', [CartController::class, 'showCart'])->name('cust.cart');
  Route::get('/service_page', [CustomerHomeController::class, 'servicePage'])->name('cust.service_page');

 Route::post('/buy', [CartController::class, 'buy'])->name('cust.buy');

 Route::get('/delete-cart/{id}', [CartController::class, 'delete_cart'])->name('cust.cart.delete');
 Route::get('/service-addres', [CartController::class, 'service_address'])->name('cust.service.address.page');
 Route::post('/service-addres/insert', [CartController::class, 'cust_cart_address_ins'])->name('cust.cart.address.ins');
 Route::post('/service-addres/insert/two', [CartController::class, 'cust_cart_address_ins_two'])->name('cust.cart.address.ins.two');

 Route::post('/find/address', [CartController::class, 'cust_find_address'])->name('cust.find.address');
Route::get('/order/confirm', [PaymentController::class, 'cod_order_confirm'])->name('cust.order.cod');
Route::get('/address/delete/{id}', [CartController::class, 'address_delete'])->name('cust.address.del');




Route::get('/payment', [PaymentController::class, 'payment'])->name('cust.payment.page');
Route::post('/ccavRequestHandler', [PaymentController::class, 'ccavRequestHandler'])->name('cust.payment.ccavRequestHandler');
Route::any('/ccavResponseHandler', [PaymentController::class, 'ccavResponseHandler'])->name('cust.payment.ccavResponseHandler');



  //update profile
  // Customer profile
 Route::get('/my-dashboard', [CustomerProfileController::class, 'my_dashboard'])->name('cust.mydashboard.page');
  Route::get('/profile', [CustomerProfileController::class, 'profile_page'])->name('cust.profile.page');
   Route::get('/profile/edit', [CustomerProfileController::class, 'profile_page_edit'])->name('cust.update.profile.page');
  Route::post('/profile/update', [CustomerProfileController::class, 'profile_update'])->name('cust.profile.update');


  //update mobile
  Route::get('/profile/update-mobile', [CustomerProfileController::class, 'update_mobile_page'])->name('cust.update.mobile.page');

  Route::get('/profile/update-mobile/enter-otp', [CustomerProfileController::class, 'update_mobile_otp_page'])->name('cust.mobile.update.otp.page');

  Route::post('/profile/update-mobile/enter-otp', [CustomerProfileController::class, 'update_mobile_otp_sent'])->name('cust.mobile.update.part.one');

  Route::post('/profile/update-mobile/enter-otp/verify', [CustomerProfileController::class, 'update_mobile_otp_verify'])->name('cust.mobile.update.part.two');




  //update email
  Route::get('/profile/update-email', [CustomerProfileController::class, 'update_email_page'])->name('cust.update.email.page');

  Route::get('/profile/update-email/enter-otp', [CustomerProfileController::class, 'update_email_otp_page'])->name('cust.email.update.otp.page');

  Route::post('/profile/update-email/enter-otp', [CustomerProfileController::class, 'update_email_otp_sent'])->name('cust.email.update.part.one');

  Route::post('/profile/update-email/enter-otp/verify', [CustomerProfileController::class, 'update_email_otp_verify'])->name('cust.email.update.part.two');



  //vendor orders lists
  Route::get('/orders/upcomming', [CustomerOrderController::class, 'upcomming_orders'])->name('cust.upcomming.orders');
  Route::get('/orders/delivered', [CustomerOrderController::class, 'delivered_orders'])->name('cust.delivered.orders');
  Route::get('/orders/cancel', [CustomerOrderController::class, 'cancel_orders'])->name('cust.cancel.orders');
  Route::get('/orders/all', [CustomerOrderController::class, 'all_orders'])->name('cust.all.orders');
  Route::get('/orders/cancel/delete/{id}', [CustomerOrderController::class, 'delete_order'])->name('cust.delete.orders');



//customer address add, edit, and delete
  Route::get('/add-address', [CartController::class, 'add_address'])->name('cust.address.add');
  Route::post('/insert-address', [CartController::class, 'insert_address'])->name('cust.address.ins');
  Route::get('/edit-address/{id}', [CartController::class, 'edit_address'])->name('cust.address.edit');
  Route::post('/update', [CartController::class, 'update_address'])->name('cust.address.update');
  Route::get('/delete/{id}', [CartController::class, 'delete_address'])->name('cust.address.delete');

  //customer as agent
  Route::get('/be-our-agent', [CartController::class, 'be_our_agent'])->name('cust.be.agent');

});








































//================================  for vendor ===================================//

Route::group(['prefix' => 'vandor'], function () {

  Route::get('/', [VenderAuthController::class, 'first_route'])->name('vandor.first.route');
  Route::get('/login', [VenderAuthController::class, 'login_page'])->name('vandor.login.view');
  Route::post('/login', [VenderAuthController::class, 'login'])->name('vandor.login.post');


  Route::get('/registration', [VenderAuthController::class, 'registration_page'])->name('vandor.registration.view');
  Route::post('/registration', [VenderAuthController::class, 'registration_main'])->name('vandor.registration.new.post');



Route::any('/logout', [VenderAuthController::class, 'logout'])->name('vandor.logout');


//----------Forget password ------------------//
Route::get('/forget-password', [VenderAuthController::class, 'forgetpassword_enter_mail_page'])->name('vandor.fgp.enter.mail.page');

Route::post('forget-password/code-generated', [VenderAuthController::class, 'code_gen'])->name('vandor.email.entered.code.generate');

Route::get('forget-password/email-verify/{id}/{vcode}',[VenderAuthController::class, 'resetPassowrd'])->name('vandor.forget.password.email.verify');

Route::post('forget-password/new-password',[VenderAuthController::class, 'newPassword'])->name('vandor.reset.new.password');


//otp login
Route::get('/login-otp-entermail', [VenderAuthController::class, 'login_otp_enter_mail'])->name('vandor.login.otp.enter.mail');

 Route::post('/login-otp-entermail', [VenderAuthController::class, 'login_sent_otp'])->name('vandor.login.sent.otp');

 Route::get('/login-otp-enterotp', [VenderAuthController::class, 'login_enter_otp_page'])->name('vandor.login.enter.otp.page');


 Route::post('/login-otp-enterotp', [VenderAuthController::class, 'login_enter_otp_submit'])->name('vandor.login.enter.otp.submit');


//social login intermediate page
  Route::get('/get/address/{id}/{email}', [VenderAuthController::class, 'get_address_page'])->name('vandor.shop.address.page');

  Route::post('/insert/shop/address', [VenderAuthController::class, 'insert_shop_address'])->name('vandor.insert.shop.address');




Route::group(['middleware' => ['isVandor']], function() {
   Route::get('/dashboard', [VenderAuthController::class, 'dashboard'])->name('vandor.dashboard');
   Route::get('manage-wallet/view/{id}', [WalletController::class, 'wallet_view'])->name('vendor.wallet.view');

  Route::get('/registration/part-1', [VenderAuthController::class, 'registration_part_one_get'])->name('vandor.registration.get');
  Route::post('/registration/part-1', [VenderAuthController::class, 'registration'])->name('vandor.registration.post');


  Route::get('/registration/part-2/{email}/{id}', [VenderAuthController::class, 'reg_part_two_get'])->name('vandor.reg.two.get');
  Route::post('/registration/part-2/{email}/{id}', [VenderAuthController::class, 'reg_part_two_post'])->name('vandor.registration.two.post');


Route::post('/vandor/get/address', [VenderAuthController::class, 'vandor_get_addess_ajax'])->name('vandor.get.address.ajax');
Route::post('/vandor/get/details', [VenderAuthController::class, 'vandor_get_details_ajax'])->name('vandor.get.details.ajax');


 Route::get('/registration/part-3/{email}/{id}', [VenderAuthController::class, 'reg_part_three_get'])->name('vandor.reg.three.get');
 Route::post('/registration/part-3/{email}/{id}', [VenderAuthController::class, 'reg_part_three_post'])->name('vandor.registration.three.post');



 Route::get('/registration/part-4/{email}/{id}', [VenderAuthController::class, 'reg_part_four_get'])->name('vandor.reg.four.get');
Route::post('/registration/part-4/{email}/{id}', [VenderAuthController::class, 'reg_part_four_post'])->name('vandor.registration.four.post');


//get service
Route::post('/get-service', [VendorServiceController::class, 'get_service'])->name('vandor.get.service');





 //service crud part
  Route::get('/service/list', [VendorServiceController::class, 'list'])->name('vandor.service.list');
  Route::get('/service/add', [VendorServiceController::class, 'add'])->name('vandor.service.add');
  Route::post('/service-insert', [VendorServiceController::class, 'insert'])->name('vandor.service.insert');
  Route::get('/service-active/{id}', [VendorServiceController::class, 'active'])->name('vandor.service.active');
  Route::get('/service-deactive/{id}', [VendorServiceController::class, 'deactive'])->name('vandor.service.deactive');
  Route::get('/service-delete/{id}', [VendorServiceController::class, 'delete'])->name('vandor.service.delete');
  Route::get('/service/edit/{id}', [VendorServiceController::class, 'edit'])->name('vandor.service.edit');
  Route::post('/service-update', [VendorServiceController::class, 'update'])->name('vandor.service.update');






Route::group(['middleware' => ['VerifiedVandor']], function() {

  // vandor profile
  Route::get('/profile', [VendorProfileController::class, 'profile_page'])->name('vandor.profile.page');
  Route::get('/profile/edit', [VendorProfileController::class, 'profile_edit_page'])->name('vandor.profile.edit.page');
  Route::post('/profile/update', [VendorProfileController::class, 'profile_update'])->name('vandor.profile.update');

  //new edits
 Route::post('/profile/office-address/update', [VendorProfileController::class, 'office_address_update'])->name('vandor.office.address.update');

 Route::post('/profile/driver-address/update', [VendorProfileController::class, 'driver_address_update'])->name('vandor.driver.address.update');

 Route::post('/profile/driver-details/update', [VendorProfileController::class, 'driver_details_update'])->name('vandor.driver.details.update');

 Route::post('/profile/all-images/update', [VendorProfileController::class, 'all_images_update'])->name('vandor.all.image.update');



  //update mobile
  Route::get('/profile/update-mobile', [VendorProfileController::class, 'update_mobile_page'])->name('vandor.update.mobile.page');

  Route::get('/profile/update-mobile/enter-otp', [VendorProfileController::class, 'update_mobile_otp_page'])->name('vandor.mobile.update.otp.page');

  Route::post('/profile/update-mobile/enter-otp', [VendorProfileController::class, 'update_mobile_otp_sent'])->name('vandor.mobile.update.part.one');

  Route::post('/profile/update-mobile/enter-otp/verify', [VendorProfileController::class, 'update_mobile_otp_verify'])->name('vandor.mobile.update.part.two');




  //update email
  Route::get('/profile/update-email', [VendorProfileController::class, 'update_email_page'])->name('vandor.update.email.page');

  Route::get('/profile/update-email/enter-otp', [VendorProfileController::class, 'update_email_otp_page'])->name('vandor.email.update.otp.page');

  Route::post('/profile/update-email/enter-otp', [VendorProfileController::class, 'update_email_otp_sent'])->name('vandor.email.update.part.one');

  Route::post('/profile/update-email/enter-otp/verify', [VendorProfileController::class, 'update_email_otp_verify'])->name('vandor.email.update.part.two');



  //vandor availability
  Route::get('/availability', [VendorAvalibilityController::class, 'availibility_page'])->name('vandor.aval.page');
  Route::post('/availability/insert', [VendorAvalibilityController::class, 'availibility_insert'])->name('vandor.aval.insert');
  Route::post('/availability/update', [VendorAvalibilityController::class, 'availibility_update'])->name('vandor.aval.update');



//vendor orders lists
  Route::get('/orders/upcomming', [VendorOrderController::class, 'upcomming_orders'])->name('vandor.upcomming.orders');
  Route::get('/orders/delivered', [VendorOrderController::class, 'delivered_orders'])->name('vandor.delivered.orders');
  Route::get('/orders/cancel', [VendorOrderController::class, 'cancel_orders'])->name('vandor.cancel.orders');
  Route::get('/orders/all', [VendorOrderController::class, 'all_orders'])->name('vandor.all.orders');
  Route::get('/orders/approve/{id}', [VendorOrderController::class, 'approve_orders'])->name('vandor.order.approve');
  Route::any('/orders/reject/{id}', [VendorOrderController::class, 'reject_orders'])->name('vandor.order.reject');
  Route::any('/orders/delivered-order/{id}', [VendorOrderController::class, 'delivered_orders_status'])->name('vandor.order.delivered.status');





 //vandor address
  Route::get('/address/list', [VendorAddressController::class, 'address_list'])->name('vandor.address.list');
  Route::get('/address/add', [VendorAddressController::class, 'address_add'])->name('vandor.address.add');
 Route::post('/address/ins', [VendorAddressController::class, 'address_ins'])->name('vandor.address.ins');
Route::get('/address/edit/{id}', [VendorAddressController::class, 'address_edit'])->name('vandor.address.edit');
Route::post('/address/update', [VendorAddressController::class, 'address_update'])->name('vandor.address.update');
Route::get('/address/delete/{id}', [VendorAddressController::class, 'address_del'])->name('vandor.address.del');



// //get service
// Route::post('/get-service', [VendorServiceController::class, 'get_service'])->name('vandor.get.service');

Route::post('/get-service-baseAmount', [VendorServiceController::class, 'baseAmount'])->name('vandor.get.service.baseAmount');
Route::post('manage-wallet/withdraw', [WalletController::class, 'WithDrawWallet'])->name('wallet.withdraw');
Route::get('manage-wallet/transactions', [WalletController::class, 'TransactionList'])->name('wallet.transactions');



});


});


});









































//============================= --- for Agent ---  ===================================//

Route::group(['prefix' => 'agent'], function () {

  Route::get('/', [AgentAuthController::class, 'first_route'])->name('agent.first.route');
  Route::get('/login', [AgentAuthController::class, 'login_page'])->name('agent.login.view');
  Route::post('/login', [AgentAuthController::class, 'login'])->name('agent.login.post');
  Route::get('/registration', [AgentAuthController::class, 'registration_page'])->name('agent.registration.view');
  Route::post('/registration', [AgentAuthController::class, 'registration'])->name('agent.registration.post');
  Route::any('/logout', [AgentAuthController::class, 'logout'])->name('agent.logout');


//----------Forget password ------------------//
Route::get('/forget-password', [AgentAuthController::class, 'forgetpassword_enter_mail_page'])->name('agent.fgp.enter.mail.page');

Route::post('forget-password/code-generated', [AgentAuthController::class, 'code_gen'])->name('agent.email.entered.code.generate');

Route::get('forget-password/email-verify/{id}/{vcode}',[AgentAuthController::class, 'resetPassowrd'])->name('agent.forget.password.email.verify');

Route::post('forget-password/new-password',[AgentAuthController::class, 'newPassword'])->name('agent.reset.new.password');



//otp login
Route::get('/login-otp-entermail', [AgentAuthController::class, 'login_otp_enter_mail'])->name('agent.login.otp.enter.mail');

 Route::post('/login-otp-entermail', [AgentAuthController::class, 'login_sent_otp'])->name('agent.login.sent.otp');

 Route::get('/login-otp-enterotp', [AgentAuthController::class, 'login_enter_otp_page'])->name('agent.login.enter.otp.page');


 Route::post('/login-otp-enterotp', [AgentAuthController::class, 'login_enter_otp_submit'])->name('agent.login.enter.otp.submit');







Route::group(['middleware' => ['isAgent']], function() {
Route::get('/dashboard', [AgentAuthController::class, 'dashboard'])->name('agent.dashboard');

Route::group(['middleware' => ['AgentVerified']], function() {
//lead list
Route::get('/lead/list', [AgentLeadsController::class, 'list'])->name('agent.lead.list');
Route::get('/lead/add', [AgentLeadsController::class, 'add'])->name('agent.lead.add');
Route::post('/getService', [AgentLeadsController::class, 'get_service'])->name('agent.lead.get.service');
Route::post('/lead/ins', [AgentLeadsController::class, 'ins'])->name('agent.lead.ins');
Route::get('/lead/edit/{id}', [AgentLeadsController::class, 'edit'])->name('agent.lead.edit');
Route::post('/lead/update', [AgentLeadsController::class, 'update'])->name('agent.lead.update');




//register by agents
Route::get('/register/customers', [AgentToUserRegisterController::class, 'list'])->name('agent.reg.list');
Route::get('/customers-registation/{id}/{email}', [AgentToUserRegisterController::class, 'register_page_for_customer'])->name('agent.cust.reg.page');





// agent profile
  Route::get('/profile', [AgentProfileController::class, 'profile_page'])->name('agent.profile.page');
  Route::post('/profile/update', [AgentProfileController::class, 'profile_update'])->name('agent.profile.update');


  //update mobile
  Route::get('/profile/update-mobile', [AgentProfileController::class, 'update_mobile_page'])->name('agent.update.mobile.page');

  Route::get('/profile/update-mobile/enter-otp', [AgentProfileController::class, 'update_mobile_otp_page'])->name('agent.mobile.update.otp.page');

  Route::post('/profile/update-mobile/enter-otp', [AgentProfileController::class, 'update_mobile_otp_sent'])->name('agent.mobile.update.part.one');

  Route::post('/profile/update-mobile/enter-otp/verify', [AgentProfileController::class, 'update_mobile_otp_verify'])->name('agent.mobile.update.part.two');




  //update email
  Route::get('/profile/update-email', [AgentProfileController::class, 'update_email_page'])->name('agent.update.email.page');

  Route::get('/profile/update-email/enter-otp', [AgentProfileController::class, 'update_email_otp_page'])->name('agent.email.update.otp.page');

  Route::post('/profile/update-email/enter-otp', [AgentProfileController::class, 'update_email_otp_sent'])->name('agent.email.update.part.one');

  Route::post('/profile/update-email/enter-otp/verify', [AgentProfileController::class, 'update_email_otp_verify'])->name('agent.email.update.part.two');


});


});


});


Route::get('/get/vandors', [VendorOrderController::class, 'get_vendor'])->name('get.vendor.list');
Route::get('/all', [VendorOrderController::class, 'all']);

Route::get('/optimize-clear', function () {
  \Artisan::call('optimize:clear');
  return 'Optimization cache cleared!';
});


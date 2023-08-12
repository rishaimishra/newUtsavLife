<!-- Start Header Area -->
<style>
.cart-dropdown-wrap {
padding: 20px 20px 0px !important;
}
</style>
@php
$allCategory=DB::table('category__cruds')->where('category_status','A')->skip(0)->take(4)->get();
$allService=DB::table('services')->where('status','A')->skip(0)->take(6)->get();
if(@Auth()->user()->id){
$cartCount=DB::table('carts')->where('user_id',Auth()->user()->id)->count();
// dd($cartCount);
}
elseif(Session::has('randmon_number')){
$session=Session::get('randmon_number');
$cartCount=DB::table('carts')->where('system_id',$session)->count();
}
else{
$cartCount=0;
}
@endphp
<header>
   <div class=" header-menu-4 header sticky-header ">
      <div class="container-fluid">
         <div class="row">
            <!-- Logo -->
            <div class="col-lg-2 align-self-center ">
               <div class="logo">
                  <a href="{{route('cust.first.route')}}">
                     <!-- <img src="{{url('/')}}/public/adminasset/assets/img/header/logo-nav.png" alt="logo"> -->
                     <img id="header-customer-new-logo" src="https://utsavlife.com/public/adminasset/assets/img/header/u-nav-logo.png" alt="utsavlife logo" style="width: 180px;height: auto;">
                     
                  </a>
               </div>
               <div class="canvas_open">
                  <a href="javascript:void(0)">
                     <span></span>
                     <span></span>
                     <span></span>
                  </a>
               </div>
            </div>
            <!-- Menu -->
            <div class="col-lg-7 col-7 my-1 header-search">
               <div class="header-bottom header-style-1 header-bottom-bg-color">
                  <div class="px-3">
                     <div class="header-wrap header-space-between position-relative">
                        <div class="header-nav d-none d-lg-flex align-items-center">
                           <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                              <nav>
                                 <ul>
                                     @if(@Auth::user()->id && @Auth::user()->role_id==2)
                                    <li>
                                       <a class="active" href="#">Menu <i class="icofont-simple-down"></i></a>
                                       <ul class="sub-menu">
                                         
                                          <li><a href="{{route('cust.mydashboard.page')}}"><i class="far fa-user mr-10"></i>My Profile</a></li>
                                          <li><a href="{{route('cust.update.email.page')}}"><i class="far fa-user mr-10"></i>Update Email</a></li>
                                          <li><a href="{{route('cust.update.mobile.page')}}"><i class="far fa-user mr-10"></i>Update Mobile</a></li>
                                          <li><a href="{{route('cust.all.orders')}}"><i class="fas fa-map-marker-alt mr-10"></i>Order Tracking</a></li>
                                          
                                          <li><a href="{{route('cust.logout')}}"><i class="fas fa-sign-out-alt mr-10"></i>Sign out</a></li>
                                         
                                       </ul>
                                    </li>
                                    @elseif(@Auth::user()->id && @Auth::user()->role_id==3)
                                    <a class="active" href="{{route('vandor.dashboard')}}"> <b> Dashboard</b> </i></a>
                                    
                                   @elseif(@Auth::user()->id && @Auth::user()->role_id==4)
                                   <a class="active" href="{{route('agent.dashboard')}}"><b> Dashboard</b> </i></a>

                                     @endif
                                    <li>
                                       <a href="#">Services<i class="icofont-simple-down"></i></a>
                                       <ul class="sub-menu">
                                          @foreach($allService as $val)
                                          <li><a href="{{route('cust.single.product',$val->id)}}">{{@$val->service}}</a></li>
                                          @endforeach
                                       </ul>
                                    </li>
                                    
                                 </ul>
                              </nav>
                           </div>
                           <div class="main-categori-wrap d-none d-lg-block">
                              <a class="categories-button-active" href="#">
                                 <span class="fi-rs-apps"></span> <span class="et">Browse All Categories</span>
                                 <i class="fas fa-angle-down"></i>
                              </a>
                              <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                 <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                       @foreach($allCategory as $val)
                                       <li>
                                          <a href="{{route('cust.single.category',$val->id)}}">{{$val->category_name}}</a>
                                       </li>
                                       @endforeach
                                       
                                    </ul>
                                 </div>
                                 <div class="more_slide_open" style="display: none">
                                    <div class="d-flex categori-dropdown-inner">
                                       <ul>
                                          <li>
                                             <a href="single-product.html"> <img src="{{url('/')}}/public/adminasset/assets/imgs/theme/icons/icon-1.svg" alt="">Television</a>
                                          </li>
                                          <li>
                                             <a href="single-product.html"> <img src="{{url('/')}}/public/adminasset/assets/imgs/theme/icons/icon-2.svg" alt="">Refregerator</a>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>
                              </div>
                           </div>
                           <!-- Menu -->
                           <style>
                           .shop-search-style input:focus {
                           border: 1px solid #000000;
                           }
                           </style>
                           <div class="shop-search-style">
                              <form class="d-flex m-0" role="search">
                                 <input type="search" name="searchme" id="searchme" placeholder="Search items here....." aria-label="Search">
                                 <button type="submit" class="p-0" style="border:none"><i class="fas fa-search"></i></button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </div>
               
            </div>
            <div class="col-lg-3 col-3 d-flex align-items-center" style="justify-content:right;">
               <div class="shop-menu-right">
                  <ul>
                     @if(@Auth::user()->id && @Auth::user()->role_id==2)
                     <li class="cart">
                        <a href="{{route('cust.cart')}}">
                           <i class="fas fa-cart-plus"></i> {{$cartCount}}
                           <span class="cart-text">Cart</span>
                        </a>
                        <a style="margin-left:20px"><span class="cart-text">{{@Auth::user()->name}}</span></a>
                     </li>
                     @elseif((@Auth::user()->id) &&( @Auth::user()->role_id==3 || @Auth::user()->role_id==4))
                      <li class="cart">
                        
                        <a style="margin-left:20px"><span class="cart-text">{{@Auth::user()->name}}</span></a>
                     </li>
                     @else
                     <li class="cart"><a href="{{route('cust.cart')}}"><i class="fas fa-cart-plus">{{$cartCount}}</i>
                        <span class="cart-text">Cart</span>
                     </a>
                     
                     <li class="account" style="margin-left: 20px">
                        <a href="#"><i class="far fa-user"></i>
                           <span class="account-text">Sign in</span>
                        </a>
                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                           <ul>
                              <li><a href="{{route('cust.login.view')}}"><i class="fas fa-sign-in"></i>Customer</a></li>
                              <li><a href="{{route('vandor.login.view')}}"><i class="fas fa-sign-in"></i>Vendor</a></li>
                              <li><a href="{{route('agent.login.view')}}"><i class="fas fa-sign-in"></i>Agent</a></li>
                           </ul>
                        </div>
                     </li>
                     <li class="account" style="margin-left: 20px">
                        <a href="#"><i class="far fa-user"></i>
                           <span class="account-text">Sign up</span>
                        </a>
                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                           <ul>
                              <li><a href="{{route('cust.registration.view')}}"><i class="fas fa-sign-in"></i>Customer</a></li>
                              <li><a href="{{route('vandor.registration.view')}}"><i class="fas fa-sign-in"></i>Vendor</a></li>
                              <li><a href="{{route('agent.registration.view')}}"><i class="fas fa-sign-in"></i>Agent</a></li>
                           </ul>
                        </div>
                     </li>
                     @endif
                  </ul>
               </div>
            </div>
         </div>
      </div>
      
   </div>
</header>
<!-- End Header Area -->
<div class="responsive-header" style="display: none;">
  <a href="https://utsavlife.com/customer">
    <!-- <img src="{{url('/')}}/public/adminasset/assets/img/header/logo-nav.png" alt="logo"> -->
    <img src="https://utsavlife.com/public/adminasset/assets/img/header/u-nav-logo.png" alt="utsav customer logo">
  </a>
</div>
<style>
      @media only screen and (max-width: 600px) {
        .responsive-header img {
                max-width: 250px !important;
                margin: -10px auto -40px !important;
                position: relative;
                top: auto;
                left: 10px;
        }
      }
</style>
{{-- mobile --}}
<div class="mobile-menu-area">
   <!--offcanvas menu area start-->
   <div class="off_canvars_overlay"></div>
   <div class="offcanvas_menu">
      <div class="offcanvas_menu_wrapper">
         <div class="canvas_close">
            <a href="javascript:void(0)"><i class="icofont-close-line"></i></a>
         </div>
         <div class="mobile-logo text-center mb-30">
            <a href="#">
               <img src="{{url('/')}}/public/adminasset/assets/img/header/logo-nav.png" alt="logo" style="width:60%">
               {{-- <h3 style="color:red;font-weight: 500;font-style: italic;transform: rotate(-1deg);">Go Party</h3> --}}
            </a>
         </div>
         <div id="menu" class="text-left ">
            <ul class="offcanvas_main_menu">
               @if(@Auth::user()->id && @Auth::user()->role_id==2)
               <li class="menu-item-has-children active">
                  <a href="#">Menu</a>
                  <ul class="sub-menu">
                     
                     <li><a href="{{route('cust.mydashboard.page')}}"><i class="far fa-user mr-10"></i>My Profile</a></li>
                     <li><a href="{{route('cust.update.email.page')}}"><i class="far fa-user mr-10"></i>Update Email</a></li>
                     <li><a href="{{route('cust.update.mobile.page')}}"><i class="far fa-user mr-10"></i>Update Mobile</a></li>
                     <li><a href="{{route('cust.all.orders')}}"><i class="fas fa-map-marker-alt mr-10"></i>Order Tracking</a></li>
                     
                     <li><a href="{{route('cust.logout')}}"><i class="fas fa-sign-out-alt mr-10"></i>Sign out</a></li>
                     
                  </ul>
               </li>
               @endif
               <li class="menu-item-has-children">
                  <a href="#">Services</a>
                  <ul class="sub-menu">
                     @foreach($allService as $val)
                     <li><a href="{{route('cust.single.product',$val->id)}}">{{@$val->service}}</a></li>
                     @endforeach
                  </ul>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<style>
@media only screen and (max-width: 500px) {
.header-search {
display: none;
}
.shop-menu-right {
}
.account-text,
.cart-text {
display: none;
}
}
</style>
@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Customer | Profile</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
<style>
  .profile_tiles{
    height: 120px !important;
  }
</style>





   <div class="section_padding" style="background: #f6f6f6;">
     <div class="container">
       <div class="bred_cum">
         <ul>
           <li><a href="{{route('cust.first.route')}}">Home</a></li>
           <li><a href="#">My Profile</a></li>
         </ul>
       </div>
       <div class="row">
        <div class="col-md-4 col-lg-3 col-sm-6">
          <div class="profile_tiles">
            <div class="p_img">
              <img src="{{url('/')}}/public/newDesignAsset/dist/images/p1.png">
            </div>
            <div class="profile_text">
              <a href="{{route('cust.profile.page')}}">My Profile</a>
              <p>Update Email, Mobile, and Profile picture</p>
            </div>
          </div>
        </div> 
        <div class="col-md-4 col-lg-3 col-sm-6">
          <div class="profile_tiles">
            <div class="p_img">
              <img src="{{url('/')}}/public/newDesignAsset/dist/images/p4.png">
            </div>
            <div class="profile_text">
              <a href="{{route('cust.all.orders')}}">Order Details</a>
              <p>View, Track, Cancel or book services again</p>
            </div>
          </div>
        </div> 
        <div class="col-md-4 col-lg-3 col-sm-6">
          <div class="profile_tiles">
            <div class="p_img">
              <img src="{{url('/')}}/public/newDesignAsset/dist/images/p5.png">
            </div>
            <div class="profile_text">
              <a href="{{route('cust.service.address.page')}}">Address Details</a>
              <p>Add, edit or delete address</p>
            </div>
          </div>
        </div> 
        <div class="col-md-4 col-lg-3 col-sm-6">
          <div class="profile_tiles">
            <div class="p_img">
              <img src="{{url('/')}}/public/newDesignAsset/dist/images/p6.png">
            </div>
            <div class="profile_text">
              <a href="{{route('cust.cart')}}">Your Cart</a>
              <p>View, delete or checkout your cart</p>
            </div>
          </div>
        </div> 
        <div class="col-md-4 col-lg-3 col-sm-6">
          <div class="profile_tiles">
            <div class="p_img">
              <img src="{{url('/')}}/public/newDesignAsset/dist/images/p2.png">
            </div>
            <div class="profile_text">
              <a href="{{route('cust.update.email.page')}}">Update Email</a>
              <p>Update Email</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-3 col-sm-6">
          <div class="profile_tiles">
            <div class="p_img">
              <img src="{{url('/')}}/public/newDesignAsset/dist/images/p3.png">
            </div>
            <div class="profile_text">
              <a href="{{route('cust.update.mobile.page')}}">Update Mobile</a>
              <p>Update Mobile</p>
            </div>
          </div>
        </div> 
        <div class="col-md-4 col-lg-3 col-sm-6">
          <div class="profile_tiles">
            <div class="p_img">
              <img src="{{url('/')}}/public/newDesignAsset/dist/images/p8.png">
            </div>
            <div class="profile_text">
              <a href="{{route('cust.logout')}}">Sign Out</a>
              <p>Sign - out your account</p>
            </div>
          </div>
        </div> 
        
       </div>


     </div>
   </div>







@include('Customer.includes.new_footer')
@include('Customer.includes.new_script')


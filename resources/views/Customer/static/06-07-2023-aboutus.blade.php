@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | About Us</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}










 <!-- banner -->
  <div class="inner_banner" style="background-image: url({{url('/')}}/public/newDesignAsset/dist/images/about.jpg);"> </div> 
   <!-- login -->
   <div class="section_padding" style="background: #f6f6f6;">
     <div class="container">
       <div class="bred_cum">
         <ul>
           <li><a href="#">Home</a></li>
           <li><a href="#">About Us</a></li>
         </ul>
       </div>
       <div class="row no-gutter mt-5">
        <div class="col-md-6">
          <div class="about_img">
            <img src="{{url('/')}}/public/newDesignAsset/dist/images/about.png">
          </div>
        </div>

        <div class="col-md-6">
          <div class="about_text">
            <div class="about_title">
              <h4>Who <span>we are</span></h4>
              <p>Headquartered in Delhi, currently serviceable in Delhi NCR. We are a team of young enthusiastic and responsible People who are keenly waiting to solve your Problems.</p>
            </div>
            <div class="about_title">
              <h4>Who <span>we are</span></h4>
              <p>Utsavlife is provide all in one solution for any kind of events or celebrations and that too with the most affordable and promising delivery.</p>
            </div>

            <div class="about_title">
              <h4>What’s <span>our goal </span></h4>
              <p>Utsavlife is respecting your time. and Utsavlife can help to reduce the efforts and time which you put in finding the right choice.</p>
            </div>
          </div>
        </div>
          
       </div>
     
     </div>
   </div>


<div class="section_padding">
   <div class="container">
     <div class="title_small text-center">
       <h4>Our Team Members</h4>
     </div>
     <div class="row">
       <div class="col-md-4">
         <div class="member_tiles">
           <div class="member_img">
             <img src="{{url('/')}}/public/newDesignAsset/dist/images/member_1.png">
             <div class="member_bg"></div>
           </div>
           <div class="member_details">
             <h4>Priyanka Singh</h4>
             <span>Co- founder & CFO</span>
           </div>
         </div>
       </div>
       <div class="col-md-4">
         <div class="member_tiles">
           <div class="member_img">
             <img src="{{url('/')}}/public/newDesignAsset/dist/images/member_2.png">
             <div class="member_bg"></div>
           </div>
           <div class="member_details">
             <h4>Subodh Kumar Gupta</h4>
             <span>Co- founder & CFO</span>
           </div>
         </div>
       </div>
       <div class="col-md-4">
         <div class="member_tiles">
           <div class="member_img">
             <img src="{{url('/')}}/public/newDesignAsset/dist/images/member_3.png">
             <div class="member_bg"></div>
           </div>
           <div class="member_details">
             <h4>Vidya Bhushan</h4>
             <span>CMO</span>
           </div>
         </div>
       </div>
     </div>
   </div>
</div>
 <br><br><br><br>



@include('Customer.includes.new_footer')
@include('Customer.includes.new_script')
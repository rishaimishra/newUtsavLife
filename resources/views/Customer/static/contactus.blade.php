@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Contact Us</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}





   <!-- banner -->
  <div class="inner_banner" style="background-image: url({{url('/')}}/public/newDesignAsset/dist/images/contact_banner.jpg);"> </div> 
   <!-- login -->
   <div class="section_padding" style="background: #f6f6f6;">
     <div class="container">
       <div class="bred_cum">
         <ul>
           <li><a href="index.html">Home</a></li>
           <li><a href="contact_us.html">Contact Us</a></li>
         </ul>
       </div>
       <div class="row no-gutter_sell mt-5">
         <div class="col-md-6">
           <div class="form_area">
             <div class="address_flex">
               <div class="address_tiles">
                 <h4>Office Address</h4>
                 <p>R-16, Uttam Nagar West, New Delhi-110059, India.</p>
               </div>
               <div class="address_tiles">
                 <h4>Contact Details</h4>
                 <p>Phone : +(91) 99719 87986<br>Support: <a href="mailto:info@utsavlife.com" style="color:#777;">info@utsavlife.com</a></p>
               </div>
             </div>
             <form method="POST" class="contact_form">
               <input type="text" placeholder="Your Name" name="">
               <input type="email" placeholder="Your Email" name="">
               <input type="text" placeholder="Your Mobile No" name="">
               <input type="text" placeholder="Subject" name="">
               <textarea rows="5" style="resize: none;" placeholder="Your Message"></textarea>
               <input type="submit" class="btn" value="Submit Message" name="">
             </form>
           </div>
         </div>
         <div class="col-md-6">
           <div class="map">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7004.534309680595!2d77.0462838935791!3d28.621754199999987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d05279b249541%3A0xb1df17d0024afcd9!2sUttam%20Nagar%20West!5e0!3m2!1sen!2sin!4v1686076080453!5m2!1sen!2sin"  height="630" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
           </div>
         </div>
          
       </div>
     
     </div>
   </div>






@include('Customer.includes.new_footer')
@include('Customer.includes.new_script')
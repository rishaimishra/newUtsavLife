<!-- footer -->
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

<footer class="section_padding" style="background-image:url('https://utsavlife.com/public/newDesignAsset/cart/dist/images/footer-bg.jpg'); background-size: cover; background-repeat: no-repeat;">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-12 col-lg-3">
        <div class="footer_tiles">
          <div class="footer_img">
            <img src="{{url('/')}}/public/newDesignAsset/dist/images/logo.png">
          </div>
          <div class="footer_content mt-4">
            <p>Utsavlife is provide all in one solution for any kind of events or celebrations and that too with the most affordable and promising delivery.</p>
          </div>
          <div class="play_store">
           <a href="#"><img src="{{url('/')}}/public/newDesignAsset/dist/images/apple_play.png"></a>
           <a href="#"><img src="{{url('/')}}/public/newDesignAsset/dist/images/google_play.png"></a>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-sm-12 col-lg-3">
        <div class="footer_tiles">
          <div class="footer_header">
            <h4>Account</h4>
          </div>
          <div class="footer_content mt-4">
            <ul>
              <li><a href="{{route('cust.login.view')}}"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>Sign In</span></a></li>

              <li><a href="{{route('cust.cart')}}"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>View Cart</span></a></li>

              <li><a href="{{route('about.us')}}"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>About Us</span></a></li>

              <li><a href="{{route('contact.us')}}"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>Contact Us</span></a></li>


              <li><a  href="#" data-bs-toggle="modal" data-bs-target="#contact"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>Cookie Privacy Policy</span></a></li>

              <li><a href="#" data-bs-toggle="modal" data-bs-target="#refferal"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"><span>Referral</span></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-lg-3">
        <div class="footer_tiles">
          <div class="footer_header">
            <h4>Account</h4>
          </div>
          <div class="footer_content mt-4">
            <ul>
              <li><a href="#" data-bs-toggle="modal" data-bs-target="#refund"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>Refund Policy</span></a></li>

              <li><a href="#" data-bs-toggle="modal" data-bs-target="#guidlines"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>User Guidlines</span></a></li>

              <li><a href="#" data-bs-toggle="modal" data-bs-target="#privacy"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>Privacy Policy</span></a></li>

              <li><a href="#" data-bs-toggle="modal" data-bs-target="#terms"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>Term & Conditions</span></a></li>

              <li><a  href="#" data-bs-toggle="modal" data-bs-target="#takedown"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>Takedown Policy</span></a></li>

              <li><a href="#" data-bs-toggle="modal" data-bs-target="#minor_inter"><img src="{{url('/')}}/public/newDesignAsset/dist/images/tick.png"> <span>Minor & User Interaction</span></a></li>


            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-lg-3">
        <div class="footer_tiles">
          <div class="footer_header">
            <h4>Corporate Office</h4>
          </div>
          <div class="footer_content mt-4">
            <ul>
              <li><a href="mailto:info@utsavlife.com"><img src="{{url('/')}}/public/newDesignAsset/dist/images/envelope.png" style="width: 15px; height:15px;"> <span><b class="text-light">Email :</b> info@utsavlife.com</span></a></li>
              <li><a href="javascript:void(0);"><img src="{{url('/')}}/public/newDesignAsset/dist/images/map_marker.png" style="width: 15px; height:15px;"> <span><b class="text-light">Address :</b> R-16, Uttam Nagar West,  New Delhi-110059, India. </span></a></li>
              <div class="qr_code mt-4">
                <img src="{{url('/')}}/public/newDesignAsset/dist/images/qr.png">
              </div>

            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="down_footer text-center">
      <p>© 2023 - UTSAVLIFE. All Rights Reserved.</p>
    </div>
  </div>
</footer>


{{-- include all modals --}}
{{-- @include('Customer.static.aboutus') --}}
@include('Customer.static.cookie_privacy')
@include('Customer.static.privacy_policy')
@include('Customer.static.refferal')
@include('Customer.static.refund')
@include('Customer.static.term_con')
@include('Customer.static.user_guidline')
@include('Customer.static.takedown_policy')
@include('Customer.static.minor_inter')


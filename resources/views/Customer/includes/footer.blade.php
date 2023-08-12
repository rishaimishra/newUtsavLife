<section class="footer-mid pt-4">
    <div class="container pt-15 pb-20">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 my-3">
                <div class="logo mb-30">
                    <a href="{{route('cust.first.route')}}" class="mb-15">
                        <img src="{{url('/')}}/public/adminasset/assets/img/header/logo-nav.png" alt="logo" style="max-width: 80%;" />
                        {{-- Go Party --}}
                    </a>
                    {{-- <p class="font-lg text-heading">Awesome E-commerce shop Template</p> --}}
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 my-3">
                <div class="footer-link-widget ">
                    <h4 class="widget-title mt-0">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{route('cust.login.view')}}">Sign In</a></li>
                        <li><a href="{{route('cust.cart')}}">View Cart</a></li>
                        <li><a href="{{route('about.us')}}" >About us</a></li>
                        <li><a href="{{route('contact.us')}}" >Contact us</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#contact">Cookie Privacy Policy</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#refferal">Referral</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 my-3">
                <div class="footer-link-widget ">
                    <h4 class="widget-title mt-0">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#refund">Refund Policy</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#guidlines">User Guidlines</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#privacy">Privacy Policy</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#terms">Term & Conditions</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#takedown">Takedown Policy</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#minor_inter">Minor & User Interaction</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 my-3">
                <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <ul class="contact-infor">
                        <li><i class="fas fa-map-marker-alt"></i><strong>Address: </strong> <span>R-16, Uttam Nagar west metro station, Gate Number 1 Metro pillar Number 690 Bikaner wali Gali New Delhi 110059, India</span></li>
                        {{-- <li><i class="fas fa-headphones-alt"></i><strong>Call Us:</strong><span>(+91) - 01141402356</span></li> --}}
                        <li><i class="far fa-envelope"></i><strong>Email:</strong>info@utsavlife.com</li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</section>


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


















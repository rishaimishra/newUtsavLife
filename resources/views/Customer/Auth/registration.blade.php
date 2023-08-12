@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Customer | Registration</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}









<div class="section_padding" style="background: #f6f6f6;">
    <div class="container">
        <div class="bred_cum">
            <ul>
                <li><a href="{{route('cust.first.route')}}">Home</a></li>
                <li><a href="#">Sign Up</a></li>
            </ul>
        </div>
        <div class="row">
            @include('Customer.includes.message')
            <div class="col-md-6 m-auto">
                <div class="login_header">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="{{route('cust.registration.view')}}" class="nav-link active" >Customer Registration</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{route('vandor.registration.view')}}" class="nav-link">Vendor Registration</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{route('agent.registration.view')}}" class="nav-link">Agent Registration</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-5" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="home-tab">
                        
                        <div class="login_form shadow">
                            <form   method="POST" action="{{ route('cust.registration.post') }}" id="reg_form" >
                                @csrf
                                <input type="hidden" name="user_type" value="customer">
                                <div class="form_title">
                                    <h4>Create An Account (Customer)</h4>
                                    @if(!@$id)
                                    <p>Allready Sign Up? <a href="{{route('cust.login.view')}}">Login</a></p>
                                    @endif
                                </div>
                                <div class="input_tiles">
                                    <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Name" >
                                    <span><i class="fa-regular fa-user"></i></span>
                                </div>
                                <div class="input_tiles">
                                    <input id="email" type="email" class="form-control input-lg" name="email"   placeholder="Email">
                                    <span><i class="fa-regular fa-envelope"></i></span>
                                </div>
                                <div class="input_tiles">
                                    <input id="mobile" type="text" class="form-control input-lg" name="mobile" placeholder="Mobile"style="padding-left: 75px;" >
                                    <span><i class="fa-solid fa-phone"></i></span>
                                    <b style="position: absolute;left: 39px;font-size: 1rem;color: #777;top: 24px;line-height: 0;font-weight: 400;font-family: sans-serif;">+91</b>
                                </div>
                                <div class="input_tiles">
                                    <input id="password" type="password" class="form-control input-lg" name="password" placeholder="Password" >
                                    <span><i class="fa-solid fa-lock"></i></span>
                                </div>
                                <input type="hidden" name="agent_id" value="{{@$id}}">
                                <input type="hidden" name="agent_email" value="{{@$email}}">
                                
                                <div class="input_footer">
                                    <input type="submit" class="btn btn_shadow_theme" value="CREATE ACCOUNT" name="">
                                </div>
                                
                                
                            </form>
                            @if(!@$id)
                            <div class="input_footer mt-4">
                                <span>Create Account Using Social Media</span>
                            </div>
                            <div class="social_login">
                                <a href="{{route('login.social',['user_type'=>'user','provider_type'=>'facebook'])}}"><img src="{{url('/')}}/public/newDesignAsset/dist/images/fb.png"></a>
                                <a href="{{route('login.social',['user_type'=>'user','provider_type'=>'google'])}}" ><img src="{{url('/')}}/public/newDesignAsset/dist/images/google.png"></a>
                            </div>
                            @endif
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>











@include('Customer.includes.new_footer')
<!-- Js File -->
@section('script')
@include('Customer.includes.new_script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
jQuery.validator.addMethod("validate_email", function(value, element) {
if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
return true;
} else {
return false;
}
}, "Please enter a valid email address.");
jQuery.validator.addMethod("mobileonly", function(value, element) {
return this.optional(element) ||  /^[+]?\d+$/.test(value.toLowerCase());
}, "Enter valid number");
$('#reg_form').validate({
rules:{
email:{
required:true,
validate_email:true
},
password:{
required:true,
minlength:6,
},
name:{
required:true,
minlength:3,
},
mobile:{
required:true,
mobileonly:true,
minlength:10,
maxlength:10,
},
},
messages:{
email:{
required:"Please enter a email address.",
},
password:{
required:"Please enter a password. ",
}
}
});
});
</script>
@endsection
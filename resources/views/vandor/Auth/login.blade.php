@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Login</title>
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
                <li><a href="#">Login</a></li>
            </ul>
        </div>
        <div class="row">
            @include('vandor.includes.message')
            <div class="col-md-6 m-auto">
                <div class="login_header">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="{{route('cust.login.view')}}" class="nav-link" >Customer Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{route('vandor.login.view')}}" class="nav-link active" >Vendor Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{route('agent.login.view')}}" class="nav-link">Agent Login</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-5" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="home-tab">
                        <div class="login_form shadow">
                            <form  method="POST" action="{{ route('vandor.login.post') }}" id="login_form">
                                @csrf
                                <input type="hidden" name="type" value="web">
                                <input type="hidden" name="user_type" value="customer">
                                <div class="form_title">
                                    <h4>Vendor Login</h4>
                                    <p>Don't have an account? <a href="{{route('vandor.registration.view')}}">Create here</a></p>
                                </div>
                                <div class="input_tiles">
                                    <input id="email" type="email" class="form-control input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ @Cookie::get('card_admin_user_email') == null ? old('email'): @Cookie::get('card_admin_user_email')}}" required autofocus placeholder="Username">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <span><i class="fa-regular fa-envelope"></i></span>
                                </div>
                                <div class="input_tiles">
                                    <input id="password" type="password" class="form-control input-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password" value="{{ @Cookie::get('card_admin_user_password') }}">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <span><i class="fa-solid fa-lock"></i></span>
                                </div>
                                <div class="input_footer">
                                    <div class="form-check">
                                        <input  name="remember" id="checkbox-signup" type="checkbox" {{ old('remember') ? 'checked' : '' }} @if(@Cookie::get('card_admin_user_email') != null) checked @endif>
                                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                    </div>
                                    <a href="{{route('vandor.fgp.enter.mail.page')}}">Forgot Password?</a>
                                </div>
                                <div class="input_footer">
                                    <input type="submit" class="btn btn_shadow_theme" value="Login" name="">
                                </div>
                                
                                
                            </form>
                            <div class="input_footer mt-4">
                                <a href="{{route('vandor.login.otp.enter.mail')}}"> <span>Login Through OTP</span></a>
                            </div>

                            <div class="social_login">

                                <a href="{{route('login.social',['user_type'=>'vandor','provider_type'=>'google'])}}" class="common-btns  google-btn">
                                    
                                    <img src="{{url('/')}}/public/newDesignAsset/dist/images/google.png">
                                </a>
                                <a href="{{route('login.social',['user_type'=>'vandor','provider_type'=>'facebook'])}}" class="common-btns facebook-btn">
                                    
                                    <img src="{{url('/')}}/public/newDesignAsset/dist/images/fb.png">
                                </a>
                                
                            </div>
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
    $('#login_form').validate({
    rules:{
    email:{
    required:true,
    validate_email:true
    },
    password:{
    required:true,
    }
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
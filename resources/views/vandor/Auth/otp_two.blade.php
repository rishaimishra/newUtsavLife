@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Login through otp</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}







<!-- Login area start -->
<section class="login-area-content section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="login_wrap_area">
                    <div class="loginwrap">
                       <br><br><br><br>
                        <div class="form_title">
                            <h4 class="mb-5">Enter otp (Vendor Panel) </h4>
                            <p class="mb-30">Don't have an account? <a href="{{route('vandor.registration.view')}}">Create here</a></p>
                        </div>
                        @include('vandor.includes.message')
                        <form method="POST" action="{{ route('vandor.login.enter.otp.submit') }}" id="login_form">
                            @csrf
                            
                            <div class="form-group">
                                <input id="email" type="text" class="form-control input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="otp"  required autofocus placeholder="Enter otp">
                        @if ($errors->has('otp'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{ $errors->first('otp') }}</strong>
                        </span>
                        @endif
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary login-btn" name="login">Sent Code</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 <br><br><br><br>







@include('Customer.includes.new_footer')
<!-- Js File -->
@section('script')
@include('Customer.includes.new_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
    jQuery.validator.addMethod("validate_email", function(value, element) {
    if (/^([A-Za-z0-9_\-\.]+)@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,3})$/.test(value)) {
    return true;
    } else {
    return false;
    }
    }, "Please enter a valid email address.");
    $('#login_form').validate({
    rules:{
    otp:{
    required:true,
    },
    },
    messages:{
    otp:{
    required:"Please enter otp.",
    },
    }
    });
    });
    </script>
    @endsection
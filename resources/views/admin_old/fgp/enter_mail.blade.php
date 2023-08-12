@extends('admin.layouts.app')
@section('title')
<title>Go Party | admin | Forget password</title>
@endsection

@include('admin.includes.headAuth')



@section('content')
<!-- Preeloader -->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_four"></div>
            <div class="object" id="object_five"></div>
        </div>
    </div>
</div>
<!-- Click Sarch bar -->
<div class="common-overlay"></div>
<!-- Preeloader -->

<!-- Login area start -->
<section class="login-area-content section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="login_wrap_area">
                    <div class="loginwrap">
                        <div class="heading-login">
                            <h1 class="mb-5">admin Forget password (Enter Email)</h1>
                            
                        </div>
                        @include('admin.includes.message')
                        <form method="POST" action="{{ route('admin.email.entered.code.generate') }}"  id="login_form">
                            @csrf
                            
                            <div class="form-group">
                                <input id="email" type="text" class="form-control input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  required autofocus placeholder="Enter email">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
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
<!-- Login area end -->
<!-- End Footer Area -->
<div class="scroll-area">
    <i class="icofont-arrow-up"></i>
</div>
@endsection
 @section('script')
    @include('admin.includes.scriptAuth')
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
   
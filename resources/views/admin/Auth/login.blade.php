@extends('admin.layouts.app')
@section('title')
<title>Utsavlife | admin | Login</title>
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
                                <h1 class="mb-5"><h4>Admin Login</h4></h1>
                                
                            </div>
                            @include('admin.includes.message')
                            <form  method="POST" action="{{ route('admin.login.post') }}" id="login_form">
                                @csrf
                                <input type="hidden" name="type" value="web">
                                <input type="hidden" name="user_type" value="customer">
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ @Cookie::get('card_admin_user_email') == null ? old('email'): @Cookie::get('card_admin_user_email')}}" required autofocus placeholder="Username">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control input-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password" value="{{ @Cookie::get('card_admin_user_password') }}">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="login_footer1 form-group mb-50">
                                    <div class="verify-form">
                                        <div class="remember-checkbox">
                                            <input  name="remember" id="checkbox-signup" type="checkbox" {{ old('remember') ? 'checked' : '' }} @if(@Cookie::get('card_admin_user_email') != null) checked @endif>
                                            <label class="form-verify-label" ><span>Remember me</span></label>
                                        </div>
                                    </div>
                                    <a class="text-muted" href="{{route('admin.fgp.enter.mail.page')}}">Forgot password?</a>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary login-btn" name="login">Log in</button>
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
   
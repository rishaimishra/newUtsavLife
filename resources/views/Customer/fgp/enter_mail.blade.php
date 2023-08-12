@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Customer | Forget password</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}








@section('content')
<!-- Login area start -->
<section class="login-area-content section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="login_wrap_area">
                    <div class="loginwrap">
                        <br><br><br><br>
                        <div class="form_title">
                            <h4>Customer Forget password (Enter Email)</h4>
                            <p>Don't have an account? <a href="{{route('cust.registration.view')}}">Create here</a></p>
                        </div>
                        @include('Customer.includes.message')
                        <form method="POST" action="{{ route('cust.email.entered.code.generate') }}"  id="login_form">
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
@endsection







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
},
messages:{
credential:{
required:"Please enter a email address or mobiile number.",
},
}
});
});
</script>
@endsection
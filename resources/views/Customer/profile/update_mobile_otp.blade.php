@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Customer | Update number | Enter Otp</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}

<style>
    .title {
        font-weight: 600;
        font-size: 24px;
        border-bottom: none !important;
    }

    .customBtn {
        border-radius: 0px;
    }

    form input {
        {{--  display: inline-block;  --}}
        width: 50px;
        height: 50px;
        text-align: center;
    }
    .custom_css{
        gap: 5px;
        align-items: center;
        min-height: 100px;
        justify-content: center;
    }
    .custom_css input{
        max-width: 80px;

    }
</style>

<!-- Login area start -->
<section class="section_padding" style="background: #f6f6f6;">
    <div class="container">
        <div class="bred_cum">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#">Update Number</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="login_wrap_area">
                    <div class="loginwrap">
                        <div class="form_title mt-3">
                            <h4 class="mb-5">Update Number (Enter Otp)</h4>

                        </div>
                        @include('Customer.includes.message')
                        {{--  <form method="POST" action="{{route('cust.mobile.update.part.two')}}" id="frm">
                            @csrf

                            <div class="form-group">
                             <input type="tel" placeholder="Enter otp" class="form-control"  name="otp">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary login-btn" name="login">Update Number</button>
                            </div>

                        </form>  --}}
                        <form class="box_form shadow" id="myForm" action="{{ route('cust.mobile.update.part.two') }}" method="POST">
                            @csrf
                            <input type="hidden" id="otp"  name="otp">
                            <div class="row justify-content-md-center">
                                <div class="col-md-12 text-center">
                                    <div class="row">
                                        <div class="col-sm-12 mt-5 bgWhite">
                                            <div class="title">
                                                Verify OTP
                                            </div>

                                            <div class="row custom_css">
                                                <input class="otp" type="text" oninput='digitValidate(this)'
                                                onkeyup='tabChange(1)' maxlength=1>
                                                <input class="otp" type="text" oninput='digitValidate(this)'
                                                    onkeyup='tabChange(2)' maxlength=1>
                                                <input class="otp" type="text" oninput='digitValidate(this)'
                                                    onkeyup='tabChange(3)' maxlength=1>
                                                <input class="otp" type="text"
                                                    oninput='digitValidate(this)'onkeyup='tabChange(4)' maxlength=1>
                                                <input class="otp" type="text" oninput='digitValidate(this)'
                                                    onkeyup='tabChange(5)' maxlength=1>
                                                <input class="otp" type="text"
                                                    oninput='digitValidate(this)'onkeyup='tabChange(6)' maxlength=1>
                                            </div>

                                            <hr class="mt-4">
                                            <button type="button"
                                                class='btn btn_shadow_theme mt-4 mb-4' onclick="getOtpValue()">Verify</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





@include('Customer.includes.new_footer')
<!-- Js File -->
@section('script')
<script>
    let digitValidate = function(ele) {
        ele.value = ele.value.replace(/[^0-9]/g, '');
    }

    let tabChange = function(val) {
        let ele = document.querySelectorAll('.otp');
        if (ele[val - 1].value != '') {
            ele[val].focus()
        } else if (ele[val - 1].value == '') {
            ele[val - 2].focus()
        }
    }
</script>
<script>
    function getOtpValue() {
        var otpInputs = document.getElementsByClassName('otp');
        var otpValue = '';
        for (var i = 0; i < otpInputs.length; i++) {
            otpValue += otpInputs[i].value;
        }
        $("#otp").val(otpValue);

        $("#myForm").unbind('submit').submit();
    }
</script>
@include('Customer.includes.new_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){

$('#frm').validate({
rules:{

otp:{
required:true,
minlength:6,
maxlength:6,
},

},
messages:{

},
});
});
</script>

@endsection

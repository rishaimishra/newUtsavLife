@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Customer | Update number | Enter new number</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}







<!-- Login area start -->
<section class="section_padding" style="background: #f6f6f6;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login_wrap_area">
                    <div class="loginwrap">

                        <div class="bred_cum">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="#">Update Number</a></li>
                            </ul>
                        </div>
                        <div class="form_title text-center mt-4">
                            <h4 class="mb-5">Update Number (Enter New Number)</h4>

                        </div>
                        @include('Customer.includes.message')
                        {{--  <form method="POST" action="{{route('cust.mobile.update.part.one')}}" id="frm">
                            @csrf

                            <div class="form-group">
                              <input type="tel" placeholder="Enter mobile" class="form-control"  name="mobile" value="{{Auth()->user()->mobile}}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary login-btn" name="login">Sent Code</button>
                            </div>

                        </form>  --}}

                        <form class="box_form shadow" action="{{route('cust.mobile.update.part.one')}}" method="POST">
                            @csrf
                            <div class="row">
                              <div class="form-group col-md-6 input_with_icon">
                                <span style="position: absolute;top: 15px;left: 30px;">+91</span>
                                <input type="text" placeholder="Enter Mobile" value="{{Auth()->user()->mobile}}" style="padding-left: 50px;">
                                <div class="input_icon">
                                  <img src="{{url('/')}}/public/newDesignAsset/cart/dist/images/pen.png">
                                </div>
                              </div>
                              <div class="form-group col-md-6 input_with_icon">
                                <span style="position: absolute;top: 15px;left: 30px;">+91</span>
                                <input type="text" placeholder="Enter mobile here" name="mobile" value="" style="padding-left: 50px;">
                              </div>
                            </div>
                            <div class="form_btn mt-4">
                              <button type="submit" class="btn btn_shadow_theme">Sent Code</button>
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


$('#frm').validate({
rules:{

 mobile:{
    required:true,
    mobileonly:true,
    minlength:10,
    maxlength:10,
    },
},
messages:{

},
});
});
</script>

@endsection

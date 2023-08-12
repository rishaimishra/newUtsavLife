@extends('Customer.layouts.app')
@section('title')
    <title>Utsavlife | Customer | Profile</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')

<div class="">
    <div class="section_padding" style="background: #f6f6f6;">
        <div class="container">

            @include('Customer.includes.message')
            <div class="bred_cum">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="#">Edit Profile</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="new-frm-edit-btns" style="text-align:right;">
                        <a href="{{ route('cust.update.mobile.page') }}" class="btn btn_shadow_theme">Update Mobile</a>
                        <a href="{{ route('cust.update.email.page') }}" class="btn btn_shadow_theme">Update Email</a>
                        <a href="{{ route('cust.update.profile.page') }}" class="btn btn_shadow_theme">Update
                            Profile</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form class="box_form shadow">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="faq-contact-form">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="image" class="new-form-label">Name</label>
                                                <input type="text" placeholder="Enter name" id="name"
                                                    class="form-control" name="name"
                                                    value="{{ auth()->user()->name }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- image div --}}
                            <div class="col-lg-6 col-md-6">
                                <div class="faq-contact-form">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div id="image">
                                                    <div class="form-group">
                                                        <label for="image" class="new-form-label">Image </label>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group rm50 vdo-class">

                                                                @if (Auth()->user()->avatar)
                                                                    <img src="{{ url('/') }}/storage/app/public/customer/{{ Auth()->user()->avatar }}"
                                                                        class="new-upload-img"
                                                                        style=" width: 150px ; height: 150px">
                                                                @else
                                                                    No Image
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
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
@include('Customer.includes.new_footer')

@section('script')
    @include('Customer.includes.new_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
        integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            jQuery.validator.addMethod("validate_email", function(value, element) {
                if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                    return true;
                } else {
                    return false;
                }
            }, "Please enter a valid email address.");
            jQuery.validator.addMethod("mobileonly", function(value, element) {
                return this.optional(element) || /^[+]?\d+$/.test(value.toLowerCase());
            }, "Enter valid number");
            $('#frm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 20,
                    },
                    // bank_name:{
                    // required:true,
                    // minlength:3,
                    // },
                    // acc_no:{
                    // required:true,
                    // minlength:6,
                    // },
                    // ifsc_no:{
                    // required:true,
                    // minlength:6,
                    // },
                    // holder_name:{
                    // required:true,
                    // minlength:6,
                    // },
                    country: {
                        required: true,
                        minlength: 3,
                    },
                    state: {
                        required: true,
                        minlength: 6,
                    },
                    city: {
                        required: true,
                        minlength: 6,
                    },
                    zip: {
                        required: true,
                        mobileonly: true,
                        minlength: 6,
                        maxlength: 8,
                    },
                },
                messages: {},
            });
        });
    </script>
    <script>
        function fun() {
            // alert(1);
            var i = document.getElementById('img').files[0];
            //console.log(i);
            var b = URL.createObjectURL(i);
            $("#hidee-img").hide();
            $(".review_img").show();
            $("#img2").attr("src", b);

        }
    </script>
@endsection

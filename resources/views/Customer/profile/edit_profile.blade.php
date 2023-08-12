@extends('Customer.layouts.app')
@section('title')
    <title>Utsavlife | Customer | Edit Profile</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}


<style>
    .add-cart a button,
    .new-frm-edit-btn {
        background: #f9004d;
        border: 1px solid #f9004d;
        color: #fff;
        transition: 0.6s ease;
        border-radius: 0 4px 4px 0;
    }
    }
</style>

<div class="content-page">
    <!-- Start content -->
    <div class="section_padding" style="background: #f6f6f6;">
        <div class="container">

            @include('Customer.includes.message')
            <div class="bred_cum">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="#">Update Profile</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="new-frm-edit-btns" style="text-align:right">
                        <a href="{{ route('cust.update.mobile.page') }}" class="btn btn_shadow_theme">Update Mobile</a>
                        <a href="{{ route('cust.update.email.page') }}" class="btn btn_shadow_theme">Update Email</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div>
                        <!-- Personal-Information -->
                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <div class="panel-body rm02 rm04">
                                    <form role="form" action="{{ route('cust.profile.update') }}" id="frm"
                                        method="post" enctype="multipart/form-data"
                                        class="contact-form form-contact box_form shadow">
                                        @csrf
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="faq-contact-form">

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="image"
                                                                        class="new-form-label">Name</label>
                                                                    <input type="text" placeholder="Enter name"
                                                                        id="name" class="form-control"
                                                                        name="name"
                                                                        value="{{ auth()->user()->name }}">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="faq-contact-form">

                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6 col-12">
                                                    <div class="review_img rmm_001" style="display: none"
                                                        onclick="triggerFileInput()">
                                                        <label for="meta description" class="text-center">Uploaded
                                                            Image</label>
                                                        <br>
                                                        <em><img src="" alt=""id="img2"
                                                                class="new-upload-img"></em>
                                                    </div>
                                                    <div class="image-container">
                                                        <div class="rmm_001" id="hidee-img"
                                                            onclick="triggerFileInput()">
                                                            <label for="meta description" class="text-center">Upload
                                                                Image</label>
                                                            <br>
                                                            <em>
                                                                <img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png"
                                                                    alt="" id="img2" class="new-upload-img"
                                                                    style="width: 200px; height: 200px">
                                                            </em>
                                                        </div>
                                                        <div class="form-group" style="display: none;">
                                                            <div id="image">
                                                                <div class="form-group">
                                                                    <label for="image" class="new-form-label">Image
                                                                    </label>
                                                                    <div class="fileUpload cust_file clearfix">
                                                                        <input type="file" class="upload"
                                                                            name="img" id="img"
                                                                            accept="image/*" onChange="fun();">
                                                                    </div>
                                                                    <label id="img-error" class="error"
                                                                        for="img"></label>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group rm50 vdo-class">
                                                        <label for="meta description" class="text-center">Previous
                                                            Image</label>
                                                        <br>
                                                        @if (Auth()->user()->avatar)
                                                            <img src="{{ url('/') }}/storage/app/public/customer/{{ Auth()->user()->avatar }}"
                                                                class="new-upload-img"
                                                                style=" width: 200px ; height: 200px">
                                                        @else
                                                            No Image
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="new-frm-edit-btns mt-5">
                                            <button class="btn btn_shadow_theme waves-effect waves-light w-md"
                                                type="submit">Update</button>
                                        </div>

                                </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>

    </div>
</div>



        @include('Customer.includes.new_footer')
        <!-- Js File -->
        @section('script')
            @include('Customer.includes.new_script')
            <script>
                function triggerFileInput() {
                    document.getElementById('img').click();
                }
            </script>
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

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
                            <h1 class="mb-5">admin Forget password (Enter New Password)</h1>
                           
                        </div>
                        @include('vandor.includes.message')
                        <form method="POST" action="{{route('admin.reset.new.password')}}"  id="login_form">
                            @csrf
                            <input type="text" value="{{$data->id}}" name="id">
                            
                            <div class="form-group">
                             <input type="password" class="form-control" placeholder="Enter your password"  name="password" >
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Re enter password"  name="confirm_password" >
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary login-btn" name="login">Change Password</button>
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
    <script type="text/javascript">
              $(function(){
                $('#login_form').validate({
                    rules:{
                        password:{
                            required:true,
                            
                        },
                        confirm_password : {
                          required:true,
                          equalTo : '[name="password"]'
                     }
                    },
                    messages:{
                      password:{
                        required:'Please enter your new password',
                    },
                    confirm_password:{
                       required:'Please enter your confirm password',
                    }
                    }
                    
                })
              })
          </script> 
    @endsection
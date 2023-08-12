<style>
	/* -- line dot Active form --  */
	.wraper {
		padding: 50px;
		text-align: center;
		width: 100%;
		margin: 10px auto;
	}
	h1 {
		margin: 50px auto;
	}
	.contain {
		border-top: 2px solid #000;
		display: flex;
		list-style: none;
		padding: 0;
		justify-content: space-between;
		align-items: stretch;
		align-content: stretch;
	}
	.link {
		position: relative;
		margin-top: 10px;
		width: 100%;
	}
	.link a {
		font-weight: bold;
		text-decoration: none;
		color: black;
		text-transform: capitalize;
		font-size: 15px;
	}
	.link:first-child {
		margin-left: -180px;
	}
	.link:last-child {
		margin-right: -180px;
	}
	.link::after {
		content: "";
		width: 15px;
		height: 15px;
		background: #fff;
		position: absolute;
		border-radius: 10px;
		top: -18px;
		left: 50%;
		transform: translatex(-50%);
		border: 2px solid black;
	}
	.active::after,
	.link:hover::after {
		background: black;
	}
	p.lead {
		font-weight: 600;
		margin: 50px auto;
		line-height: 1.5;
	}

	/* -- for page --  */
	.login_wrap_area, .social-login-wrap {
			box-shadow: none !important;
	}
	.heading-login {
			text-align: left;
	}
	.login_wrap_area .form-group input {
			background: #d5d7f3 !important;
			border: none !important;
			height: 45px !important;
			padding-left: 20px !important;
			font-size: 16px !important;
			width: 100% !important;
	}
	label {
			text-align: left;
			width: 100%;
	}
	select {
			background: #d5d7f3;
			border: none;
			height: 45px;
			padding-left: 20px;
			font-size: 16px;
			width: 100%;
			border-radius: 5px;
	}
	.error {
			color: red;
			font-size: 14px;
	}
	.sub-btn {
			display: flex;
			justify-content: space-between;
	}
	.fileUpload.cust_file.clearfix {
		width: 100%
	}
	.new-upload-img {
    width: 100px !important;
    height: 100px !important;
    border-radius: 0 !important;
		margin-left: 0 !important;
	}
	.up-img {
		display: flex;
    justify-content: center;
		gap: 50px;
	}
</style>
@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Registration</title>
@endsection
@include('vandor.includes.headAuth')
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
<!-- register area start -->
<section class="login-area-content">
	<div class="container">
		  {{-- -- start line dot Active form -- --}}
			<div class="wraper">
        <ul class="contain">
          <li class="link"><a href="{{route('vandor.registration.get')}}">Vendor</a></li>
          <li class="link"><a href="{{route('vandor.reg.two.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Service</a></li>
          <li class="link"><a href="{{route('vandor.reg.three.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Payment</a></li>
          <li class="link active"><a href="{{route('vandor.reg.four.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Documents</a></li>
        </ul>
      </div>
      {{-- -- end line dot Active form -- --}}
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="login_wrap_area">
					<div class="loginwrap">
						<div class="heading-login">
							 <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:15px">
                            <h1 style="font-size:18px">Part-4</h1>
                            <a class="btn btn-primary" href="{{route('vandor.dashboard')}}">DashBoard</a>
                            </div>
                            
							
						
							@include('vandor.includes.message')
							@if(@$success)
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>
								{{@$success}}
								</strong>
							</div>
							@endif
						</div>
						<form  method="POST" action="{{ route('vandor.registration.four.post',["id"=>$id,'email'=>$email]) }}" id="reg_form" enctype="multipart/form-data" >
							@csrf
							<input type="hidden" name="vandor_id" value="{{@$id}}">
							<input type="hidden" name="email" value="{{@$email}}">
							


              <h2 style="font-size: 20px;text-align: left;margin-bottom: 20px;">Images information </h2>




							<div id="image" >
										<div class="form-group">
											<label for="image">Pan Card Image <span style="color: red;">*</span></label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												<input type="file"   class="upload" name="img1" id="img1" accept="image/*"  onChange="fun1();" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										<div class="review_img1 rmm_001" style="display: none">
											<em><img src="" alt=""id="imgshw1" class="new-upload-img"></em>
										</div>


										<div class=" rmm_001" id="hidee-img1">
										<label for="meta description" class="text-center">Upload Image</label>
										<br>
										<em><img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png" alt=""id="imgshw1" class="new-upload-img"></em>
										</div>


										
										<div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(@$data->VandorDetails->pan_image)
											<img src="{{url('/')}}/storage/app/public/vandor/pan_image/{{@$data->VandorDetails->pan_image}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div>

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>








									<div id="image" >
										<div class="form-group">
											<label for="image"> Kyc Image <span style="color: red;">*</span></label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												<input type="file"   class="upload" name="img2" id="img2" accept="image/*"  onChange="fun2();" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										<div class="review_img2 rmm_001" style="display: none">
											<em><img src="" alt=""id="imgshw2" class="new-upload-img"></em>
										</div>


										<div class=" rmm_001" id="hidee-img2">
										<label for="meta description" class="text-center">Upload Image</label>
										<br>
										<em><img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png" alt=""id="imgshw2" class="new-upload-img"></em>
										</div>


										
										<div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(@$data->VandorDetails->kyc_image)
											<img src="{{url('/')}}/storage/app/public/vandor/kyc_image/{{@$data->VandorDetails->kyc_image}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div>

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>







									<div id="image" >
										<div class="form-group">
											<label for="image">Vendor Image <span style="color: red;">*</span></label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												<input type="file"   class="upload" name="img3" id="img3" accept="image/*"  onChange="fun3();" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										<div class="review_img3 rmm_001" style="display: none">
											<em><img src="" alt=""id="imgshw3" class="new-upload-img"></em>
										</div>


										<div class=" rmm_001" id="hidee-img3">
										<label for="meta description" class="text-center">Upload Image</label>
										<br>
										<em><img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png" alt=""id="img2" class="new-upload-img"></em>
										</div>


										
										<div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(@$data->VandorDetails->vendor_image)
											<img src="{{url('/')}}/storage/app/public/vandor/vendor_image/{{@$data->VandorDetails->vendor_image}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div>

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>








									<div id="image" >
										<div class="form-group">
											<label for="image">Gst file </label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												<input type="file" @if(@$data->VandorDetails->gst_no && !@$data->VandorDetails->gst_image) required  @endif   class="upload" name="img4" id="img4"   onChange="fun4();" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										


										
										<div class="vdo-class">
											
											<br>
											@if(@$data->VandorDetails->gst_image)
											<label for="meta description">Previous file</label>
											{{-- <img src="{{url('/')}}/storage/app/public/vandor/gst_image/{{@$data->VandorDetails->gst_image}}"  class="new-upload-img"> --}}
											<iframe src="{{url('/')}}/storage/app/public/vandor/gst_image/{{@$data->VandorDetails->gst_image}}" height="200" width="300"></iframe>
								
											@endif
										</div>

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>










									<div class="clearfix"></div>
									<br>
									<br>














							
						<input type="hidden" name="btn" id="btnVal">
                            
                            <div class="form-group sub-btn">
                            	<button onclick="functionPrev()" class="btn btn-primary"  > Previous</button>
                                <button onclick="functionSave()" class="btn btn-primary" > Save</button>
                                <button onclick="functionNext()"  class="btn btn-primary" > Next</button>
                            </div>
						</form>

						{{-- <a href="{{route('vandor.reg.three.get',["id"=>$id,'email'=>$email])}}">Back</a> --}}
					</div>
				</div>
			</div>
			<div class="col-lg-12" style="display:none;">
				<div class="social-login-wrap">
					<div class="heading-login">
						<h1 class="mb-5">Create Account Using Social Media</h1>
						
						<p class="mb-30">Already Have Account <a href="{{route('vandor.login.view')}}">Login</a></p>
						
					</div>
					
					
					
				</div>
				
			</div>
		</div>
	</div>
</section>
@endsection
@section('script')
@include('vandor.includes.scriptAuth')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
@if(@$data->VandorDetails->pan_image)
<script>
		function functionSave(){
    // console.log(1)
    $("#btnVal").val('save');
    $('#reg_form')[0].submit();
}

function functionPrev(){
	 $("#btnVal").val('prev');
    $('#reg_form')[0].submit();
}
</script>
@else
<script>

	function functionSave(){
    // console.log(1)
    $("#btnVal").val('save');
    $('#reg_form')[0].submit();
}

function functionPrev(){
	 $("#btnVal").val('prev');
    $('#reg_form')[0].submit();
}


// $(document).ready(function(){
function functionNext(){
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
$('#reg_form').validate({
rules:{
img1:{
required:true,
},
img2:{
required:true,
},
img3:{
required:true,
},
// img4:{
// required:true,
// },
img5:{
required:true,
},
img6:{
required:true,
},
img7:{
required:true,
},
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
}
// });
</script>
@endif

<script>
function fun1(){
	$("#hidee-img1").hide();
var i=document.getElementById('img1').files[0];
console.log(i);
var b=URL.createObjectURL(i);
$(".review_img1").show();
$("#imgshw1").attr("src",b);
}
</script>


<script>
function fun2(){
	$("#hidee-img2").hide();
var i=document.getElementById('img2').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img2").show();
$("#imgshw2").attr("src",b);
}
</script>


<script>
function fun3(){
	$("#hidee-img3").hide();
var i=document.getElementById('img3').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img3").show();
$("#imgshw3").attr("src",b);
}
</script>


<script>
function fun4(){
	$("#hidee-img4").hide();
var i=document.getElementById('img4').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img4").show();
$("#imgshw4").attr("src",b);
}
</script>












@endsection
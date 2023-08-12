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
		          <li class="link active"><a href="{{route('vandor.reg.three.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Payment</a></li>
		          <li class="link"><a href="{{route('vandor.reg.four.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Documents</a></li>
			</ul>
		</div>
		{{-- -- end line dot Active form -- --}}
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="login_wrap_area">
					<div class="loginwrap">
						<div class="heading-login">
							 <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:15px">
                            <h1 style="font-size:18px">Part-3</h1>
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
						<form  method="POST" action="{{ route('vandor.registration.three.post',["id"=>$id,'email'=>$email]) }}" id="reg_form"  enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="vandor_id" value="{{@$id}}">
							<input type="hidden" name="email" value="{{@$email}}">
							<div class="clearfix"></div>
									
									<h2 style="font-size: 20px;text-align: left;margin-bottom: 20px;">Bank information </h2>
									<div class="form-group">
										<label for="FullName">Bank Name</label>
										<input type="text" placeholder="Enter bank name" class="form-control"  name="bank_name" value="{{@$bankDetails->bank_name}}">
									</div>
									<div class="form-group">
										<label for="FullName">Account No</label>
										<input type="number" placeholder="Enter account no"  class="form-control"  name="acc_no" value="{{@$bankDetails->acc_no}}">
									</div>
									<div class="form-group">
										<label for="FullName">Ifsc Code</label>
										<input type="text" placeholder="Enter ifsc code"  class="form-control"  name="ifsc_no" value="{{@$bankDetails->ifsc_no}}">
									</div>
									<div class="form-group">
										<label for="FullName">Account Holder Name</label>
										<input type="text" placeholder="Enter account holder name"  class="form-control"  name="holder_name" value="{{@$bankDetails->holder_name}}">
									</div>

									<div class="form-group">
										<label for="FullName">Branch Name</label>
										<input type="text" placeholder="Enter bank Branch name"  class="form-control"  name="branch_name" value="{{@$bankDetails->branch_name}}">
									</div>

									<div class="form-group">
										<label for="FullName">Account Type</label>
										<select class="form-control" name="acc_type" style="background: #d5d7f3">
											<option value="saving" @if(@$bankDetails->acc_type=="saving") selected  @endif>Savings Account</option>

											<option value="current" @if(@$bankDetails->acc_type=="current") selected  @endif>Current Account</option>

											<option value="salary" @if(@$bankDetails->acc_type=="salary") selected  @endif>Salary Account</option>

											<option value="fixed" @if(@$bankDetails->acc_type=="fixed") selected  @endif>Fixed deposit Account</option>

											<option value="recurring" @if(@$bankDetails->acc_type=="recurring") selected  @endif>Recurring deposit Account</option>

											<option value="nri" @if(@$bankDetails->acc_type=="nri") selected  @endif>NRI Account</option>
										</select>
									</div>




<br>
							<div id="image" >
										<div class="form-group">
											<label for="FullName">Add Cancelled Checkbook/Passbook 1st page on bank details Image <span style="color: red;">*</span></label>
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
											@if(@$bankDetails->checkbookOrPassbookImage)
											<img src="{{url('/')}}/storage/app/public/vandor/checkbookOrPassbookImage/{{@$bankDetails->checkbookOrPassbookImage}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div>

										</div>
										
									</div>
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

@if(@$bankDetails->checkbookOrPassbookImage)


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
bank_name:{
required:true,
minlength:3,
},
acc_no:{
required:true,
minlength:6,
},
ifsc_no:{
required:true,
minlength:6,
},
holder_name:{
required:true,
minlength:6,
},
branch_name:{
required:true,
},
acc_type:{
required:true,
},
// img1:{
// required:true,	
// },
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


@else

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
bank_name:{
required:true,
minlength:3,
},
acc_no:{
required:true,
minlength:6,
},
ifsc_no:{
required:true,
minlength:6,
},
holder_name:{
required:true,
minlength:6,
},
branch_name:{
required:true,
},
acc_type:{
required:true,
},
img1:{
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

@endif
</script>

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

@endsection
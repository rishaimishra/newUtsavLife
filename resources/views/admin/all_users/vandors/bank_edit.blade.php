@extends('admin.layouts.app')
@section('title')
<title>Utsavlife | admin | Vendor | bank edit</title>
@endsection
@section('left_part')
@include('admin.includes.left_part')
{{-- for datepicker --}}
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
@endsection
@section('content')
<style type="text/css">
	.rm02 .form-group textarea {
		min-height: 70px;
	}
	.rm02 .form-group select,
	.rm02 .form-group input,
	.rm02 .form-group textarea{
		background: whitesmoke;
	}
.up-img {
display: flex;
padding: 5px 10px;
justify-content: center;
gap: 30px;
}
	.new-upload-img {
		width: 100px;
		height: 100px;
		border-radius: 50%;
		object-fit: cover;
	}
	.upload {
		color: #4a4a4a;
padding: 12px;
border-radius: 5px;
	}
	.updt-btns {
display: flex;
align-items: center;
justify-content: right;
gap: 10px;
}
.panel-fill.panel-default .panel-heading {
	width: 100%;
}
</style>
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="wraper container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="pull-left page-title">Edit Bank </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Utsavlife</a></li>
						<li class="active">Edit Bank </li>
					</ol>
				</div>
				<a href="{{route('admin.vandor.view',$data->vandor_id)}}">Back</a>
			</div>
			@include('admin.includes.message')
			
			<form action="{{route('admin.vandor.bank.update')}}" method="post" id="frm" enctype="multipart/form-data">
				@csrf
				<div class="clearfix"></div>
				<br>
				<br>
				<input type="hidden" name="vandor_id" value="{{$data->vandor_id}}">
				<h2>Bank Information Edit </h2>
				<div class="form-group">
					<label for="FullName"> Name</label>
					<input type="text" placeholder="Enter bank name" class="form-control"  name="bank_name" value="{{@$data->bank_name}}">
				</div>
				<div class="form-group">
					<label for="FullName"> Account No</label>
					<input type="text" placeholder="Enter account_no"  class="form-control"  name="acc_no" value="{{@$data->acc_no}}">
				</div>
				<div class="form-group">
					<label for="FullName">Ifsc Code</label>
					<input type="text" placeholder="Enter ifsc no"  class="form-control"  name="ifsc_no" value="{{@$data->ifsc_no}}">
				</div>
				<div class="form-group">
					<label for="FullName"> Holder Name</label>
					<input type="text" placeholder="Enter bank holder name"  class="form-control"  name="holder_name" value="{{@$data->holder_name}}">
				</div>
				<div class="form-group">
					<label for="FullName"> branch name</label>
					<input type="text" placeholder="Enter bank Barnch name"  class="form-control"  name="branch_name" value="{{@$data->branch_name}}">
				</div>
				<div class="form-group">
					<div class="form-group">
						<label for="FullName"> Account Type</label>
						<select class="form-control" name="acc_type">
							<option value="saving" @if(@$data->acc_type=="saving") selected  @endif>Savings Account</option>
							<option value="current" @if(@$data->acc_type=="current") selected  @endif>Current Account</option>
							<option value="salary" @if(@$data->acc_type=="salary") selected  @endif>Salary Account</option>
							<option value="fixed" @if(@$data->acc_type=="fixed") selected  @endif>Fixed deposit Account</option>
							<option value="recurring" @if(@$data->acc_type=="recurring") selected  @endif>Recurring deposit Account</option>
							<option value="nri" @if(@$data->acc_type=="nri") selected  @endif>NRI Account</option>
						</select>
					</div>
				</div>




				<br>
							<div id="image" >
										<div class="form-group">
											<label for="FullName">Add Cancelled Checkbook/Passbook 1st page on bank details <span style="color: red;">*</span></label>
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
											@if(@$data->checkbookOrPassbookImage)
											<img src="{{url('/')}}/storage/app/public/vandor/checkbookOrPassbookImage/{{@$data->checkbookOrPassbookImage}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div>

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>


				<div class="col-lg-12">
					<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update</button>
				</div>
			</form>
			
		</div>
	</div>
</div>
</div>
</div>
<!-- container -->
</div>
<!-- content -->

</div>
<!-- ============================================================== -->
<!-- End Right content here -->
@section('footer')
{{-- @include('vandor.includes.footer') --}}
@endsection
@endsection
{{-- end content --}}
@section('script')
@include('admin.includes.script')
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
bank_name:{
required:true,
},
acc_no:{
required:true,
},
ifsc_no:{
required:true,
},
holder_name:{
required:true,
},
branch_name:{
required:true,
},
acc_type:{
required:true,
},
},
messages:{
},
});
});
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
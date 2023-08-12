@extends('admin.layouts.app')
@section('title')
<title>Utsavlife | admin | Vendors | Details edit</title>
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
					<h4 class="pull-left page-title">Edit Details </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Utsavlife</a></li>
						<li class="active">Edit Details </li>
					</ol>
				</div>
				<a href="{{route('admin.vandor.view',$data->id)}}">Back</a>
			</div>
			@include('admin.includes.message')
			
			<form action="{{route('admin.vandor.details.update')}}" method="post" id="frm">
				@csrf
				<div class="clearfix"></div>
				<br>
				<br>
				<input type="hidden" name="vandor_id" value="{{$data->id}}">
				<h2>Vendor Details Edit </h2>
				<div class="form-group">
					<label>Pan Card No.</label>
					<input id="pan_card" style="text-transform:uppercase" type="text" class="form-control input-lg" name="pan_card" placeholder="Pan Card" value="{{@$data->VandorDetails->pan_card}}" >
				</div>
				<div class="form-group">
					<label>Kyc Type</label>
					<br>
					<select name="kyc_type" id="kyc_type" class="form-control" onchange="kycValidation()">
						<option value="">Select Kyc Type</option>
						<option value="VO" @if(@$data->VandorDetails->kyc_type=="VO") selected @endif>Voter Card</option>
						<option value="AD" @if(@$data->VandorDetails->kyc_type=="AD") selected @endif>Aadher Card</option>
						<option value="PA" @if(@$data->VandorDetails->kyc_type=="PA") selected @endif>Passport</option>
						<option value="DL" @if(@$data->VandorDetails->kyc_type=="DL") selected @endif>Driving Licensce</option>
						<option value="OT" @if(@$data->VandorDetails->kyc_type=="OT") selected @endif>Other Govt. Id</option>
					</select>
				</div>
				<div class="form-group">
					<label>ID No.</label>
					<input id="kyc_no" type="text" class="form-control input-lg" name="kyc_no" placeholder="ID No" value="{{@$data->VandorDetails->kyc_no}}" >
				</div>
				<div class="form-group">
					<label>Calling No.</label>
					<input id="calling_no" type="text" class="form-control input-lg" name="calling_no" placeholder="Calling No" value="{{@$data->VandorDetails->calling_no}}" >
				</div>
				<div class="form-group">
					<label>Gst No.</label>
					<input id="gst_no" type="text" style="text-transform:uppercase" class="form-control input-lg" name="gst_no" placeholder="Gst no" value="{{@$data->VandorDetails->gst_no}}" >
				</div>
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
pan_card:{
required:true,
},
kyc_type:{
required:true,
},
kyc_no:{
required:true,
},
calling_no:{
// required:true,
mobileonly:true,
},
gst_no:{
// required:true,
},
},
messages:{
},
});
});
</script>
@endsection
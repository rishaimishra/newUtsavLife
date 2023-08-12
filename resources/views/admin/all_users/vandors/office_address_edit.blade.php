@extends('admin.layouts.app')
@section('title')
<title>Utsavlife | admin | Vendor | Office edit</title>
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
					<h4 class="pull-left page-title">Edit Office </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('agent.dashboard')}}">Utsavlife</a></li>
						<li class="active">Edit Office </li>
					</ol>
				</div>
				<a href="{{route('admin.vandor.view',$data->id)}}">Back</a>
			</div>
			@include('Agent.includes.message')
			
			<form action="{{route('admin.vandor.office.update')}}" method="post">
				@csrf
				<div class="clearfix"></div>
				<br>
				<br>
				<input type="hidden" name="vandor_id" value="{{$data->id}}">
				<h2>Office Address Edit </h2>
				<div class="form-group">
					<label > Pin Code</label>
					<input type="number" name="office_pincode" id="office_pincode" class="form-control" value="{{@$data->VandorDetails->office_pincode}}" >
				</div>
				<div class="form-group mt-3">
					<label >  House No/Flat No/ Building No</label>
					<input type="text" name="office_house_no" id="office_house_no" class="form-control" value="{{@$data->VandorDetails->office_house_no}}" >
				</div>
				<div class="form-group">
					<label >  Area</label>
					<input type="text" name="office_area" id="office_area" class="form-control" value="{{@$data->VandorDetails->office_area}}" >
				</div>
				<div class="form-group mt-3">
					<label > Landmark</label>
					<input type="text" name="office_landmark" id="office_landmark" class="form-control" value="{{@$data->VandorDetails->office_landmark}}" >
				</div>
				<br>
				<div class="form-group mt-3">
					<label > City</label>
					<input type="text" name="office_city" id="office_city" class="form-control" value="{{@$data->VandorDetails->office_city}}" >
				</div>
				<div class="form-group mt-3">
					<label > State</label>
					<input type="text" name="office_state" id="office_state" class="form-control"  value="{{@$data->VandorDetails->office_state}}">
				</div>

				<div class="form-group mt-3">
					<label > Mobile No.</label>
					<input type="text" name="office_mobile" id="office_mobile" class="form-control"  value="{{@$data->VandorDetails->office_mobile}}">
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
@include('Agent.includes.script')
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
office_pincode:{
required:true,
},
office_house_no:{
required:true,
},
office_area:{
required:true,
},
office_landmark:{
required:true,
},
office_city:{
required:true,
},
office_state:{
required:true,
},
office_mobile:{
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
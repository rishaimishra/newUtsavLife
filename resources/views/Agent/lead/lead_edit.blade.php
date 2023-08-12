@extends('Agent.layouts.app')
@section('title')
<title>Utsavlife | Vandor | Leads Edit</title>
@endsection
@section('left_part')
@include('Agent.includes.left_part')
{{-- for datepicker --}}
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
@endsection
@section('content')
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
	.panel-body select {
		width: 100% !important;
    padding: 10px;
    border-radius: 5px;
	}	
	.panel-body textarea {
		min-height: 70px;
	}
</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="wraper container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="pull-left page-title">Leads Edit </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('agent.dashboard')}}">Utsavlife</a></li>
						<li class="active"> Leads Edit </li>
					</ol>
				</div>
			</div>
			@include('Agent.includes.message')
			
			<div class="row">
				<div class="col-lg-12">
					<div>
						<!-- Personal-Information -->
						<div class="panel panel-default panel-fill">
														<div class="panel-body rm02 rm04">
															<div class="panel-heading">
							<h3 class="panel-title">Edit leads</h3>
<div class="add-btn "><a href="{{route('agent.lead.list')}}"><i class="icofont-minus-circle"></i> Back</a></div>
							 </div>

								<form role="form" action="{{route('agent.lead.update')}}" id="frm" method="post" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="id" value="{{@$data->id}}">
									<div class="form-group rm50">
										<label for="title">Category name</label>
										<select name="category_id" id="category_id" onchange="getService(this.value)">
											<option value=""> Select Category</option>
											@foreach($category as $val)
											<option value="{{$val->id}}" @if($val->id==$data->category_id) selected @endif> {{$val->category_name}}</option>
											@endforeach
										</select>
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50"  id="service_fetch">
										<label for="title">Service name</label>
										<select name="service_id">
											<option value=""> Select Service</option>
											@foreach($allService as $val2)
											<option value="{{$val2->id}}" @if($val2->id==$data->services) selected @endif> {{$val2->service}}</option>
											@endforeach
										</select>
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">User name</label>
										<input type="text"  class="form-control"  placeholder="Enter user name"  name="lead_name" value="{{@$data->lead_name}}" >
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Address</label>
										<textarea  class="form-control"  placeholder="Enter address"  name="lead_address" >{{@$data->lead_address}}</textarea>
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">City</label>
										<input type="text"  class="form-control"  placeholder="Enter user name"  name="lead_city" value="{{@$data->lead_city}}" >
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Pin</label>
										<input type="text"  class="form-control"  placeholder="Enter user name"  name="lead_pin" value="{{@$data->lead_pin}}" >
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">User Email</label>
										<input type="text"  class="form-control"  placeholder="Enter user email"  name="lead_email" value="{{@$data->lead_email}}" >
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">User Mobile</label>
										<input type="text"  class="form-control"  placeholder="Enter user mobile"  name="lead_phone" value="{{@$data->lead_phone}}" >
									</div>
									<div class="clearfix"></div>
									<div class="clearfix"></div>
									<div class="col-lg-12" style="margin-top: 10px;">
										<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update</button>
									</div>
								</form>
							</div>
						</div>
						<!-- Personal-Information -->
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
{{-- @include('Agent.includes.footer') --}}
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
service_id:{
required:true,
},
category_id:{
required:true,
},
lead_name:{
required:true,
minlength:3,
},
lead_address:{
required:true,
minlength:5,
},
lead_city:{
required:true,
minlength:3,
},
lead_pin:{
required:true,
minlength:3,
},
lead_email:{
required:true,
validate_email:true,
},
lead_phone:{
required:true,
mobileonly:true,
minlength:10,
maxlength:10,
},
},
messages:{
//  link:{
//     required:" social link is mandatory",
//     min:"Enter valid links"
// }
}
});
});
</script>
<script>
	function getService(val){
		console.log(val);
	//ajax
	$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': "{{csrf_token()}}"
	}
	});
	
	var fd= new FormData;
	fd.append('category_id',val);
	$.ajax({
	url:'{{route('agent.lead.get.service')}}',
	type:'POST',
	data: fd,
	contentType: false,
	processData: false,
	
	success:function(res){
	console.log(res);
	//alert("j");
	$("#service_fetch").html(res);
	}
	});
	}
</script>
@endsection
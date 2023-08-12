@extends('admin.layouts.app')
@section('title')
<title>Go party | admin | Assign Vandors</title>
@endsection
@section('left_part')
@include('admin.includes.left_part')
{{-- for datepicker --}}
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
@endsection
@section('content')
<!-- Start right Content here -->
<!-- ============================================================== -->
<style type="text/css">
	.rm02 .form-group textarea {
		min-height: 70px;
	}
	.rm02 .form-group select,
	.rm02 .form-group input,
	.rm02 .form-group textarea{
		background: whitesmoke;
	}
</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="wraper container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="pull-left page-title">Assign Vandors </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Go party</a></li>
						<li class="active"> Assign Vandors </li>
					</ol>
				</div>
			</div>
			@include('admin.includes.message')
			
			<div class="row">
				<div class="col-lg-12">
					<div>
						<!-- Personal-Information -->
						<div class="panel panel-default panel-fill">
							<div class="panel-body rm02 rm04">
								<div class="panel-heading">
							<h3 class="panel-title">Assign Vandor for order id : {{$orderDetails->id}}</h3>
							<div class="add-btn "><a href="{{route('admin.all.orders')}}"><i class="icofont-minus-circle"></i> Back</a></div>
							 </div>
								<form role="form" action="{{route('admin.assign.vandor.update')}}" id="frm" method="post" enctype="multipart/form-data">
									@csrf
									
									<input type="hidden" name="id" value="{{$orderDetails->id}}">
								
									
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Vandor name</label>
										<select class="form-group" name="vandor_id" id="vandor_id" required>
											<option value=""> Select vandor</option>
											@foreach($allVandors as $vandor)
											<option value="{{$vandor->id}}"> {{$vandor->name}}</option>
											@endforeach
										</select>
									</div>
								
									
									
									<div class="clearfix"></div>
									<div class="col-lg-12" style="margin-top: 10px;">
										<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Assign</button>
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
{{-- @include('admin.includes.footer') --}}
@endsection
@endsection
{{-- end content --}}
@section('script')
@include('admin.includes.script')



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
$('#frm').validate({
rules:{

category_name:{
required:true,
},


category_description:{
required:true,
minlength:5,
},

},
messages:{
//  link:{
//     required:" social link is mandatory",
//     min:"Enter valid links"
// }
},

});
});
</script>

{{-- <script>
	function getcategory(val){
		console.log(val);
	//ajax
	$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': "{{csrf_token()}}"
	}
	});
	
	var fd= new FormData;
	fd.append('category_id',val);
	fd.append('type',"add");
	$.ajax({
	url:'{{route('admin.get.service')}}',
	type:'POST',
	data: fd,
	contentType: false,
	processData: false,
	
	success:function(res){
	// console.log(res);
	//alert("j");
	$("#service_fetch").html(res);
	}
	});
	}
</script> --}}
@endsection
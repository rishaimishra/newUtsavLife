@extends('admin.layouts.app')
@section('title')
<title>Utsavlife | admin | Reason Edit</title>
@endsection
@section('left_part')
@include('admin.includes.left_part')
<link href="{{ URL::asset('public/croppie/croppie.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('public/croppie/croppie.min.css') }}" rel="stylesheet" />
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
					<h4 class="pull-left page-title">Reason Edit </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Utsavlife</a></li>
						<li class="active"> Reason Edit </li>
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
									<h3 class="panel-title">Edit reason</h3>
									<div class="add-btn "><a href="{{route('admin.reason.list')}}"><i class="icofont-minus-circle"></i> Back</a></div>
								</div>
								<form role="form" action="{{route('admin.update.reason')}}" id="frm" method="post" enctype="multipart/form-data">
									@csrf
									
									<input type="hidden" name="id" value="{{$reason->id}}">
									
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Reason</label>
										<input type="text"  class="form-control"  placeholder="Enter reason"  name="reason" value="{{$reason->reason}}" >
									</div>
									<div class="clearfix"></div>
									
									
								<div class="clearfix"></div>
								<div class="col-lg-12" style="margin-top: 10px;">
									<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Edit</button>
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
reason:{
required:true,
minlength:5,
},
},
messages:{

},
});
});
</script>

@endsection
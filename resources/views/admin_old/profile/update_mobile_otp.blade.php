@extends('Agent.layouts.app')
@section('title')
<title>Go party | Agent | Update number</title>
@endsection
@section('left_part')
@include('Agent.includes.left_part')
{{-- for datepicker --}}
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
@endsection
@section('content')
<style>
        .rm02 .form-group textarea {
        min-height: 70px;
    }
    .rm02 .form-group select,
    .rm02 .form-group input,
    .rm02 .form-group textarea{
        background: whitesmoke;
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
					<h4 class="pull-left page-title">Update number</h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('agent.dashboard')}}">Go party</a></li>
						<li class="active">Update number</li>
					</ol>
				</div>
			</div>
			@include('vandor.includes.message')
			<div class="add-btn "><a href="{{route('agent.update.mobile.page')}}"><i class="icofont-minus-circle"></i> Back</a></div>
			<div class="row">
				<div class="col-lg-12">
					<div>
						<!-- Personal-Information -->
						<div class="panel panel-default panel-fill">
							<div class="panel-heading">
							<h3 class="panel-title">Enter otp</h3> </div>
							<div class="panel-body rm02 rm04">
								<form role="form" action="{{route('agent.mobile.update.part.two')}}" id="frm" method="post" enctype="multipart/form-data" >
									@csrf
									
									<div class="form-group">
										<label for="FullName">otp</label>
										<input type="tel" placeholder="Enter otp" class="form-control"  name="otp">
									</div>
									<div class="clearfix"></div>
									
									<div class="col-lg-12">
										<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update Number</button>
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
{{-- @include('vandor.includes.footer') --}}
@endsection
@endsection
{{-- end content --}}
@section('script')
@include('Agent.includes.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){

$('#frm').validate({
rules:{

otp:{
required:true,
minlength:6,
maxlength:6,
},

},
messages:{

},
});
});
</script>

@endsection
@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vendor | View profile</title>
@endsection
@section('left_part')
@include('vandor.includes.left_part')
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
gap: 30px;
}
.new-upload-img {
width: 150px;
height: 150px;
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
<!-- new style -->
<style >
  .panel-body input,
  .panel-body .form-control {
      border: none;
    background: transparent !important;
    padding: 0 !important;
    margin: -10px 0 -10px;
  }
</style>
<!-- new style -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="wraper container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="pull-left page-title">View Profile</h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('vandor.dashboard')}}">Utsavlife</a></li>
						<li class="active">View profile</li>
					</ol>
				</div>
			</div>
			@include('vandor.includes.message')
			<div class="row">
				<div class="col-lg-12">
					<div>
						<!-- Personal-Information -->
						<div class="panel panel-default panel-fill">
							<div class="panel-body rm02 rm04">
								<div class="panel-heading">
									<h3 class="panel-title">View Profile</h3>
									<div class="updt-btns">
										<a href="{{route('vandor.update.mobile.page')}}" class="btn btn-primary waves-effect waves-light w-md">Update Mobile</a>
										<a href="{{route('vandor.update.email.page')}}" class="btn btn-primary waves-effect waves-light w-md">Update Email</a>

										<a href="{{route('vandor.profile.edit.page')}}" class="btn btn-primary waves-effect waves-light w-md">Update Profile</a>
									</div>
									<div class="add-btn "><a href="{{route('vandor.profile.page')}}"><i class="icofont-minus-circle"></i> Back</a></div>
								</div>
								{{-- Vandor details Edit  --}}
								
								<div class="form-group">
									<label for="FullName">Name</label>
									<input type="text" placeholder="Enter name"  id="name" class="form-control"  name="name" readonly value="{{auth::user()->name}}">
								</div>
								
								<div class="clearfix"></div>
								
								
								<div class="form-group">
									<label>Pan Card No.</label>
									<input id="pan_card" readonly type="text" class="form-control input-lg" name="pan_card" placeholder="Pan Card" value="{{@auth::user()->VandorDetails->pan_card}}" >
								</div>
								<div class="form-group">
									<label>Kyc Type</label>
									<br>
									<div class="form-control p-0"  style="display: flex;
																	    align-items: center;
																	    background: whitesmoke;">
									@if(@auth::user()->VandorDetails->kyc_type=="VO")Voter Card @endif
										 @if(@auth::user()->VandorDetails->kyc_type=="AD")Aadher Card @endif
										 @if(@auth::user()->VandorDetails->kyc_type=="PA")Passport @endif
										 @if(@auth::user()->VandorDetails->kyc_type=="DL")Driving Licensce @endif
										 @if(@auth::user()->VandorDetails->kyc_type=="OT")Other Govt. Id @endif
										</div>
								</div>
								<div class="form-group">
									<label>ID No.</label>
									<input readonly id="kyc_no" type="text" class="form-control input-lg" name="kyc_no" placeholder="ID No" value="{{@auth::user()->VandorDetails->kyc_no}}" onkeyup="kycValidation()"  >
								</div>
								<div class="form-group">
									<label >Pin Code</label>
									<input readonly type="number" name="pin_code" id="pin_code" class="form-control" value="{{@auth::user()->VandorDetails->pin_code}}" >
								</div>
								<div class="form-group mt-3">
									<label >House No/Flat No/ Building No</label>
									<input readonly type="text" name="house_no" id="house_no" class="form-control" value="{{@auth::user()->VandorDetails->house_no}}" >
								</div>
								<div class="form-group">
									<label >Area</label>
									<input readonly type="text" name="area" id="area" class="form-control" value="{{@auth::user()->VandorDetails->area}}" >
								</div>
								<div class="form-group mt-3">
									<label >Landmark</label>
									<input readonly type="text" name="landmark" id="landmark" class="form-control" value="{{@auth::user()->VandorDetails->landmark}}" >
								</div>
								<br>
								<div class="form-group mt-3">
									<label >City</label>
									<input readonly type="text" name="city" id="city" class="form-control" value="{{@auth::user()->VandorDetails->city}}" >
								</div>
								<div class="form-group mt-3">
									<label >State</label>
									<input readonly type="text" name="state" id="state" class="form-control"  value="{{@auth::user()->VandorDetails->state}}">
								</div>
								<div class="form-group">
									<label>Calling No.</label>
									<input readonly id="calling_no" type="text" class="form-control input-lg" name="calling_no" placeholder="Pan Card" value="{{@auth::user()->VandorDetails->calling_no}}" >
								</div>
								<div class="form-group">
									<label>Gst No.</label>
									<input readonly id="gst_no" type="text" class="form-control input-lg" style="text-transform:uppercase" name="gst_no" placeholder="Pan Card" value="{{@auth::user()->VandorDetails->gst_no}}" >
								</div>
								
								</div>
								
								
								
								{{-- OFFICE ADDRESS EDIT -form 2 --}}
								<div class="panel-body rm02 rm04">
								<h1 style="font-size: 25px;margin: 17px 0; margin-top:30px">Office Address</h1>
								
								<div class="form-group">
									<label > Pin Code</label>
									<input readonly type="number" name="office_pincode" id="office_pincode" class="form-control" value="{{@auth::user()->VandorDetails->office_pincode}}" >
								</div>
								<div class="form-group mt-3">
									<label > House No</label>
									<input readonly type="text" name="office_house_no" id="office_house_no" class="form-control" value="{{@auth::user()->VandorDetails->office_house_no}}" >
								</div>
								<div class="form-group">
									<label > Area</label>
									<input readonly type="text" name="office_area" id="office_area" class="form-control" value="{{@auth::user()->VandorDetails->office_area}}" >
								</div>
								<div class="form-group mt-3">
									<label > Landmark</label>
									<input readonly type="text" name="office_landmark" id="office_landmark" class="form-control" value="{{@auth::user()->VandorDetails->office_landmark}}" >
								</div>
								<br>
								<div class="form-group mt-3">
									<label > City</label>
									<input readonly type="text" name="office_city" id="office_city" class="form-control" value="{{@auth::user()->VandorDetails->office_city}}" >
								</div>
								<div class="form-group mt-3">
									<label > State</label>
									<input readonly type="text" name="office_state" id="office_state" class="form-control"  value="{{@auth::user()->VandorDetails->office_state}}">
								</div>
								
								</div>








								
								{{-- ALL IMAGE EDIT form-5   --}}
								<div class="panel-body rm02 rm04">
								<h1 style="font-size: 25px;margin: 17px 0; margin-top: 30px;">Images</h1>
								<div id="image" >
									<div class="form-group">
										<label for="image">Pan Card Image </label>
									
									</div>
									
									<div class="up-img">
										
										
										<div class="vdo-class">
											<br>
											@if(@auth::user()->VandorDetails->pan_image)
											<img src="{{url('/')}}/storage/app/public/vandor/pan_image/{{@auth::user()->VandorDetails->pan_image}}"  class="new-upload-img">
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
										<label for="image"> Kyc Image </label>
										
									</div>
									
									<div class="up-img">
										
									
										
										<div class="vdo-class">
											<br>
											@if(@auth::user()->VandorDetails->kyc_image)
											<img src="{{url('/')}}/storage/app/public/vandor/kyc_image/{{@auth::user()->VandorDetails->kyc_image}}"  class="new-upload-img">
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
										<label for="image"> Vendor Image </label>
										
									</div>
									<div class="up-img">
										
									
										<div class="vdo-class">
											<br>
											@if(@auth::user()->VandorDetails->vendor_image)
											<img src="{{url('/')}}/storage/app/public/vandor/vendor_image/{{@auth::user()->VandorDetails->vendor_image}}"  class="new-upload-img">
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
										<label for="image">Gst</label>
								
								
										<div class="up-img">
										<div class="vdo-class">
											<br>
											@if(@auth::user()->VandorDetails->gst_image)
											{{-- <img src="{{url('/')}}/storage/app/public/vandor/gst_image/{{@auth::user()->VandorDetails->gst_image}}"  class="new-upload-img"> --}}

											<iframe src="{{url('/')}}/storage/app/public/vandor/gst_image/{{@auth::user()->VandorDetails->gst_image}}" height="200" width="300"></iframe>
											@else
											No pdf
											@endif
										</div>
									</div>
									
								</div>
								<div class="clearfix"></div>
								<br>
								<br>
							</div>
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
@include('vandor.includes.script')
@endsection
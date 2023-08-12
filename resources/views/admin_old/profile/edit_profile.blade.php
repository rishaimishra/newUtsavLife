@extends('Agent.layouts.app')
@section('title')
<title>Go party | Agent | Edit profile</title>
@endsection
@section('left_part')
@include('Agent.includes.left_part')
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
					<h4 class="pull-left page-title">Edit profile</h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('agent.dashboard')}}">Go party</a></li>
						<li class="active">Edit profile</li>
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
							<h3 class="panel-title">Profile update</h3> 

							<div class="updt-btns">
							<a href="{{route('agent.update.mobile.page')}}" class="btn btn-primary waves-effect waves-light w-md">Update Mobile</a>
							<a href="{{route('agent.update.email.page')}}" class="btn btn-primary waves-effect waves-light w-md">Update Email</a>
							</div>
							<div class="add-btn "><a href="{{route('agent.profile.page')}}"><i class="icofont-minus-circle"></i> Back</a></div>

						</div>
								<form role="form" action="{{route('agent.profile.update')}}" id="frm" method="post" enctype="multipart/form-data" >
									@csrf
									<div class="form-group">
										<label for="FullName">Name</label>
										<input type="text" placeholder="Enter name"  id="name" class="form-control"  name="name" value="{{auth()->user()->name}}">
									</div>
									{{-- <div class="form-group">
										<label for="FullName">Mobile</label>
										<input type="tel" placeholder="Enter mobile" class="form-control"  name="mobile" value="{{Auth()->user()->mobile}}">
									</div> --}}
									<div class="clearfix"></div>
									
									
									<div class="clearfix"></div>
									<div id="image" >
										<div class="form-group">
											<label for="image">Image <span style="color: red;">*</span></label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												<input type="file"   class="upload" name="img" {{-- onmouseout ="vdo_img()" onkeyup="vdo_img()"  --}}id="img" accept="image/*"  onChange="fun();" >
											</div>
											{{-- <label for="image" style="margin-top: 10px;margin-bottom: 10px">Image dimension should be (200-1200 width) x (100-500 height)</label> --}}
											<label id="img-error" class="error" for="img"></label>
										</div>
										{{-- <div class="clearfix"></div> --}}
										<div class="up-img">

										<div class="review_img rmm_001" style="display: none">
											<em><img src="" alt=""id="img2" class="new-upload-img"></em>
										</div>


										<div class=" rmm_001" id="hidee-img">
										<label for="meta description" class="text-center">Upload Image</label>
										<br>
										<em><img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png" alt=""id="img2" class="new-upload-img"></em>
										</div>


										{{-- <div class="clearfix"></div> --}}
										<div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(Auth()->user()->avatar)
											<img src="{{url('/')}}/storage/app/public/vandor/{{Auth()->user()->avatar}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div>

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>



									{{-- 	<h2>Address</h2> --}}
									{{-- <div class="form-group">
										<label for="FullName">Country</label>
										<input type="text" placeholder="Enter Country" class="form-control"  name="country" value="{{Auth()->user()->country}}">
									</div>
									<div class="form-group">
										<label for="FullName">State</label>
										<input type="text" placeholder="Enter State" class="form-control"  name="state" value="{{Auth()->user()->state}}">
									</div>
									<div class="form-group">
										<label for="FullName">City</label>
										<input type="text" placeholder="Enter City" class="form-control"  name="city" value="{{Auth()->user()->city}}">
									</div>
									<div class="form-group">
										<label for="FullName">Zip code</label>
										<input type="text" placeholder="Enter Zip code" class="form-control"  name="zip" value="{{Auth()->user()->zip}}">
									</div> --}}
									{{--
									<div class="form-group">
										<label for="address_address">Shop Address</label>
										<input type="text" id="address-input" name="address_address" class="form-control map-input" value="{{@$address->address_address}}">
										<input type="text" name="address_latitude" id="address-latitude" value="{{@$address->lat}}" />
										<input type="text" name="address_longitude" id="address-longitude" value="{{@$address->lng}}" />
									</div>
									<div class="form-group">
										<label for="address_address">Distance covered (km)</label>
										<input type="number"  name="distance_cover" class="form-control" value="{{@$address->distance_cover}}">
									</div>
									<div id="address-map-container" style="width:100%;height:300px; ">
										<div style="width: 100%; height: 100%" id="address-map"></div>
									</div> --}}
									
									
									
									
									<div class="clearfix"></div>
									<br>
									<br>
									<h2>Bank information </h2>
									<div class="form-group">
										<label for="FullName">Bank Name</label>
										<input type="text" placeholder="Enter bank name" class="form-control"  name="bank_name" value="{{@$bankDetails->bank_name}}">
									</div>
									<div class="form-group">
										<label for="FullName"> Bank Account No</label>
										<input type="text" placeholder="Enter account_no"  class="form-control"  name="acc_no" value="{{@$bankDetails->acc_no}}">
									</div>
									<div class="form-group">
										<label for="FullName">Ifsc no</label>
										<input type="text" placeholder="Enter ifsc no"  class="form-control"  name="ifsc_no" value="{{@$bankDetails->ifsc_no}}">
									</div>
									<div class="form-group">
										<label for="FullName">Bank holder No</label>
										<input type="text" placeholder="Enter bank holder name"  class="form-control"  name="holder_name" value="{{@$bankDetails->holder_name}}">
									</div>
									<div class="col-lg-12">
										<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update</button>
									</div>
								</form>
								
							</div>
						</div>
						{{-- <div class="updt-btns">
							<a href="{{route('agent.update.mobile.page')}}" class="btn btn-primary waves-effect waves-light w-md">Update Mobile</a>
							<a href="{{route('agent.update.email.page')}}" class="btn btn-primary waves-effect waves-light w-md">Update Email</a>
						</div> --}}
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
name:{
required:true,
minlength:2,
maxlength:20,
},
// bank_name:{
// required:true,
// minlength:3,
// },
// acc_no:{
// required:true,
// minlength:6,
// },
// ifsc_no:{
// required:true,
// minlength:6,
// },
// holder_name:{
// required:true,
// minlength:6,
// },
// country:{
// required:true,
// minlength:3,
// },
// state:{
// required:true,
// minlength:6,
// },
// city:{
// required:true,
// minlength:6,
// },
// zip:{
//   required:true,
//     mobileonly:true,
//     minlength:6,
//     maxlength:8,
// },
address_address:{
required:true,
minlength:5,
},
distance_cover:{
required:true,
}
},
messages:{
},
});
});
</script>
<script>
function fun(){
	$("#hidee-img").hide();
var i=document.getElementById('img').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img").show();
$("#img2").attr("src",b);
}
</script>
{{--
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXag1Tt3SDyc_RWQQcsCrs3Ez7dRWwBEo&libraries=places&callback=initialize" async defer></script>
<script>
function initialize() {
$('form').on('keyup keypress', function(e) {
var keyCode = e.keyCode || e.which;
if (keyCode === 13) {
e.preventDefault();
console.log(1);
return false;
}
});
const locationInputs = document.getElementsByClassName("map-input");
const autocompletes = [];
const geocoder = new google.maps.Geocoder;
console.log(2);
for (let i = 0; i < locationInputs.length; i++) {
const input = locationInputs[i];
const fieldKey = input.id.replace("-input", "");
const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';
const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || parseFloat({{$address->lat}});
const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) ||  parseFloat({{$address->lng}});
const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
center: {lat: latitude, lng: longitude},
zoom: 13
});
const marker = new google.maps.Marker({
map: map,
position: {lat: latitude, lng: longitude},
});
marker.setVisible(isEdit);
const autocomplete = new google.maps.places.Autocomplete(input);
autocomplete.key = fieldKey;
autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
console.log(3);
}
for (let i = 0; i < autocompletes.length; i++) {
const input = autocompletes[i].input;
const autocomplete = autocompletes[i].autocomplete;
const map = autocompletes[i].map;
const marker = autocompletes[i].marker;
google.maps.event.addListener(autocomplete, 'place_changed', function () {
marker.setVisible(false);
const place = autocomplete.getPlace();
console.log("lat: ",JSON.stringify(place.geometry.location.lat()));
console.log("long: ",JSON.stringify(place.geometry.location.lng()));
$("#address-latitude").val(JSON.stringify(place.geometry.location.lat()));
$("#address-longitude").val(JSON.stringify(place.geometry.location.lng()));
geocoder.geocode({'placeId': place.place_id}, function (results, status) {
console.log(results,status);
if (status === google.maps.GeocoderStatus.OK) {
const lat = results[0].geometry.location.lat();
const lng = results[0].geometry.location.lng();
setLocationCoordinates(autocomplete.key, lat, lng);
console.log(47);
}
});
if (!place.geometry) {
window.alert("No details available for input: '" + place.name + "'");
input.value = "";
return;
}
if (place.geometry.viewport) {
map.fitBounds(place.geometry.viewport);
} else {
map.setCenter(place.geometry.location);
map.setZoom(17);
}
marker.setPosition(place.geometry.location);
marker.setVisible(true);
});
console.log(4);
}
}
function setLocationCoordinates(key, lat, lng) {
console.log(5);
const latitudeField = document.getElementById(key + "-" + "latitude");
const longitudeField = document.getElementById(key + "-" + "longitude");
latitudeField.value = lat;
longitudeField.value = lng;
}
</script>
--}}
@endsection
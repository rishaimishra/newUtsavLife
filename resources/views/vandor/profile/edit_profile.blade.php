@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Edit profile</title>
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
						<li><a href="{{route('vandor.dashboard')}}">Utsavlife</a></li>
						<li class="active">Edit profile</li>
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
						<h3 class="panel-title">Profile update</h3>
						<div class="updt-btns">
							<a href="{{route('vandor.update.mobile.page')}}" class="btn btn-primary waves-effect waves-light w-md">Update Mobile</a>
							<a href="{{route('vandor.update.email.page')}}" class="btn btn-primary waves-effect waves-light w-md">Update Email</a>
						</div>
						<div class="add-btn "><a href="{{route('vandor.profile.page')}}"><i class="icofont-minus-circle"></i> Back</a></div>
					</div>









{{-- Vandor details Edit  --}}
					<form role="form" action="{{route('vandor.profile.update')}}" id="frm1" method="post" enctype="multipart/form-data" >
						@csrf
						<div class="form-group">
							<label for="FullName">Name</label>
							<input type="text" placeholder="Enter name"  id="name" class="form-control"  name="name" value="{{auth::user()->name}}">
						</div>
						
						<div class="clearfix"></div>
						
						
						{{-- <div class="form-group">
							<label>Pan Card No.</label>
							<input id="pan_card" type="text" class="form-control input-lg" name="pan_card" placeholder="Pan Card" value="{{@auth::user()->VandorDetails->pan_card}}" >
						</div> --}}
						{{-- <div class="form-group">
							<label>Kyc Type</label>
							<br>
							<select name="kyc_type" id="kyc_type" onchange="kycValidation()">
								<option value="">Select Kyc Type</option>
								<option value="VO" @if(@auth::user()->VandorDetails->kyc_type=="VO") selected @endif>Voter Card</option>
								<option value="AD" @if(@auth::user()->VandorDetails->kyc_type=="AD") selected @endif>Aadher card</option>
								<option value="PA" @if(@auth::user()->VandorDetails->kyc_type=="PA") selected @endif>Passport</option>
								<option value="DL" @if(@auth::user()->VandorDetails->kyc_type=="DL") selected @endif>Driving Licensce</option>
								<option value="OT" @if(@auth::user()->VandorDetails->kyc_type=="OT") selected @endif>Other</option>
							</select>
						</div> --}}
						{{-- <div class="form-group">
							<label>ID No.</label>
							<input id="kyc_no" type="text" class="form-control input-lg" name="kyc_no" placeholder="ID No" value="{{@auth::user()->VandorDetails->kyc_no}}" onkeyup="kycValidation()"  >
						</div> --}}
						<div class="form-group">
							<label >Pin Code</label>
							<input type="number" name="pin_code" id="pin_code" class="form-control" value="{{@auth::user()->VandorDetails->pin_code}}" >
						</div>
						<div class="form-group mt-3">
							<label >House No/Flat No/ Building No</label>
							<input type="text" name="house_no" id="house_no" class="form-control" value="{{@auth::user()->VandorDetails->house_no}}" >
						</div>
						<div class="form-group">
							<label >Area</label>
							<input type="text" name="area" id="area" class="form-control" value="{{@auth::user()->VandorDetails->area}}" >
						</div>
						<div class="form-group mt-3">
							<label >Landmark</label>
							<input type="text" name="landmark" id="landmark" class="form-control" value="{{@auth::user()->VandorDetails->landmark}}" >
						</div>
						<br>
						<div class="form-group mt-3">
							<label >City</label>
							<input type="text" name="city" id="city" class="form-control" value="{{@auth::user()->VandorDetails->city}}" >
						</div>
						<div class="form-group mt-3">
							<label >State</label>
							<input type="text" name="state" id="state" class="form-control"  value="{{@auth::user()->VandorDetails->state}}">
						</div>

						<div class="form-group">
								<label>Calling No.</label>
								<input id="calling_no" type="text" class="form-control input-lg" name="calling_no" placeholder="Calling No" value="{{@auth::user()->VandorDetails->calling_no}}" >
							</div>
							<div class="form-group">
								<label>Gst No.</label>
								<input id="gst_no" type="text" class="form-control input-lg" style="text-transform:uppercase" name="gst_no" placeholder="Gst No" value="{{@auth::user()->VandorDetails->gst_no}}" >
							</div>
						
						
						<div class="col-lg-12">
							<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update</button>
						</div>
					</form>

</div>



















{{-- OFFICE ADDRESS EDIT -form 2 --}}
<div class="panel-body rm02 rm04">
<h1 style="font-size: 25px;margin: 17px 0; margin-top:30px">Office Address</h1>
<form action="{{route('vandor.office.address.update')}}" id="frm2" method="post" enctype="multipart/form-data">
	@csrf
	<p>Same address as Your Address?</p>
	<input type="radio" name="driverAddress" onclick="getAddressForOffice(this.value);" value="Y" />Yes
	<input type="radio" name="driverAddress" onclick="getAddressForOffice(this.value);" value="N" />No
	<div class="form-group">
		<label >Pin Code</label>
		<input type="number" name="office_pincode" id="office_pincode" class="form-control" value="{{@auth::user()->VandorDetails->office_pincode}}" >
	</div>
	<div class="form-group mt-3">
		<label > House No</label>
		<input type="text" name="office_house_no" id="office_house_no" class="form-control" value="{{@auth::user()->VandorDetails->office_house_no}}" >
	</div>
	<div class="form-group">
		<label > Area</label>
		<input type="text" name="office_area" id="office_area" class="form-control" value="{{@auth::user()->VandorDetails->office_area}}" >
	</div>
	<div class="form-group mt-3">
		<label >Landmark</label>
		<input type="text" name="office_landmark" id="office_landmark" class="form-control" value="{{@auth::user()->VandorDetails->office_landmark}}" >
	</div>
	<br>
	<div class="form-group mt-3">
		<label >City</label>
		<input type="text" name="office_city" id="office_city" class="form-control" value="{{@auth::user()->VandorDetails->office_city}}" >
	</div>
	<div class="form-group mt-3">
		<label >State</label>
		<input type="text" name="office_state" id="office_state" class="form-control"  value="{{@auth::user()->VandorDetails->office_state}}">
	</div>
	
		<div class="col-lg-12">
				<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update</button>
			</div>

</form>
</div>












{{-- ALL IMAGE EDIT form-5   --}}
<div class="panel-body rm02 rm04">
<h1 style="font-size: 25px;margin: 17px 0; margin-top:30px">Images Update</h1>
<form action="{{route('vandor.all.image.update')}}" id="frm5" method="post" enctype="multipart/form-data">
						@csrf
							<div id="image" >
										<div class="form-group">
											<label for="image">Pan Card Image <span style="color: red;">*</span></label>
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


										
										{{-- <div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(@auth::user()->VandorDetails->pan_image)
											<img src="{{url('/')}}/storage/app/public/vandor/pan_image/{{@auth::user()->VandorDetails->pan_image}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div> --}}

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>








									<div id="image" >
										<div class="form-group">
											<label for="image"> Kyc Image <span style="color: red;">*</span></label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												<input type="file"   class="upload" name="img2" id="img2" accept="image/*"  onChange="fun2();" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										<div class="review_img2 rmm_001" style="display: none">
											<em><img src="" alt=""id="imgshw2" class="new-upload-img"></em>
										</div>


										<div class=" rmm_001" id="hidee-img2">
										<label for="meta description" class="text-center">Upload Image</label>
										<br>
										<em><img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png" alt=""id="imgshw2" class="new-upload-img"></em>
										</div>


										
										{{-- <div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(@auth::user()->VandorDetails->kyc_image)
											<img src="{{url('/')}}/storage/app/public/vandor/kyc_image/{{@auth::user()->VandorDetails->kyc_image}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div> --}}

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>







									<div id="image" >
										<div class="form-group">
											<label for="image">Vendor Image <span style="color: red;">*</span></label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												<input type="file"   class="upload" name="img3" id="img3" accept="image/*"  onChange="fun3();" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										<div class="review_img3 rmm_001" style="display: none">
											<em><img src="" alt=""id="imgshw3" class="new-upload-img"></em>
										</div>


										<div class=" rmm_001" id="hidee-img3">
										<label for="meta description" class="text-center">Upload Image</label>
										<br>
										<em><img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png" alt=""id="img2" class="new-upload-img"></em>
										</div>


										
										{{-- <div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(@auth::user()->VandorDetails->vendor_image)
											<img src="{{url('/')}}/storage/app/public/vandor/vendor_image/{{@auth::user()->VandorDetails->vendor_image}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div> --}}

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>








									<div id="image" >
										<div class="form-group">
											<label for="image">Gst </label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload file</span>
												<input type="file"   class="upload" name="img4" id="img4"   onChange="fun4();" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										{{-- <div class="review_img4 rmm_001" style="display: none">
											<em><img src="" alt=""id="imgshw4" class="new-upload-img"></em>
										</div> --}}


										{{-- <div class=" rmm_001" id="hidee-img4">
										<label for="meta description" class="text-center">Upload Image</label>
										<br>
										<em><img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png" alt=""id="imgshw4" class="new-upload-img"></em>
										</div>
 --}}

										
										{{-- <div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(@auth::user()->VandorDetails->gst_image)
											<img src="{{url('/')}}/storage/app/public/vandor/gst_image/{{@auth::user()->VandorDetails->gst_image}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div> --}}

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>










								







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
$('#frm1').validate({
rules:{
name:{
required:true,
minlength:2,
maxlength:20,
},
city:{
required:true,
},
state:{
required:true,
},
house_no:{
required:true,
},
kyc_type:{
required:true,
},
kyc_no:{
required:true,
},
pan_card:{
required:true,
},
landmark:{
required:true,
},
area:{
required:true,
},
pin_code:{
required:true,
},
// gst_no:{
// required:true,
// },
calling_no:{
mobileonly:true,
},
},
messages:{
},
});
});
</script>




{{-- office details --}}
<script>
$(document).ready(function(){

$('#frm2').validate({
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
},
messages:{
},
});
});
</script>




{{-- driver details --}}
<script>
$(document).ready(function(){

$('#frm3').validate({
rules:{

driver_name:{
required:true,
},
driver_mobile_no:{
required:true,
minlength:5,
},
driver_kyc_type:{
required:true,
},
dricer_kyc_no:{
required:true,
},
driver_licence_no:{
required:true,
},
},
messages:{
},
});
});
</script>



{{-- driver address --}}
<script>
$(document).ready(function(){

$('#frm4').validate({
rules:{
driver_pincode:{
required:true,
},
driver_house_no:{
required:true,
},
driver_area:{
required:true,
},
driver_landmark:{
required:true,
},
driver_city:{
required:true,
},
driver_state:{
required:true,
},
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




<script>
	function getAddressForOffice(val){
			// alert(val)
		// console.log(val);
	if(val=="Y"){
	//ajax
	$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': "{{csrf_token()}}"
	}
	});
	
	var fd= new FormData;
	fd.append('vandor_id',{{@auth::user()->id}});
	$.ajax({
	url:'{{route('vandor.get.address.ajax')}}',
	type:'POST',
	data: fd,
	contentType: false,
	processData: false,
	
	success:function(res){
	// console.log(res);
		$("#office_pincode").val(res.data.pin_code);
		$("#office_house_no").val(res.data.house_no);
		$("#office_area").val(res.data.area);
		$("#office_landmark").val(res.data.landmark);
		$("#office_city").val(res.data.city);
		$("#office_state").val(res.data.state);
	}
	});
    }else{
    	$("#office_pincode").val('');
		$("#office_house_no").val('');
		$("#office_area").val('');
		$("#office_landmark").val('');
		$("#office_city").val('');
		$("#office_state").val('');
    }

	}
</script>



<script>
	function getDetailsFun(val){
			// alert(val)
		// console.log(val);
	if(val=="Y"){
	//ajax
	$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': "{{csrf_token()}}"
	}
	});
	
	var fd= new FormData;
	fd.append('vandor_id',{{@auth::user()->id}});
	$.ajax({
	url:'{{route('vandor.get.details.ajax')}}',
	type:'POST',
	data: fd,
	contentType: false,
	processData: false,
	
	success:function(res){
	// console.log(res);
		$("#driver_name").val(res.data.name);
		$("#driver_mobile_no").val(res.data.mobile);
		$("#driver_kyc_type").val(res.data.vandor_details.kyc_type);
		$("#dricer_kyc_no").val(res.data.vandor_details.kyc_no);
	}
	});
    }else{
    	$("#driver_name").val('');
		$("#driver_mobile_no").val('');
		$("#driver_kyc_type").val('');
		$("#dricer_kyc_no").val('');
    }

	}
</script>




<script>
function getAddressForDriver(val){
		// alert(val)
		// console.log(val);
	if(val=="Y"){
	//ajax
	$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': "{{csrf_token()}}"
	}
	});
	
	var fd= new FormData;
	fd.append('vandor_id',{{@auth::user()->id}});
	$.ajax({
	url:'{{route('vandor.get.address.ajax')}}',
	type:'POST',
	data: fd,
	contentType: false,
	processData: false,
	
	success:function(res){
	// console.log(res);
		$("#driver_pincode").val(res.data.pin_code);
		$("#driver_house_no").val(res.data.house_no);
		$("#driver_area").val(res.data.area);
		$("#driver_landmark").val(res.data.landmark);
		$("#driver_city").val(res.data.city);
		$("#driver_state").val(res.data.state);
	}
	});
    }else{
    	$("#driver_pincode").val('');
		$("#driver_house_no").val('');
		$("#driver_area").val('');
		$("#driver_landmark").val('');
		$("#driver_city").val('');
		$("#driver_state").val('');
    }
	}
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


<script>
function fun2(){
	$("#hidee-img2").hide();
var i=document.getElementById('img2').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img2").show();
$("#imgshw2").attr("src",b);
}
</script>


<script>
function fun3(){
	$("#hidee-img3").hide();
var i=document.getElementById('img3').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img3").show();
$("#imgshw3").attr("src",b);
}
</script>


<script>
function fun4(){
	$("#hidee-img4").hide();
var i=document.getElementById('img4').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img4").show();
$("#imgshw4").attr("src",b);
}
</script>


<script>
function fun5(){
	$("#hidee-img5").hide();
var i=document.getElementById('img5').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img5").show();
$("#imgshw5").attr("src",b);
}
</script>


<script>
function fun6(){
	$("#hidee-img6").hide();
var i=document.getElementById('img6').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img6").show();
$("#imgshw6").attr("src",b);
}
</script>


<script>
    function kycValidation(){
        var dkyc=$("#kyc_type").val();
           // alert(dkyc)
           if(dkyc=="AD"){
            $("#kyc_no").attr({
               "maxlength" : 16,        // substitute your own
               "minlength" : 16,      // values (or variables) here
            });
            $('#kyc_no').attr('type', 'number');
           }
           else if(dkyc=="VO"){
            $("#kyc_no").css('text-transform','uppercase');
            $('#kyc_no').attr('type', 'text');
           }
           else{
            $('#kyc_no').attr('type', 'text');
            }
    }
</script>
@endsection
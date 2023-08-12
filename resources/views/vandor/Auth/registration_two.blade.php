<style>
	/* -- line dot Active form --  */
	.wraper {
		padding: 50px;
		text-align: center;
		width: 100%;
		margin: 10px auto;
	}
	h1 {
		margin: 50px auto;
	}
	.contain {
		border-top: 2px solid #000;
		display: flex;
		list-style: none;
		padding: 0;
		justify-content: space-between;
		align-items: stretch;
		align-content: stretch;
	}
	.link {
		position: relative;
		margin-top: 10px;
		width: 100%;
	}
	.link a {
		font-weight: bold;
		text-decoration: none;
		color: black;
		text-transform: capitalize;
		font-size: 15px;
	}
	.link:first-child {
		margin-left: -180px;
	}
	.link:last-child {
		margin-right: -180px;
	}
	.link::after {
		content: "";
		width: 15px;
		height: 15px;
		background: #fff;
		position: absolute;
		border-radius: 10px;
		top: -18px;
		left: 50%;
		transform: translatex(-50%);
		border: 2px solid black;
	}
	.active::after,
	.link:hover::after {
		background: black;
	}
	p.lead {
		font-weight: 600;
		margin: 50px auto;
		line-height: 1.5;
	}

	/* -- for page --  */
	.login_wrap_area, .social-login-wrap {
			box-shadow: none !important;
	}
	.heading-login {
			text-align: left;
	}
	.login_wrap_area .form-group input {
			background: #d5d7f3 !important;
			border: none !important;
			height: 45px !important;
			padding-left: 20px !important;
			font-size: 16px !important;
			width: 100% !important;
	}
	label {
			text-align: left;
			width: 100%;
	}
	select {
			background: #d5d7f3;
			border: none;
			height: 45px;
			padding-left: 20px;
			font-size: 16px;
			width: 100%;
			border-radius: 5px;
	}
	.error {
			color: red;
			font-size: 14px;
	}
	.sub-btn {
			display: flex;
			justify-content: space-between;
	}
	
	/* -- only this page --  */
	.same-add {
		display: flex;
		justify-content: space-between;
		margin: 10px 0;
	}
	textarea.form-control {
		background: #d5d7f3 !important;
	}
	.fileUpload.cust_file.clearfix {
		width: 100%
	}
	.new-upload-img {
    width: 100px !important;
    height: 100px !important;
    border-radius: 0 !important;
		margin-left: 0 !important;
	}
	.up-img {
		display: flex;
    justify-content: center;
		gap: 50px;
	}
</style>
@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Registration</title>
@endsection
@include('vandor.includes.headAuth')
@section('content')
<!-- Preeloader -->
<div id="loading">
	<div id="loading-center">
		<div id="loading-center-absolute">
			<div class="object" id="object_one"></div>
			<div class="object" id="object_two"></div>
			<div class="object" id="object_three"></div>
			<div class="object" id="object_four"></div>
			<div class="object" id="object_five"></div>
		</div>
	</div>
</div>
<!-- Click Sarch bar -->
<div class="common-overlay"></div>
<!-- Preeloader -->
<!-- register area start -->
<section class="login-area-content">
	<div class="container">
		 {{-- -- start line dot Active form -- --}}
     <div class="wraper">
			<ul class="contain">
				 <li class="link"><a href="{{route('vandor.registration.get')}}">Vendor</a></li>
		          <li class="link active"><a href="{{route('vandor.reg.two.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Service</a></li>
		          <li class="link"><a href="{{route('vandor.reg.three.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Payment</a></li>
		          <li class="link"><a href="{{route('vandor.reg.four.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Documents</a></li>
			</ul>
		</div>
		{{-- -- end line dot Active form -- --}}
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="login_wrap_area">
					<div class="loginwrap">
						<div class="heading-login">
							<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:15px">
							<h1 style="font-size:18px">Part-2</h1>
							<a class="btn btn-primary" href="{{route('vandor.dashboard')}}">DashBoard</a>
							</div>
                            
							
							 @include('vandor.includes.message')
							@if(@$success)
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>
								{{@$success}}
								</strong>
							</div>
							@endif
						</div>
						<form  method="POST" action="{{ route('vandor.registration.two.post',["id"=>$id,'email'=>$email]) }}" id="reg_form"enctype="multipart/form-data" >
							@csrf
							<h2 style="font-size: 20px;text-align: left;margin-bottom: 20px;">Service And Office information </h2>
							<input type="hidden" name="vandor_id" value="{{@$id}}">
							<input type="hidden" name="email" value="{{@$email}}">

							<p class="mb-3">You can add only one service while register, later on you can add more from service tab.</p>

							{{-- <div class="form-group rm50">
								
								<label for="title">Category Name</label>
								<select class="form-group" name="category_id" id="category_id" onchange="getService(this.value)">
									<option value=""> Select Category</option>
									@foreach($category as $val)
									<option value="{{$val->id}}" @if($val->id==@$vandorService->category) selected @endif> {{$val->category_name}}</option>
									@endforeach
								</select>
							</div> --}}

							<div class="clearfix"></div>
							<input type="hidden" name="vendor_service_id" value="{{@$vandorService->id}}">
							<div class="form-group rm50"  id="service_fetch">
								<label for="title">Service Name</label>
								<select class="form-group" name="service_id" id="serviceName" onchange="serviceNamefun()">

							{{-- @if($vandorServiceCount>0) --}}
							       <option value="">Select Service</option>
							       
									@foreach($allService as $val2)
									<option value="{{$val2->id}}" @if($val2->id==@$vandorService->service_id) selected @endif>{{$val2->service}}</option>
									@endforeach
									{{-- @endif --}}
								</select>
							</div>

							
							
							<div class="clearfix"></div>
							<div class="form-group rm50">
								<label for="title">Service Description</label>
								<textarea  class="form-control"  placeholder="Enter Service description"  name="service_desc" >{{@$vandorService->service_desc}}</textarea>
							</div>
							<div class="clearfix"></div>
							<div class="form-group rm50">
								<label for="title">Price</label>
								<input type="number"  class="form-control"  placeholder="Enter price"  name="price" value="{{@$vandorService->price}}" >
							</div>

							<div id="image" >
										<div class="form-group">
											<label for="image">Product Images (3 to 5) <span style="color: red;">*</span></label>
											<br>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
											{{-- 	<input type="file"   class="upload" name="img7" id="img7" accept="image/*"  onChange="fun7();" >
 --}}
												 <input type="file" name="productImages[]" class="myfrm form-control" multiple accept="image/*" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										<div class="review_img7 rmm_001" style="display: none">
											<em><img src="" alt=""id="imgshw7" class="new-upload-img"></em>
										</div>



										
										<div class="vdo-class">
											<label for="meta description">Previous Images</label>
											<br>
											@if(@$vandorService->image)
											<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$vandorService->image}}"  class="new-upload-img">
											@else
											No Image
											@endif

											@if(@$vandorService->image2)
											<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$vandorService->image2}}"  class="new-upload-img">
											@endif

											@if(@$vandorService->image3)
											<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$vandorService->image3}}"  class="new-upload-img">
											@endif

											@if(@$vandorService->image4)
											<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$vandorService->image4}}"  class="new-upload-img">
											@endif

											@if(@$vandorService->image5)
											<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$vandorService->image5}}"  class="new-upload-img">
											
											@endif
										</div>

										</div>
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>





							
							
							<div class="form-group">
								<label>Calling No.</label>
								<input id="calling_no" type="text" class="form-control input-lg" name="calling_no" placeholder="Calling No" value="{{@$data->VandorDetails->calling_no}}" >
							</div>
							<div class="form-group">
								<label>Gst No.</label>
								<input id="gst_no" type="text" style="text-transform:uppercase" class="form-control input-lg" name="gst_no" placeholder="Gst no" value="{{@$data->VandorDetails->gst_no}}" >
							</div>














							{{-- driver details --}}
							<div id="dd" @if(@$vandorService->driver_name) @else style="display:none" @endif>
							<hr>
							<h1 style="font-size:18px;text-align:left">Driver Details</h1>
							<div class="same-add">
							<p>Same address as your details?</p>
<div>
							<input type="radio" name="getDetails" onclick="getDetailsFun(this.value);" value="Y" />Yes
                            <input type="radio" name="getDetails" onclick="getDetailsFun(this.value);" value="N" />No
</div>
							</div>
							<div class="form-group">
								<label> Name</label>
								<input id="driver_name" type="text" class="form-control input-lg" name="driver_name" placeholder="Driver Name" value="{{@$vandorService->driver_name}}" >
							</div>
							<div class="form-group">
								<label> Mobile Number</label>
								<input id="driver_mobile_no" type="text" class="form-control input-lg" name="driver_mobile_no" placeholder="driver_mobile_no" value="{{@$vandorService->driver_mobile_no}}" >
							</div>
							<div class="form-group">
								<label> Kyc Type</label>
								<br>
								<select name="driver_kyc_type" id="driver_kyc_type" onchange="kycValidation()">
									<option value="">Select Kyc Type</option>
									<option value="VO" @if(@$vandorService->driver_kyc_type=="VO") selected @endif>Voter Card</option>
									<option value="AD" @if(@$vandorService->driver_kyc_type=="AD") selected @endif>Aadher Card</option>
									<option value="PA" @if(@$vandorService->driver_kyc_type=="PA") selected @endif>Passport</option>
									<option value="DL" @if(@$vandorService->driver_kyc_type=="DL") selected @endif >Driving Licensce</option>
									<option value="OT" @if(@$vandorService->driver_kyc_type=="OT") selected @endif>Other Govt.Id</option>
								</select>
							</div>
							<div class="form-group">
								<label> ID No.</label>
								<input id="dricer_kyc_no" type="text" class="form-control input-lg" name="dricer_kyc_no" placeholder="ID No" value="{{@$vandorService->dricer_kyc_no}}" >
							</div>
							<div class="form-group">
								<label>Driving License No</label>
								<input id="driver_licence_no" type="text" class="form-control input-lg" name="driver_licence_no" placeholder="driver licence no" value="{{@$vandorService->driver_licence_no}}" >
							</div>


								<div id="image" >
										<div class="form-group">
											<label for="image">Driver Image <span style="color: red;">*</span></label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												<input type="file" @if(!@$vandorService->driver_image) required  @endif  class="upload" name="img6" id="img6" accept="image/*"  onChange="fun6();" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										<div class="review_img6 rmm_001" style="display: none">
											<em><img src="" alt=""id="imgshw6" class="new-upload-img"></em>
										</div>


										<div class=" rmm_001" id="hidee-img6">
										<label for="meta description" class="text-center">Upload Image</label>
										<br>
										<em><img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png" alt=""id="imgshw6" class="new-upload-img"></em>
										</div>


										
										<div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(@$vandorService->driver_image)
											<img src="{{url('/')}}/storage/app/public/vandor/driver_image/{{@$vandorService->driver_image}}"  class="new-upload-img">
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
											<label for="image">DL Image <span style="color: red;">*</span></label>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												<input type="file" @if(!@$vandorService->dl_image) required  @endif  class="upload" name="img5" id="img5" accept="image/*"  onChange="fun5();" >
											</div>
											
											
										</div>
										
										<div class="up-img">

										<div class="review_img5 rmm_001" style="display: none">
											<em><img src="" alt=""id="imgshw5" class="new-upload-img"></em>
										</div>


										<div class=" rmm_001" id="hidee-img5">
										<label for="meta description" class="text-center">Upload Image</label>
										<br>
										<em><img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png" alt=""id="imgshw5" class="new-upload-img"></em>
										</div>


										
										<div class="vdo-class">
											<label for="meta description">Previous Image</label>
											<br>
											@if(@$vandorService->dl_image)
											<img src="{{url('/')}}/storage/app/public/vandor/dl_image/{{@$vandorService->dl_image}}"  class="new-upload-img">
											@else
											No Image
											@endif
										</div>

										</div>
										
									</div>
									<br>
									<br>













							<hr>
							<h1 style="font-size:18px;text-align:left"> Driver address</h1>
							<div class="same-add">
							<p>Same address as your address?</p>
							<div>
								<input type="radio" name="driverAddress" onclick="getAddressForDriver(this.value);" value="Y" />Yes
								<input type="radio" name="driverAddress" onclick="getAddressForDriver(this.value);" value="N" />No
							</div>
							</div>
							<div class="form-group">
								<label >Driver Pin Code</label>
								<input type="number" name="driver_pincode" id="driver_pincode" class="form-control" value="{{@$vandorService->driver_pincode}}" >
							</div>
							<div class="form-group mt-3">
								<label >Driver House No/Flat No/ Building No</label>
								<input type="text" name="driver_house_no" id="driver_house_no" class="form-control" value="{{@$vandorService->driver_house_no}}" >
							</div>
							<div class="form-group">
								<label >Driver Area</label>
								<input type="text" name="driver_area" id="driver_area" class="form-control" value="{{@$vandorService->driver_area}}" >
							</div>
							<div class="form-group mt-3">
								<label >Driver Landmark</label>
								<input type="text" name="driver_landmark" id="driver_landmark" class="form-control" value="{{@$vandorService->driver_landmark}}" >
							</div>
							<br>
							<div class="form-group mt-3">
								<label >Driver City</label>
								<input type="text" name="driver_city" id="driver_city" class="form-control" value="{{@$vandorService->driver_city}}" >
							</div>
							<div class="form-group mt-3">
								<label >Driver State</label>
								<input type="text" name="driver_state" id="driver_state" class="form-control"  value="{{@$vandorService->driver_state}}">
							</div>

</div>










							<hr>
							<h1 style="font-size:18px;text-align:left">Office Address</h1>
							<div class="same-add">
							<p>Same address as your address?</p>
<div>
							<input type="radio" name="driverAddress" onclick="getAddressForOffice(this.value);" value="Y" />Yes
                            <input type="radio" name="driverAddress" onclick="getAddressForOffice(this.value);" value="N" />No
							</div></div>
							<div class="form-group">
								<label > Pin Code</label>
								<input type="number" name="office_pincode" id="office_pincode" class="form-control" value="{{@$data->VandorDetails->office_pincode}}" >
							</div>
							<div class="form-group mt-3">
								<label >  House No</label>
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

							<div class="form-group mt-3">
								<label > Office Mobile No</label>
								<input type="text" name="office_mobile" id="office_mobile" class="form-control" value="{{@$data->VandorDetails->office_mobile}}" >
							</div>

							<br>

							<div class="form-group mt-3">
                                <label for="FullName">Country</label>
                                <select class="form-control" name="office_country" id="office_country" style="background: #d5d7f3">
                                   @php
                                   $allCountry=DB::table('tbl_countries')->get();
                                   @endphp

                                   <option value="">Select</option>
                                   @foreach($allCountry as $val)
                                    <option value="{{$val->id}}" @if(@$val->id==@$data->VandorDetails->office_country) selected  @endif>{{@$val->name}}</option>
                                    @endforeach
                                </select>
                            </div>
							<div class="form-group mt-3">
								<label > City</label>
								<input type="text" name="office_city" id="office_city" class="form-control" value="{{@$data->VandorDetails->office_city}}" >
							</div>
							<div class="form-group mt-3">
								<label > State</label>
								<input type="text" name="office_state" id="office_state" class="form-control"  value="{{@$data->VandorDetails->office_state}}">
							</div>
							
							
							


                            <input type="hidden" name="btn" id="btnVal">
                            
                            <div class="form-group sub-btn">
                            	<button onclick="functionPrev()" class="btn btn-primary"  > Previous</button>
                                <button onclick="functionSave()" class="btn btn-primary" > Save</button>
                                <button onclick="functionNext()"  class="btn btn-primary" > Next</button>
                            </div>


							
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-12" style="display:none;">
				<div class="social-login-wrap">
					<div class="heading-login">
						<h1 class="mb-5">Create Account Using Social Media</h1>
						
						<p class="mb-30">Already Have Account <a href="{{route('vandor.login.view')}}">Login</a></p>
						
					</div>
					
					
					
				</div>
				
			</div>
		</div>
	</div>
</section>
@endsection
@section('script')
@include('vandor.includes.scriptAuth')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>
function functionSave(){
    // console.log(1)
    $("#btnVal").val('save');
    $('#reg_form')[0].submit();
}

function functionPrev(){
	 $("#btnVal").val('prev');
    $('#reg_form')[0].submit();
}


// check name of service
$(document).ready(function(){
var name=$( "#serviceName option:selected" ).text();
var chk=name.toLowerCase().includes('Car'.toLowerCase());
     console.log("car",chk)
     if(chk==true){
     	$("#dd").show();
     }
});


function functionNext(){
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
$('#reg_form').validate({
rules:{
category_id:{
required:true,
},
service_id:{
required:true,
},
service_desc:{
required:true,
minlength:3,
},
price:{
required:true,
},
calling_no:{
mobileonly:true,
},



// gst_no:{
// required:true,
// },
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
email:{
required:"Please enter a email address.",
},
password:{
required:"Please enter a password. ",
}
},

});
}
// });
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
	fd.append('type',"add");
	$.ajax({
	url:'{{route('vandor.get.service')}}',
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
	fd.append('vandor_id',{{@$id}});
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
	fd.append('vandor_id',{{@$id}});
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
		$("#office_country").val(res.data.country);
		$("#office_city").val(res.data.city);
		$("#office_state").val(res.data.state);
	}
	});
    }else{
    	$("#office_pincode").val('');
		$("#office_house_no").val('');
		$("#office_area").val('');
		$("#office_landmark").val('');
		$("#office_country").val('');
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
	fd.append('vandor_id',{{@$id}});
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
function fun7(){
	$("#hidee-img7").hide();
var i=document.getElementById('img7').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img7").show();
$("#imgshw7").attr("src",b);
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
	// if val is car then show driver details
	function serviceNamefun(){
		var name=$( "#serviceName option:selected" ).text();
		var chk=name.toLowerCase().includes('Car'.toLowerCase());
     console.log("car",chk)
     if(chk==true){
     	//chk that card is there or not
     	var arr = ['Card','card'];
     	var status=true;
     	arr.forEach(function(item) {
		   	var cardChk=name.toLowerCase().includes(item.toLowerCase());
		   	if(cardChk==true){
		   		status=false
		   	}
		});
     
     	console.log("no card",status);
        if(status){
     	  $("#dd").show();
        }else{
        	$("#dd").hide();
     	
     	$("#driver_name").val('');
		$("#driver_mobile_no").val('');
		$("#driver_kyc_type").val('');
		$("#dricer_kyc_no").val('');

     	$("#driver_pincode").val('');
		$("#driver_house_no").val('');
		$("#driver_area").val('');
		$("#driver_landmark").val('');
		$("#driver_city").val('');
		$("#driver_state").val('');

        }
     }else{
     	$("#dd").hide();
     	
     	$("#driver_name").val('');
		$("#driver_mobile_no").val('');
		$("#driver_kyc_type").val('');
		$("#dricer_kyc_no").val('');

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
	function kycValidation(){
		var dkyc=$("#driver_kyc_type").val();
   // alert(dkyc)
   if(dkyc=="AD"){
   	$("#dricer_kyc_no").attr({
       "maxlength" : 16,        // substitute your own
       "minlength" : 16,      // values (or variables) here
    });
    $('#dricer_kyc_no').attr('type', 'number');
   }
   else if(dkyc=="VO"){
	$("#dricer_kyc_no").css('text-transform','uppercase');
    $('#dricer_kyc_no').attr('type', 'text');
   }else{
   	$('#dricer_kyc_no').attr('type', 'text');
     }
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
@endsection
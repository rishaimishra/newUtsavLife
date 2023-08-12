@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Services add</title>
@endsection
@section('left_part')
@include('vandor.includes.left_part')
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
	.new-upload-img {
		width: 200px;
height: 200px;
object-fit: cover;
	}
</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="wraper container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="pull-left page-title">Service Add </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('vandor.dashboard')}}">Utsavlife</a></li>
						<li class="active"> Service Add </li>
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
									<h3 class="panel-title">Add Service</h3>
									<div class="add-btn "><a href="{{route('vandor.service.list')}}"><i class="icofont-minus-circle"></i> Back</a></div>
								</div>
								<form role="form" action="{{route('vandor.service.insert')}}" id="frm" method="post" enctype="multipart/form-data">
									@csrf
									{{-- <div class="form-group rm50">
										<label for="title">Category Name</label>
										<select class="form-control" name="category_id" id="category_id" onchange="getService(this.value)">
											<option value=""> Select Category</option>
											@foreach($category as $val)
											<option value="{{$val->id}}"> {{$val->category_name}}</option>
											@endforeach
										</select>
									</div> --}}
									<div class="clearfix"></div>
									<div class="form-group rm50"  id="service_fetch">
										<label for="title">Service Name</label>
										<select class="form-control  py-3" name="service_id" id="serviceName" onchange="serviceNamefun()">
											<option value=""> Select Service</option>
											@foreach($services as $val)
											<option value="{{$val->id}}"> {{$val->service}}</option>
											@endforeach
										</select>
									</div>
									{{-- <p id="base_price">Base Price Set By Admin is: 0 </p> --}}
									{{-- <div class="form-group rm50">
										<label for="title">Service name</label>
										<select name="service_id" class="form-control">
											<option value=""> Select Service</option>
											@foreach($services as $val)
											<option value="{{$val->id}}"> {{$val->service}}</option>
											@endforeach
										</select>
									</div> --}}
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Company Name (optional)</label>
										<input type="text"  class="form-control"  placeholder="Enter company name"  name="company_name" >
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Address</label>
										<textarea  class="form-control"  placeholder="Enter address"  name="address" ></textarea>
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Service Description</label>
										<textarea  class="form-control"  placeholder="Enter service description"  name="service_desc" ></textarea>
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Material Description</label>
										<textarea  class="form-control"  placeholder="Enter Material description"  name="material_desc" ></textarea>
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Price</label>
										<input type="number"  class="form-control"  placeholder="Enter price"  name="price" >
									</div>
									<div id="image" >
										<div class="form-group">
											<label for="image">Product Images (3 to 5) <span style="color: red;">*</span></label>
											<br>
											<div class="fileUpload btn btn-primary cust_file clearfix">
												<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
												{{-- <input type="file"   class="upload" name="img7" id="img7" accept="image/*"  onChange="fun7();" > --}}
												<input type="file" name="productImages[]" class="myfrm form-control" accept="image/*" multiple>
											</div>
											
											
										</div>
										
										
									</div>
									<div class="clearfix"></div>
									<br>
									<br>
									<br>
									<br>
									{{-- ----------------------------- driver details ------------------------------------   --}}
									<div id="dd"  style="display:none" >
										<hr>
										<h1 style="font-size:18px;text-align:left">Driver Details</h1>
										<div class="same-add">
											<p>Same as Your Details?</p>
											<div>
												<input type="radio" name="getDetails" onclick="getDetailsFun(this.value);" value="Y" />Yes
												<input type="radio" name="getDetails" onclick="getDetailsFun(this.value);" value="N" />No
											</div>
										</div>
										<div class="form-group">
											<label>Driver Name</label>
											<input id="driver_name" type="text" class="form-control input-lg" name="driver_name" placeholder="Driver Name" value="{{@$vandorService->driver_name}}" >
										</div>
										<div class="form-group">
											<label>Driver Mobile Number</label>
											<input id="driver_mobile_no" type="text" class="form-control input-lg" name="driver_mobile_no" placeholder="driver_mobile_no" value="{{@$vandorService->driver_mobile_no}}" >
										</div>
										<div class="form-group">
											<label>Driver Kyc Type</label>
											<br>
											<select name="driver_kyc_type" id="driver_kyc_type" onchange="kycValidation()">
												<option value="">Select Kyc Type</option>
												<option value="VO" @if(@$vandorService->driver_kyc_type=="VO") selected @endif>Voter Card</option>
												<option value="AD" @if(@$vandorService->driver_kyc_type=="AD") selected @endif>Aadher card</option>
												<option value="PA" @if(@$vandorService->driver_kyc_type=="PA") selected @endif>Passport</option>
												<option value="DL" @if(@$vandorService->driver_kyc_type=="DL") selected @endif >Driving Licensce</option>
												<option value="OT" @if(@$vandorService->driver_kyc_type=="OT") selected @endif>Other Govt.Id</option>
											</select>
										</div>
										<div class="form-group">
											<label>Driver ID No.</label>
											<input id="dricer_kyc_no" type="text" class="form-control input-lg" name="dricer_kyc_no" placeholder="Driver ID No" value="{{@$vandorService->dricer_kyc_no}}" >
										</div>
										<div class="form-group">
											<label>Driving License No</label>
											<input id="driver_licence_no" type="text" class="form-control input-lg" name="driver_licence_no" placeholder="driver licence no" value="{{@$vandorService->driver_licence_no}}" >
										</div>
										<div id="image" >
											<div class="form-group">
												<label for="image">driver Image <span style="color: red;">*</span></label>
												<div class="fileUpload btn btn-primary cust_file clearfix">
													<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i> Upload Image</span>
													<input type="file"   class="upload" name="img6" id="img6" accept="image/*"  onChange="fun6();" >
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
													<input type="file"   class="upload" name="img5" id="img5" accept="image/*"  onChange="fun5();" >
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
												
											</div>
											
										</div>
										<br>
										<br>
										<br>
										<br>
										<br>
										<hr>
										<h1 style="font-size:18px;text-align:left"> Driver address</h1>
										<div class="same-add">
											<p>Same address as Your Address?</p>
											<div>
												<input type="radio" name="driverAddress" onclick="getAddressForDriver(this.value);" value="Y" />Yes
												<input type="radio" name="driverAddress" onclick="getAddressForDriver(this.value);" value="N" />No
											</div>
										</div>
										<div class="form-group">
											<label >Driver Pin code</label>
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
									
									
									
									<div class="clearfix"></div>
									<div class="col-lg-12" style="margin-top: 10px;">
										<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Add</button>
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
@include('vandor.includes.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
$('#frm').validate({
rules:{
service_id:{
required:true,
},
company_name:{
minlength:5,
},
address:{
required:true,
minlength:5,
},
service_desc:{
required:true,
minlength:5,
},
material_desc:{
required:true,
minlength:5,
},
price:{
required:true,
min:5,
},
driver_licence_no:{
	required:true,
},
},
messages:{
//  link:{
//     required:" social link is mandatory",
//     min:"Enter valid links"
// }
},
submitHandler:function(form){
var from = parseInt($('#from').val());
var to = parseInt($('#to').val());
//console.log(from);
//console.log(to);
//return false;
if (from>to) {
alert('Card From No. should be less than Card to No. ');
return false;
} else if(from == to){
alert('Card From No. should be less than to Card to No. ');
return false;
}
else{
form.submit();
}
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
	fd.append('vandor_id',{{@Auth::user()->id}});
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
	fd.append('vandor_id',{{@Auth::user()->id}});
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
@endsection
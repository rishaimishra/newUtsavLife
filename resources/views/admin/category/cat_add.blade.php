@extends('admin.layouts.app')
@section('title')
<title>Utsavlife | admin | Events add</title>
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
					<h4 class="pull-left page-title">Events Add </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Utsavlife</a></li>
						<li class="active"> Events Add </li>
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
									<h3 class="panel-title">Add Events</h3>
									<div class="add-btn "><a href="{{route('admin.category.list')}}"><i class="icofont-minus-circle"></i> Back</a></div>
								</div>
								<form role="form" action="{{route('admin.insert.category')}}" id="frm" method="post" enctype="multipart/form-data">
									@csrf
									
									
									
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Event name</label>
										<input type="text"  class="form-control"  placeholder="Enter Event name"  name="category_name" >
									</div>
									<div class="clearfix"></div>
									<div class="form-group rm50">
										<label for="title">Event Description</label>
										<textarea  class="form-control"  placeholder="Enter Event description"  name="category_description" ></textarea>
									</div>
									{{-- image --}}
									<div class="form-group"style="margin-left: 30px !important;margin-top: 30px !important ">
										<label for="image">Event Image</label>
										<div class="clearfix"></div>
										<div class="fileUpload btn btn-primary cust_file clearfix">
											<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i>Upload</span>
											<br>
											<input type="file" id="icon" name="image"  class="inputfile inputfile-1"  accept="image/*">
											<input type="hidden" name="profile_picture" id="profile_picture">
										</div>
										
									</div>
									<div class="uplodimgfilimg ">
										<em><img src="" alt="" id="img2"></em>
									</div>
									<div class="clearfix"></div>
									
									
									
								</div>
								
								<div class="clearfix"></div>
								<div class="review_img rmm_001" style="display: none;margin-left: 20px;">
									<em><img src="" alt=""id="img2" style="width: 300px;height: 250px;"></em>
								</div>
								<div class="clearfix"></div>
								
								
								<div class="clearfix"></div>
								<div class="col-lg-12" style="margin-top: 10px;">
									<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Add</button>
								</div>
							</form>
						</div>
					</div>
					<div class="modal" tabindex="-1" role="dialog" id="croppie-modal">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Crop Event Image</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-12">
											<div class="croppie-div" style="width: 100%;"></div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" id="crop-img">Save changes</button>
									<button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
								</div>
							</div>
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
image:{
required:true,
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
<script>
function fun(){
var i=document.getElementById('img').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img").show();
$("#img2").attr("src",b);
}
</script>
<script src="{{ URL::asset('public/croppie/croppie.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
{{-- blog front --}}
<script>
function dataURLtoFile(dataurl, filename) {
var arr = dataurl.split(','),
mime = arr[0].match(/:(.*?);/)[1],
bstr = atob(arr[1]),
n = bstr.length,
u8arr = new Uint8Array(n);
while(n--){
u8arr[n] = bstr.charCodeAt(n);
}
return new File([u8arr], filename, {type:mime});
}
var uploadCrop;
$(document).ready(function(){
$(".js-example-basic-multiple").select2();
if($('.type').val()=='C'){
$(".s_h_hids").slideDown(0);
} else{
$(".s_h_hids").slideUp(0);
}
$(".ccllk02").click(function(){
$(".s_h_hids").slideDown();
});
$(".ccllk01").click(function(){
$(".s_h_hids").slideUp();
$('.cmpy').val('');
});
$(".type-radio").change(function(){
var t= $("input[name=type]:checked").val();
if(t=="I"){
$(".comany_name").css('display','none');
}else{
$(".comany_name").css('display','block');
}
});
$('#croppie-modal').on('hidden.bs.modal', function() {
uploadCrop.croppie('destroy');
});
$('#croppie-modal .close, #croppie-modal .close_btn').on('click', function() {
$('#icon').val('');
});
$('#crop-img').click(function() {
uploadCrop.croppie('result', {
type: 'base64',
format: 'png'
}).then(function(base64Str) {
$("#croppie-modal").modal("hide");
//  $('.lds-spinner').show();
let file = dataURLtoFile('data:text/plain;'+base64Str+',aGVsbG8gd29ybGQ=','hello.png');
console.log(file.mozFullPath);
console.log(base64Str);
// $('#file').val(base64Str);
$('#profile_picture').val(base64Str);
// $.each(file, function(i, f) {
var reader = new FileReader();
reader.onload = function(e){
$('.uplodimgfilimg').append('<em><img  src="' + e.target.result + '"><em>');
};
reader.readAsDataURL(file);
//  });
$('.uplodimgfilimg').show();
});
});
});
$("#icon").change(function () {
$('.uplodimgfilimg').html('');
let files = this.files;
console.log(files);
let img  = new Image();
if (files.length > 0) {
let exts = ['image/jpeg', 'image/png', 'image/gif'];
let valid = true;
$.each(files, function(i, f) {
if (exts.indexOf(f.type) <= -1) {
valid = false;
return false;
}
});
if (! valid) {
alert('Please choose valid image files (jpeg, png, gif) only.');
$("#icon").val('');
return false;
}
// img.src = window.URL.createObjectURL(event.target.files[0])
// img.onload = function () {
//     if(this.width > 250 || this.height >160) {
//         flag=0;
//         alert('Please upload proper image size less then : 250px x 160px');
//         $("#file").val('');
//         $('.uploadImg').hide();
//         return false;
//     }
// };
$("#croppie-modal").modal("show");
uploadCrop = $('.croppie-div').croppie({
viewport: { width: 530, height: 320, type: 'square' },
boundary: { width: $(".croppie-div").width(), height: 400 }
});
var reader = new FileReader();
reader.onload = function (e) {
$('.upload-demo').addClass('ready');
// console.log(e.target.result)
uploadCrop.croppie('bind', {
url: e.target.result
}).then(function(){
console.log('jQuery bind complete');
});
}
reader.readAsDataURL(this.files[0]);
//  $('.uploadImg').append('<img width="100"  src="' + reader.readAsDataURL(this.files[0]) + '">');
//  $.each(files, function(i, f) {
//      var reader = new FileReader();
//      reader.onload = function(e){
//          $('.uploadImg').append('<img width="100"  src="' + e.target.result + '">');
//      };
//      reader.readAsDataURL(f);
//  });
//  $('.uploadImg').show();
}
});
</script>
@endsection
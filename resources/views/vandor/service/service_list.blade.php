@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Services</title>
@endsection
@section('left_part')
@include('vandor.includes.left_part')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style type="text/css">
	.modal-backdrop {
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
z-index: 1030;
background-color: #333333;
opacity:0.4;
}
table.dataTable tbody tr {
background-color: #eee7ef;
}
.modal-dialog {
    width: 80% !important;
}
</style>
@endsection
@section('content')
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">
			<!-- Page-Title -->
			<div class="row">
				<div class="col-sm-12">
					<h4 class="pull-left page-title">Service List </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('vandor.dashboard')}}">Utsavlife</a></li>
						<li class="active">Services</li>
					</ol>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<!-- Start Widget -->
			<div class="row">
				<div class="col-md-12">
					
					<div class="clearfix"></div>
					<div class="panel panel-default">
						<div class="panel-heading rm02 rm04">
							<div class="add-btn "><a href="{{route('vandor.service.add')}}"><i class="icofont-plus-circle"></i> Add Services</a></div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
										<table id="example" class="cell-border">
											<thead>
												<tr>
													<th scope="col">id</th>
													{{-- <th scope="col">Category Name</th> --}}
													<th scope="col">Service Name</th>
													<th scope="col">Service price</th>
													<th scope="col">status</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($list as $key=> $value)
												<tr>
													
													<td data-label="Name">{{@$value->id}}</td>
													{{-- <td data-label="Name">{{@$value->categoryDetails->category_name}}</td> --}}
													<td data-label="Name">{{@$value->serviceDetails->service}}</td>
													<td data-label="Name">{{@$value->price}}</td>
													<td data-label="Mail ID">@if(@$value->status=="A")
														<p>Active</p>
														@else
														<p>Deactive</p>
													@endif</td>
													<td class="rm07">
														<a href="javascript:void(0);" class="action-dots"  id="action{{$value->id}}"><img src="{{url('/')}}/public/vandorAgentJsCss/assets/images/action-dots.png" alt="" onclick="fun({{$value->id}})"></a>
														<div class="show-actions" id="show-action{{$value->id}}" style="display: none;"> <span class="angle"><img src="{{url('/')}}/public/vandorAgentJsCss/assets/images/angle.png" alt=""></span>
														<ul>
															@if(@$value->status=="A")
															<li><a href="{{route('vandor.service.deactive',$value->id)}}">Deactive</a></li>
															@else
															<li><a href="{{route('vandor.service.active',$value->id)}}">Active</a></li>
															@endif
															<li><a href="{{route('vandor.service.edit',$value->id)}}">Edit</a></li>
															
															<li><a onclick="return confirm('Are you sure want to delete this service ?')" href="{{route('vandor.service.delete',$value->id)}}">Delete</a></li>
															<li><a  href="#" data-toggle="modal" data-target="#myModalview{{$value->id}}">View</a></li>
															
															
															<li><a href="#" onclick="Cancel({{$value->id}})">Cancel</a></li>
														</ul>
													</div>
												</td>
												
											</tr>
											
											
											{{-- for view --}}
											<div class="modal" id="myModalview{{@$value->id}}">
												<div class="modal-dialog">
													<div class="modal-content">
														<!-- Modal Header -->
														<div class="modal-header">
															<h4 class="modal-title">Details of service : {{@$value->serviceDetails->service}}</h4>
															
														</div>
														<!-- Modal body -->
														<div class="modal-body">
															{{-- <h5>Category Name </h5>
															<p>{{@$value->categoryDetails->category_name}}</p> --}}
															<h5>Service Name </h5>
															<p>{{@$value->serviceDetails->service}}</p>
															<h5> Status </h5>
															<p>@if(@$value->status=="A")
																<p>Active</p>
																@else
																<p>Deactive</p>
															@endif</p>
															<h5> Address </h5>
															<p>{{@$value->address}}</p>
															<h5> Service Description </h5>
															<p>{{@$value->service_desc}}</p>
															<h5> Matiral Description</h5>
															<p>{{@$value->material_desc}}</p>
															<h5> Price </h5>
															<p>{{@$value->price}}</p>
															<h5>Created Date </h5>
															<p>{{@$value->created_at->format('Y-m-d')}}</p>
															<p>Product Image</p>
															<p>
																@if(@$value->image)
																	<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$value->image}}"  class="new-upload-img" style="width: 200px; margin-right:5px">
																	@else
																	No Image
																	@endif

																	@if(@$value->image2)
																	<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$value->image2}}"  class="new-upload-img" style="width: 200px; margin-right:5px">
																	@endif

																	@if(@$value->image3)
																	<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$value->image3}}"  class="new-upload-img" style="width: 200px; margin-right:5px">
																	@endif

																	@if(@$value->image4)
																	<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$value->image4}}"  class="new-upload-img" style="width: 200px; margin-right:5px">
																	@endif

																	@if(@$value->image5)
																	<img src="{{url('/')}}/storage/app/public/vandor/product_image/{{@$value->image5}}"  class="new-upload-img" style="width: 200px; margin-right:5px">
																	
																	@endif








																{{-- vandor driver details --}}
																@if(@$value->driver_name)
																<div>
																	
																	<div>
																		
																		<div class="row">
																			<div class="col-md-6">
																				<!-- Personal-Information -->
																				<div class="panel panel-default panel-fill">
																					<div class="panel-heading">
																						<h3 class="panel-title">vandor Driver Information</h3>
																					</div>
																					<div class="panel-body">
																						<div class="about-info-p">
																							<strong>Pan Card</strong>
																							<br>
																							<p class="text-muted">{{@$value->pan_card}}</p>
																						</div>
																						
																						
																						<div class="about-info-p">
																							<strong>Driver Name</strong>
																							<br>
																							<p class="text-muted">
																								{{@$value->driver_name}}
																							</p>
																						</div>
																						<div class="about-info-p">
																							<strong>Driver Mobile No</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_mobile_no}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong>Driver Kyc Type</strong>
																							<br>
																							<p class="text-muted">
																								@if(@$value->driver_kyc_type=="VO")
																								<p>Voter Card</p>
																								@elseif(@$vandor->status=="AD")
																								<p>Addhar Card</p>
																								@elseif(@$vandor->status=="PA")
																								<p>Passport</p>
																								@elseif(@$vandor->status=="DL")
																								<p>Driving lisence</p>
																								@else
																								Other Govt. Id
																								@endif
																							</p>
																						</div>
																						
																						<div class="about-info-p">
																							<strong>Driver Kyc No</strong>
																							<br>
																							<p class="text-muted">{{@$value->dricer_kyc_no}}</p>
																						</div>
																						
																						<div class="about-info-p">
																							<strong>Driver licence No</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_licence_no}}</p>
																						</div>
																						
																						<div class="about-info-p">
																							<label for="meta description">Driver Image</label>
																							<br>
																							@if(@$value->driver_image)
																							<img src="{{url('/')}}/storage/app/public/vandor/driver_image/{{@$value->driver_image}}"  class="new-upload-img" style="width: 200px">
																							@else
																							No Image
																							@endif
																						</div>


																						<div class="about-info-p">
																							<label for="meta description">Driver License Image</label>
																							<br>
																							@if(@$value->dl_image)
																							<img src="{{url('/')}}/storage/app/public/vandor/dl_image/{{@$value->dl_image}}"  class="new-upload-img"  style="width: 200px" >
																							@else
																							No Image
																							@endif
																						</div>
																						
																						
																						
																					</div>
																				</div>
																				<!-- Personal-Information -->
																				<!-- Languages -->
																				
																				<!-- Languages -->
																			</div>
																			<div class="col-md-6">
																				<!-- Personal-Information -->
																				<div class="panel panel-default panel-fill">
																					<div class="panel-heading">
																						<h3 class="panel-title">Vandor Driver Address Information</h3>
																					</div>
																					<div class="panel-body">
																						<div class="about-info-p">
																							<strong> Pin Code</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_pincode}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong> House No/Flat No/ Building No</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_house_no}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong> Area</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_area}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong> Lankmark</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_landmark}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong> City</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_city}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong> State</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_state}}</p>
																						</div>
																						
																					</div>
																				</div>
																				
																			</div>
																			
																		</div>
																		
																	</div>
																</div>
																@endif
															</p>
															
														</div>
														<!-- Modal footer -->
														<div class="modal-footer">
															
															
															<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
											@endforeach
											
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
oTable = $('#example').DataTable({
"bSort": true
});
$('#myInputTextField').keyup(function(){
oTable.search($(this).val()).draw() ;
})
</script>
<script>
var resizefunc = [];
</script>
<script>
function fun(id){
$('.show-actions').slideUp();
$("#show-action"+id).show();
}
function Cancel(id){
$("#show-action"+id).hide();
}
$(document).mouseup(function(e)
{
var container = $(".show-actions");
// if the target of the click isn't the container nor a descendant of the container
if (!container.is(e.target) && container.has(e.target).length === 0)
{
container.hide();
}
});
</script>
@endsection
@extends('admin.layouts.app')
@section('title')
<title>Utsavlife | admin | Vendors View</title>
@endsection
@section('left_part')
@include('admin.includes.left_part')
{{-- for datepicker --}}
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
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
</style>
@endsection
@section('content')
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		
		
		<div class="wraper container-fluid">
			
			<div class="row">
				<div class="col-sm-12">
					<h4 class="pull-left page-title">Vendor View Page</h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Utsavlife</a></li>
						
						<li class="active">Vendor View Page</li>
					</ol>
				</div>
			</div>
			<div class="add-btn ">{{-- <a href="{{route('admin.vandor.list')}}"> --}}<a href="{{ url()->previous()}}"><i class="icofont-minus-circle"></i> Back</a></div>
			@include('admin.includes.message')
			<div class="row">
				<h1>Details of {{@$vandor->name}}</h1>
				<div class="col-lg-12">
					
					<div>
						@if(@$vandor->status=="A")
						<li><a href="{{route('admin.vandor.deactive',$vandor->id)}}">Deactive</a></li>
						@elseif(@$vandor->status=="U")
						<li><a href="{{route('admin.vandor.active',$vandor->id)}}">Active</a></li>
						@else
						<li><a href="{{route('admin.vandor.active',$vandor->id)}}">Active</a></li>
						@endif
					
						
						<li><a onclick="return confirm('Are you sure want to delete this vandor ?')" href="{{route('admin.vandor.delete',$vandor->id)}}">Delete</a></li>

						<li><a href="{{route('admin.vandor.view',$vandor->id)}}">View</a></li>

						<li><a href="{{route('admin.vandor.orders',$vandor->id)}}">Orders</a></li>
						
						<div class="row">
							<div class="col-md-6">
								<!-- Personal-Information -->
								<div class="panel panel-default panel-fill">
									<div class="panel-heading">
										<h3 class="panel-title">vandor Information</h3>
									</div>
									<div class="panel-body">
										<div class="about-info-p">
											<strong>Vandor Name</strong>
											<br>
											<p class="text-muted">{{@$vandor->name}}</p>
										</div>
										
										
										<div class="about-info-p">
											<strong>Email</strong>
											<br>
											<p class="text-muted">{{@$vandor->email}}</p>
										</div>
										<div class="about-info-p">
											<strong>Mobile</strong>
											<br>
											<p class="text-muted">{{@$vandor->mobile}}</p>
										</div>
										<div class="about-info-p">
											<strong>Status</strong>
											@if(@$vandor->status=="A")
												<p>Active</p>
												@elseif(@$vandor->status=="U")
												<p>Unverified</p>
												@else
												Inactive
											@endif
										</div>
										
										<div class="about-info-p">
											<strong>Create Time</strong>
											<br>
											<p class="text-muted">{{@$vandor->created_at->format('d/m/Y') }}</p>
										</div>
										<div class="about-info-p">
											<strong>Last Update Time</strong>
											<br>
											<p class="text-muted">{{@$vandor->updated_at->format('d/m/Y') }}</p>
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
										<h3 class="panel-title">Vandor Information</h3>
									</div>
									<div class="panel-body">
										<div class="about-info-p">
											<strong>Pan Card</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->pan_card}}</p>
										</div>
										
										
										<div class="about-info-p">
											<strong>Kyc Type</strong>

											@if(@$vandor->vandorDetails->kyc_type=="VO")
												<p>Voter Card</p>
												@elseif(@$vandor->status=="AD")
												<p>Addhar Card</p>
												@elseif(@$vandor->status=="PA")
												<p>Passport</p>
												@elseif(@$vandor->status=="DL")
												<p>Driving Lisence</p>
												@else
												Other Govt.Id
											    @endif
										
										</div>
										<div class="about-info-p">
											<strong>Kyc No</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->kyc_no}}</p>
										</div>
										<div class="about-info-p">
											<strong>Calling No</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->calling_no}}</p>
										</div>
										
										<div class="about-info-p">
											<strong>Gst No</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->gst_no}}</p>
										</div>
										

										<a href="{{route('admin.vandor.details.edit',$vandor->id)}}" class="btn btn-primary">Edit Vandor Details</a>
										
										
									</div>
								</div>
								<!-- Personal-Information -->
								<!-- Languages -->
								
								<!-- Languages -->
							</div>
							
						</div>
						
					</div>
				</div>










{{-- vandor and address information --}}
				<div class="col-lg-12">
					
					<div>
						
						<div class="row">
							
							<div class="col-md-6">
								<!-- Personal-Information -->
								<div class="panel panel-default panel-fill">
									<div class="panel-heading">
										<h3 class="panel-title">Vendor Address</h3>
									</div>
									<div class="panel-body">
										<div class="about-info-p">
											<strong>Pin Code</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->pin_code}}</p>
										</div>

										<div class="about-info-p">
											<strong>House No/Flat No/ Building No</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->house_no}}</p>
										</div>

										<div class="about-info-p">
											<strong>Area</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->area}}</p>
										</div>

										<div class="about-info-p">
											<strong>Lankmark</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->landmark}}</p>
										</div>

										<div class="about-info-p">
											<strong>City</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->city}}</p>
										</div>

										<div class="about-info-p">
											<strong>State</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->state}}</p>
										</div>
										<a href="{{route('admin.vandor.address.edit',$vandor->id)}}" class="btn btn-primary">Edit Address</a>
									</div>
								</div>
								
							</div>




							<div class="col-md-6">
								<!-- Personal-Information -->
								<div class="panel panel-default panel-fill">
									<div class="panel-heading">
										<h3 class="panel-title"> Office Address</h3>
									</div>
									<div class="panel-body">
										<div class="about-info-p">
											<strong> Pin Code</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->office_pincode}}</p>
										</div>

										<div class="about-info-p">
											<strong> House No/Flat No/ Building No</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->office_house_no}}</p>
										</div>

										<div class="about-info-p">
											<strong> Area</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->office_area}}</p>
										</div>

										<div class="about-info-p">
											<strong> Lankmark</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->office_landmark}}</p>
										</div>

										<div class="about-info-p">
											<strong> City</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->office_city}}</p>
										</div>

										<div class="about-info-p">
											<strong> State</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->office_state}}</p>
										</div>

										<div class="about-info-p">
											<strong> Mobile No.</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->office_mobile}}</p>
										</div>

										<a href="{{route('admin.vandor.office.edit',$vandor->id)}}" class="btn btn-primary">Edit Office Address</a>
										
									</div>
								</div>
								
							</div>
							
						</div>
						
					</div>
				</div>


















{{-- all images --}}
<div class="col-lg-12">
					
					<div>
						
						<div class="row">
							<div class="col-md-6">
								<!-- Personal-Information -->
								<div class="panel panel-default panel-fill">
									<div class="panel-heading">
										<h3 class="panel-title">Vendor Image Information</h3>
									</div>
									<div class="panel-body">


										<div class="about-info-p">
											<strong>Pan Card Image </strong>
											<br>
											<div class="pull-left"> @if(@$vandor->vandorDetails->pan_image)
											<img src="{{url('/')}}/storage/app/public/vandor/pan_image/{{$vandor->vandorDetails->pan_image}}" alt="" class="thumb-md">
											<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">View</button>
											<div id="myModal1" class="modal fade" role="dialog">
											  <div class="modal-dialog">

											    <!-- Modal content-->
											    <div class="modal-content">
											      <div class="modal-header">
											        <button type="button" class="close" data-dismiss="modal">&times;</button>
											        <h4 class="modal-title">Pan Card Image</h4>
											      </div>
											      <div class="modal-body">
											        <img src="{{url('/')}}/storage/app/public/vandor/pan_image/{{$vandor->vandorDetails->pan_image}}" alt=""  style="width:100%;height:100%">
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      </div>
											    </div>

											  </div>
											</div>
											@else No Image @endif 
										</div>
										</div>
										<br>
										<br>
										<br>


										




										<div class="about-info-p">
											<strong>Kyc Image </strong>
											<br>
											<div class="pull-left"> @if(@$vandor->vandorDetails->kyc_image)
											<img src="{{url('/')}}/storage/app/public/vandor/kyc_image/{{$vandor->vandorDetails->kyc_image}}" alt="" class="thumb-md">
											<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">View</button>
											<div id="myModal2" class="modal fade" role="dialog">
											  <div class="modal-dialog">

											    <!-- Modal content-->
											    <div class="modal-content">
											      <div class="modal-header">
											        <button type="button" class="close" data-dismiss="modal">&times;</button>
											        <h4 class="modal-title">Kyc Image</h4>
											      </div>
											      <div class="modal-body">
											       	<img src="{{url('/')}}/storage/app/public/vandor/kyc_image/{{$vandor->vandorDetails->kyc_image}}" alt="" style="width:100%;height:100%">
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      </div>
											    </div>

											  </div>
											</div>
											@else No Image @endif 
										</div>
										</div>
										<br>
										<br>
										<br>


										<div class="about-info-p">
											<strong>Vendor Image </strong>
											<br>
											<div class="pull-left"> @if(@$vandor->vandorDetails->vendor_image)
											<img src="{{url('/')}}/storage/app/public/vandor/vendor_image/{{$vandor->vandorDetails->vendor_image}}" alt="" class="thumb-md ">
											<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal3">View</button>
											<div id="myModal3" class="modal fade" role="dialog">
											  <div class="modal-dialog">

											    <!-- Modal content-->
											    <div class="modal-content">
											      <div class="modal-header">
											        <button type="button" class="close" data-dismiss="modal">&times;</button>
											        <h4 class="modal-title">Vandor Image</h4>
											      </div>
											      <div class="modal-body">
											        <img src="{{url('/')}}/storage/app/public/vandor/vendor_image/{{$vandor->vandorDetails->vendor_image}}" alt=""style="width:100%;height:100%">
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      </div>
											    </div>

											  </div>
											</div>

											@else No Image @endif 
										</div>
										</div>
										<br>

										
										<br>


										
										
										
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
										{{-- <h3 class="panel-title">Vandor Driver Address Information</h3> --}}
									</div>
									<div class="panel-body">

										<div class="about-info-p">
											<strong>Gst </strong>
											<br>
											<div class="pull-left"> @if(@$vandor->vandorDetails->gst_image)
											{{-- <img src="{{url('/')}}/storage/app/public/vandor/gst_image/{{$vandor->vandorDetails->gst_image}}" alt="" class="thumb-md img-circle"> --}}
											<iframe src="{{url('/')}}/storage/app/public/vandor/gst_image/{{$vandor->vandorDetails->gst_image}}" height="300" width="300"></iframe>

											<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal4">View</button>
											<div id="myModal4" class="modal fade" role="dialog">
											  <div class="modal-dialog">

											    <!-- Modal content-->
											    <div class="modal-content">
											      <div class="modal-header">
											        <button type="button" class="close" data-dismiss="modal">&times;</button>
											        <h4 class="modal-title">Gst</h4>
											      </div>
											      <div class="modal-body">
											       <iframe src="{{url('/')}}/storage/app/public/vandor/gst_image/{{$vandor->vandorDetails->gst_image}}" height="600" width="600"></iframe>
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      </div>
											    </div>

											  </div>
											</div>
											@else No pdf file uploaded yet @endif 
										</div>
										</div>
										<br>

									

<br>


									
										<br>

									</div>
								</div>
								
							</div>
							
						</div>
						
					</div>
				</div>












{{-- Bank details --}}

<div class="col-lg-12">
					
					<div>
						
						<div class="row">
							<div class="col-md-8">
								<!-- Personal-Information -->
								<div class="panel panel-default panel-fill">
									<div class="panel-heading">
										<h3 class="panel-title">Vendor Bank Information</h3>
									</div>
									@php
									$bankDetails=DB::table('vandor_bank_details')->where('vandor_id',$vandor->id)->first();

									@endphp
									<div class="panel-body">
										<div class="about-info-p">
											<strong>Bank Name</strong>
											<br>
											<p class="text-muted">{{@$bankDetails->bank_name}}</p>
										</div>

										<div class="about-info-p">
											<strong>Account No</strong>
											<br>
											<p class="text-muted">{{@$bankDetails->acc_no}}</p>
										</div>

										<div class="about-info-p">
											<strong>Ifsc Code</strong>
											<br>
											<p class="text-muted">{{@$bankDetails->ifsc_no}}</p>
										</div>

										<div class="about-info-p">
											<strong>Holder Name</strong>
											<br>
											<p class="text-muted">{{@$bankDetails->holder_name}}</p>
										</div>

										<div class="about-info-p">
											<strong>Branch Name</strong>
											<br>
											<p class="text-muted">{{@$bankDetails->branch_name}}</p>
										</div>

										<div class="about-info-p">
											<strong>Account Type</strong>
											<br>
											<p class="text-muted">{{@$bankDetails->acc_type}}</p>
										</div>


											<div class="about-info-p">
											<strong>Cancelled Checkbook/Passbook 1st page on bank details Image </strong>
											<br>
											<div class="pull-left"> @if(@$bankDetails->checkbookOrPassbookImage)
										<img src="{{url('/')}}/storage/app/public/vandor/checkbookOrPassbookImage/{{@$bankDetails->checkbookOrPassbookImage}}"   class="thumb-md ">
											<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalVIEWPassBook">View</button>


											<div id="myModalVIEWPassBook" class="modal fade" role="dialog">
											  <div class="modal-dialog">

											    <!-- Modal content-->
											    <div class="modal-content">
											      <div class="modal-header">
											        <button type="button" class="close" data-dismiss="modal">&times;</button>
											        <h4 class="modal-title">Cancelled Checkbook/Passbook 1st page on bank details Image </h4>
											      </div>
											      <div class="modal-body">
											        <img src="{{url('/')}}/storage/app/public/vandor/checkbookOrPassbookImage/{{@$bankDetails->checkbookOrPassbookImage}}" alt=""style="width:100%;height:100%">
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      </div>
											    </div>

											  </div>
											</div>

											@else No Image @endif 
										</div>
										</div>
										<br>
										<br>


										<a href="{{route('admin.vandor.bank.edit',$vandor->id)}}" 
										 class="btn btn-primary">
											Bank Edit
										</a>


										
									</div>
								</div>
							
								
							</div>
						
							
						</div>
						
					</div>
				</div>

			   @if(@$vandor->status!="A")
				<a href="{{route('admin.vandor.active',$vandor->id)}}" class="btn btn-primary">Verifiy Vendor</a>
				@endif


















					<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
										<table id="example" class="cell-border">
											<thead>
												<tr>
													<th scope="col">id</th>
													<th scope="col">Category Name</th>
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
													<td data-label="Name">{{@$value->categoryDetails->category_name}}</td>
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
															
															<li><a  href="#" data-toggle="modal" data-target="#myModalview{{$value->id}}">View</a></li>
															
															
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
															<h5>Category Name </h5>
															<p>{{@$value->categoryDetails->category_name}}</p>

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
															<h5> application status </h5>
															<p>{{@$value->material_desc}}</p>
															<h5> Price </h5>
															<p>{{@$value->price}}</p>

															<h5>Product image </h5>
															<p>
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

																	
															</p>

																{{-- vandor driver details --}}
																@if(@$value->driver_name)
																<div>
																	
																	<div>
																		
																		<div class="row">
																			<div class="col-md-6">
																				<!-- Personal-Information -->
																				<div class="panel panel-default panel-fill">
																					<div class="panel-heading">
																						<h3 class="panel-title">vandor driver Information</h3>
																					</div>
																					<div class="panel-body">
																						<div class="about-info-p">
																							<strong>pan card</strong>
																							<br>
																							<p class="text-muted">{{@$value->pan_card}}</p>
																						</div>
																						
																						
																						<div class="about-info-p">
																							<strong>Driver name</strong>
																							<br>
																							<p class="text-muted">
																								{{@$value->driver_name}}
																							</p>
																						</div>
																						<div class="about-info-p">
																							<strong>Driver mobile no</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_mobile_no}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong>Driver kyc type</strong>
																							<br>
																							<p class="text-muted">
																								@if(@$value->driver_kyc_type=="VO")
																								<p>Voter card</p>
																								@elseif(@$vandor->status=="AD")
																								<p>Addhar card</p>
																								@elseif(@$vandor->status=="PA")
																								<p>Passport</p>
																								@elseif(@$vandor->status=="DL")
																								<p>Driving lisence</p>
																								@else
																								Other Govt Id
																								@endif
																							</p>
																						</div>
																						
																						<div class="about-info-p">
																							<strong>Driver kyc no</strong>
																							<br>
																							<p class="text-muted">{{@$value->dricer_kyc_no}}</p>
																						</div>
																						
																						<div class="about-info-p">
																							<strong>Driver licence no</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_licence_no}}</p>
																						</div>
																						
																						<div class="about-info-p">
																							<label for="meta description">Driver Image</label>
																							<br>
																							@if(@$value->driver_image)
																							<img src="{{url('/')}}/storage/app/public/vandor/driver_image/{{@$value->driver_image}}"  class="new-upload-img" style="width: 100px">
																							@else
																							No Image
																							@endif
																						</div>

																							<div class="about-info-p">
																							<label for="meta description">Driver License Image</label>
																							<br>
																							@if(@$value->dl_image)
																							<img src="{{url('/')}}/storage/app/public/vandor/dl_image/{{@$value->dl_image}}"  class="new-upload-img"  style="width: 100px" >
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
																							<strong>Driver Pin code</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_pincode}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong>Driver House No/Flat No/ Building No</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_house_no}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong>Driver area</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_area}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong>Driver lankmark</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_landmark}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong>Driver city</strong>
																							<br>
																							<p class="text-muted">{{@$value->driver_city}}</p>
																						</div>
																						<div class="about-info-p">
																							<strong>Driver state</strong>
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


															<h5>Created Date </h5>
															<p>{{@$value->created_at}}</p>
															
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
		</div> <!-- container -->
		
		</div> <!-- content -->
		
	</div>
	<!-- ============================================================== -->
	<!-- End Right content here -->
	<!-- ============================================================== -->
	<!-- End Right content here -->
	@section('footer')
	{{-- @include('admin.include.footer') --}}
	@endsection
	@endsection
	{{-- end content --}}
	@section('script')
	@include('admin.includes.script')
	{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
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
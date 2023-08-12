@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Upcomming Orders</title>
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
.inactive-cls a {
background: #e140fd;
margin-left: 5px;
}
table.dataTable tbody tr {
background-color: #eee7ef;
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
					<h4 class="pull-left page-title">Upcomming Orders </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('vandor.dashboard')}}">Utsavlife</a></li>
						<li class="active">Upcomming Orders</li>
					</ol>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<!-- Start Widget -->
			<div class="row">
				 @include('vandor.includes.message')
				
				<div class="clearfix"></div>
				<div class="panel panel-default">
					<div class="panel-heading rm02 rm04">
						<div class="col-md-12" style="display: flex; align-items: center; justify-content: right;">
							{{-- <div class="{{request()->segment(3)=='all'?'waves-effect add-btn active':'add-btn inactive-cls'}}"><a href="{{route('vandor.all.orders')}}">  All Orders</a></div> --}}
							<div class="{{request()->segment(3)=='upcomming'?'add-btnwaves-effect add-btn active':'add-btn inactive-cls'}}"><a href="{{route('vandor.upcomming.orders')}}">  Upcomming Orders</a></div>
							<div class="{{request()->segment(3)=='delivered'?'waves-effect add-btn active':'add-btn inactive-cls'}}"><a href="{{route('vandor.delivered.orders')}}">  Delivered Orders</a></div>
							<div class="{{request()->segment(3)=='cancel'?'waves-effect add-btn active':'add-btn inactive-cls'}}"><a href="{{route('vandor.cancel.orders')}}">  Cancel Orders</a></div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="table-responsive">
									<table id="example" class="cell-border">
										<thead>
											<tr>
												<th scope="col">id</th>
												<th scope="col">Vendor Status</th>
												<th scope="col">Customer</th>
												<th scope="col">Email</th>
												<th scope="col">Mobile</th>
												<th scope="col">Category</th>
												<th scope="col">Service</th>
												<th scope="col">Event date range</th>
												<th scope="col">Order status</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($data as $key=> $value)
											<tr>
												
												<td data-label="Name">{{@$value->id}}</td>
												<td data-label="Mail ID">@if(@$value->vandor_order_status=="AP")
													<p>APPROVED</p>
													@elseif(@$value->vandor_order_status=="RJ")
													<p>REJECTED</p>
													@else
													PENDING
												@endif</td>
												<td data-label="Name">{{@$value->CustomerDetails->name}}</td>
												<td data-label="Name">{{@$value->customer_email}}</td>
												<td data-label="Name">{{@$value->customer_phone	}}</td>
												<td data-label="Name">{{@$value->categoryDetails->category_name}}</td>
												<td data-label="Name">{{@$value->serviceDetails->service}}</td>
												<td data-label="Name"> ( {{@$value->event_date}} - {{@$value->event_end_date}} ) </td>
												<td data-label="Mail ID">@if(@$value->order_status==1)
													@if(date('Y-m-d') < $value->event_date)
													<p>Upcomming</p>
													@else
													<p>On Going</p>
													@endif
													@elseif(@$value->order_status==2)
													<p>cancel</p>
													@else
													Delivered
												@endif</td>
												<td class="rm07">
													<a href="javascript:void(0);" class="action-dots"  id="action{{$value->id}}"><img src="{{url('/')}}/public/vandorAgentJsCss/assets/images/action-dots.png" alt="" onclick="fun({{$value->id}})"></a>
													<div class="show-actions" id="show-action{{$value->id}}" style="display: none;"> <span class="angle"><img src="{{url('/')}}/public/vandorAgentJsCss/assets/images/angle.png" alt=""></span>
													<ul>
														
														<li><a  href="#" data-toggle="modal" data-target="#myModalview{{$value->id}}">View</a></li>

														@if($value->order_status==1 && $value->vandor_order_status=="PN")

														<li><a  href="{{route('vandor.order.approve',$value->id)}}" onclick="return confirm('Are you sure want to approve this order ?')" >Approve</a></li>

														{{-- <li><a  href="{{route('vandor.order.reject',$value->id)}}" onclick="return confirm('Are you sure want to reject this order ?')"  >Reject</a></li> --}}
														<li><a  href="#" data-toggle="modal" data-target="#myModalviewreject{{$value->id}}">Reject</a></li>
														@else
														<li><a  href="{{route('vandor.order.delivered.status',$value->id)}}">Delivered</a></li>

														@endif
														
														
														<li><a href="#" onclick="Cancel({{$value->id}})">Cancel</a></li>
													</ul>
												</div>
											</td>
											
										</tr>



											
											{{-- for Reject --}}
											<div class="modal" id="myModalviewreject{{@$value->id}}">
												<div class="modal-dialog">
													<div class="modal-content">
														<!-- Modal Header -->
														<div class="modal-header">
															<h4 class="modal-title">Reason or cancel order : {{@$value->id}}</h4>
															
														</div>
														<!-- Modal body -->
														<div class="modal-body">
															<form action="{{route('vandor.order.reject',$value->id)}}" method="post">
																@csrf
																<input type="hidden" name="id" value="{{$value->id}}">

																@php
																$allReason=DB::table('reasons')->where('status','A')->get();
																@endphp
																<label>Select Reason</label>
																<select class="form-control" name="reason1" onchange="rsn(this.value)" required>
																	<option value="">select reason</option>
																	@foreach($allReason as $rsn)
																	<option value="{{$rsn->reason}}">{{$rsn->reason}}</option>

																	@endforeach
																	<option value="oth">Other</option>
																</select>
																<br>
																<div id="rsnbox{{$value->id}}" style="display:none;">
																<textarea class="form-control" id="rsnfield{{$value->id}}" name="reason2" placeholder="enter cancel reason"></textarea>
															</div>
																<input type="submit" class="btn btn-primary" name="submit">
															</form>
															<script>
																function rsn(val){
																	// alert(val)
																	console.log(val)
																	if(val==="oth"){
																		$("#rsnbox{{$value->id}}").show();
																	}else{
																		$("#rsnbox{{$value->id}}").hide();
																		$("#rsnfield{{$value->id}}").val('');
																	}
																}
																
															</script>
														
															
														</div>
														<!-- Modal footer -->
														<div class="modal-footer">
															
															
															<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										
										
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
														<br>
														
														
														<h5>Service Name </h5>
														<p>{{@$value->serviceDetails->service}}</p>
														<br>


														<h5> Status </h5>
														<p>@if(@$value->status=="A")
															<p>Active</p>
															@else
															<p>Deactive</p>
														@endif</p>
														<br>


														<h5> Address </h5>
														<p>{{@$value->address}}</p>
														<br>


														<h5> Service Description </h5>
														<p>{{@$value->serviceDetails->service_desc}}</p>
														<br>


														<h5> Order Start Date </h5>
														<p>{{@$value->event_date}}</p>
														<br>

														<h5> Order End Date </h5>
														<p>{{@$value->event_end_date}}</p>
														<br>

														<h5> Time </h5>
														<p>@if(@$value->time=="M")Morning 
															@elseif(@$value->time=="N") Night @else Full Day  @endif</p>
														<br>

														<h5> Days </h5>
														<p>{{@$value->days}}</p>
														<br>

														<h5> Amount</h5>
														<p>{{@$value->total_price}}</p>
														<br>

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
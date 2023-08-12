@extends('admin.layouts.app')
@section('title')
<title>Go party | Vandor | Delivered Orders</title>
@endsection
@section('left_part')
@include('admin.includes.left_part')
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
					<h4 class="pull-left page-title">Delivered Orders </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Go party</a></li>
						<li class="active">Delivered Orders</li>
					</ol>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<!-- Start Widget -->
			<div class="row">
				
				<div class="clearfix"></div>
				<div class="panel panel-default">
					<div class="panel-heading rm02 rm04">
						<div class="col-md-12" style="display: flex; align-items: center; justify-content: right;">
							<div class="{{request()->segment(3)=='all'?'waves-effect add-btn active':'add-btn inactive-cls'}}"><a href="{{route('admin.all.orders')}}">  All Orders</a></div>
							<div class="{{request()->segment(3)=='upcomming'?'add-btnwaves-effect add-btn active':'add-btn inactive-cls'}}"><a href="{{route('admin.upcomming.orders')}}">  Upcomming Orders</a></div>
							<div class="{{request()->segment(3)=='delivered'?'waves-effect add-btn active':'add-btn inactive-cls'}}"><a href="{{route('admin.delivered.orders')}}">  Delivered Orders</a></div>
							<div class="{{request()->segment(3)=='cancel'?'waves-effect add-btn active':'add-btn inactive-cls'}}"><a href="{{route('admin.cancel.orders')}}">  Cancel Orders</a></div>
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
												<th scope="col">Vandor</th>
												<th scope="col">Vandor Status</th>
												<th scope="col">Customer</th>
												<th scope="col">Email</th>
												<th scope="col">Mobile</th>
												<th scope="col">Category</th>
												<th scope="col">Service</th>
												<th scope="col">Event date</th>
												<th scope="col">Order status</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($data as $key=> $value)
											<tr>
												
												<td data-label="Name">{{@$value->id}}</td>
												<td data-label="Name">
													@if(@$value->VandorDetails->name=="")
													<strong>Not Assign</strong>
													@else
													{{@$value->VandorDetails->name}}
													@endif
												</td>
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
												<td data-label="Name">{{@$value->event_date}}</td>
												<td data-label="Mail ID">@if(@$value->order_status==1)
													<p>Upcomming</p>
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
														<p>{{@$value->total_price}}</p>
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
{{-- @include('admin.includes.footer') --}}
@endsection
@endsection
{{-- end content --}}
@section('script')
@include('admin.includes.script')
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
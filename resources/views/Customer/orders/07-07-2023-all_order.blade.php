@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Customer | All Orders</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}
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
.inactive-cls a{
	background: black;
}
</style>
{{-- @endsection --}}










<div class="section_padding" style="background: #f6f6f6;">
	<div class="container">
		<div class="bred_cum">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="#">Order Tracking</a></li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="order_track_area">
					<div class="inner_title">
						<h4>All Orders</h4>
						<span>Utsavlife <spn class="text_blue">All Orders</spn></span>
					</div>
					<div class="track_filter">
						<ul>
							<li><a href="{{route('cust.all.orders')}}" >All Orders</a></li>
							<li><a href="{{route('cust.upcomming.orders')}}" >Upcomming Orders</a></li>
							<li><a href="{{route('cust.delivered.orders')}}" >Delivered Orders</a></li>
							<li><a href="{{route('cust.cancel.orders')}}">Cancel Orders</a></li>
						</ul>
					</div>
					<div class="table-responsive order_trck_table">
						<table class="table table-striped" id="example">
							<thead>
								<tr>
									<th>Id</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Services</th>
									<th>Event Date</th>
									<th>Order Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
									@foreach($data as $key=> $value)
								<tr>
									<td class="align-middle">{{@$value->id}}</td>
									<td class="align-middle">{{@$value->CustomerDetails->name}}</td>
									<td class="align-middle">{{@$value->customer_email}}</td>
									<td class="align-middle">{{@$value->customer_phone	}}</td>
									<td class="align-middle">{{@$value->serviceDetails->service}}</td>
									<td class="align-middle">{{@$value->event_date}}</td>
									<td data-label="Mail ID">@if(@$value->order_status==1)
										<p>Upcomming</p>
										@elseif(@$value->order_status==2)
										<p>Cancel</p>
										@else
										Delivered
									@endif
								</td>

									<td class="rm07">
														<a href="javascript:void(0);" class="action-dots"  id="action{{$value->id}}"><img src="{{url('/')}}/public/adminasset/assets/images/action-dots.png" alt="" onclick="fun({{$value->id}})"></a>
														<div class="show-actions" id="show-action{{$value->id}}" style="display: none;"> <span class="angle"><img src="{{url('/')}}/public/adminasset/assets/images/angle.png" alt=""></span>
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
														<br>
														
														
														<h5>Service Name </h5>
														<p>{{@$value->serviceDetails->service}}</p>
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









@include('Customer.includes.new_footer')
<!-- Js File -->
@section('script')
@include('Customer.includes.new_script')
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
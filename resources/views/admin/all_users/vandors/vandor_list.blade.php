@extends('admin.layouts.app')
@section('title')
<title>Utsavlife | admin | Vendors</title>
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
					<h4 class="pull-left page-title">Service List </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Utsavlife</a></li>
						<li class="active">Vendors</li>
					</ol>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<!-- Start Widget -->
			<div class="row">
				<div class="col-md-12">
					
					<div class="clearfix"></div>
					<div class="panel panel-default">
						
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
										<table id="example" class="cell-border">
											<thead>
												<tr>
													<th scope="col">id</th>
													<th scope="col">Vendor Name</th>
													<th scope="col">Vendor Email</th>
													<th scope="col">Vendor Mobile</th>
													<th scope="col">status</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($vandors as $key=> $value)
												<tr>
													
													<td>{{@$value->id}}</td>
												
													<td data-label="Name">{{@$value->name}}</td>
													<td data-label="Name">{{@$value->email}}</td>
													<td data-label="Name">{{@$value->mobile}}</td>
													<td data-label="Mail ID">@if(@$value->status=="A")
														<p>Active</p>
														@elseif(@$value->status=="U")
														<p>Unverified</p>
														@else
														Inactive
													@endif</td>
													<td class="rm07">
														<a href="javascript:void(0);" class="action-dots"  id="action{{$value->id}}"><img src="{{url('/')}}/public/vandorAgentJsCss/assets/images/action-dots.png" alt="" onclick="fun({{$value->id}})"></a>
														<div class="show-actions" id="show-action{{$value->id}}" style="display: none;"> <span class="angle"><img src="{{url('/')}}/public/vandorAgentJsCss/assets/images/angle.png" alt=""></span>
														<ul>
															@if(@$value->status=="A")
															<li><a href="{{route('admin.vandor.deactive',$value->id)}}">Deactive</a></li>
															@elseif(@$value->status=="U")
															<li><a href="{{route('admin.vandor.active',$value->id)}}">active</a></li>
															@else
															<li><a href="{{route('admin.vandor.active',$value->id)}}">Active</a></li>
															@endif
														
															
															<li><a onclick="return confirm('Are you sure want to delete this vandor ?')" href="{{route('admin.vandor.delete',$value->id)}}">Delete</a></li>

															<li><a href="{{route('admin.vandor.view',$value->id)}}">View</a></li>

															<li><a href="{{route('admin.vandor.orders',$value->id)}}">Orders</a></li>


															{{-- <li><a  href="#" data-toggle="modal" data-target="#myModalview{{$value->id}}">View</a></li> --}}
															
															
															<li><a href="#" onclick="Cancel({{$value->id}})">Cancel</a></li>
														</ul>
													</div>
												</td>
												
											</tr>
											
											
											{{-- for view --}}
										{{-- 	<div class="modal" id="myModalview{{@$value->id}}">
												<div class="modal-dialog">
													<div class="modal-content">
														<!-- Modal Header -->
														<div class="modal-header">
															<h4 class="modal-title">Details of service : {{@$value->serviceDetails->service}}</h4>
															
														</div>
														<!-- Modal body -->
														<div class="modal-body">
															
															<h5>Vandor Name </h5>
															<p>{{@$cat->category_name}}</p>

															<h5>Service Name </h5>
															<p>{{@$value->service}}</p>
															<h5> Status </h5>
															<p>@if(@$value->status=="A")
																<p>Active</p>
																@else
																<p>Deactive</p>
															@endif</p>
															
															<h5> Price </h5>
															<p>{{@$value->price}}</p>

															<h5> Discount Price </h5>
															<p>{{@$value->discount_price}}</p>

															<h5> Unity </h5>
															<p>{{@$value->price_basis}}</p>

															<h5>Created Date </h5>
															<p>{{@$value->created_at}}</p>
															
														</div>
														<!-- Modal footer -->
														<div class="modal-footer">
															
															
															<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div> --}}
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
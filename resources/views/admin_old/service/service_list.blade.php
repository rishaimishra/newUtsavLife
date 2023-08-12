@extends('admin.layouts.app')
@section('title')
<title>Go party | admin | Services</title>
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
						<li><a href="{{route('admin.dashboard')}}">Go party</a></li>
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
							<div class="add-btn "><a href="{{route('admin.service.add.page')}}"><i class="icofont-plus-circle"></i> Add Services</a></div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
										<table id="example" class="cell-border">
											<thead>
												<tr>
													<th scope="col">id</th>
													<th scope="col">category Name</th>
													<th scope="col">Service Name</th>
													<th scope="col">Service price</th>
													<th scope="col">status</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($services as $key=> $value)
												<tr>
													
													<td data-label="Name">{{@$value->id}}</td>
													@php
															$cat=DB::table('category__cruds')->where('id',$value->serviceCategoryDetails->category_id)->first();

															@endphp

													<td data-label="Name">{{@$cat->category_name}}</td>
													<td data-label="Name">{{@$value->service}}</td>
													
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
															<li><a href="{{route('admin.service.deactive',$value->id)}}">Deactive</a></li>
															@else
															<li><a href="{{route('admin.service.active',$value->id)}}">Active</a></li>
															@endif
															<li><a href="{{route('admin.service.edit',$value->id)}}">Edit</a></li>
															
															<li><a onclick="return confirm('Are you sure want to delete this service ?')" href="{{route('admin.service.delete',$value->id)}}">Delete</a></li>
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
															<p>{{@$cat->category_name}}</p>

															<h5>Service Name </h5>
															<p>{{@$value->service}}</p>

															<h5>Service Image </h5>
															<em><img src="{{url('/')}}/storage/app/public/service/{{@$value->image}}" alt="" style="width: 150px !important; height: 150px !important"></em>


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
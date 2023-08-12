@extends('admin.layouts.app')
@section('title')
<title>Utsavlife | admin | All vendor cancel orders</title>
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
					<h4 class="pull-left page-title">All Orders </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Utsavlife</a></li>
						<li class="active">All Orders</li>
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
							<h3>vendor list of rejected order id: {{@$id}}</h3>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="table-responsive">
									<table id="example" class="cell-border">
										<thead>
											<tr>
												{{-- <th scope="col">id</th> --}}
												<th scope="col">Vandor</th>
												
												<th scope="col">reason</th>
												<th scope="col">date</th>
											</tr>
										</thead>
										<tbody>
											@foreach($data as $key=> $value)
											<tr>
												
												{{-- <td data-label="Name">{{@$value->id}}</td> --}}
												
												<td data-label="Name">{{@$value->venodrDetails->name}}</td>
												
												<td data-label="Name">{{@$value->reason}}</td>
												<td data-label="Name">{{@$value->created_at}}</td>
												
										</tr>

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
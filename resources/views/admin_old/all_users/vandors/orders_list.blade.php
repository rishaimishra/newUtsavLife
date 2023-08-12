@extends('admin.layouts.app')
@section('title')
<title>Go party | admin | Vandors Orders</title>
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
					<h4 class="pull-left page-title">Order List of {{$vandorDetails->name}} </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Go party</a></li>
						<li class="active">Vandors</li>
					</ol>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<!-- Start Widget -->
			<div class="add-btn "><a href="{{route('admin.vandor.list')}}"><i class="icofont-minus-circle"></i> Back</a></div>
			<div class="row">
				<div class="col-md-12">
					
					<div class="clearfix"></div>
					<div class="panel panel-default">
						
		{{-- Accepets Orders --}}
						<div class="panel-body">
							<div class="row">
								<h1>Accepts Orders</h1>
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
											</tr>
										</thead>
										<tbody>
											@foreach($accepted as $key=> $value)
											<tr>
												
												<td data-label="Name">{{@$value->id}}</td>
												<td data-label="Name">
													@if(@$value->VandorDetails->name=="")
													<strong>Not Assign</strong>
													@else
													{{@$value->VandorDetails->name}}
													@endif
												</td>
												<td data-label="Mail ID">Accepted</td>
												<td data-label="Name">{{@$value->CustomerDetails->name}}</td>
												<td data-label="Name">{{@$value->customer_email}}</td>
												<td data-label="Name">{{@$value->customer_phone	}}</td>
												<td data-label="Name">{{@$value->categoryDetails->category_name}}</td>
												<td data-label="Name">{{@$value->serviceDetails->service}}</td>
												<td data-label="Name">{{@$value->event_date}}</td>
												
											
										</tr>
										
										
										@endforeach
										
									</tbody>
								</table>
								</div>
								
							</div>
						</div>













						{{-- Cancel Orders --}}
						<div class="panel-body">
							<div class="row">
									<h1>Cancel Orders</h1>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
										<table id="example2" class="cell-border">
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
												
											</tr>
										</thead>
										<tbody>
											@foreach($rejected as $key=> $value)
											<tr>
												
												<td data-label="Name">{{@$value->id}}</td>
												<td data-label="Name">
													@if(@$value->VandorDetails->name=="")
													<strong>Not Assign</strong>
													@else
													{{@$value->VandorDetails->name}}
													@endif
												</td>
												<td data-label="Mail ID">Rejected</td>

												<td data-label="Name">{{@$value->CustomerDetails->name}}</td>
												<td data-label="Name">{{@$value->customer_email}}</td>
												<td data-label="Name">{{@$value->customer_phone	}}</td>
												<td data-label="Name">{{@$value->categoryDetails->category_name}}</td>
												<td data-label="Name">{{@$value->serviceDetails->service}}</td>
												<td data-label="Name">{{@$value->event_date}}</td>
											
											
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
});


oTable2 = $('#example2').DataTable({
"bSort": true
});
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
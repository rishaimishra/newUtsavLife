@extends('Agent.layouts.app')
@section('title')
<title>Utsavlife | Agent | Register user list</title>
@endsection
@section('left_part')
@include('Agent.includes.left_part')
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
					<h4 class="pull-left page-title">Register User List </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('agent.dashboard')}}">Utsavlife</a></li>
						<li class="active">UserList</li>
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
							@include('vandor.includes.message')
								<div class="add-btn "><a href="{{route('agent.cust.reg.page',[Auth()->user()->id,Auth()->user()->email])}}"><i class="icofont-plus-circle"></i> Register User</a></div>
							
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
										<table id="example" class="cell-border">
											<thead>
												<tr>
													
													<th scope="col">Name</th>
													<th scope="col">Email</th>
													<th scope="col">Phone</th>
													{{-- <th scope="col">Action</th> --}}
												</tr>
											</thead>
											<tbody>
												@foreach($data as $key=> $value)
												<tr>
													
													<td data-label="Name">{{@$value->name}}</td>
													<td data-label="Name">{{@$value->email}}</td>
													<td data-label="Name">{{@$value->mobile}}</td>
													
													{{-- <td class="rm07">
														<a href="javascript:void(0);" class="action-dots"  id="action{{$value->id}}"><img src="{{url('/')}}/public/adminasset/assets/images/action-dots.png" alt="" onclick="fun({{$value->id}})"></a>
														<div class="show-actions" id="show-action{{$value->id}}" style="display: none;"> <span class="angle"><img src="{{url('/')}}/public/adminasset/assets/images/angle.png" alt=""></span>
														<ul>
															
															<li><a href="{{route('agent.lead.edit',$value->id)}}">Edit</a></li>
															
															
															<li><a  href="#" data-toggle="modal" data-target="#myModalview{{$value->id}}">View</a></li>
															
															
															<li><a href="#" onclick="Cancel({{$value->id}})">Cancel</a></li>
														</ul>
													</div>
												</td> --}}
												
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
@include('Agent.includes.script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
oTable = $('#example').DataTable({
"bSort": false
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
@extends('admin.layouts.app')
@section('title')
<title>Go party | admin | Vandors</title>
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
						<li class="active">Wallet</li>
					</ol>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<!-- Start Widget -->
			<div class="row">
				<div class="col-md-12">
					
					<div class="clearfix"></div>
					<div class="panel panel-default">
						<h3>Pending Wallet Total: {{$wallet_total}}</h3>
						<h3>Withdrawable: {{$withdraw}}</h3>
						{{-- {{$vendor_id}} --}}
						<a href="{{route('admin.wallet.transactions',$vendor_id)}}">transaction list</a>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
										<table id="example_wallet" class="cell-border">
											<thead>
												<tr>
													<th scope="col">id</th>
													<th scope="col">Customer Email</th>
													<th scope="col">Phone</th>
													<th scope="col">Total Price</th>
													<th scope="col">Event Address</th>
													<th scope="col">Event Pin</th>
													<th scope="col">Status</th>
													<th scope="col">Withdraw Request</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($wallet as $key=> $value)
												<tr>
													
													<td data-label="Name">{{@$value->id}}</td>
												
													<td data-label="Name">{{@$value->customer_email}}</td>
													<td data-label="Name">{{@$value->customer_phone}}</td>
													<td data-label="Name">{{@$value->total_price}}</td>
													<td data-label="Name">{{@$value->event_address}}</td>
													<td data-label="Name">{{@$value->event_pin}}</td>
													<td data-label="Mail ID">@if(@$value->status=="A")
														<p>Active</p>
														@elseif(@$value->status=="P")
														<p>Pending</p>
														@else
														Inactive
													@endif</td>
													
													<td data-label="Mail ID">@if(@$value->WithdrawReq=="Approved")
														<p>Approved</p>
														@elseif(@$value->WithdrawReq=="P")
														<p>Pending</p>
														@else
														Inactive
													@endif</td>
													<td class="rm07">
														<a href="javascript:void(0);" class="action-dots"  id="action{{$value->id}}"><img src="{{url('/')}}/public/vandorAgentJsCss/assets/images/action-dots.png" alt="" onclick="fun({{$value->id}})"></a>
														<div class="show-actions" id="show-action{{$value->id}}" style="display: none;"> <span class="angle"><img src="{{url('/')}}/public/vandorAgentJsCss/assets/images/angle.png" alt=""></span>
														<ul>
															
														
															<li><a href="{{route('admin.wallet.withdraw.approve',$value->id)}}">Approve</a></li>
															<li><a href="{{route('admin.wallet.withdraw.disapprove',$value->id)}}">DisApprove</a></li>

																										
														</ul>
													</div>
												</td>
												
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
oTable = $('#example_wallet').DataTable({
"bSort": true
});
$('#myInputTextField').keyup(function(){
oTable.search($(this).val()).draw() ;
})

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
<script>
var resizefunc = [];
</script>
@endsection
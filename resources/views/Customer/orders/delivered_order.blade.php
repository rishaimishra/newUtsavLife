@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Customer | Delivered Orders</title>
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
.track_filter ul li a.active {
    background-color:#0364A5;
    color:#fff;
}
</style>
{{-- @endsection --}}
<style>#main-order{}#main-order .text-right{text-align:right;}#main-order .accent-color{color:#0364a5;}#main-order .row{margin:0;}.main-order-title{}.main-order-list{}.main-order-each-item{padding:0 0 0;border-radius:4px;overflow:hidden;border:1px solid #00000024;margin:0 0 10px;}.mo-top{background:rgb(0 0 0 / 8%);padding:10px 10px;}.mo-top .row{}.mo-top .row>div{font-size:14px;}.mo-top .row>div span{font-weight:600;color:#4b4b4b;}#main-order .btn-link{color:#0364a5;}.mo-body{padding:10px 10px;}.mo-body .mo-body-top{}.mo-body .mo-body-top>div{font-weight:600;color:#4b4b4b;line-height:20px;}.mo-body .mo-body-top>div span{font-size:12px;}.mo-body .mo-b-main{margin:10px 0 0;}.mo-body .mo-b-main img{}.mo-body .mo-b-main .order-desc{font-weight:500;font-size:14px;}.mo-body .mo-b-main .order-price{font-weight:500;color:#fe5b60!important;font-size:14px;}.order-option{text-align:center;}.order-option button{text-decoration:none!important;display:block;margin:0 auto 0;width:90%;font-size:12px!important;padding:6px 0 6px!important;}.order-option .view-order-btn{margin-bottom:10px;}.order-option .cancel-order-btn{color:#fe5b60;background:transparent;border-color:#fe5b60;}.order-option .cancel-order-btn:hover{color:#fff;background:#fe5b60;border-color:#fe5b60;}.order-hash-no{font-size:12px;}@media only screen and (max-width:500px){.order-option{margin-top:20px}.mo-top .row>div{margin-bottom:10px}.order-hash-no{font-size:14px}}</style>

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
						<h4>Delivered Orders</h4>
						<span>Utsavlife <spn class="text_blue">All Orders</spn></span>
					</div>
					<div class="track_filter">
                        <ul>
                            <li><a href="{{ route('cust.all.orders') }}" @if(request()->segment(2) == "orders" && request()->segment(3) == "all")class="active" @endif>All Orders</a></li>
                            <li><a href="{{ route('cust.upcomming.orders') }}" @if(request()->segment(2) == "orders" && request()->segment(3) == "upcomming")class="active" @endif>Upcomming Orders</a></li>
                            <li><a href="{{ route('cust.delivered.orders') }}" @if(request()->segment(2) == "orders" && request()->segment(3) == "delivered")class="active" @endif>Delivered Orders</a></li>
                            <li><a href="{{ route('cust.cancel.orders') }}" @if(request()->segment(2) == "orders" && request()->segment(3) == "cancel")class="active" @endif>Cancel Orders</a></li>
                        </ul>
                    </div>
					@if(\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ \Session::get('success') }}
                    </div>
                    @endif
                    @if(count($data) > 0)
                    @foreach ($data as $key => $value)
                    <div id="main-order">
                        <div class="main-order-title"></div>
                        <div class="main-order-list">
                            <!-- each repeating card -->
                            <div class="main-order-each-item">
                            <div class="mo-top">
                                <div class="row">
                                <div class="col-md-2 col-4">
                                    ORDER PLACED <br> <span>{{ date("d/M/Y",strtotime($value->created_at)) }}</span>
                                </div>
                                <div class="col-md-2 col-4">
                                    SHIP TO <br> <span>{{ @$value->billing_name }}</span>
                                </div>
                                <div class="col-md-2 col-4">
                                    PLACED BY <br>
                                    <span> {{ @$value->CustomerDetails->name }}</span>
                                </div>
                                <div class="col-md-2 col-4">
                                    Delivery Date <br> <span>{{ date("d/M/Y",strtotime($value->event_date)) }} - {{ date("d/M/Y",strtotime($value->event_end_date)) }}</span>
                                </div>
                                <div class="col-md-2 col-4">
                                    TOTAL <br> <span>INR {{ @$value->total_price }}</span>
                                </div>
                                <div class="col-md-2 col-8 text-right">
                                    ORDER # <span class="order-hash-no">{{ @$value->id }}</span>
                                    <br> <span class="btn-link" data-toggle="modal"
                                    data-target="#myModalview{{ $value->id }}">View Order Details</span>
                                </div>
                                </div>
                            </div>
                            <div class="mo-body">
                                <div class="mo-body-top row">
                                <div class="mo-b-t-left col-6">
                                    {{--  Arrival 15 Jul - 22 Jul <br>
                                    <span class="accent-color">Not yet dispatched</span>  --}}
                                </div>
                                <div class="mo-b-t-right col-6 text-right">
                                    {{--  Delivery Date 15 Jul <br>
                                    <span class="accent-color">Not yet dispatched</span>  --}}
                                </div>
                                </div>
                                <div class="mo-b-main">
                                <div class="row">
                                    <div class="col-lg-1 col-md-2 col-3">
                                        @if(!empty($value->services))
                                    <img src="{{url('/')}}/storage/app/public/service/{{@$value->serviceDetails->image}}" alt=""
                                        class="img-fluid">
                                        @else
                                        <img src="{{url('/')}}/storage/app/public/packages/{{@$value->packageDetails->image}}" alt=""
                                        class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-9">
                                        @if(!empty($value->services))
                                    <div class="order-desc  accent-color">{{ @$value->serviceDetails->service }}</div>
                                    @else
                                    <div class="order-desc  accent-color">{{ @$value->packageDetails->name }}</div>
                                    @endif
                                    <div class="order-price">INR {{ @$value->total_price }}</div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-12 order-option">
                                    <button type="button" class="btn_solid view-order-btn" data-toggle="modal"
                                    data-target="#myModalview{{ $value->id }}">View Order</button>
                                    {{--  @if($value->event_end_date >= date("Y-m-d"))
                                    <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route("cust.delete.orders",$value->id) }}" class="btn_solid cancel-order-btn" style="text-decoration:none;">Cancel Order</a>
                                    @endif  --}}
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="modal" id="myModalview{{ @$value->id }}">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        @if(!empty($value->services))
                                        <h4 class="modal-title">Details of service :
                                            {{ @$value->serviceDetails->service }}</h4>
                                        @else
                                        <h4 class="modal-title">Details of Package :
                                            {{ @$value->packageDetails->service }}</h4>
                                        @endif
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-2">
                                                    @if(!empty($value->services))
                                                    <img src="{{url('/')}}/storage/app/public/service/{{@$value->serviceDetails->image}}" alt=""
                                                        class="img-fluid mx-auto d-block" width="250">
                                                        @else
                                                        <img src="{{url('/')}}/storage/app/public/packages/{{@$value->packageDetails->image}}" alt=""
                                                        class="img-fluid mx-auto d-block" width="250">
                                                        @endif
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Category Name </h5>
                                                <p>{{ @$value->categoryDetails->category_name }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                @if(!empty($value->services))
                                                <h5>Service Name </h5>
                                                <p>{{ @$value->serviceDetails->service }}</p>
                                                @else
                                                <h5>Package Name </h5>
                                                <p>{{ @$value->packageDetails->name }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Shipping Address </h5>
                                                <p>{{ @$value->address }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Payment Method </h5>
                                                @if($value->payment_type == "COD")
                                                <p>Cash on Delivery</p>
                                                @else
                                                <p>Online Payment</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                @if(!empty($value->services))
                                                <h5> Service Description </h5>
                                                <p>{{ @$value->serviceDetails->service_desc }}</p>
                                                @else
                                                <h5> Package Description </h5>
                                                <p>{{ @$value->packageDetails->description }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <h5> Order Start Date </h5>
                                                <p>{{ date("d-M-Y",strtotime(@$value->event_date)) }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5> Order End Date </h5>
                                                <p>{{ date("d-M-Y",strtotime(@$value->event_end_date)) }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5> Time </h5>
                                                <p>
                                                    @if (@$value->time == 'M')
                                                        Morning
                                                    @elseif(@$value->time == 'N')
                                                        Night
                                                    @else
                                                        Full Day
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5> Days </h5>
                                        <p>{{ @$value->days }}</p>
                                            </div>
                                            <div class="col-md-6">

                                        <h5> Amount</h5>
                                        <p>{{ @$value->total_price }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Ordered Date </h5>
                                            <p>{{ date("d-M-Y",strtotime(@$value->created_at)) }}</p>
                                            </div>
                                        </div>



                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">


                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                    <div id="main-order">
                        <div class="main-order-title"></div>
                        <div class="main-order-list">
                            <!-- each repeating card -->
                            <div class="main-order-each-item">
                            <div class="mo-body">
                                <div class="mo-b-main">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center">No Record Found</h4>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif
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

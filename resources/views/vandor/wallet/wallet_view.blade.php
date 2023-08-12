{{-- <h1>Vandor panel</h1>
<br>
<br>
@include('vandor.includes.message')
<br>
{{auth()->user()}}
<br>
<a href="{{route('vandor.logout')}}">Logout</a>
 --}}
@extends('vandor.layouts.app')
@section('title')
    <title>Utsavlife | Vendor | Dashboard</title>
@endsection
@section('left_part')
    @include('vandor.includes.left_part')
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
                        <h4 class="pull-left page-title">Wallet View</h4>
                        {{-- <h4>{{auth()->user()}}</h4> --}}
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('vandor.dashboard') }}">Utsavlife</a></li>
                            <li class="active">Wallet</li>
                        </ol>
                    </div>
                </div>
                <!-- Start Widget -->
                @include('vandor.includes.message')


                <div class="row">
                    <div class="col-md-12">

                        <div class="clearfix"></div>
                        <div class="panel panel-default">
                            <h3>Pending Wallet Total: {{ $wallet_total }}</h3>
                            <h3>Withdrawable: {{$withdraw}}</h3>
                            <a href="{{route('wallet.transactions')}}">transaction list</a>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Withdraw
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Withdraw</h5>

                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> --}}
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('wallet.withdraw') }}">@csrf
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                    <input type="number" name="wallet_amount" class="form-control"
                                                        id="exampleInputEmail1" aria-describedby="emailHelp"
                                                        placeholder="Enter amount">

                                                    <input type="hidden" name="user_id" class="form-control"
                                                        id="exampleInputEmail1" aria-describedby="emailHelp" value="{{Auth::user()->id}}">
                                                  
                                                </div>
                                              
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>


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
                                                        {{-- <th scope="col">Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($wallet as $key => $value)
                                                        <tr>

                                                            <td data-label="Name">{{ @$value->id }}</td>

                                                            <td data-label="Name">{{ @$value->customer_email }}</td>
                                                            <td data-label="Name">{{ @$value->customer_phone }}</td>
                                                            <td data-label="Name">{{ @$value->total_price }}</td>
                                                            <td data-label="Name">{{ @$value->event_address }}</td>
                                                            <td data-label="Name">{{ @$value->event_pin }}</td>
                                                            {{-- <td data-label="Mail ID">@if (@$value->status == 'A')
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
                                                                    
                                                                
                                                                    <li><a href="{{route('admin.wallet.view',$value->id)}}">View Wallet</a></li>
        
                                                                                                                
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
@endsection

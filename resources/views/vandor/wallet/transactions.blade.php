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
                        <h4 class="pull-left page-title">Transactions View</h4>
                        {{-- <h4>{{auth()->user()}}</h4> --}}
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('vandor.dashboard') }}">Utsavlife</a></li>
                            <li class="active">Transactions</li>
                        </ol>
                    </div>
                </div>
                <!-- Start Widget -->
                @include('vandor.includes.message')


                <div class="row">
                    <div class="col-md-12">

                        <div class="clearfix"></div>
                        <div class="panel panel-default">
                            <h3>Transaction Total: {{ $transaction_total }}</h3>



                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table id="example_wallet" class="cell-border">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Transaction Date</th>
                                                       
                                                        {{-- <th scope="col">Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($transactions as $key => $value)
                                                        <tr>

                                                            <td data-label="Name">{{ @$value->id }}</td>

                                                            <td data-label="Name">{{ @$value->amount }}</td>
                                                            <td data-label="Name">{{ @$value->transaction_date }}</td>
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

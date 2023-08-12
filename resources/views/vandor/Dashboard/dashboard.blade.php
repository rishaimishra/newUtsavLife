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
                            <h4 class="pull-left page-title">Welcome !</h4>
                            {{-- <h4>{{auth()->user()}}</h4> --}}
                            <ol class="breadcrumb pull-right">
                                <li><a href="{{route('vandor.dashboard')}}">Utsavlife</a></li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!-- Start Widget -->
                  

                    <div class="row">
                        @include('vandor.includes.message')
                        @if(auth()->user()->status=="U" || auth()->user()->status=="I")
                       <strong><p> You have been Successful registered as a vendor account.<br> May your account be incomplete, Please complete your account to click on complete profile OR click the below link.<br> Thank You !</p></strong>
                        @endif
                        <div class=" col-lg-4 col-md-6 col-sm-6">
                            <div class="mini-stat clearfix bx-shadow bg-white"> <span class="mini-stat-icon bg-info"><i class="icofont-list"></i></span>
                                <div class="mini-stat-info text-right text-dark"> <span class="counter text-dark">{{@$service}}</span> Total Services </div>
                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6 col-sm-6">
                            <div class="mini-stat clearfix bx-shadow bg-white"> <span class="mini-stat-icon bg-warning"><i class="icofont-tasks-alt"></i></span>
                                <div class="mini-stat-info text-right text-dark"> <span class="counter text-dark">{{@$upcomming}}</span> Total Upcomming orders </div>
                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6 col-sm-6">
                            <div class="mini-stat clearfix bx-shadow bg-white"> <span class="mini-stat-icon bg-pink"><i class="fas fa-file-video"></i></span>
                                <div class="mini-stat-info text-right text-dark"> <span class="counter text-dark">{{@$deliverd}}</span> Total previous orders </div>
                            </div>
                        </div>
                      {{--   <div class=" col-lg-4 col-md-6 col-sm-6">
                            <div class="mini-stat clearfix bx-shadow bg-white"> <span class="mini-stat-icon bg-success"><i class="far fa-question-circle"></i></span>
                                <div class="mini-stat-info text-right text-dark"> <span class="counter text-dark">{{@$faqs}}</span> Total Faqs </div>
                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6 col-sm-6">
                            <div class="mini-stat clearfix bx-shadow bg-white"> <span class="mini-stat-icon bg-info"><i class="   fas fa-share-alt-square"></i></span>
                                <div class="mini-stat-info text-right text-dark"> <span class="counter text-dark">{{@$active_social}}</span> Total Active Social links </div>
                            </div>
                        </div> --}}
                        
                       {{--  <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bx-shadow bg-white"> <span class="mini-stat-icon bg-success"><i class="fa fa-eye"></i></span>
                                <div class="mini-stat-info text-right text-dark"> <span class="counter text-dark">20544</span> New Visitors </div>
                            </div>
                        </div> --}}
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
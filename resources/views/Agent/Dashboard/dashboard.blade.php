{{-- <h1>Agent panel</h1>
<br>
<br>
@include('Agent.includes.message')
<br>
{{auth()->user()}}
<br>
<a href="{{route('agent.logout')}}">Logout</a> --}}

@extends('Agent.layouts.app')
@section('title')
<title>Utsavlife | Agent | Dashboard</title>

@endsection
@section('left_part')
@include('Agent.includes.left_part')
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
                                <li><a href="{{route('agent.dashboard')}}">Utsavlife</a></li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!-- Start Widget -->
                  

                    <div class="row">
                         @include('Agent.includes.message')
                        @if(auth()->user()->status=="U" || auth()->user()->status=="I")
                       <strong> You need to wait to aceess the website untill admin approval.</strong>
                        @endif


                        <div class=" col-lg-4 col-md-6 col-sm-6">
                            <div class="mini-stat clearfix bx-shadow bg-white"> <span class="mini-stat-icon bg-info"><i class="icofont-list"></i></span>
                                <div class="mini-stat-info text-right text-dark"> <span class="counter text-dark">{{@$tamplate}}</span> Total Services </div>
                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6 col-sm-6">
                            <div class="mini-stat clearfix bx-shadow bg-white"> <span class="mini-stat-icon bg-warning"><i class="icofont-tasks-alt"></i></span>
                                <div class="mini-stat-info text-right text-dark"> <span class="counter text-dark">{{@$design}}</span> Total Upcomming orders </div>
                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6 col-sm-6">
                            <div class="mini-stat clearfix bx-shadow bg-white"> <span class="mini-stat-icon bg-pink"><i class="fas fa-file-video"></i></span>
                                <div class="mini-stat-info text-right text-dark"> <span class="counter text-dark">{{@$material_type}}</span> Total previous orders </div>
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
@include('Agent.includes.script')

@endsection
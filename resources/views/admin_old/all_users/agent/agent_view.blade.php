@extends('admin.layouts.app')
@section('title')
<title>Go party | admin | Agent</title>
@endsection
@section('left_part')
@include('admin.includes.left_part')
{{-- for datepicker --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		
		
		<div class="wraper container-fluid">
			
			<div class="row">
				<div class="col-sm-12">
					<h4 class="pull-left page-title">Agent View Page</h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('admin.dashboard')}}">Go party</a></li>
						
						<li class="active">Agent View Page</li>
					</ol>
				</div>
			</div>
			<div class="add-btn "><a href="{{route('admin.agent.list')}}"><i class="icofont-minus-circle"></i> Back</a></div>
			
			<div class="row">
				<div class="col-lg-12">
					
					<div>
						
						<div class="row">
							<div class="col-md-6">
								<!-- Personal-Information -->
								<div class="panel panel-default panel-fill">
									<div class="panel-heading">
										<h3 class="panel-title">agent Information</h3>
									</div>
									<div class="panel-body">
										<div class="about-info-p">
											<strong>agent name</strong>
											<br>
											<p class="text-muted">{{@$agent->name}}</p>
										</div>
										
										
										<div class="about-info-p">
											<strong>email</strong>
											<br>
											<p class="text-muted">{{@$agent->email}}</p>
										</div>
										<div class="about-info-p">
											<strong>Mobile</strong>
											<br>
											<p class="text-muted">{{@$agent->mobile}}</p>
										</div>
										<div class="about-info-p">
											<strong>status</strong>
											<br>
											<p class="text-muted">@if(@$agent->status=="A")
												<p>Active</p>
												@elseif(@$agent->status=="U")
												<p>Unverified</p>
												@else
												Inactive
											@endif</p>
										</div>
										
										<div class="about-info-p">
											<strong>Create Time</strong>
											<br>
											<p class="text-muted">{{@$agent->created_at}}</p>
										</div>
										<div class="about-info-p">
											<strong>Last update Time</strong>
											<br>
											<p class="text-muted">{{@$agent->updated_at}}</p>
										</div>
										
										
									</div>
								</div>
								<!-- Personal-Information -->
								<!-- Languages -->
								
								<!-- Languages -->
							</div>
							<div class="col-md-6">
								<!-- Personal-Information -->
								<div class="panel panel-default panel-fill">
									<div class="panel-heading">
										<h3 class="panel-title">agent Information</h3>
									</div>
									<div class="panel-body">
										<div class="about-info-p">
											<strong>Image </strong>
											<br>
											<div class="pull-left"> @if(@$agent->avatar=="users/default.png")
											<i class='fas fa-user-tie' style='font-size:36px;color: black;'  ></i>
											@elseif(@$agent->avatar)
											<img src="{{url('/')}}/storage/app/public/agent/{{$agent->avatar}}" alt="" class="thumb-md img-circle">
											
											@else<i class='fas fa-user-tie' style='font-size:36px;color: black;'  ></i> @endif </div>
										</div>
										
									</div>
								</div>
								
							</div>
							
						</div>
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
		</div> <!-- container -->
		
		</div> <!-- content -->
		
	</div>
	<!-- ============================================================== -->
	<!-- End Right content here -->
	<!-- ============================================================== -->
	<!-- End Right content here -->
	@section('footer')
	{{-- @include('admin.include.footer') --}}
	@endsection
	@endsection
	{{-- end content --}}
	@section('script')
	@include('admin.includes.script')
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	@endsection
@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vandor | Availability add</title>
@endsection
@section('left_part')
@include('vandor.includes.left_part')
{{-- for datepicker --}}
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
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
					<h4 class="pull-left page-title">Availability Add </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('vandor.dashboard')}}">Utsavlife</a></li>
						<li class="active"> Availability Add </li>
					</ol>
				</div>
			</div>
			@include('vandor.includes.message')
			
			<div class="row">
				<div class="col-lg-12">
					<div>
						<!-- Personal-Information -->
						<div class="panel panel-default panel-fill">
							<div class="panel-heading">
							<h3 class="panel-title">Add Availablity</h3> </div>
							<h4>Day: 10AM - 4PM,   Night: 6PM - 12PM</h4>
							<div class="panel-body rm02 rm04">
								<form role="form" action="{{route('vandor.aval.insert')}}" id="frm" method="post" enctype="multipart/form-data">
									@csrf







									{{--Monday --}}
									<div class="form-group rm50">
										<label for="title">Monday</label>
										<select name="mon" class="day-sel" id="mon" onchange="MonDayFunction(this.value)">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="mon_day" class="time-sel" id="mon_day">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="mon_night" class="time-sel" id="mon_night">
											<option value="Y" selected >Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									<div class="clearfix"></div>
									<hr>










									{{-- tuesday --}}
									<div class="form-group rm50">
										<label for="title">Tuesday</label>
										<select name="tues" class="day-sel" id="tues" onchange="TuesDayFunction(this.value)">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="tues_day" class="time-sel" id="tues_day">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="tues_night" class="time-sel" id="tues_night">
											<option value="Y" selected >Yes</option>
											<option value="N">No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>









									{{-- wedday --}}
									<div class="form-group rm50">
										<label for="title">WednesDay</label>
										<select name="wed" class="day-sel" id="wed"  onchange="WednesDayFunction(this.value)">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="wed_day" class="time-sel" id="wed_day">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="wed_night" class="time-sel" id="wed_night">
											<option value="Y" selected >Yes</option>
											<option value="N">No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>








									{{-- thursday --}}
									<div class="form-group rm50">
										<label for="title">ThursDay</label>
										<select name="thurs" class="day-sel" id="thurs" onchange="ThursDayFunction(this.value)">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="thurs_day" class="time-sel" id="thurs_day">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="thurs_night" class="time-sel" id="thurs_night">
											<option value="Y" selected >Yes</option>
											<option value="N">No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>










									{{-- friday --}}
									<div class="form-group rm50">
										<label for="title">Friday</label>
										<select name="fri" class="day-sel" id="fri" onchange="FriDayFunction(this.value)">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="fri_day" class="time-sel" id="fri_day">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="fri_night" class="time-sel" id="fri_night">
											<option value="Y" selected >Yes</option>
											<option value="N">No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>









									{{-- SaturDay --}}
									<div class="form-group rm50">
										<label for="title">SaturDay</label>
										<select name="sat" class="day-sel" id="sat" onchange="SatDayFunction(this.value)">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="sat_day" class="time-sel" id="sat_day">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="sat_night" class="time-sel" id="sat_night">
											<option value="Y" selected >Yes</option>
											<option value="N">No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>











									{{-- Sunday --}}
									<div class="form-group rm50">
										<label for="title">Sunday</label>
										<select name="sun" class="day-sel" id="sun" onchange="SunDayFunction(this.value)">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="sun_day" class="time-sel" id="sun_day">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="sun_night" class="time-sel" id="sun_night">
											<option value="Y" selected >Yes</option>
											<option value="N">No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>



									





									
									
									
									<div class="clearfix"></div>
									<div class="col-lg-12" style="margin-top: 10px;">
										<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Add</button>
									</div>
								</form>
							</div>
						</div>
						<!-- Personal-Information -->
					</div>
				</div>
			</div>
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



<script>
	function MonDayFunction(val) {
		if(val=="N"){
			$("#mon_day").val('N');
			$("#mon_night").val('N');
		}else{
			$("#mon_day").val('Y');
			$("#mon_night").val('Y');

		}
	}



	function TuesDayFunction(val) {
		if(val=="N"){
			$("#tues_day").val('N');
			$("#tues_night").val('N');
		}else{
			$("#tues_day").val('Y');
			$("#tues_night").val('Y');
		}
	}



	function WednesDayFunction(val) {
		if(val=="N"){
			$("#wed_day").val('N');
			$("#wed_night").val('N');
		}else{
            $("#wed_day").val('Y');
			$("#wed_night").val('Y');
		}
	}





	function ThursDayFunction(val) {
		if(val=="N"){
			$("#thurs_day").val('N');
			$("#thurs_night").val('N');
		}else{
			$("#thurs_day").val('Y');
			$("#thurs_night").val('Y');

		}
	}




	function FriDayFunction(val) {
		if(val=="N"){
			$("#fri_day").val('N');
			$("#fri_night").val('N');
		}else{
			$("#fri_day").val('Y');
			$("#fri_night").val('Y');

		}
	}






	function SatDayFunction(val) {
		if(val=="N"){
			$("#sat_day").val('N');
			$("#sat_night").val('N');
		}else{
			$("#sat_day").val('Y');
			$("#sat_night").val('Y');
		}
	}





	function SunDayFunction(val) {
		if(val=="N"){
			$("#sun_day").val('N');
			$("#sun_night").val('N');
		}else{
			$("#sun_day").val('Y');
			$("#sun_night").val('Y');

		}
	}
	
</script>
@endsection
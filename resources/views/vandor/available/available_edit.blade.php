@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vandor | Availability Edit</title>
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
					<h4 class="pull-left page-title">Availability Edit </h4>
					<ol class="breadcrumb pull-right">
						<li><a href="{{route('vandor.dashboard')}}">Utsavlife</a></li>
						<li class="active"> Availability Edit </li>
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
							<h3 class="panel-title">Edit Availablity</h3> </div>
							<div class="panel-body rm02 rm04">
								<h4>Day: 10AM - 4PM,   Night: 6PM - 12PM</h4>
								<form role="form" action="{{route('vandor.aval.update')}}" id="frm" method="post" enctype="multipart/form-data">
									@csrf





									

									{{--Monday --}}
									<div class="form-group rm50">
										<label for="title">Monday</label>
										<select name="mon" class="day-sel"  id="mon" onchange="MonDayFunction(this.value)">
											<option value="Y" @if($data->mon=="Y") selected @endif>Yes</option>
											<option value="N" @if($data->mon=="N") selected @endif>No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="mon_day" class="time-sel" id="mon_day">
											<option value="Y"  @if($data->mon_day=="Y") selected @endif>Yes</option>
											<option value="N" @if($data->mon_day=="N") selected @endif>No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="mon_night" class="time-sel" id="mon_night">
											<option value="Y"  @if($data->mon_night=="Y") selected @endif >Yes</option>
											<option value="N"  @if($data->mon_night=="N") selected @endif>No</option>
										</select>
									</div>

									<div class="clearfix"></div>
									<hr>














									{{-- tuesday --}}
									<div class="form-group rm50">
										<label for="title">Tuesday</label>
										<select name="tues" class="day-sel" id="tues" onchange="TuesDayFunction(this.value)">
											<option value="Y" @if($data->tues=="Y") selected @endif>Yes</option>
											<option value="N" @if($data->tues=="N") selected @endif>No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="tues_day" class="time-sel" id="tues_day">
											<option value="Y" @if($data->tues_day=="Y") selected @endif>Yes</option>
											<option value="N" @if($data->tues_day=="N") selected @endif>No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="tues_night" class="time-sel" id="tues_night">
											<option value="Y" @if($data->tues_night=="Y") selected @endif >Yes</option>
											<option value="N" @if($data->tues_night=="N") selected @endif>No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>















									{{-- wedday --}}
									<div class="form-group rm50">
										<label for="title">WednesDay</label>
										<select name="wed" class="day-sel" id="wed"  onchange="WednesDayFunction(this.value)">
											<option value="Y" @if($data->wed=="Y") selected @endif >Yes</option>
											<option value="N" @if($data->wed=="N") selected @endif >No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="wed_day" class="time-sel" id="wed_day">
											<option value="Y" @if($data->wed_day=="Y") selected @endif >Yes</option>
											<option value="N" @if($data->wed_day=="N") selected @endif >No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="wed_night" class="time-sel" id="wed_night">
											<option value="Y" @if($data->wed_night=="Y") selected @endif  >Yes</option>
											<option value="N" @if($data->wed_night=="N") selected @endif >No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>













									{{-- thursday --}}
									<div class="form-group rm50">
										<label for="title">ThursDay</label>
										<select name="thurs" class="day-sel" id="thurs" onchange="ThursDayFunction(this.value)">
											<option value="Y"  @if($data->thurs=="Y") selected @endif>Yes</option>
											<option value="N"  @if($data->thurs=="N") selected @endif>No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="thurs_day" class="time-sel" id="thurs_day">
											<option value="Y"  @if($data->thurs_day=="Y") selected @endif>Yes</option>
											<option value="N"  @if($data->thurs_day=="N") selected @endif>No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="thurs_night" class="time-sel" id="thurs_night">
											<option value="Y"  @if($data->thurs_night=="Y") selected @endif >Yes</option>
											<option value="N"  @if($data->thurs_night=="N") selected @endif>No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>












									{{-- friday --}}
									<div class="form-group rm50">
										<label for="title">Friday</label>
										<select name="fri" class="day-sel" id="fri" onchange="FriDayFunction(this.value)">
											<option value="Y" @if($data->fri=="Y") selected @endif>Yes</option>
											<option value="N" @if($data->fri=="N") selected @endif>No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="fri_day" class="time-sel" id="fri_day">
											<option value="Y" @if($data->fri_day=="Y") selected @endif>Yes</option>
											<option value="N" @if($data->fri_day=="N") selected @endif>No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="fri_night" class="time-sel" id="fri_night">
											<option value="Y" @if($data->fri_night=="Y") selected @endif >Yes</option>
											<option value="N" @if($data->fri_night=="N") selected @endif>No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>












									{{-- SaturDay --}}
									<div class="form-group rm50">
										<label for="title">SaturDay</label>
										<select name="sat" class="day-sel" id="sat" onchange="SatDayFunction(this.value)">
											<option value="Y" @if($data->sat=="Y") selected @endif>Yes</option>
											<option value="N" @if($data->sat=="N") selected @endif>No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="sat_day" class="time-sel" id="sat_day">
											<option value="Y" @if($data->sat_day=="Y") selected @endif>Yes</option>
											<option value="N" @if($data->sat_day=="N") selected @endif>No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="sat_night" class="time-sel" id="sat_night">
											<option value="Y" @if($data->sat_night=="Y") selected @endif >Yes</option>
											<option value="N" @if($data->sat_night=="N") selected @endif>No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>











									{{-- Sunday --}}
									<div class="form-group rm50">
										<label for="title">Sunday</label>
										<select name="sun" class="day-sel" id="sun" onchange="SunDayFunction(this.value)">
											<option value="Y" @if($data->sun=="Y") selected @endif >Yes</option>
											<option value="N" @if($data->sun=="N") selected @endif >No</option>
										</select>
									</div>

									{{-- time --}}
									<div class="form-group rm50">
										<label for="title">Day</label>
										<select name="sun_day" class="time-sel"  id="sun_day">
											<option value="Y" @if($data->sun_day=="Y") selected @endif >Yes</option>
											<option value="N" @if($data->sun_day=="N") selected @endif >No</option>
										</select>
									</div>

									<div class="form-group rm50">
										<label for="title">Night</label>
										<select name="sun_night" class="time-sel" id="sun_night">
											<option value="Y" @if($data->sun_night=="Y") selected @endif  >Yes</option>
											<option value="N" @if($data->sun_night=="N") selected @endif >No</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>



									





									
									
									
									<div class="clearfix"></div>
									<div class="col-lg-12" style="margin-top: 10px;">
										<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update</button>
									</div>
								</form>
							</div>
						</div>










						<h1>MAP</h1>
						<div class="form-group">
					    <label for="address_address">Address</label>
					    <input type="text" id="address-input" name="address_address" class="form-control map-input">
					    <input type="text" name="address_latitude" id="address-latitude" value="0" />
					    <input type="text" name="address_longitude" id="address-longitude" value="0" />
					</div>
					<div id="address-map-container" style="width:100%;height:400px; ">
					    <div style="width: 100%; height: 100%" id="address-map"></div>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXag1Tt3SDyc_RWQQcsCrs3Ez7dRWwBEo&libraries=places&callback=initialize" async defer></script>


<script>
	function initialize() {

    $('form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            console.log(1);
            return false;
        }
    });
    const locationInputs = document.getElementsByClassName("map-input");

    const autocompletes = [];
    const geocoder = new google.maps.Geocoder;
    console.log(2);
    for (let i = 0; i < locationInputs.length; i++) {

        const input = locationInputs[i];
        const fieldKey = input.id.replace("-input", "");
        const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

        const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
        const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

        const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
            center: {lat: latitude, lng: longitude},
            zoom: 13
        });
        const marker = new google.maps.Marker({
            map: map,
            position: {lat: latitude, lng: longitude},
        });

        marker.setVisible(isEdit);

        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.key = fieldKey;
        autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
        console.log(3);
    }

    for (let i = 0; i < autocompletes.length; i++) {
        const input = autocompletes[i].input;
        const autocomplete = autocompletes[i].autocomplete;
        const map = autocompletes[i].map;
        const marker = autocompletes[i].marker;

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            marker.setVisible(false);
            const place = autocomplete.getPlace();

            console.log("lat: ",JSON.stringify(place.geometry.location.lat()));
            console.log("long: ",JSON.stringify(place.geometry.location.lng()));

            $("#address-latitude").val(JSON.stringify(place.geometry.location.lat()));
		    $("#address-longitude").val(JSON.stringify(place.geometry.location.lng()));







            geocoder.geocode({'placeId': place.place_id}, function (results, status) {
            	console.log(results,status);
                if (status === google.maps.GeocoderStatus.OK) {
                    const lat = results[0].geometry.location.lat();
                    const lng = results[0].geometry.location.lng();
                    setLocationCoordinates(autocomplete.key, lat, lng);
                     console.log(47);
                }
            });

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                input.value = "";
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

        });
         console.log(4);
    }
}

function setLocationCoordinates(key, lat, lng) {
	console.log(5);
    const latitudeField = document.getElementById(key + "-" + "latitude");
    const longitudeField = document.getElementById(key + "-" + "longitude");
    latitudeField.value = lat;
    longitudeField.value = lng;
}









</script>
























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
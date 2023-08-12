@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Address edit</title>
@endsection
@section('left_part')
@include('vandor.includes.left_part')
<style>
    .form-horizontal .form-group{
        margin-left: 0px !important;
        margin-right: 0px !important;
    }
</style>
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
                    <h4 class="pull-left page-title">Address edit </h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{route('vandor.dashboard')}}">Utsavlife</a></li>
                        <li class="active"> Address edit </li>
                    </ol>
                </div>
                
            </div>
            @include('vandor.includes.message')
            
            <div class="row">
                <div class="col-lg-12">
                    
                    <div>
                        <!-- Personal-Information -->
                        <div class="panel panel-default panel-fill">
                            <div class="panel-body rm02 rm04">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Edit Address</h3>
                                    <div class="add-btn "><a href="{{route('vandor.address.list')}}"><i class="icofont-minus-circle"></i> Back</a></div>
                                </div>
                                
                                <form method="POST" action="{{ route('vandor.address.update') }}"  class="form-horizontal m-t-20" id="reg_form">
                                    @csrf
                                    <input type="hidden" name="id" value="{{@$id}}">
                                    
                                    
                                    <div class="form-group">
                                        <label for="address_address">Shop Address</label>
                                        <input type="text" id="address-input" name="address_address" class="form-control map-input" value="{{@$address->address_address}}">
                                        <input type="hidden" name="address_latitude" id="address-latitude" value="{{@$address->lat}}" />
                                        <input type="hidden" name="address_longitude" id="address-longitude" value="{{@$address->lng}}" />
                                    </div>
                                   {{--  <div class="form-group">
                                        <label for="address_address">Area covered (km)</label>
                                         <p>You are covering your service and providing services withing that of radius.</p>
                                        <input type="number"  name="distance_cover" class="form-control" value="{{@$address->distance_cover}}">
                                    </div> --}}



                                      <div class="form-group">
                                        <label for="FullName">Country</label>
                                        <select class="form-control" name="country" style="background: #d5d7f3">
                                           @php
                                           $allCountry=DB::table('tbl_countries')->get();
                                           @endphp

                                           <option value="">Select</option>
                                           @foreach($allCountry as $val)
                                            <option value="{{$val->id}}" @if(@$val->id==@$address->country) selected  @endif>{{@$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div id="address-map-container" style="width:100%;height:300px; ">
                                        <div style="width: 100%; height: 100%" id="address-map"></div>
                                    </div>
                                    
                                    
                                    <button class="btn btn-primary btn-lg w-lg waves-effect waves-light rm01" style="margin-top:200px"  type="submit">edit</button>
                                    
                                    
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
$('#reg_form').validate({
rules:{

address_longitude:{
required:true,
minlength:5,
},
address_latitude:{
required:true,
minlength:5,
},
address_address:{
required:true,
minlength:5,
},
distance_cover:{
required:true,
}
},
messages:{
email:{
required:"Please enter a email address.",
},
password:{
required:"Please enter a password. ",
}
}
});
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb3u4WhswXfkedBokSesulamIrCWhskG4&libraries=places&callback=initialize" async defer></script>
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
@endsection
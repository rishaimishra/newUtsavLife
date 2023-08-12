@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Registration</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}










<div class="section_padding" style="background: #f6f6f6;">
    <div class="container">
        <div class="bred_cum">
            <ul>
                <li><a href="{{route('cust.first.route')}}">Home</a></li>
                <li><a href="#">Sign Up</a></li>
            </ul>
        </div>
        <div class="row">
           @include('vandor.includes.message')
            @if(@$success)
           <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>
                    {{@$success}}
                </strong>
            </div>
            @endif

            <div class="col-md-6 m-auto">
                <div class="login_header">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="{{route('cust.registration.view')}}" class="nav-link" >Customer Registration</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{route('vandor.registration.view')}}" class="nav-link active">Vendor  Registration</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{route('agent.registration.view')}}" class="nav-link">Agent Registration</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-5" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="home-tab">
                        
                        <div class="login_form shadow">
                             <form  method="POST" action="{{ route('vandor.registration.new.post') }}" id="reg_form" >
                                @csrf
                                <input type="hidden" name="user_type" value="customer">
                                <div class="form_title">
                                    <h4>Create An Account (Vendor)</h4>
                                   
                                    <p>Allready Sign Up? <a href="{{route('vandor.login.view')}}">Login</a></p>
                                   
                                </div>
                                <div class="input_tiles">
                                    <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Name" value="{{@$data->name}}" >
                                    <span><i class="fa-regular fa-user"></i></span>
                                </div>
                                <div class="input_tiles">
                                     <input id="email" type="email" class="form-control input-lg" name="email"   placeholder="Email" value="{{@$data->email}}" >
                                    <span><i class="fa-regular fa-envelope"></i></span>
                                </div>
                                <div class="input_tiles">
                                   <input id="mobile" type="text" class="form-control input-lg" name="mobile" placeholder="Mobile" value="{{@$data->mobile}}" style="padding-left: 75px;" >
                                    <span><i class="fa-solid fa-phone"></i></span>
                                    <b style="position: absolute;left: 39px;font-size: 1rem;color: #777;top: 24px;line-height: 0;font-weight: 400;font-family: sans-serif;">+91</b>
                                </div>
                                <div class="input_tiles">
                                     <input id="password" type="password" class="form-control input-lg" name="password" placeholder="Password" value="" >
                                    <span><i class="fa-solid fa-lock"></i></span>
                                </div>
                                


                                  {{-- For Address Start --}}
                             {{-- <div class="form-group">
                                <label for="address_address">Address</label>
                                <input type="text" id="address-input" name="address_address" class="form-control map-input">
                                <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                                <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                            </div> --}}




{{-- uncmnt --}}
                            {{-- <div class="form-group">
                              <label for="address_address">Area covered (Km radius)</label>
                              <input type="number"  name="distance_cover" class="form-control" value="10">
                            </div> --}}

                            
                           
                            
                            {{-- end address --}}



                                
                                <div class="input_footer">
                                    <input type="submit" class="btn btn_shadow_theme" value="CREATE ACCOUNT" name="">
                                </div>
                            </form>




                          
                            <div class="input_footer mt-4">
                                <span>Create Account Using Social Media</span>
                            </div>
                            <div class="social_login">
                                <a href="{{route('login.social',['user_type'=>'vandor','provider_type'=>'facebook'])}}" ><img src="{{url('/')}}/public/newDesignAsset/dist/images/fb.png"></a>
                                <a href="{{route('login.social',['user_type'=>'vandor','provider_type'=>'google'])}}"  ><img src="{{url('/')}}/public/newDesignAsset/dist/images/google.png"></a>
                            </div>
                           
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

















@include('Customer.includes.new_footer')
<!-- Js File -->
@section('script')
@include('Customer.includes.new_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
jQuery.validator.addMethod("validate_email", function(value, element) {
if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
return true;
} else {
return false;
}
}, "Please enter a valid email address.");
jQuery.validator.addMethod("mobileonly", function(value, element) {
return this.optional(element) ||  /^[+]?\d+$/.test(value.toLowerCase());
}, "Enter valid number");
$('#reg_form').validate({
rules:{
email:{
required:true,
validate_email:true
},
password:{
required:true,
minlength:6,
},
name:{
required:true,
minlength:3,
},
mobile:{
required:true,
mobileonly:true,
minlength:10,
maxlength:10,
},
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
},

 city:{
    required:true,
    },
    state:{
    required:true,
    },
    house_no:{
    required:true,
    },
    kyc_type:{
    required:true,
    },
    kyc_no:{
    required:true,
    },
    pan_card:{
    required:true,
    },
    landmark:{
    required:true,
    },
    area:{
    required:true,
    },
    pin_code:{
    required:true,
    },
    address_type:{
    required:true,
    },


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
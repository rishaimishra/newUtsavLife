<style>
    /* -- line dot Active form --  */
    .wraper {
      padding: 50px;
      text-align: center;
      width: 100%;
      margin: 10px auto;
    }
    h1 {
      margin: 50px auto;
    }
    .contain {
      border-top: 2px solid #000;
      display: flex;
      list-style: none;
      padding: 0;
      justify-content: space-between;
      align-items: stretch;
      align-content: stretch;
    }
    .link {
      position: relative;
      margin-top: 10px;
      width: 100%;
    }
    .link a {
      font-weight: bold;
      text-decoration: none;
      color: black;
      text-transform: capitalize;
      font-size: 15px;
    }
    .link:first-child {
      margin-left: -180px;
    }
    .link:last-child {
      margin-right: -180px;
    }
    .link::after {
      content: "";
      width: 15px;
      height: 15px;
      background: #fff;
      position: absolute;
      border-radius: 10px;
      top: -18px;
      left: 50%;
      transform: translatex(-50%);
      border: 2px solid black;
    }
    .active::after,
    .link:hover::after {
      background: black;
    }
    p.lead {
      font-weight: 600;
      margin: 50px auto;
      line-height: 1.5;
    }

    /* -- for page --  */
    .login_wrap_area, .social-login-wrap {
        box-shadow: none !important;
    }
    .heading-login {
        text-align: left;
    }
    .login_wrap_area .form-group input {
        background: #d5d7f3 !important;
        border: none !important;
        height: 45px !important;
        padding-left: 20px !important;
        font-size: 16px !important;
        width: 100% !important;
    }
    label {
        text-align: left;
        width: 100%;
    }
    select {
        background: #d5d7f3;
        border: none;
        height: 45px;
        padding-left: 20px;
        font-size: 16px;
        width: 100%;
        border-radius: 5px;
    }
    .error {
        color: red;
        font-size: 14px;
    }
    .sub-btn {
        display: flex;
        justify-content: space-between;
    }
</style>
@extends('vandor.layouts.app')
@section('title')
<title>Utsavlife | Vendor | Registration</title>
@endsection
@include('vandor.includes.headAuth')
@section('content')
<!-- Preeloader -->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_four"></div>
            <div class="object" id="object_five"></div>
        </div>
    </div>
</div>
<!-- Click Sarch bar -->
<div class="common-overlay"></div>
<!-- Preeloader -->
<!-- register area start -->
<section class="login-area-content">
    <div class="container">
        {{-- -- start line dot Active form -- --}}
     <div class="wraper">
        <ul class="contain">
          <li class="link active"><a href="{{route('vandor.registration.get')}}">Vendor</a></li>
          <li class="link"><a href="{{route('vandor.reg.two.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Service</a></li>
          <li class="link"><a href="{{route('vandor.reg.three.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Payment</a></li>
          <li class="link"><a href="{{route('vandor.reg.four.get',['email'=>Auth::user()->email,'id'=>Auth::user()->id])}}">Documents</a></li>
        </ul>
      </div>
      {{-- -- end line dot Active form -- --}}
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="login_wrap_area">
                    <div class="loginwrap">
                       
                        <div class="heading-login">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:15px">
                            <h1 style="font-size:18px">Part-1</h1>
                            <a class="btn btn-primary" href="{{route('vandor.dashboard')}}">DashBoard</a>
                            </div>
                            
                           
                           @include('vandor.includes.message')
                            @if(@$success)
                           <div class="alert alert-success">
                              <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>
                                    {{@$success}}
                                </strong>
                            </div>
                            @endif
                        </div>
                        <form  method="POST" action="{{ route('vandor.registration.post') }}" id="reg_form" >
                            @csrf
                            <h2 style="font-size: 20px;text-align: left;margin-bottom: 20px;">Vendor information </h2>
                            <div class="form-group">
                                <label>Name</label>
                                <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Name" value="{{@$data->name}}" disabled >
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control input-lg" name="email"   placeholder="Email" value="{{@$data->email}}" disabled >
                            </div>
                            
                            {{-- <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control input-lg" name="password" placeholder="Password" value="" >
                            </div> --}}
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input id="mobile" type="text" class="form-control input-lg" name="mobile" placeholder="Mobile" value="{{@$data->mobile}}" disabled >
                            </div>
                            <div class="form-group">
                                <label>Pan Card No.</label>
                                <input id="pan_card" style="text-transform:uppercase" type="text" class="form-control input-lg" name="pan_card" placeholder="Pan Card No" value="{{@$data->VandorDetails->pan_card}}" >
                            </div>
                            <div class="form-group">
                                <label>Kyc Type</label>
                                <br>
                                <select name="kyc_type" id="kyc_type" onchange="kycValidation()">
                                    <option value="">Select Kyc Type</option>
                                    <option value="VO" @if(@$data->VandorDetails->kyc_type=="VO") selected @endif>Voter Card</option>
                                    <option value="AD" @if(@$data->VandorDetails->kyc_type=="AD") selected @endif>Aadher card</option>
                                    <option value="PA" @if(@$data->VandorDetails->kyc_type=="PA") selected @endif>Passport</option>
                                    <option value="DL" @if(@$data->VandorDetails->kyc_type=="DL") selected @endif>Driving Licensce</option>
                                    <option value="OT" @if(@$data->VandorDetails->kyc_type=="OT") selected @endif>Other Govt. Id</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>ID No.</label>
                                <input id="kyc_no" type="text" class="form-control input-lg" name="kyc_no" placeholder="ID No" value="{{@$data->VandorDetails->kyc_no}}" >
                            </div>
                            <div class="form-group">
                                <label >Pin code</label>
                                <input type="number" placeholder="Pin Code" name="pin_code" id="pin_code" class="form-control" value="{{@$data->VandorDetails->pin_code}}" >
                            </div>
                            <div class="form-group mt-3">
                                <label >House No/Flat No/ Building No</label>
                                <input type="text" placeholder="House No" name="house_no" id="house_no" class="form-control" value="{{@$data->VandorDetails->house_no}}" >
                            </div>
                            <div class="form-group">
                                <label >Area</label>
                                <input type="text" name="area" placeholder="Area" id="area" class="form-control" value="{{@$data->VandorDetails->area}}" >
                            </div>
                            <div class="form-group mt-3">
                                <label >Landmark</label>
                                <input type="text" placeholder="Landmark" name="landmark" id="landmark" class="form-control" value="{{@$data->VandorDetails->landmark}}" >
                            </div>
                            <br>

                            <div class="form-group mt-3">
                                <label for="FullName">Country</label>
                                <select class="form-control" name="country" style="background: #d5d7f3">
                                   @php
                                   $allCountry=DB::table('tbl_countries')->get();
                                   @endphp

                                   <option value="">Select</option>
                                   @foreach($allCountry as $val)
                                    <option value="{{$val->id}}" @if(@$val->id==@$data->VandorDetails->country) selected  @endif>{{@$val->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group mt-3">
                                <label >City</label>
                                <input type="text" name="city" placeholder="City" id="city" class="form-control" value="{{@$data->VandorDetails->city}}" >
                            </div>
                            <div class="form-group mt-3">
                                <label >State</label>
                                <input type="text" name="state" placeholder="State" id="state" class="form-control"  value="{{@$data->VandorDetails->state}}">
                            </div>
                            
                            
                            
                            {{-- For Address Start --}}
                            {{--  <div class="form-group">
                                <label for="address_address">Address</label>
                                <input type="text" id="address-input" name="address_address" class="form-control map-input">
                                <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                                <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                            </div>
                            <label for="address_address">Distance covered (km)</label>
                            <input type="number"  name="distance_cover" class="form-control" value="10">
                            --}}
                            
                            {{-- end address --}}
                            <input type="hidden" name="btn" id="btnVal">
                            
                            <div class="form-group sub-btn">
                                <button onclick="functionSave()" class="btn btn-primary" > Save</button>
                                <button onclick="functionNext()"  class="btn btn-primary" > Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>








            <div class="col-lg-12" style="display:none;">
                <div class="social-login-wrap">
                    <div class="heading-login">
                        <h1 class="mb-5">Create Account Using Social Media</h1>
                        
                        <p class="mb-30">Already Have Account <a href="{{route('vandor.login.view')}}">Login</a></p>
                        
                    </div>
                    
                    <div class="scial-login mt-115">
                        <a href="{{route('login.social',['user_type'=>'vandor','provider_type'=>'facebook'])}}" class="social-login facebook-login">
                            <i class="fab fa-facebook"></i>
                            <span>Continue with Facebook</span>
                        </a>
                        <a href="{{route('login.social',['user_type'=>'vandor','provider_type'=>'google'])}}" class="social-login google-login">
                            <i class="fab fa-google"></i>
                            <span>Continue with Google</span>
                        </a>
                        
                    </div>
                    
                </div>
                <div id="address-map-container" style="width:100%;height:400px; ">
                    <div style="width: 100%; height: 100%" id="address-map"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@include('vandor.includes.scriptAuth')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>

function functionSave(){
    // console.log(1)
    $("#btnVal").val('save');
    $('#reg_form')[0].submit();
}



// $(document).ready(function(){
function functionNext(){
    $("#btnVal").val('next');
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
}
// });
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



<script>
    function kycValidation(){
        var dkyc=$("#kyc_type").val();
           // alert(dkyc)
           if(dkyc=="AD"){
            $("#kyc_no").attr({
               "maxlength" : 16,        // substitute your own
               "minlength" : 16,      // values (or variables) here
            });
            $('#kyc_no').attr('type', 'number');
           }
           else if(dkyc=="VO"){
            $("#kyc_no").css('text-transform','uppercase');
            $('#kyc_no').attr('type', 'text');
           }
           else{
            $('#kyc_no').attr('type', 'text');
            }
    }
</script>
@endsection
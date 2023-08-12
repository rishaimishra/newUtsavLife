<style>
    .buy-product {
    position: relative;
    display: flex;
    padding: 14px 26px;
    border-radius: 4px;
    background-color: #0264a5;
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    align-items: center;
    border: none;
    text-transform: uppercase;
    }
    .buy-product:hover {
    background-color: #041b52;
    }
    .text-brand.text-end {
    font-size: 16px;
    }
    .form-control {
    background: #d5d7f3 !important;
    }
    .form-control:focus {
    box-shadow: none !important;
    }
    .select-form {
    padding: 10px;
    border-radius: 5px;
    border: none;
    width: 100%;
    background: #d5d7f3;
    }
    </style>
    @extends('Customer.layouts.app')
    @section('title')
    <title>Utsavlife - Indias largest event organising company</title>
    @endsection
    @include('Customer.includes.head-cart')
    @include('Customer.includes.new_header')
    <style>
        .box_form_address {
            padding: 30px;
            border: none;
            background-color: #fefefe;
            margin-top: 30px;
        }
        .box_form_address input[type="text"] , .box_form_address select , .box_form_address input[type="number"]{
            width: 100%;
            outline: none;
            border: 1px solid #d2d2d2;
            border-radius: 5px;
            padding: 15px 40px 15px 15px;
            background-color: #fff !important;
            font-size: 14px;
        }
    </style>
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
    <section class="section_padding" style="background: #f6f6f6;">
        <div class="container">

            <div class="cart-itmes">
                <div class="row">
                    <div class="bred_cum">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="#">Add Address</a></li>
                        </ul>
                    </div>
                    {{--  <a href="{{route('cust.service.address.page')}}">Back</a>  --}}
                     @include('Customer.includes.message')
                    <button onclick="fetchAddres()" style="border: none;
                                                    background: #0264a5;
                                                    color: #fff;
                                                    padding: 10px 12px;
                                                    width: fit-content;
                                                    margin-left: 12px;
                                                    border-radius: 5px;"
                     class="mt-4">Fetch Address</button>

                    <form method="POST" action="{{ route('cust.address.ins') }}"  class="form-horizontal m-t-20 box_form_address" id="reg_form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label >Customer Name</label>
                                    <input type="text" name="billing_name" id="billing_name" placeholder="Customer Name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label >Customer Mobile</label>
                                    <input type="number" name="billing_mobile" id="billing_mobile" placeholder="Customer Mobile" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group my-3">
                                    <label for="address_address">Delivary Address</label>
                                    <input type="text" id="address-input" name="address_address" placeholder="Delivery Address" class="form-control map-input" ">
                                    <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                                    <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label >Pin code</label>
                                    <input type="number" name="pin_code" id="pin_code" class="form-control" placeholder="Pin Code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label >House No/Flat No/ Building No</label>
                                    <input type="text" name="house_number" id="house_number" class="form-control" placeholder="House No">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label >Area, Street, Village, sector</label>
                                    <input type="text" name="area" id="area" class="form-control" placeholder="Area, Street, Village">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label >Landmark</label>
                                    <input type="text" name="landmark" id="landmark" class="form-control" placeholder="Landmark">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label for="FullName">Country</label>
                                    <select class="form-control" name="country" style="background: #d5d7f3">
                                       @php
                                       $allCountry=DB::table('tbl_countries')->get();
                                       @endphp

                                       <option value="">Select</option>
                                       @foreach($allCountry as $val)
                                        <option value="{{$val->id}}" >{{@$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 form-group mt-3">
                                <label >City</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="City">
                            </div>
                            <div class="col-md-6 col-12 form-group mt-3">
                                <label >State</label>
                                <input type="text" name="state" id="state" class="form-control" placeholder="State">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label >For Address</label>
                                    <br>
                                    <select name="for_address" id="for_address" class="select-form">
                                        <option value="self">Self</option>
                                        <option value="family">Family</option>
                                        <option value="friend">Friend</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label >Location Type</label>
                                    <br>
                                    <select name="address_type" id="address_type" class="select-form">
                                        <option value="home">Home</option>
                                        <option value="office">Office</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                         <br>
                        <div class="form-group">
                        <label >Do you want this address as Default Address?</label>
                            <br>
                            <input type="radio" id="default_address" name="default_address" value="N">No
                            <input type="radio" id="default_address" name="default_address" value="Y">Yes
                        </div>
                        <br>

                        <div>
                            <div id="address-map-container" style="width:100%;height:300px; display: none;">
                                <div style="width: 100%; height: 300px" id="address-map"></div>
                            </div>
                        </div>



                        <button class="btn btn-primary btn-lg w-lg waves-effect waves-light rm01 mt-5"  type="submit">Add Address</button>

                    </form>

                </div>
            </div>
        </section>
        {{-- cart part end --}}
        <!-- End Right content here -->
        @section('footer')
        @include('Customer.includes.new_footer')
        @endsection
        @endsection
        {{-- end content --}}
        @section('script')
        {{-- @include('Customer.includes.script') --}}

      <script src="{{url('/')}}/public/adminasset/assets/js/modernizr.min.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/jquery-3.6.0.min.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/popper.min.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/bootstrap.min.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/owl.carousel.min.js"></script>

        <script src="{{url('/')}}/public/adminasset/assets/js/slick.js"></script>

        <script src="{{url('/')}}/public/adminasset/assets/js/jquery.magnific-popup.min.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/jquery.waypoints.min.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/jquery.counterup.min.js"></script>

        <script src="{{url('/')}}/public/adminasset/assets/js/countdown.min.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/typeit.min.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/isotope.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ "></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/vticker.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/jquery.lineProgressbar.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/ajax-form.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/mobile-menu.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/shop.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/jquery.elevatezoom.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/jquery-ui.js"></script>
        <script src="{{url('/')}}/public/adminasset/assets/js/script.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>

        <script>
        $(document).ready(function(){
        $('#reg_form').validate({
        rules:{
        address_longitude:{
        required:true,
        },
        address_latitude:{
        required:true,
        },
        address_address:{
        required:true,
        minlength:5,
        },
        city:{
        required:true,
        },
        state:{
        required:true,
        },
        house_number:{
        required:true,
        },
        billing_name:{
        required:true,
        },
        billing_mobile:{
        required:true,
        },
        for_address:{
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
        <script>
        function addressType(val){
        // alert(val);
        if(val=="new"){
        $("#default_address").show();
        $("#address-input").val('');
        $("#address-latitude").val('');
        $("#city").val("");
        $("#state").val("");
        $("#house_number").val("");
        $("#billing_name").val("");
        $("#billing_mobile").val("");
        $("#for_address").val("");
        $("#landmark").val('');
        $("#area").val('');
        $("#pin_code").val("");
        $("#address_type").val('');
        initMap();
        }else{
        //ajax call to get address details
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
        });
        var addressId=$("#addressId").val();
        var fd= new FormData;
        fd.append('address_id',addressId);
        $.ajax({
        url:'{{route('cust.find.address')}}',
        type:'POST',
        data: fd,
        contentType: false,
        processData: false,

        success:function(res){
        //console.log(res.id.name,res.subject.name);
        console.log(res);
        $("#default_address").hide();
        $("#address-input").val(res.data.address);
        $("#address-latitude").val(res.data.lat);
        $("#address-longitude").val(res.data.long);
        $("#city").val(res.data.city);
        $("#state").val(res.data.state);
        $("#house_number").val(res.data.house_number);
        $("#billing_name").val(res.data.billing_name);
        $("#billing_mobile").val(res.data.billing_mobile);
        $("#for_address").val(res.data.for_address);
        $("#landmark").val(res.data.landmark);
        $("#area").val(res.data.area);
        $("#pin_code").val(res.data.pin_code);
        $("#address_type").val(res.data.address_type);


        }
        });

        initMap(res.data.lat,res.data.long);
        }

        function initMap(lat,long) {
        var uluru = {lat: lat, lng: long };
        var map = new google.maps.Map(document.getElementById('address-map-container'), {
        zoom: 14,
        center: uluru
        // You can set more attributes value here like map marker icon etc
        });
        var marker = new google.maps.Marker({
        position: uluru,
        map: map
        });
        }
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb3u4WhswXfkedBokSesulamIrCWhskG4&libraries=places&callback=initialize" async defer></script>
        <script>
        function initialize() {
        $('form').on('keyup keypress', function (e) {
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
                center: { lat: latitude, lng: longitude },
                zoom: 13
            });


            const marker = new google.maps.Marker({
                map: map,
                position: { lat: latitude, lng: longitude },
            });


            marker.setVisible(isEdit);
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.key = fieldKey;
            autocompletes.push({ input: input, map: map, marker: marker, autocomplete: autocomplete });
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
                console.log("lat: ", JSON.stringify(place.geometry.location.lat()));
                console.log("long: ", JSON.stringify(place.geometry.location.lng()));
                $("#address-latitude").val(JSON.stringify(place.geometry.location.lat()));
                $("#address-longitude").val(JSON.stringify(place.geometry.location.lng()));
                geocoder.geocode({ 'placeId': place.place_id }, function (results, status) {
                    console.log(results, status);
                    if (status === google.maps.GeocoderStatus.OK) {
                        //get post code start
                        // console.log("p");
                        console.log(results[0].address_components.length);

                        for (var i = 0; i < results[0].address_components.length; i++) {
                            var types = results[0].address_components[i].types;
                            // console.log(types.);
                            for (var typeIdx = 0; typeIdx < types.length; typeIdx++) {
                                if (types[typeIdx] == 'postal_code') {
                                    //console.log(results[0].address_components[i].long_name);
                                    console.log(results[0].address_components[i].short_name);
                                    $("#pin_code").val(results[0].address_components[i].short_name);
                                }
                            }
                        }
                        // console.log("end");
                        const lat = results[0].geometry.location.lat();
                        const lng = results[0].geometry.location.lng();
                        // setLocationCoordinates(autocomplete.key, lat, lng);
                        console.log(47999999999999999);
                        initMap((place.geometry.location.lat()), (place.geometry.location.lng()));

                        function initMap(lat, long) {
                            var uluru = { lat: lat, lng: long };
                            var map = new google.maps.Map(document.getElementById('address-map-container'), {
                                zoom: 14,
                                center: uluru
                                // You can set more attributes value here like map marker icon etc
                            });
                            var marker = new google.maps.Marker({
                                position: uluru,
                                map: map
                            });
                        }
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
        </script >






    {{-- fetch address code --}}


    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
        <script>
            function fetchAddres(){
                var map, infoWindow;

            infoWindow = new google.maps.InfoWindow;

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {

                    var Lat = position.coords.latitude;
                    var Long = position.coords.longitude;
                    console.log(Lat, Long)
                    getGeoLocation(Lat,Long)

                }, function () {
                    //error
                    alert("error");
                });
            } else {

                // Browser doesn't support Geolocation
                alert("Browser doesn't support Geolocation");

            }
          }


            function getGeoLocation(Lat,Long){


                $.ajax({
                url:`https://maps.googleapis.com/maps/api/geocode/json?latlng=${Lat},${Long}&key=AIzaSyBb3u4WhswXfkedBokSesulamIrCWhskG4`,
                type:'GET',
                // contentType: false,
                // processData: false,

                success:function(res){
                console.log(res.results[0].address_components[8],res.results[2].formatted_address);
                $("#address-latitude").val(Lat);
                $("#address-longitude").val(Long);

                //address
                $("#address-input").val(res.results[2].formatted_address);




                  //find state for administrative_area_level_1
                  var state="";
                 for (var i=0; i<res.results[0].address_components.length; i++) {
                        for (var b=0;b<res.results[0].address_components[i].types.length;b++) {

                        //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                            if (res.results[0].address_components[i].types[b] == "administrative_area_level_1") {
                                //this is the object you are looking for
                                state= res.results[0].address_components[i];
                                console.log(state)
                                $("#state").val(state.long_name);
                                break;
                            }
                        }
                    }


                    // country for country
                     var country="";
                     for (var i=0; i<res.results[0].address_components.length; i++) {
                            for (var b=0;b<res.results[0].address_components[i].types.length;b++) {

                            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                                if (res.results[0].address_components[i].types[b] == "country") {
                                    //this is the object you are looking for
                                    country= res.results[0].address_components[i];
                                    console.log(country)
                                    break;
                                }
                            }
                        }



                      // postal_code for postal_code
                     var postal_code="";
                     for (var i=0; i<res.results[0].address_components.length; i++) {
                            for (var b=0;b<res.results[0].address_components[i].types.length;b++) {

                            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                                if (res.results[0].address_components[i].types[b] == "postal_code") {
                                    //this is the object you are looking for
                                    postal_code= res.results[0].address_components[i];
                                    console.log(postal_code)
                                    $("#pin_code").val(postal_code.long_name);
                                    break;
                                }
                            }
                        }



                      // city for city
                     var city="";
                     for (var i=0; i<res.results[0].address_components.length; i++) {
                            for (var b=0;b<res.results[0].address_components[i].types.length;b++) {

                            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                                if (res.results[0].address_components[i].types[b] == "locality") {
                                    //this is the object you are looking for
                                    city= res.results[0].address_components[i];
                                    console.log(city)
                                    $("#city").val(city.long_name);
                                    break;
                                }
                            }
                        }








                }//end success
                });

            }

        </script>

        @endsection

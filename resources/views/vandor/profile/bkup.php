

<h1>Driver Details</h1>

<form action="{{route('vandor.driver.details.update')}}"  id="frm3" method="post" enctype="multipart/form-data"> 
@csrf
							<p>Same as Your Details?</p>

							<input type="radio" name="getDetails" onclick="getDetailsFun(this.value);" value="Y" />Yes
                            <input type="radio" name="getDetails" onclick="getDetailsFun(this.value);" value="N" />No
							<div class="form-group">
								<label>Driver Name</label>
								<input id="driver_name" type="text" class="form-control input-lg" name="driver_name" placeholder="Driver Name" value="{{@auth::user()->VandorDetails->driver_name}}" >
							</div>
							<div class="form-group">
								<label>Driver Mobile Number</label>
								<input id="driver_mobile_no" type="text" class="form-control input-lg" name="driver_mobile_no" placeholder="driver_mobile_no" value="{{@auth::user()->VandorDetails->driver_mobile_no}}" >
							</div>
							<div class="form-group">
								<label>Driver Kyc Type</label>
								<br>
								<select name="driver_kyc_type" id="driver_kyc_type" {{-- onchange="kyctypechange(this.value)" --}}>
									<option value="">Select Kyc Type</option>
									<option value="VO" @if(@auth::user()->VandorDetails->driver_kyc_type=="VO") selected @endif>Voter Card</option>
									<option value="AD" @if(@auth::user()->VandorDetails->driver_kyc_type=="AD") selected @endif>Aadher card</option>
									<option value="PA" @if(@auth::user()->VandorDetails->driver_kyc_type=="PA") selected @endif>Passport</option>
									<option value="DL" @if(@auth::user()->VandorDetails->driver_kyc_type=="DL") selected @endif >Driving Licensce</option>
									<option value="OT" @if(@auth::user()->VandorDetails->driver_kyc_type=="OT") selected @endif>Other</option>
								</select>
							</div>
							<div class="form-group">
								<label>Driver ID No.</label>
								<input id="dricer_kyc_no" type="text" class="form-control input-lg" name="dricer_kyc_no" placeholder="Driver ID No" value="{{@auth::user()->VandorDetails->dricer_kyc_no}}" >
							</div>
							<div class="form-group">
								<label>Driving License No</label>
								<input id="driver_licence_no" type="text" class="form-control input-lg" name="driver_licence_no" placeholder="driver licence no" value="{{@auth::user()->VandorDetails->driver_licence_no}}" >
							</div>

<div class="col-lg-12">
				<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update</button>
			</div>
	
</form>






<br>








	<h1> Driver address</h1>
<form action="{{route('vandor.driver.address.update')}}" id="frm4" method="post" enctype="multipart/form-data">
@csrf
							<p>Same address as Your Address?</p>

							<input type="radio" name="driverAddress" onclick="getAddressForDriver(this.value);" value="Y" />Yes
                            <input type="radio" name="driverAddress" onclick="getAddressForDriver(this.value);" value="N" />No
							<div class="form-group">
								<label >Driver Pin code</label>
								<input type="number" name="driver_pincode" id="driver_pincode" class="form-control" value="{{@auth::user()->VandorDetails->driver_pincode}}" >
							</div>
							<div class="form-group mt-3">
								<label >Driver House No</label>
								<input type="text" name="driver_house_no" id="driver_house_no" class="form-control" value="{{@auth::user()->VandorDetails->driver_house_no}}" >
							</div>
							<div class="form-group">
								<label >Driver Area</label>
								<input type="text" name="driver_area" id="driver_area" class="form-control" value="{{@auth::user()->VandorDetails->driver_area}}" >
							</div>
							<div class="form-group mt-3">
								<label >Driver Landmark</label>
								<input type="text" name="driver_landmark" id="driver_landmark" class="form-control" value="{{@auth::user()->VandorDetails->driver_landmark}}" >
							</div>
							<br>
							<div class="form-group mt-3">
								<label >Driver City</label>
								<input type="text" name="driver_city" id="driver_city" class="form-control" value="{{@auth::user()->VandorDetails->driver_city}}" >
							</div>
							<div class="form-group mt-3">
								<label >Driver State</label>
								<input type="text" name="driver_state" id="driver_state" class="form-control"  value="{{@auth::user()->VandorDetails->driver_state}}">
							</div>

	<div class="col-lg-12">
				<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update</button>
			</div>

</form>


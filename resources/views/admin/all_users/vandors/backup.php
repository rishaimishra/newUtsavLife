backup.php
{{-- vandor driver details --}}

<div class="col-lg-12">
					
					<div>
						
						<div class="row">
							<div class="col-md-6">
								<!-- Personal-Information -->
								<div class="panel panel-default panel-fill">
									<div class="panel-heading">
										<h3 class="panel-title">vandor driver Information</h3>
									</div>
									<div class="panel-body">
										<div class="about-info-p">
											<strong>pan card</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->pan_card}}</p>
										</div>
										
										
										<div class="about-info-p">
											<strong>Driver name</strong>
											<br>
											<p class="text-muted">
											{{@$vandor->vandorDetails->driver_name}}
										   </p>
										</div>
										<div class="about-info-p">
											<strong>Driver mobile no</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->driver_mobile_no}}</p>
										</div>
										<div class="about-info-p">
											<strong>Driver kyc type</strong>
											<br>
											<p class="text-muted">
												@if(@$vandor->vandorDetails->driver_kyc_type=="VO")
												<p>Voter card</p>
												@elseif(@$vandor->status=="AD")
												<p>Addhar card</p>
												@elseif(@$vandor->status=="PA")
												<p>Passport</p>
												@elseif(@$vandor->status=="DL")
												<p>Driving lisence</p>
												@else
												Other
											    @endif
											</p>
										</div>
										
										<div class="about-info-p">
											<strong>Driver kyc no</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->dricer_kyc_no}}</p>
										</div>
										
										<div class="about-info-p">
											<strong>Driver licence no</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->driver_licence_no}}</p>
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
										<h3 class="panel-title">Vandor Driver Address Information</h3>
									</div>
									<div class="panel-body">
										<div class="about-info-p">
											<strong>Driver Pin code</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->driver_pincode}}</p>
										</div>

										<div class="about-info-p">
											<strong>Driver house no</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->driver_house_no}}</p>
										</div>

										<div class="about-info-p">
											<strong>Driver area</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->driver_area}}</p>
										</div>

										<div class="about-info-p">
											<strong>Driver lankmark</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->driver_landmark}}</p>
										</div>

										<div class="about-info-p">
											<strong>Driver city</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->driver_city}}</p>
										</div>

										<div class="about-info-p">
											<strong>Driver state</strong>
											<br>
											<p class="text-muted">{{@$vandor->vandorDetails->driver_state}}</p>
										</div>
										
									</div>
								</div>
								
							</div>
							
						</div>
						
					</div>
				</div>




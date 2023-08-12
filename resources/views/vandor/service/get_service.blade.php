<label for="title">Service name</label>
<select name="service_id" class="form-control" id="serviceName" onchange="serviceNamefun()">
	<option value="">Select service</option>
	@foreach($allService as $val)
	<option name="{{@$val->service}}" value="{{@$val->id}}" >{{@$val->service}}</option>
	
	@endforeach
	
</select>


<script>
	// if val is car then show driver details
	function serviceNamefun(){
		var name=$( "#serviceName option:selected" ).text();
		var chk=name.toLowerCase().includes('Car'.toLowerCase());
     console.log("car",chk)
     if(chk==true){
     	//chk that card is there or not
     	var arr = ['Card','card'];
     	var status=true;
     	arr.forEach(function(item) {
		   	var cardChk=name.toLowerCase().includes(item.toLowerCase());
		   	if(cardChk==true){
		   		status=false
		   	}
		});
     
     	console.log("no card",status);
        if(status){
     	  $("#dd").show();
        }else{
        	$("#dd").hide();
     	
	     	$("#driver_name").val('');
			$("#driver_mobile_no").val('');
			$("#driver_kyc_type").val('');
			$("#dricer_kyc_no").val('');

	     	$("#driver_pincode").val('');
			$("#driver_house_no").val('');
			$("#driver_area").val('');
			$("#driver_landmark").val('');
			$("#driver_city").val('');
			$("#driver_state").val('');
        }
     }else{
     	$("#dd").hide();
     	
     	$("#driver_name").val('');
		$("#driver_mobile_no").val('');
		$("#driver_kyc_type").val('');
		$("#dricer_kyc_no").val('');

     	$("#driver_pincode").val('');
		$("#driver_house_no").val('');
		$("#driver_area").val('');
		$("#driver_landmark").val('');
		$("#driver_city").val('');
		$("#driver_state").val('');
     }
	}
</script>
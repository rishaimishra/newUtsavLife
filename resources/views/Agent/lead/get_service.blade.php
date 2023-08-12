<label for="title">Service name</label>
<select name="service_id">
	<option value="">Select servicesss</option>
	@foreach($allService as $val)
	<option value="{{@$val->id}}">{{@$val->service}}</option>
	
	@endforeach
	
</select>
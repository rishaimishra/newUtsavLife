<style>
	.pmnt-mthd input {
    margin-right: 5px;
		margin-bottom: 18px;
	}
</style>
@extends('Customer.layouts.app')
@section('title')
{{--
<title>Go Party | Customer | DASHBOARD</title>
--}}
<title>Utsavlife-Payment</title>
@endsection
@include('Customer.includes.head')
@include('Customer.includes.header')
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
<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
<style>
	.payment-heading {
		background: #0264a5;
width: 50%;
margin: 20px auto 0;
display: flex;
align-items: center;
justify-content: space-between;
padding: 10px;
border: 1px solid #0264a5;
	}
	.new-heading {
		color: #fff
	}
	.payment-table {
		border: 1px solid #0264a5;
		width: 50%;
	}
	.table-content {
	}
	table.table.table-wishlist {
    box-shadow: 0 0 20px #ddd;
    border: 1px solid #ddd;
    margin-top: 30px;
}
</style>
<div class="cart-itmes">
	<div class="container">
	<div class="row">
		@if(count(@$cart)>0)
		{{-- list portion of cart --}}
		<div class="col-lg-12 px-4">
			<div class="table-responsive shopping-summery">
				
				<table class="table table-wishlist">
					<thead>
						<tr class="main-heading">
							
							<th scope="col">Product</th>
							<th scope="col">Description</th>
							<th scope="col">Details</th>
							<th scope="col">Days</th>
							<th scope="col" style="white-space:pre">Base Price</th>
							<th scope="col">Quantity</th>
							<th scope="col">Total Price</th>
							
							
						</tr>
					</thead>
					<tbody>
						
						@foreach(@$cart as $row)
						<tr class="pt-30">
							
							<td class="image product-thumbnail pt-40"><img src="{{url('/')}}/storage/app/public/service/{{@$row->serviceDetails->image}}" alt="#">
								{{--  <img src="/storage/{{$row->image}}" class="w-100" alt="" /> --}}
								<br>
								<h6 class="mb-5"><a class="product-name mb-10 text-heading" href="{{route('cust.single.product',$row->serviceDetails->id)}}">{{$row->serviceDetails->service}} </a></h6>
							</td>
							<td class="product-des product-name">
								{{$row->serviceDetails->description}}
							</td>
							<td>
								<p><strong>Category:{{$row->categoryDetails->category_name}}</strong><br>
									<strong>Start Date:</strong>{{$row->order_date}}<br>
									<strong>End Date:</strong>{{$row->order_end_date}}<br>
								<strong>Shift:</strong>@if($row->time=="M")Morning @elseif($row->time=="N") Night @else Full Day @endif</p>
							</td>
							<td class="product-des product-name">
								{{$row->days}}
								
								
							</td>
							<td class="product-des product-name">
								{{$row->price}}
							</td>
							{{-- Form input field (quantity) --}}
							<td class="text-center detail-info" data-title="Stock">
								{{@$row->quantity}}
							</td>
							
							<td class="price" data-title="Price">
								<h4 class="text-body" id="total_price{{$row->id}}">{{$row->total_price}} </h4>
								
								
							</td>
							
							
						</tr>
						
						
						@endforeach
						
					</tbody>
				</table>
				<div class="row m-0 mt-4">

					<div class="col-lg-6 col-12 my-1 px-0">
						<div class="pmnt-mthd">
							<h1 style="font-size: 22px;color: #0264a5;margin-bottom: 10px;">Chosee Payment Status</h1>
							<input type="radio" name="paymentType" value="cod" onclick="onRadioChange()">COD
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="paymentType" value="online" onclick="onRadioChange()">Online
						</div>
						<div id="cod-place-order" style="display:none;">
							<a class="btn btn-primary" href="{{route('cust.order.cod')}}"> Place Order</a>
						</div>
						<div>
							<button class="btn btn-primary" onclick="formSubmitFun()" style="display:none;" id="ckout">Proceed</button>
						</div>
					</div>
					
					{{-- sub total portion --}}
					<div class="col-lg-6 col-12 my-1 px-0">
						<div class="border cart-subtotal p-md-4 cart-totals">
							<div class="table-responsive" style="overflow-x:hidden">
								<table class="table no-border">
									<tbody>
										<tr>
											<td class="cart_total_label">
												<p class="font-lg text-heading m-0">Subtotal</p>
											</td>
											<td class="cart_total_amount">
												<h4 class="text-brand text-end" id="subTotalText">{{@$total_price}}</h4>
												{{-- <input type="hidden" name="subTotal" id="subTotal" value="{{@$total_price}}"> --}}
											</td>
										</tr>
										
									</tbody>
								</table>
							</div>
							{{-- <a href="checkout.html" class="btn mb-20 w-100">Proceed To CheckOut</a> --}}
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="cart-action d-flex justify-content-between">
			{{-- <a class="btn ">Continue Shopping</a>
			<a class="btn  mr-10 mb-sm-15">Update Cart</a> --}}
		</div>
		<div class="row mt-50">
			<div class="col-lg-7">
				
			</div>
			<div class="col-lg-5">
				
			</div>
		</div>
	</div>
	</div>
	@else
	<div class="empty-state__icon">
		<img src="data:image/png;base64,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" alt="">
		<h4 class="empty-state__message">Cart is empty</h4>
	</div>
	@endif
	
	
	
	
</div>
</div>
</div>
















<form method="POST" id="paymntForm" name="customerData" action="{{route('cust.payment.ccavRequestHandler')}}" style="display: none;">
<div class="payment-heading">
<h4 class="new-heading m-0">Payment</h4>
<h4 class="new-heading m-0">Total Amount: {{@$total_price}}</h4>
</div>
{{-- <table width="40%" height="100" border='1' align="center"><caption><font size="4" color="blue"><b>Payment</b></font></caption></table> --}}
<table align="center" class="payment-table">
{{-- <tr>
<td>Parameter Name:</td><td>Parameter Value:</td>
</tr> --}}
{{-- <tr>
<td colspan="2"> Compulsory information</td>
</tr> --}}
<input type="hidden" name="tid" id="tid" readonly />
<input type="hidden" name="merchant_id" value="2090384"/>
<input type="hidden" readonly name="order_id" id="order_id" value="{{$cart_details->order_id}}"/>

<input type="hidden" name="amount" value="{{@$total_price}}"/>
<input type="hidden" name="currency" value="INR"/>
<input type="hidden" name="redirect_url" value="https://utsavlife.com/customer/ccavResponseHandler"/>
<input type="hidden" name="cancel_url" value="https://utsavlife.com/customer/ccavResponseHandler"/>
<input type="hidden" name="language" value="EN"/>
<input type="hidden" name="billing_name" value="{{@$cart_details->billing_name}}"/>
<input type="hidden" name="billing_address" value="{{@$cart_details->address}}"/>
<input type="hidden" name="billing_city" value="{{@$cart_details->event_city}}"/>
<input type="hidden" name="billing_state" value="{{@$cart_details->state}}"/>
<input type="hidden" name="billing_zip" value="{{@$cart_details->pin_code}}"/>
<input type="hidden" name="billing_country" value="India"/>
<input type="hidden" name="billing_tel" value="{{@$cart_details->billing_mobile}}"/>
<input type="hidden" name="billing_email" value="{{@Auth::user()->email}}"/>
<input type="hidden" name="delivery_name" value="{{@Auth::user()->name}}"/>
<input type="hidden" name="delivery_address" value="{{@$cart_details->address}}"/>
<input type="hidden" name="delivery_city" value="{{@$cart_details->event_city}}"/>
<input type="hidden" name="delivery_state" value="{{@$cart_details->state}}"/>
<input type="hidden" name="delivery_zip" value="{{@$cart_details->pin_code}}"/>
<input type="hidden" name="delivery_country" value="India"/>
<input type="hidden" name="delivery_tel" value="{{@$cart_details->billing_mobile}}"/>

<div>
<tr>
	<td>&nbsp; Payment Option: </td>
</tr>
<tr>
	<td>
		&nbsp;&nbsp;<input class="payOption" type="radio" name="payment_option" value="OPTCRDC">Credit Card<br/>
		&nbsp;&nbsp;<input class="payOption" type="radio" name="payment_option" value="OPTDBCRD">Debit Card  <br/>
		&nbsp;&nbsp;<input class="payOption" type="radio" name="payment_option" value="OPTNBK">Net Banking<br/>
		&nbsp;&nbsp;<input class="payOption" type="radio" name="payment_option" value="OPTCASHC">Cash Card <br/>
		&nbsp;&nbsp;<input class="payOption" type="radio" name="payment_option" value="OPTMOBP">Mobile Payments<br/>
		{{-- &nbsp;&nbsp;<input class="payOption" type="radio" name="payment_option" value="OPTEMI">EMI<br/> --}}
		&nbsp;&nbsp;<input class="payOption" type="radio" name="payment_option" value="OPTWLT">Wallet
	</td>
</tr>

<!-- EMI section start -->

<tr >
	<td  colspan="2">&nbsp;&nbsp;
		<div id="emi_div" style="display: none">
			<table border="1" width="100%">
				<tr> <td colspan="2">&nbsp; EMI Section </td></tr>
				<tr> <td>&nbsp; Emi plan id: </td>
				<td><input readonly="readonly" type="text" id="emi_plan_id"  name="emi_plan_id" value=""/> </td>
			</tr>
			<tr> <td>&nbsp; Emi tenure id: </td>
			<td><input readonly="readonly" type="text" id="emi_tenure_id" name="emi_tenure_id" value=""/>  </td>
		</tr>
		<tr><td>&nbsp; Pay Through</td>
		<td>
			<select name="emi_banks"  id="emi_banks">
			</select>
		</td>
	</tr>
	<tr><td colspan="2">
		<div id="emi_duration" class="span12">
			<span class="span12 content-text emiDetails">&nbsp; EMI Duration</span>
			<table id="emi_tbl" cellpadding="0" cellspacing="0" border="1" >
			</table>
		</div>
	</td>
</tr>
<tr>
	<td id="processing_fee" colspan="2">
	</td>
</tr>
</table>
</div>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<!-- EMI section end -->
<tr><td>&nbsp; Card Type: </td>
<td><input type="text" id="card_type" name="card_type" value="" readonly="readonly"/></td>
</tr>
<tr> <td>&nbsp; Card Name: </td>
<td> <select name="card_name" id="card_name"> <option value="">Select Card Name</option> </select> </td>
</tr>
<tr> <td>&nbsp; Data Accepted At </td>
<td><input type="text" id="data_accept" name="data_accept" readonly="readonly"/></td>
</tr>
<tr> <td>&nbsp; Card Number: </td>
<td> <input type="text" id="card_number" name="card_number" value=""/>&nbsp; e.g. 4111111111111111 </td>
</tr>
<tr> <td>&nbsp; Expiry Month: </td>
<td> <input type="text" name="expiry_month" value=""/>&nbsp; e.g. 07 </td>
</tr>
<tr> <td>&nbsp; Expiry Year: </td>
<td> <input type="text" name="expiry_year" value=""/>&nbsp; e.g. 2027</td>
</tr>
<tr> <td>&nbsp; CVV Number:</td>
<td> <input type="text" name="cvv_number" value=""/>&nbsp; e.g. 328</td>
</tr>
<tr> <td>&nbsp; Issuing Bank:</td>
<td><input type="text" name="issuing_bank" value=""/>&nbsp; e.g. State Bank Of India</td>
</tr>
<tr>
<td>&nbsp; Mobile Number:</td>
<td><input type="text" name="mobile_number" value=""/>&nbsp; e.g. 9770707070</td>
</tr>
<tr>
<td>&nbsp; MMID:</td>
<td><input type="text" name="mm_id" value=""/>&nbsp; e.g. 1234567</td>
</tr>
{{-- 	<tr>
<td> OTP:</td>
<td><input type="text" name="otp" value=""/>e.g. 123456</td>
</tr>
<tr>
<td> Promotions:</td>
<td> <select name="promo_code" id="promo_code"> <option value="">All Promotions &amp; Offers</option> </select> </td>
</tr> --}}
</div>
<tr>
<td></td><td><INPUT TYPE="submit" class="show-more-btn" value="CheckOut" style="border:none"></td>
</tr>
</table>
</form>
<div>













{{-- <div>
	<h1>Chosee Payment Status</h1>
	<input type="radio" name="paymentType" value="cod" onclick="onRadioChange()">COD
	<input type="radio" name="paymentType" value="online" onclick="onRadioChange()">Online
</div>



<div id="cod-place-order" style="display:none;">
	<a class="btn btn-primary" href="{{route('cust.order.cod')}}"> Place Order</a>
</div>







<div>
<button class="btn btn-primary" onclick="formSubmitFun()" style="display:none;" id="ckout">Proceed</button>
</div> --}}



</div>
<br>
<br>
<br>




























@include('Customer.includes.footer')
@include('Customer.includes.script')
<!-- <script language="javascript" type="text/javascript" src="json.js"></script>-->
<!-- <script src="jquery-1.7.2.min.js"></script>-->
<script language="javascript" type="text/javascript" src="{{url('/')}}/public/adminasset/assets/json.js"></script>
<script src="{{url('/')}}/public/adminasset/assets/jquery-1.7.2.min.js"></script>
<script>


	function onRadioChange(){
		var value=$('input[name="paymentType"]:checked').val();
		// alert(value)
		if(value=="online"){
			$("#ckout").show();
			$("#cod-place-order").hide();

		}else{
			$("#ckout").hide();
			$("#cod-place-order").show();
		}
	}





function formSubmitFun(){
$("#paymntForm").submit();
}
</script>
<script type="text/javascript">
$(function(){
	/* json object contains
		1) payOptType - Will contain payment options allocated to the merchant. Options may include Credit Card, Net Banking, Debit Card, Cash Cards or Mobile Payments.
		2) cardType - Will contain card type allocated to the merchant. Options may include Credit Card, Net Banking, Debit Card, Cash Cards or Mobile Payments.
		3) cardName - Will contain name of card. E.g. Visa, MasterCard, American Express or and bank name in case of Net banking.
		4) status - Will help in identifying the status of the payment mode. Options may include Active or Down.
		5) dataAcceptedAt - It tell data accept at CCAvenue or Service provider
		6)error -  This parameter will enable you to troubleshoot any configuration related issues. It will provide error description.
		*/
	var jsonData;
	var access_code="AVNJ21KB60BH74JNHB" // shared by CCAVENUE
	var amount="6000.00";
	var currency="INR";
	
$.ajax({
url:'https://secure.ccavenue.com/transaction/transaction.do?command=getJsonData&access_code='+access_code+'&currency='+currency+'&amount='+amount,
dataType: 'jsonp',
jsonp: false,
jsonpCallback: 'processData',
success: function (data) {
jsonData = data;
// processData method for reference
processData(data);
		// get Promotion details
$.each(jsonData, function(index,value) {
			if(value.Promotions != undefined  && value.Promotions !=null){
				var promotionsArray = $.parseJSON(value.Promotions);
			$.each(promotionsArray, function() {
						console.log(this['promoId'] +" "+this['promoCardName']);
											var	promotions=	"<option value="+this['promoId']+">"
					+this['promoName']+" - "+this['promoPayOptTypeDesc']+"-"+this['promoCardName']+" - "+currency+" "+this['discountValue']+"  "+this['promoType']+"</option>";
					$("#promo_code").find("option:last").after(promotions);
				});
			}
		});
},
error: function(xhr, textStatus, errorThrown) {
alert('An error occurred! ' + ( errorThrown ? errorThrown :xhr.status ));
//console.log("Error occured");
}
		});
		
		$(".payOption").click(function(){
			var paymentOption="";
			var cardArray="";
			var payThrough,emiPlanTr;
		var emiBanksArray,emiPlansArray;
			
	paymentOption = $(this).val();
	$("#card_type").val(paymentOption.replace("OPT",""));
	$("#card_name").children().remove(); // remove old card names from old one
$("#card_name").append("<option value=''>Select</option>");
	$("#emi_div").hide();
	
	//console.log(jsonData);
	$.each(jsonData, function(index,value) {
		//console.log(value);
	if(paymentOption !="OPTEMI"){
		if(value.payOpt==paymentOption){
			cardArray = $.parseJSON(value[paymentOption]);
		$.each(cardArray, function() {
			$("#card_name").find("option:last").after("<option class='"+this['dataAcceptedAt']+" "+this['status']+"'  value='"+this['cardName']+"'>"+this['cardName']+"</option>");
		});
	}
	}
	
	if(paymentOption =="OPTEMI"){
		if(value.payOpt=="OPTEMI"){
			$("#emi_div").show();
			$("#card_type").val("CRDC");
			$("#data_accept").val("Y");
			$("#emi_plan_id").val("");
						$("#emi_tenure_id").val("");
						$("span.emi_fees").hide();
			$("#emi_banks").children().remove();
			$("#emi_banks").append("<option value=''>Select your Bank</option>");
			$("#emi_tbl").children().remove();
			
	emiBanksArray = $.parseJSON(value.EmiBanks);
	emiPlansArray = $.parseJSON(value.EmiPlans);
		$.each(emiBanksArray, function() {
			payThrough = "<option value='"+this['planId']+"' class='"+this['BINs']+"' id='"+this['subventionPaidBy']+"' label='"+this['midProcesses']+"'>"+this['gtwName']+"</option>";
			$("#emi_banks").append(payThrough);
		});
		
		emiPlanTr="<tr><td>&nbsp;</td><td>EMI Plan</td><td>Monthly Installments</td><td>Total Cost</td></tr>";
							
		$.each(emiPlansArray, function() {
			emiPlanTr=emiPlanTr+
							"<tr class='tenuremonth "+this['planId']+"' id='"+this['tenureId']+"' style='display: none'>"+
								"<td> <input type='radio' name='emi_plan_radio' id='"+this['tenureMonths']+"' value='"+this['tenureId']+"' class='emi_plan_radio' > </td>"+
								"<td>"+this['tenureMonths']+ "EMIs. <label class='merchant_subvention'>@ <label class='emi_processing_fee_percent'>"+this['processingFeePercent']+"</label>&nbsp;%p.a</label>"+
								"</td>"+
								"<td>"+this['currency']+"&nbsp;"+this['emiAmount'].toFixed(2)+
								"</td>"+
								"<td><label class='currency'>"+this['currency']+"</label>&nbsp;"+
									"<label class='emiTotal'>"+this['total'].toFixed(2)+"</label>"+
									"<label class='emi_processing_fee_plan' style='display: none;'>"+this['emiProcessingFee'].toFixed(2)+"</label>"+
									"<label class='planId' style='display: none;'>"+this['planId']+"</label>"+
								"</td>"+
							"</tr>";
						});
						$("#emi_tbl").append(emiPlanTr);
	}
}
	});
	
});
	
$("#card_name").click(function(){
	if($(this).find(":selected").hasClass("DOWN")){
		alert("Selected option is currently unavailable. Select another payment option or try again later.");
	}
	if($(this).find(":selected").hasClass("CCAvenue")){
		$("#data_accept").val("Y");
	}else{
		$("#data_accept").val("N");
	}
});
// Emi section start
$("#emi_banks").live("change",function(){
	if($(this).val() != ""){
			var cardsProcess="";
			$("#emi_tbl").show();
			cardsProcess=$("#emi_banks option:selected").attr("label").split("|");
					$("#card_name").children().remove();
					$("#card_name").append("<option value=''>Select</option>");
				$.each(cardsProcess,function(index,card){
				$("#card_name").find("option:last").after("<option class=CCAvenue value='"+card+"' >"+card+"</option>");
				});
					$("#emi_plan_id").val($(this).val());
					$(".tenuremonth").hide();
					$("."+$(this).val()+"").show();
					$("."+$(this).val()).find("input:radio[name=emi_plan_radio]").first().attr("checked",true);
					$("."+$(this).val()).find("input:radio[name=emi_plan_radio]").first().trigger("click");
					
					if($("#emi_banks option:selected").attr("id")=="Customer"){
						$("#processing_fee").show();
					}else{
						$("#processing_fee").hide();
					}
					
				}else{
					$("#emi_plan_id").val("");
					$("#emi_tenure_id").val("");
					$("#emi_tbl").hide();
				}
				
				
				
				$("label.emi_processing_fee_percent").each(function(){
					if($(this).text()==0){
						$(this).closest("tr").find("label.merchant_subvention").hide();
					}
				});
				
		});
		
		$(".emi_plan_radio").live("click",function(){
			var processingFee="";
			$("#emi_tenure_id").val($(this).val());
			processingFee=
					"<span class='emi_fees' >"+
						"Processing Fee:"+$(this).closest('tr').find('label.currency').text()+"&nbsp;"+
						"<label id='processingFee'>"+$(this).closest('tr').find('label.emi_processing_fee_plan').text()+
						"</label><br/>"+
			"Processing fee will be charged only on the first EMI."+
	"</span>";
$("#processing_fee").children().remove();
$("#processing_fee").append(processingFee);
// If processing fee is 0 then hiding emi_fee span
if($("#processingFee").text()==0){
	$(".emi_fees").hide();
}
			
		});
		
		
		$("#card_number").focusout(function(){
			/*
			emi_banks(select box) option class attribute contains two fields either allcards or bin no supported by that emi
			*/
			if($('input[name="payment_option"]:checked').val() == "OPTEMI"){
				if(!($("#emi_banks option:selected").hasClass("allcards"))){
				if(!$('#emi_banks option:selected').hasClass($(this).val().substring(0,6))){
					alert("Selected EMI is not available for entered credit card.");
				}
			}
		}
		
		});
			
			
			// Emi section end
// below code for reference
function processData(data){
var paymentOptions = [];
var creditCards = [];
var debitCards = [];
var netBanks = [];
var cashCards = [];
var mobilePayments=[];
$.each(data, function() {
		// this.error shows if any error
console.log(this.error);
paymentOptions.push(this.payOpt);
switch(this.payOpt){
case 'OPTCRDC':
	var jsonData = this.OPTCRDC;
	var obj = $.parseJSON(jsonData);
	$.each(obj, function() {
		creditCards.push(this['cardName']);
	});
break;
case 'OPTDBCRD':
	var jsonData = this.OPTDBCRD;
	var obj = $.parseJSON(jsonData);
	$.each(obj, function() {
		debitCards.push(this['cardName']);
	});
break;
	case 'OPTNBK':
		var jsonData = this.OPTNBK;
	var obj = $.parseJSON(jsonData);
	$.each(obj, function() {
		netBanks.push(this['cardName']);
	});
break;
case 'OPTCASHC':
var jsonData = this.OPTCASHC;
var obj =  $.parseJSON(jsonData);
$.each(obj, function() {
	cashCards.push(this['cardName']);
});
break;
case 'OPTMOBP':
var jsonData = this.OPTMOBP;
var obj =  $.parseJSON(jsonData);
$.each(obj, function() {
	mobilePayments.push(this['cardName']);
});
}
});
//console.log(creditCards);
// console.log(debitCards);
// console.log(netBanks);
// console.log(cashCards);
//  console.log(mobilePayments);
}
});
</script>
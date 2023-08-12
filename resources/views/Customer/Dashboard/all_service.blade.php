@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | All Services</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
<style>
.services_tiles .services_quantity_till .input_label input[type="number"] {
width: 100%;
background: #e1e1e1;
outline: none;
border-radius: 0px;
text-align: center;
color: #101010;
font-size: 13px;
border: none;
padding: 5px;
margin-left: 10px;
}
</style>

<!-- new style -->
<style>
    .ur {
    border: none;
    background-color: #e6e2e2;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
  }

  .cpy {
    border: none;
    background-color: #e6e2e2;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
    cursor: pointer;
  }

  .ur.focus,
  .ur:focus {
    outline: 0;
    box-shadow: none !important;
  }

  .share-message {
    font-size: 11px;
    color: #ee5535;
  }

  .os-title {
    display: flex !important;
    align-items: center;
    justify-content: space-between;
  }

  .share-link-btn {
    color: #0364a5 !important;
    cursor: pointer;
  }
</style>





<!-- banner -->
<div class="banner_area">
   <div class="owl-carousel banner_slide">
      <div class="banner_tiles" style="background-image: url({{url('/')}}/public/newDesignAsset/dist/images/details_banner.jpg);"></div>
      <div class="banner_tiles" style="background-image: url({{url('/')}}/public/newDesignAsset/dist/images/banner_1.jpg);"></div>
   </div>
   <!-- banner caption -->
   <div class="banner_caption">
      <h1>WEDDING</h1>
      <br>
      <form class="banner_search">
         <input type="search" name="searchme" id="searchme" placeholder="Search For What You Need" aria-label="Search">
         <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
   </div>
</div>










<!-- services -->
<div class="section_padding bg_shadw">
   <div class="container">
      <div class="section_title">
         <h2>Our <span>Services</span></h2>
         <p> dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         tempor incididunt </p>
      </div>
      <div class="row">
         @if(count(@$services)>0)
         @foreach(@$services as $row)
        <div class="col-md-4 col-lg-3 col-sm-6">
         <div class="services_tiles_area pb-5">
            <div class="services_tiles shadow">
               <img src="{{url('/')}}/storage/app/public/service/{{@$row->image}}">
               <div class="services_details">
                  <h4 class="os-title">
                    {{$row->service}}
                    <span class="share-link-btn" data-share-url="{{route('cust.single.product',$row->id)}}">
                      <i class="fas fa-share-nodes"></i>
                    </span>
                  </h4>
                  <span id="pro-text-{{@$row->id}}">{!! substr(@$row->description,0, 25) !!}</span>
                  <a style="font-size: 12px;cursor: pointer;color: #0364a5;display: block;margin: 5px 0 0;text-decoration: underline;"
                    href="{{route('cust.single.product',$row->id)}}">Show more</a>
                  <div class="services_quantity_till">
                     <div class="label">
                        <span>Add Quantity </span>
                        <span>By utsavlife</span>
                     </div>
                     <div class="input_label">
                        <input  type="number" name="quantity" id="quantity{{$row->id}}" value="1" min="1" onchange="changeQuantity({{$row->id}})">
                     </div>
                  </div>
                  <div class="services_quantity_till">
                     <div class="label">
                        <span>{{$row->price_basis}}</span>
                        <h4>₹ {{(int)$row->discount_price}} <s>₹ {{$row->price}}</s></h4>
                     </div>
                     @if(!@Auth::user()->id)
                     <div class="input_label">
                        <button  href="#" data-bs-toggle="modal" data-bs-target="#myModalviewNew{{$row->id}}">
                            <i class="fas fa-shopping-cart mr-5"></i> &nbsp; ADD
                        </button>
                     </div>
                     @elseif(!@Auth::user()->role_id==3 || !@Auth::user()->role_id==4)
                     @elseif(@Auth::user()->role_id==2)
                     <div class="input_label">
                        <button  href="#" data-bs-toggle="modal" data-bs-target="#myModalviewNew{{$row->id}}">
                            <i class="fas fa-shopping-cart mr-5"></i> &nbsp; ADD
                        </button>
                     </div>
                     @endif
                  </div>

                     <a href="{{route('cust.single.product',$row->id)}}" class="btn btn_shadow_theme">More Details</a>

               </div>
            </div>
         </div>
      </div>
         @endforeach
         @else
         <h4>No Sevice Found:(</h4>
         @endif
      </div>







      {{-- modal part --}}
      @foreach(@$services as $row)
      {{-- jeet modal --}}
      <div class="modal" id="myModalviewNew{{@$row->id}}">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="new-heading mb-0">Proceed To Cart</h4>
               </div>
               <!-- Modal body -->
               <form action="{{ route('cust.add_to_cart.new') }}" method="POST" id="frm{{$row->id}}">
                  @csrf
                  <div class="modal-body">
                     <h3 class="cart-heading">Service name: <b>{{$row->service}}</b></h3>
                     <!-- <div class="col-md-6"> -->
                     <input type="hidden" name="service_id" value="{{$row->id}}">
                     @php
                     $cat=DB::table('service__cruds')->where('service_id',$row->id)->pluck('category_id')->toArray();
                     // print_r($cat);
                     $allCat=DB::table('category__cruds')->whereIn('id',$cat)->get();
                     @endphp
                     <div class="modal-design">
                        <label for="#cart_category">Choose Occation</label>
                        <select name="cart_category" id="cart_category" class="form-control">
                           <option value="">Select</option>
                           @foreach(@$allCat as $val)
                           <option value="{{$val->id}}">{{@$val->category_name}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="modal-design">
                        <label for="#date">Order Start Date</label>
                        <input type="date" name="date" id="date{{$row->id}}" class="form-control">
                     </div>
                     <div class="modal-design">
                        <label for="#date">Order End Date</label>
                        <input type="date" name="end_date" id="end_date{{$row->id}}" class="form-control">
                     </div>
                     <div class="modal-design" style="display:none;">
                        <label for="#cart_category">Time</label>
                        <select name="time" class="form-control">
                           <option value="F">Full</option>
                           <option value="M">Morning</option>
                           <option value="N">Night</option>

                        </select>
                     </div>
                     <div class="modal-design">
                        <label for="">Add Quantity</label>
                        <input type="number" class="quentity form-control" name="quantity" id="quantityModal{{$row->id}}" value="1" min="1" onchange="changeQuantity2({{$row->id}})">
                     </div>
                     <div class="modal-design">
                        <label for="">Days</label>
                        <input type="number" readonly class="quentity form-control" name="days" id="days{{$row->id}}" value="1" min="1">
                     </div>
                     <!-- </div> -->
                  </div>
                  <div class="modal-footer add-cart">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" name="btn" value="add" class="btn" style="background-color: #0E4970; color:#fff"><i class="fas fa-shopping-cart mr-5"> </i> Add</button>
                     <button type="submit" name="btn" value="book" class="btn" style="background-color: #0E4970; color:#fff"><i class="fas fa-shopping-cart mr-5"> </i> Book Now</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      {{-- end jeet modal --}}
      @endforeach


   </div>
</div>






















@include('Customer.includes.new_footer')
<!-- Js File -->
@section('script')
@include('Customer.includes.new_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>

{{-- share modal --}}
<div class="modal fade" id="shareLinkModa" tabindex="-1" role="dialog" aria-labelledby="shareLinkModaLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content col-12">
      <div class="modal-header">
        <h5 class="modal-title">Share</h5>
        <span class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </span>
      </div>
      <div class="modal-footer" style=" text-align: center;">
        <label style="font-weight: 600;width: 100%;margin: 10px 0 10px;">Copy link to share </label>
        <div class=""
          style=" display: flex; align-items: center; justify-content: center; flex-wrap: wrap; background: #00000012; margin: auto; border-radius: 4px;">
          <input class="col-10 ur" type="url" placeholder="..." id="copy-share-link"
            aria-describedby="inputGroup-sizing-default"
            style="height: 40px;display: inline-block;background: transparent;width: auto;padding: 0 19px 0;"
            readonly="">
          <button class="cpy" onclick="copyTextToClipboard()"
            style=" display: inline-block; height: 40px; padding: 0 20px; background: #0364a5; color: #fff;">
            <i class="far fa-clone">
            </i>
          </button>
        </div>
        <span class="share-message" style="display: none;width: 100%;margin: 10px 0 10px;color: #0364a5;">Share link
          was successfully copied!</span>
      </div>
    </div>
  </div>
</div>



<script>
  $(document).ready(function () {
    $('body').on('click', '[data-dismiss="modal"]', function () { $(`.modal`).modal('hide'); })


    $('body').on('click', '.share-link-btn', async function () {
      const url = $(this).attr('data-share-url');

      try {
        await navigator.share({
          title: document.title,
          text: "Utsav Life Product shared",
          url: url
        })
        console.log("Data was shared successfully");
      } catch (err) {
        console.error("Share failed:", err.message);
        shareLinkPopup(url);
      }


      // if (navigator.share) {
      //   navigator.share({
      //     title: document.title,
      //     text: "Utsav Life Product shared",
      //     url: url
      //   })
      //     .then(() => {
      //       console.log('Successful share');

      //       setTimeout(() => {
      //         $('#shareLinkModa').modal('hide');
      //         $('.share-message').hide();
      //       }, 1000);
      //     })
      //     .catch(error => {
      //       console.log('Error sharing:', error);
      //       shareLinkPopup(url);
      //     });
      // } else {
      //   shareLinkPopup(url);
      // }
    })
  })

  function shareLinkPopup(url) {
    console.log(url);
    $('#copy-share-link').val(url);
    $('#shareLinkModa').modal('show');
  }

  function copyTextToClipboard() {
    // Get the text field
    var copyText = document.querySelector('#copy-share-link');
    console.log(copyText);

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    $('.share-message').show();
    setTimeout(() => {
      $('#shareLinkModa').modal('hide');
      $('.share-message').hide();
    }, 1000);
  }
</script>

@foreach(@$services as $row)
<script>
$(document).ready(function(){

var minDt=new Date().toISOString().split("T")[0];
$("#date{{$row->id}}" ).attr("min", minDt);
$("#end_date{{$row->id}}" ).attr("min", minDt);
$('#frm{{$row->id}}').validate({
rules:{
cart_category:{
required:true,
},
date:{
required:true,
},
end_date:{
required:true,
},
time:{
required:true,
},
},
messages:{
},
submitHandler: function(form){
// alert(1)
var startDate=$("#date{{$row->id}}").val();
var endDate=$("#end_date{{$row->id}}").val();
// console.log(startDate,endDate);
if ((Date.parse(endDate) < Date.parse(startDate))) {
alert("End date should be greater than Start date");
// document.getElementById("ed_endtimedate").value = "";
return false
}
else{
//calculate day diff between 2 dates and put it in day field
let date_1 = new Date(startDate);
let date_2 = new Date(endDate);
let difference = date_2.getTime() - date_1.getTime();
// console.log(difference);
let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
// console.log(TotalDays );
if(TotalDays==0){
$("#days{{$row->id}}").val(1);
}else{
$("#days{{$row->id}}").val(TotalDays+1);
}
form.submit();
}
},
});
});
</script>
<script>
function changeQuantity(id){
var firstQuantity=$("#quantity"+id).val();
console.log(id,firstQuantity);
$("#quantityModal"+id).val(parseInt(firstQuantity));
}
function changeQuantity2(id){
var firstQuantity=$("#quantityModal"+id).val();
console.log(id,firstQuantity);
$("#quantity"+id).val(parseInt(firstQuantity));
}
</script>
@endforeach

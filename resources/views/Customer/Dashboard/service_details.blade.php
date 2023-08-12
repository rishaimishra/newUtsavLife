@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | SD</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')
{{-- @endsection --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--  <link rel="stylesheet" href="{{ asset('public/plugin/productZoom/css/main.css') }}">  --}}

<link rel='stylesheet' href='{{ asset('public') }}/unitegallery/css/unite-gallery.css' type='text/css' />

<style>
   h1 {
      font-size: 4rem !important;
   }
    .cartbutton{
        padding: 4px 8px;
    outline: none;
    border: 1px solid rgb(3, 100, 165);
    color: rgb(89, 187, 252);
    border-radius: 5px;
    text-decoration: none !important;
    font-size: 14px;
    color: #0364a5;
    padding: 6px 13px;
    outline: none;
    border: 1px solid #0364a5;
    border-radius: 5px;
    align-items: center;
    background: transparent;
    margin-left: 10px;
  }
    .cartbutton:hover{
      background: rgb(3, 100, 165);
    }
  .cartbutton i {
         color: rgb(3, 100, 165);
    margin-right: 10px !important;
  }
      .cartbutton:hover,
    .cartbutton:hover i {
      color:  #fff;
}





.my_class{
    height:550px !important;
}
.ug-gallery-wrapper .ug-strip-panel{
    margin-top: 30px !important;
}
.ug-gallery-wrapper{
    overflow: initial;
}
.moreText {
   display: none;
 }
</style>




{{-- -- start show single data -- --}}
<section class="products-details my-4">
   <div class="container">
    @if(\Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ \Session::get('success') }}
    </div>
    @endif
      <div class="row">
         <div class="col-md-6 col-12 my-3">
            <div id="gallery">
                @if(count($all_images) > 0)
                @foreach($all_images as $image)
                @if($image['type'] == "image")
                <img alt="Preview Image 1"
                     src="{{ $image['url'] }}"
                     data-image="{{ $image['url'] }}"
                     data-description="Preview Image 1 Description">
                @elseif($image['type'] == "youtube")
                    <img alt="Youtube Video"
                        data-type="youtube"
                        data-videoid="{{ $image['url'] }}"
                        data-description="You can include youtube videos easily!">
                @endif
                @endforeach
                @endif



                {{--  <img alt="Vimeo Video"
                     data-type="vimeo"
                     src="http://i.vimeocdn.com/video/447294219_200x150.jpg"
                     data-image="http://i.vimeocdn.com/video/447294219_640.jpg"
                     data-videoid="73234449"
                     data-description="This gallery can also play vimeo videos!">  --}}

                {{--  <img alt="Html5 Video"
                     src="http://vjs.zencdn.net/v/oceans.mp4"
                     data-type="html5video"
                     data-image="http://vjs.zencdn.net/v/oceans.png"
                     data-videoogv="http://vjs.zencdn.net/v/oceans.ogv"
                     data-videowebm="http://vjs.zencdn.net/v/oceans.webm"
                     data-videomp4="http://vjs.zencdn.net/v/oceans.mp4"
                     data-description="This is html5 video demo played by mediaelement2 player">  --}}
            </div>
            {{--  <div class="show">
                <img src="{{url('/')}}/storage/app/public/service/{{@$service->image}}" id="show-img">

              </div>
              <div class="small-img">
                <img src="{{ asset('public/plugin/productZoom/images/online_icon_right@2x.png') }}" class="icon-left" alt="" id="prev-img">
                <div class="small-container">
                  <div id="small-img-roll">
                    <img src="{{url('/')}}/storage/app/public/service/{{$service->image}}" class="show-small-img" alt="">
                    @if(!empty($service->additional_images))
                    @php
                        $explodeImages = explode(",",$service->additional_images);
                    @endphp
                    @foreach($explodeImages as $image)
                    <img src="{{ url('/') }}/storage/app/public/service/{{ @$image }}" class="show-small-img" alt="">
                    @endforeach
                    @endif
                    </div>
                </div>
                <img src="{{ asset('public/plugin/productZoom/images/online_icon_right@2x.png') }}" class="icon-right" alt="" id="next-img">
            </div>  --}}

         </div>
         <div class="col-md-6 col-12 my-3">
            <div class="products-details-content">
               <h1 class="new-heading mb-2">{{@$service->service}}</h1>
               <label for=""><b>Description:&nbsp;&nbsp;</b></label>
               @php
                  $countChar = strlen($service->description);
                  $first100Char = substr(@$service->description,0, 100);
                  $onward100Char = substr(@$service->description,100, $countChar);
               @endphp
               <div class="lessText">{!! @$first100Char !!} @if($countChar > 100) <a href="javascript:;" class="more-btn">Read More</a> @endif</div>
               <div class="moreText">
                  {!! @$service->description !!}

                  <a href="javascript:;" class="less-btn">Read Less</a>
               </div>
               <hr>
               <div class="product-price">
                  <label for=""><b>Price:&nbsp;&nbsp;</b></label>
                  <span class="old-price"> ₹ {{@$service->price}}</span><br>
                  <label for=""><b>Discount Price:&nbsp;&nbsp;</b></label>
                  <span class="new-price">₹ <del>{{@$service->discount_price}}</del></span><br>
                  <label for=""><b>Unit:&nbsp;&nbsp;</b></label>
                  <span class="qty-price"> {{@$service->price_basis}}</span>
               </div><br>
               <p class="font-lg taxes">inclusive of all taxes</p>
                @if(!@Auth::user()->id)
                                    <div class="add-cart">
                                    <a class="add cartbutton" href="#" data-bs-toggle="modal" data-bs-target="#myModalviewNew2{{$service->id}}"><i class="fas fa-shopping-cart mr-5"></i>Add
                                    </a>
                                 </div>
                                  @elseif(!@Auth::user()->role_id==3 || !@Auth::user()->role_id==4)
                                  @elseif(@Auth::user()->role_id==2)
                                 <div class="add-cart">
                                    <a class="add cartbutton" href="#" data-bs-toggle="modal" data-bs-target="#myModalviewNew2{{$service->id}}"><i class="fas fa-shopping-cart mr-5"></i>ADD
                                    </a>
                                 </div>
                                 @endif
            </div>
         </div>
      </div>
   </div>
</section>
{{-- -- end show single data -- --}}
{{-- rohit modal --}}
<div class="modal" id="myModalviewNew2{{$service->id}}">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="new-heading mb-0">Proceed To Cart</h4>
         </div>
         <!-- Modal body -->
         <form action="{{ route('cust.add_to_cart.new') }}" method="POST" id="frm">
            @csrf
            <div class="modal-body">
               <h3 class="cart-heading">Service name: <b>{{$service->service}}</b></h3>
               <!-- <div class="col-md-6"> -->
               <input type="hidden" name="service_id" value="{{$service->id}}">
               @php
               $cat=DB::table('service__cruds')->where('service_id',$service->id)->pluck('category_id')->toArray();
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
                  <input type="date" name="date" id="date" class="form-control">
               </div>


                <div class="modal-design">
                  <label for="#date">Order End Date</label>
                  <input type="date" name="end_date" id="end_date" class="form-control">
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
                  <label for=""> Add Quantity</label>
                  <input type="number" class="quentity form-control" name="quantity" id="quantityModal{{$service->id}}" value="1" min="1" {{-- onchange="changeQuantity2({{$service->id}})" --}}>
               </div>
               <div class="modal-design">
                  <label for="">Days</label>
                  <input type="number" readonly class="quentity form-control" name="days" id="days" value="1" min="1">
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
{{-- end rohit modal --}}






@include('Customer.includes.new_footer')
@include('Customer.includes.new_script')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
        crossorigin="anonymous"></script>

<script type='text/javascript' src='{{ asset('public') }}/unitegallery/js/unitegallery.min.js'></script>
<script type='text/javascript' src='{{ asset('public') }}/unitegallery/themes/compact/ug-theme-compact.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
{{--  <script src="{{ asset('public/plugin/productZoom/scripts/main.js') }}"></script>  --}}
{{--  <script src="{{ asset('public/plugin/productZoom/scripts/zoom-image.js') }}"></script>  --}}
<script>
    $(document).ready(function(){
        $("#gallery").addClass("my_class")

        $('.show').zoomImage();

        $('.show-small-img:first-of-type').css({'border': 'solid 1px black', 'padding': '2px'})
        $('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')
        $('.show-small-img').click(function () {
          $('#show-img').attr('src', $(this).attr('src'))
          $('#big-img').attr('src', $(this).attr('src'))
          $(this).attr('alt', 'now').siblings().removeAttr('alt')
          $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
          if ($('#small-img-roll').children().length > 4) {
            if ($(this).index() >= 3 && $(this).index() < $('#small-img-roll').children().length - 1){
              $('#small-img-roll').css('left', -($(this).index() - 2) * 76 + 'px')
            } else if ($(this).index() == $('#small-img-roll').children().length - 1) {
              $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
            } else {
              $('#small-img-roll').css('left', '0')
            }
          }
        })
        $('#next-img').click(function (){
            $('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
            $('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
            $(".show-small-img[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
            $(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')
            if ($('#small-img-roll').children().length > 4) {
              if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
                $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
              } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
                $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
              } else {
                $('#small-img-roll').css('left', '0')
              }
            }
          })

          $('#prev-img').click(function (){
            $('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
            $('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
            $(".show-small-img[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
            $(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')
            if ($('#small-img-roll').children().length > 4) {
              if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
                $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
              } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
                $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
              } else {
                $('#small-img-roll').css('left', '0')
              }
            }
          })
    })
    $("document").ready(function() {
        setTimeout(function() {
            $(".show-small-img:first-of-type").trigger('click');
        },10);

    });
    setInterval(function() {
        $("#next-img").trigger('click');
    },2000);
</script>
<script>
$(document).ready(function(){
    var minDt=new Date().toISOString().split("T")[0];
    $("#date" ).attr("min", minDt);
    $("#end_date" ).attr("min", minDt);
$('#frm').validate({
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
   var startDate=$("#date").val();
   var endDate=$("#end_date").val();
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
         $("#days").val(1);
      }else{
         $("#days").val(TotalDays+1);
      }



      form.submit();
   }
},
});
});


</script>
<script type="text/javascript">

    jQuery(document).ready(function(){

         jQuery("#gallery").unitegallery({
            gallery_skin:"compact",
            gallery_height:500,

         });



    });

    $('.more-btn').click(function() {
      $('.moretext').slideToggle();
      $('.lessText').hide();
    });
    $('.less-btn').click(function() {
      $('.moretext').slideToggle();
      $('.lessText').show();
    });

</script>

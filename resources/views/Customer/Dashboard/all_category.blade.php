@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | All Events</title>
@endsection
{{-- @section('head') --}}
@include('Customer.includes.new_head')
@include('Customer.includes.new_header')


<!-- banner -->
<div class="banner_area">
   <div class="owl-carousel banner_slide">
      <div class="banner_tiles" style="background-image: url({{url('/')}}/public/newDesignAsset/dist/images/banner_1.jpg);"></div>
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

@include('Customer.includes.message')




<!-- package area -->
<div class="section_padding">
  <div class="container">
    <div class="section_title">
      <h2><span>PACKAGES</span></h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
    <div class="row">
     @if(count(@$category)>0)
     @foreach(@$category as $row)


      <div class="col-md-4 col-lg-3 col-sm-6">
        <div class="package_tiles">
          <div class="package_img">
            <img  src="{{url('/')}}/storage/app/public/category/{{@$row->image}}">
          </div>
          <div class="package_details">
            <h4>{{$row->category_name}}</h4>
            <p>{{$row->category_description}}</p>
            <a href="{{route('cust.single.category',$row->id)}}" class="btn btn_shadow_theme">More Details</a>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <h4>No Events Found:(</h4>
      @endif

    </div>

  </div>
</div>



@include('Customer.includes.new_footer')
@include('Customer.includes.new_script')


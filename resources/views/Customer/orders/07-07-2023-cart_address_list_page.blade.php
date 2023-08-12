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
.new-btn-add {
    background: var(--main-color);
    color: #fff;
    width: 165px !important;
    padding: 6px;
    text-align: center;
    margin-bottom: 30px;
    border-radius: 5px;
}
.new-btn-add:hover {
    background: var(--heading-color);
    color: #fff
}
</style>
@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | Customer | CART</title>
@endsection
@include('Customer.includes.head')
@include('Customer.includes.header')
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
{{-- cart part start --}}
<!-- cart page area start -->
<section class="cart-page-area section-padding">
    <div class="container">
        
        <div class="cart-itmes">
            <div class="row" style="display:flex;justify-content:center">
              <div class="col-md-6 col-12">
                <h4 style="font-size: 22px;font-weight: 500;color: #0264a5;margin: 30px 0 15px;">Select a event venue address</h4>
                @include('Customer.includes.message')
                <a href="{{route('cust.address.add')}}" class="new-btn-add">Add new Address</a> <br>
                
                <form method="POST" action="{{route('cust.cart.address.ins.two')}}"  class="form-horizontal m-t-20 mt-5" id="reg_form">
                    @csrf
                    {{-- all address with radio buttion --}}
                    @foreach($all_address as $key=> $val)
                    <input type="radio" required name="address_id" value="{{$val->id}}" @if($val->default_address=="Y")checked @endif>
                    <h5> {{@$val->billing_name}}</h5>
                    <p><b>{{@$val->address}}</b></p>
                    <p> {{@$val->area}}</p>
                    <p>{{@$val->landmark}}</p>
                    <p>{{-- {{@$val->city}}  --}} </p>
                    <p> {{@$val->city}}, {{@$val->state}}, {{@$val->pin_code}} </p>
                    <p>India</p>
                    <p>Phone Number: {{@$val->billing_mobile}}</p>

                    <div class="mt-2">
                        <a href="{{route('cust.address.edit',$val->id)}}" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Are you sure want to delete this address?')" href="{{route('cust.address.delete',$val->id)}}" class="btn btn-primary">delete</a>
                    </div>
                    <br>
                    @endforeach
                    
                    
                    <br>
                    <button class="btn btn-primary btn-lg w-lg waves-effect waves-light rm01 mt-5"  type="submit">Book Now</button>
                    
                </form>
              </div>
            </div>
        </div>
    </section>
    {{-- cart part end --}}
    <!-- End Right content here -->
    @section('footer')
    @include('Customer.includes.footer')
    @endsection
    @endsection
    {{-- end content --}}
    @section('script')
    @include('Customer.includes.script')
    
    
    @endsection
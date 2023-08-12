@extends('Customer.layouts.app')
@section('title')
    <title>Utsavlife | Customer | CART</title>
@endsection
@include('Customer.includes.head-cart')
<link rel="stylesheet" type="text/css"
    href="{{ url('/') }}/public/newDesignAsset/dist/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/newDesignAsset/dist/css/owl.theme.default.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/newDesignAsset/dist/css/owl.carousel.min.css">
<!-- font awaume -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/newDesignAsset/dist/css/all.min.css">
<!-- custom css -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/newDesignAsset/dist/css/style.css">
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/newDesignAsset/dist/css/responsive.css">
<style>
    .active_address_box {
        background-color: #b2e0ff;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-theme-solid {
        background-color: #0364a5;
        outline: none;
        border: none;
        padding: 15px;
        color: #fff;
        text-transform: uppercase;
        font-size: 15px;
        font-family: poppins-bold;
        width: 100%;
    }

    .select_address_area .form-check {
        justify-content: flex-start;
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 15px;
        border-bottom: 1px solid #d2d2d2;
    }

    .cart_box {
        background: #fff;
        padding: 30px;
        margin-top: 30px;
    }
</style>
@include('Customer.includes.new_header')
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
    <div class="section_padding" style="background: #f6f6f6;">
        <div class="container">
            <div class="bred_cum">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="cart.html">Select Address</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="cart_box">
                        <div class="title">
                            <h4>Select <span>Address</span></h4>
                        </div>
                        <div class="cart_body">
                            <form method="POST" action="{{ route('cust.cart.address.ins.two') }}">
                                @csrf
                                @error('address_id')
                                <div class="alert alert-danger" role="alert">
                                  <h4 class="alert-heading">{{ $message }}</h4>
                                </div>
                                @enderror
                                <div class="active_address_box">
                                    <div class="active_title">
                                        <h4>Login <img
                                                src="{{ url('/') }}/public/newDesignAsset/cart/dist/images/green_tick.png">
                                        </h4>
                                        <h5><span>{{ Auth::user()->name }} |</span> {{ Auth::user()->mobile }}</h5>
                                    </div>
                                    <a href="#" class="btn btn-solid-white shadow">Change</a>
                                </div>
                                @foreach ($all_address as $key => $val)
                                    <div class="select_address_area active_address">
                                        <div class="form-check"
                                            style="display: flex; align-items: start; justify-content: space-between;">
                                            <div>
                                                <input type="radio" class="form-check-input"
                                                id="flexRadioDefault{{ $val->id }}" name="address_id"
                                                value="{{ $val->id }}"
                                                @if ($val->default_address == 'Y') checked @else @if($key == 0) checked @endif @endif>
                                                <label class="form-check-label" for="flexRadioDefault{{ $val->id }}">
                                                    <span>{{ @$val->billing_name }}</span> |
                                                    <span>{{ @$val->billing_mobile }}</span>
                                                    <p>{{ @$val->address }},{{ @$val->city }}, {{ @$val->state }}</p>
                                                </label>
                                            </div>
                                            <div class="">
                                                <a href="{{ route('cust.address.edit', $val->id) }}"
                                                    class="text-primary"><i
                                                        class="fa-sharp fa-solid fa-pen-to-square"></i></a>&nbsp;&nbsp;
                                                <a onclick="return confirm('Are you sure want to delete this address?')"
                                                    href="{{ route('cust.address.delete', $val->id) }}"
                                                    class="text-danger"><i class="fa-solid fa-trash-can"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="added_btn">
                                    <a href="{{ route('cust.address.add') }}" class="btn btn_shadow_theme">Add New
                                        Address</a>
                                </div>

                                <div class="btn_area mt-5">
                                    <button type="submit" class="btn-theme-solid">Book Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if($lastSegment == "cart")
                <div class="col-md-5">
                    <div class="cart_box">
                        <div class="title">
                            <h4>Total Price <span>Distribution</span></h4>
                        </div>
                        <div class="cart_body">
                            <table class="table table-lg table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Price</td>
                                        <th class="text-right">₹{{ $total_price }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="cart_footer_result">
                                <span>Total Amount</span>
                                <span>₹{{ $total_price }}</span>
                            </div>
                            <div class="cart_des mt-4">
                                <p>This is the total amount of all services in your cart. Select this option at checkout.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>


        </div>
    </div>
@section('footer')
    @include('Customer.includes.new_footer')
@endsection
@endsection
{{-- end content --}}
@section('script')
@include('Customer.includes.script')
@endsection

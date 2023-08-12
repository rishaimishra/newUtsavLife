@extends('Customer.layouts.app')
@section('title')
<title>Utsavlife | not req</title>
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




<div class="container">
    <div class="content">
        <h1>Services</h1>
        <div class="row" style="display: flex;">
            @if(!empty(@$services))
            @foreach(@$services as $row)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$row->service}}</h5>
                    <img src="/storage/{{$row->image}}" width="200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <label for="price">{{$row->price_basis}}:</label>
                        <p id="price"><strong>Rs. {{$row->price}}</strong></p>
                        <p class="card-text">{{$row->description}}</p>
                        <!-- Button trigger modal -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModalview{{$row->id}}"><button class="btn btn-primary">Add to Cart</button></a>
                        <!-- Modal -->
                        <div class="modal" id="myModalview{{@$row->id}}">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Proceed To Cart</h4>
                                    </div>
                                    <!-- Modal body -->
                                    <form action="{{ route('cust.add_to_cart') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <h3>Service name: <b>{{$row->service}}</b></h3>
                                            <!-- <div class="col-md-6"> -->
                                            <input type="hidden" name="service_id" value="{{$row->id}}">
                                            @php
                                            $cat=DB::table('service__cruds')->where('service_id',$row->id)->pluck('category_id')->toArray();
                                            // print_r($cat);
                                            $allCat=DB::table('category__cruds')->whereIn('id',$cat)->get();
                                            @endphp
                                            <div class="row" style="padding: 10px;">
                                                <label for="#cart_category">Choose Occation</label>
                                                <select name="cart_category" id="cart_category">
                                                    <option value="">Select</option>
                                                    @foreach(@$allCat as $val)
                                                    <option value="{{$val->id}}">{{@$val->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="row" style="padding: 10px; display: inline-grid">
                                                <label for="#date">Order Date</label>
                                                <input type="date" name="date" id="date">
                                                <div class="row" style="padding: 10px;">
                                                    <label for="#cart_category">Time</label>
                                                    <select name="time">
                                                        <option value="">Select</option>
                                                        
                                                        <option value="M">Morning</option>
                                                        <option value="N">Night</option>
                                                        <option value="F">Full</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <h4>No Service Found:(</h4>
            @endif
        </div>
    </div>
</div>

<hr>
</hr>
@include('Customer.includes.new_footer')

@include('Customer.includes.new_script')
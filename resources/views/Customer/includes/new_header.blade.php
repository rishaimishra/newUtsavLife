@php
$allCategory=DB::table('category__cruds')->where('category_status','A')->skip(0)->take(4)->get();
$allService=DB::table('services')->where('status','A')->skip(0)->take(6)->get();
if(@Auth()->user()->id){
$cartCount=DB::table('carts')->where('user_id',Auth()->user()->id)->count();
// dd($cartCount);
}
elseif(Session::has('randmon_number')){
$session=Session::get('randmon_number');
$cartCount=DB::table('carts')->where('system_id',$session)->count();
}
else{
$cartCount=0;
}
@endphp





 <!-- header -->
  <header>
     <div class="container">
       <div class="header_flex">
         <div class="left_panel">
           <div class="panel_tiles">
             <a href="{{route('cust.first.route')}}" class="logo"><img src="{{url('/')}}/public/newDesignAsset/dist/images/logo.png"></a>
           </div>






              {{-- part 1 dropdown --}}
              <div class="panel_tiles ddl">
             {{--    @if(@Auth::user()->id && @Auth::user()->role_id==2)
                <li class="nav-item dropdown">
                  <a class="none_ddl nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Menu
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    
                    <li><a class="dropdown-item" href="{{route('cust.mydashboard.page')}}"><i class="far fa-user mr-10"></i> My Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('cust.update.email.page')}}"><i class="far fa-user mr-10"></i> Update Email</a></li>
                    <li><a class="dropdown-item" href="{{route('cust.update.mobile.page')}}"><i class="far fa-user mr-10"></i> Update Mobile</a></li>
                    <li><a class="dropdown-item" href="{{route('cust.all.orders')}}"><i class="fas fa-map-marker-alt mr-10"></i> Order Tracking</a></li>
                    
                    <li><a class="dropdown-item" href="{{route('cust.logout')}}"><i class="fas fa-sign-out-alt mr-10"></i> Sign out</a></li>
                    
                  </ul>
                </li>
                @elseif(@Auth::user()->id && @Auth::user()->role_id==3)
                
                <a class="none_ddl nav-link dropdown-toggle"href="{{route('vandor.dashboard')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <b> Dashboard</b> </i></a>
                
                @elseif(@Auth::user()->id && @Auth::user()->role_id==4)
                <a class="active">
                  <a class="none_ddl nav-link dropdown-toggle"  href="{{route('agent.dashboard')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <b> Dashboard</b> </i></a>
                  @endif --}}


                   <li class="nav-item dropdown">
                  <a class="none_ddl nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    locations
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    
                    <li><a class="dropdown-item" href="#"> Delhi</a></li>
                    <li><a class="dropdown-item" href="#"> Mumbai</a></li>
                    <li><a class="dropdown-item" href="#"> Chennai</a></li>
                    <li><a class="dropdown-item" href="#"> Kolkata</a></li>
                    
                    <li><a class="dropdown-item" href="#">Patna</a></li>
                    
                  </ul>
                </li>


                </div>




                {{-- part 2 dropdown --}}
                <div class="panel_tiles ddl">
                  <li class="nav-item dropdown">
                    <a class="none_ddl nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      @foreach($allService as $val)
                      <li><a class="dropdown-item" href="{{route('cust.single.product',$val->id)}}">{{@$val->service}}</a></li>
                      @endforeach
                    </ul>
                  </li>
                </div>




                {{-- part 2 dropdown --}}
                <div class="panel_tiles ddl">
                  <div class="dropdown">
                    <button class="bg_light_blue_ddl dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Browse all categories
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      @foreach($allCategory as $val)
                      <li>
                        <a class="dropdown-item" href="{{route('cust.single.category',$val->id)}}">{{$val->category_name}}</a>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
         </div>
















{{-- web --}}
         <div class="right_panel web_panel">
         
          @if(!@Auth::user()->id)
            <div class="panel_tiles_right">
              <a href="{{route('cust.login.view')}}" class="btn btn_outline btn_sign_in"><i class="fa-solid fa-user-plus"></i> Sign In</a>
            </div>
            <div class="panel_tiles_right">
              <a href="{{route('cust.registration.view')}}" class="btn btn_solid btn_sign_up"><i class="fa-solid fa-user-plus"></i> Sign Up</a>
            </div>
             @endif



            {{-- cart icon with different conditions--}}
            @if(@Auth::user()->id && @Auth::user()->role_id==2)
            <div class="panel_tiles_right cart">
              <a href="{{route('cust.cart')}}">
                <img src="{{url('/')}}/public/newDesignAsset/dist/images/cart_ic_blue.png">
                <span>{{$cartCount}}</span>
              </a>
            </div>



              <div class="right_panel">
                <div class="account_profile">
                  {{-- <a href="#"><img src="dist/images/add_nedw.png"></a> --}}
                  <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{@Auth::user()->name}}
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{route('cust.mydashboard.page')}}"><i class="fa-regular fa-user"></i> My Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('cust.cart')}}"><i class="fa-solid fa-cart-shopping"></i> Cart</a></li>
                    <li><a class="dropdown-item" href="{{route('cust.service.address.page')}}"><i class="fa-solid fa-location-dot"></i> Your address</a></li>
                    <li><a class="dropdown-item" href="{{route('cust.logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a></li>
                  </ul>
                </div>
                </div>
             </div>

             @elseif((@Auth::user()->id) &&( @Auth::user()->role_id==3 || @Auth::user()->role_id==4))
           

            <div class="right_panel">
            <div class="account_profile">
              {{-- <a href="#"><img src="dist/images/add_nedw.png"></a> --}}
              <div class="dropdown">
              <button class="btn" type="button">
                {{@Auth::user()->name}}
              </button>
              
            </div>
            </div>
         </div>


            @else
            <div class="panel_tiles_right cart">
              <a href="{{route('cust.cart')}}">
                <img src="{{url('/')}}/public/newDesignAsset/dist/images/cart_ic_blue.png">
                <span>{{$cartCount}}</span>
              </a>
            </div>
            @endif

            <a href="https://utsavlife.com/vandor/registration" style="text-decoration: none !important;margin: 0 0 0 30px !important;" class="btn_solid">Be a Partner</a>

         </div>
        



{{-- mobile --}}
         <div class="mob_right_panel mob_panel">
          @if(!@Auth::user()->id)
            <div class="panel_tiles_right">
              <a href="{{route('cust.login.view')}}" class="btn btn_outline btn_sign_in"><i class="fa-solid fa-user-plus"></i> Sign In</a>
            </div>
            <div class="panel_tiles_right">
              <a href="{{route('cust.registration.view')}}" class="btn btn_solid btn_sign_up"><i class="fa-solid fa-user-plus"></i> Sign Up</a>
            </div>
             @endif



            {{-- cart icon with different conditions--}}
            @if(@Auth::user()->id && @Auth::user()->role_id==2)
            <div class="panel_tiles_right cart">
              <a href="{{route('cust.cart')}}">
                <img src="{{url('/')}}/public/newDesignAsset/dist/images/cart_ic_blue.png">
                <span>{{$cartCount}}</span>
              </a>
              <a style="margin-left:20px"><span class="cart-text">{{@Auth::user()->name}}</span></a>
            </div>

             @elseif((@Auth::user()->id) &&( @Auth::user()->role_id==3 || @Auth::user()->role_id==4))
              <div class="panel_tiles_right cart">
              <a style="margin-left:20px"><span class="cart-text">{{@Auth::user()->name}}</span></a>
            </div>


            @else
            <div class="panel_tiles_right cart">
              <a href="{{route('cust.cart')}}">
                <img src="{{url('/')}}/public/newDesignAsset/dist/images/cart_ic_blue.png">
                <span>{{$cartCount}}</span>
              </a>
            </div>
            @endif
         </div>



       </div>
     </div>
  </header>

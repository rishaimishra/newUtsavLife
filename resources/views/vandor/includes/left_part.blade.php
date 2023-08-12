@section('head')
@include('vandor.includes.head')
@endsection
<style>
#sidebar-menu > ul > li > a.active {
background: #9c27b0 !important;
color: #FFF;
}
#sidebar-menu ul ul a {
/* color: #75798B; */
color: #597884;
display: block;
padding:15px 33px 9px 11px;
}
.abc{
background-color:#FF6347 !important;
color:white !important;
}
.abc span{
color: white !important;
}
</style>
<!-- color change  -->
<style>
 body,html{
    background:  #fff;
  }
  .dataTables_paginate > .pagination > .active > a,
  .topbar .topbar-left,
  .slimScrollDiv .sidebar-inner #sidebar-menu > ul > li > a.active,
  .add-btn a,
  #wrapper #sidebar-menu > ul > li > a.active,
      .btn-primary,.btn-primary:focus,.btn-primary:hover,
  .navbar-default {
        background: #0264a5 !important;
  }
  .btn-primary,.btn-primary:focus,.btn-primary:hover,
  .dataTables_paginate > .pagination > .active > a {
    border-color: #0264a5 !important;
  }
  table.dataTable tbody tr,
  #sidebar-menu {
      background: transparent !important;
  }
  
  .panel-default > .panel-heading,
  .panel .panel-body,
  .sidebar-inner {
      background: #0264a526 !important;
  }
  .nav.navbar-nav.navbar-right.pull-right .dropdown .dropdown-menu {
    display: none !important;
  }
  .dataTables_filter label,
  .dataTables_length label {
    display:  flex !important;
    justify-content: start;
    align-items: center;
  }
  .dataTables_filter input ,
  .dataTables_length select{
    height: 30px;
    margin: 0 10px 0;
    background:  #fff !important;
  }
  
</style>
<!-- color change  -->
<!-- Begin page -->
<!-- new fixes 13 april -->
<style>
  .nav.navbar-nav.navbar-right.pull-right h4 {
    margin: 5px 0 0 0 !important;
    font-size: 16px !important;
  }
  /* *:not(i) */
  p, span, b, div, h1, h2, h3, h4, h5, h6, small {
    font-family: 'Poppins', sans-serif !important;
    font-style: normal !important;
    font-weight: 600 !important;
  }
  .user-details {
    display: flex;
    align-items: center;
    justify-content: start;
  }
  .user-details .user-info {
    margin: 0 0 0 12px;
  }
  .button-menu-mobile {
    margin: 0 0 0 -5px;
  }
  #wrapper.enlarged .left.side-menu {
    padding-top: 0;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: transparent !important;
    border: none !important;
  }
  #header-new-logo {
    width: 190px;
    height: auto;
    filter: invert(1) brightness(19.5);
    margin: -20px 0 -20px;
  }
</style>
<!-- new fixes 13 april -->
<div id="wrapper">



  <!-- Top Bar Start -->
  <div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
      <div class="text-center">
        
        <h1 id="logo-new" style="color: white; display: block;">
          <img id="header-new-logo" src="https://utsavlife.com/public/adminasset/assets/img/header/u-nav-logo.png" alt="utsavlife logo">
        </h1>
      </div>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="">
          <div class="pull-left">
            <button class="button-menu-mobile open-left" onclick="clk()"> <i class="fa fa-bars"></i> </button> <span class="clearfix"></span> </div>


            
            <ul class="nav navbar-nav navbar-right pull-right" style="display: flex;align-items: center;">
                <li><h4 style="color: white; margin-right: 30px; font-style: italic;">Welcome {{Auth::user()->name}} @if(Auth::user()->reg_complete=="Y")<i class="fas fa-check"></i> @endif</h4></li>             
                 <li class="dropdown">
                <a href="#" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                  @if(@auth::user()->VandorDetails->vendor_image)
                <img src="{{url('/')}}/storage/app/public/vandor/vendor_image/{{@auth::user()->VandorDetails->vendor_image}}" alt="" class="thumb-md img-circle">@else<i class='fas fa-user-tie' style='font-size:36px;color: black;'  ></i> @endif </a>
                <ul class="dropdown-menu">
               
                 
                {{--   <li><a href="{{ route('vandor.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> Logout</a></li> --}}
                </ul>
              </li>
            </ul>
          </div>
          <!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <!-- Top Bar End -->










    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
          <div class="pull-left"> @if(@auth::user()->VandorDetails->vendor_image)
          <img src="{{url('/')}}/storage/app/public/vandor/vendor_image/{{@auth::user()->VandorDetails->vendor_image}}" alt="" class="thumb-md img-circle">@else<i class='fas fa-user-tie' style='font-size:36px;color: black;'  ></i> @endif </div>
          <div class="user-info">
            <div class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Vandor Panel<span class="caret"></span></a>
            <ul class="dropdown-menu">
              
          {{--     <li> <a class="dropdown-item" href="{{ route('vandor.logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('vandor.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li> --}}
          </ul>
        </div>
      </div>
    </div>
    <!--- Divider -->
    <div id="sidebar-menu">
      <ul>
        <li> <a href="{{route('vandor.dashboard')}}" class="{{request()->segment(2)=='dashboard'?'waves-effect active':''}}" ><i class="fas fa-tachometer-alt"></i><span id="dsh"> Dashboard </span></a> </li>
        @if(Auth::user()->reg_complete=="N")
        <li> <a href="{{route('vandor.registration.get')}}" class="{{request()->segment(2)=='registration'?'waves-effect active':''}}" ><i class="fas fa-tachometer-alt"></i><span id="dsh"> Complete Profile </span></a> </li>
        <li> <a href="{{route('vandor.service.list')}}" class="{{request()->segment(2)=='service'?'waves-effect active':''}}" ><i class="fas fa-list"></i><span> Services </span></a> </li>
        @else
        <li> <a href="{{route('vandor.service.list')}}" class="{{request()->segment(2)=='service'?'waves-effect active':''}}" ><i class="fas fa-list"></i><span> Services </span></a> </li>
        <li> <a href="{{route('vandor.profile.page')}}" class="{{request()->segment(2)=='profile'?'waves-effect active':''}}" ><i class="fas fa-user"></i></i><span> Profile </span></a> </li>
        {{-- <li> <a href="{{route('vandor.aval.page')}}" class="{{request()->segment(2)=='availability'?'waves-effect active':''}}" ><i class="fas fa-cog ri5"></i><span> Availablitity </span></a> </li>
        --}}
        <li> <a href="{{route('vandor.upcomming.orders')}}" class="{{request()->segment(2)=='orders'?'waves-effect active':''}}" ><i class="fab fa-jedi-order"></i><span> Orders </span></a> </li>
        <li> <a href="{{route('vandor.address.list')}}" class="{{request()->segment(2)=='address'?'waves-effect active':''}}" ><i class="fas fa-map-marker-alt"></i><span> Address </span></a> </li>
        <li> <a href="{{route('vendor.wallet.view',Auth::user()->id)}}" class="{{request()->segment(2)=='address'?'waves-effect active':''}}" ><i class="fas fa-map-marker-alt"></i><span> Wallet View </span></a> </li>
        
        @endif

               <li> <a class="dropdown-item" href="{{ route('vandor.logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('vandor.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li> 

        
        
        
        
      </li>
      
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
</div>
<!-- Left Sidebar End -->
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
function clk(){
  if($("#dsh").is(":visible")){
    $("#logo-new").hide();
    $(".topbar-left").hide();
    $("body").addClass('sidebar-close');
  } else{
    $("#logo-new").show();
    $(".topbar-left").show();
    $("body").addClass('sidebar-open');
  }
}
</script>
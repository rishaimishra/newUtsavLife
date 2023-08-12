@section('head')
@include('admin.includes.head')
@endsection
<style>

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
#sidebar-menu > ul > li > a.active {
    background: #9c27b0 !important;
}
</style>
{{-- <body class="fixed-left"> --}}
  <!-- Begin page -->
  <div id="wrapper">
    <!-- Top Bar Start -->
    <div class="topbar">
      <!-- LOGO -->
      <div class="topbar-left">
        <div class="text-center">
          {{-- <a href="index.html" class="logo"><img src="{{url('/')}}/assets/img/logo-d-long.png" alt=""></a> --}}
         <h1 id="logo-new" style="color:white">Go party</h1>
        </div>
      </div>
      <!-- Button mobile view to collapse sidebar menu -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="">
            <div class="pull-left">
              <button class="button-menu-mobile open-left" onclick="clk()"> <i class="fa fa-bars"></i> </button> <span class="clearfix"></span> </div>
              <!--<form class="navbar-form pull-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control search-bar" placeholder="Type here for search...">
                </div>
                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
              </form>-->
              <ul class="nav navbar-nav navbar-right pull-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"> @if(@Auth::user()->avatar)
                  <img src="{{url('/')}}/storage/app/public/vandor/{{Auth::user()->avatar}}" alt="" class="thumb-md img-circle">@else<i class='fas fa-user-tie' style='font-size:36px;color: black;'  ></i> @endif  </a>
                  <ul class="dropdown-menu">
                    {{--  <li><a href="javascript:void(0)"><i class="fas fa-user-circle"></i> Profile</a></li> --}}
                    {{--  <li><a href="{{route('change.password')}}"><i class="fas fa-cog"></i> Change Password</a></li> --}}
                    <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> Logout</a></li>
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
            <div class="pull-left"> @if(@Auth::user()->avatar)
            <img src="{{url('/')}}/storage/app/public/vandor/{{Auth::user()->avatar}}" alt="" class="thumb-md img-circle">@else<i class='fas fa-user-tie' style='font-size:36px;color: black;'  ></i> @endif</div>
            <div class="user-info">
              <div class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">admin Panel<span class="caret"></span></a>
              <ul class="dropdown-menu">
               
                <li> <a class="dropdown-item" href="{{ route('admin.logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
                  {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </div>
          <p class="text-muted m-0">{{@Auth::guard('admin')->user()->name}}</p>
        </div>
      </div>
      <!--- Divider -->
      <div id="sidebar-menu">
        <ul>
          <li> <a href="{{route('admin.dashboard')}}" class="{{request()->segment(2)=='dashboard'?'waves-effect active':''}}" ><i class="fas fa-cog ri5"></i><span id="dsh"> Dashboard </span></a> </li>

            <li> <a href="{{route('admin.category.list')}}" class="{{request()->segment(2)=='manage-category'?'waves-effect active':''}}" ><i class="fas fa-user"></i></i><span> Category </span></a> </li>
        
        
          <li> <a href="{{route('admin.service.list')}}" class="{{request()->segment(2)=='manage-service'?'waves-effect active':''}}" ><i class="fas fa-cog ri5"></i><span> Service </span></a> </li>

          <li> <a href="{{route('admin.vandor.list')}}" class="{{request()->segment(2)=='manage-vandors'?'waves-effect active':''}}" ><i class="fas fa-cog ri5"></i><span> Vandor list </span></a> </li> 

         <li> <a href="{{route('admin.customer.list')}}" class="{{request()->segment(2)=='manage-customers'?'waves-effect active':''}}" ><i class="fas fa-cog ri5"></i><span> Customer list </span></a> </li> 

         <li> <a href="{{route('admin.agent.list')}}" class="{{request()->segment(2)=='manage-agents'?'waves-effect active':''}}" ><i class="fas fa-cog ri5"></i><span> Agent list </span></a> </li> 
{{-- 
          <li> <a href="{{route('admin.lead.list')}}" class="{{request()->segment(2)=='manage-leads'?'waves-effect active':''}}" ><i class="fas fa-cog ri5"></i><span> Lead list </span></a> </li> 


          <li> <a href="{{route('admin.all.orders')}}" class="{{request()->segment(2)=='manage-orders'?'waves-effect active':''}}" ><i class="fas fa-cog ri5"></i><span> Order list </span></a> </li>  --}}

         
          
          
   

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
    } else{
        $("#logo-new").show();
      }
  }
</script>
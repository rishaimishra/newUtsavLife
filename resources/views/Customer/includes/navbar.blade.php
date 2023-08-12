
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <h1>Customer panel</h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <h3><a class="nav-link active" aria-current="page" href="{{route('cust.dashboard')}}">Home</a></h3>
          </li>
          {{-- <li class="nav-item">
            <h3><a class="nav-link" aria-current="page" href="{{route('cust.details')}}">User Detail</a></h3>
          </li> --}}
          @if(@Auth::user()->id)
          <li class="nav-item">
            <h3><a class="nav-link" aria-current="page" href="{{route('cust.profile.page')}}">Edit Profile</a></h3>
          </li>

          <li class="nav-item">
            <h3><a class="nav-link" aria-current="page" href="{{route('cust.all.orders')}}">Orders</a></h3>
          </li>

          <li class="nav-item">
            <h3><a class="nav-link" aria-current="page" href="{{route('cust.cart')}}">Cart</a></h3>
          </li>
          <li class="nav-item">
            <h3><a class="nav-link" aria-current="page" href="{{route('cust.logout')}}">Logout</a></h3>
          </li>
          @endif


           <li class="nav-item">
            <h3><a class="nav-link" aria-current="page" href="{{route('cust.cart')}}">Cart</a></h3>
          </li>

          
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" name="searchme" id="searchme" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
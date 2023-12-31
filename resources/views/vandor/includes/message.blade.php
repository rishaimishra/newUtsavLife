@if(Session::has('success'))
    <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>
            {!!Session::get('success')!!}
        </strong>
    </div>              
@endif
{{-- 
    <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>
            {!!Session::get('success2')!!}
        </strong>
    </div>              
 --}}
@if(Session::has('error'))
    <div class="alert alert-danger">
      <a href="#" class="close" id="a" data-dismiss="alert">&times;</a>
        <strong>
            {{Session::get('error')}}
        </strong>
    </div>
@endif
@if ($errors->any())
{{-- @dd($errors->all()) --}}
    <div class="alert alert-danger alert-dismissible" style="text-align: center;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="list-style: none;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(".close").click(function(){
  $(".alert").hide(200);
});
</script>
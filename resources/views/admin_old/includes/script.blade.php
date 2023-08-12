
<script src="https://kit.fontawesome.com/446e463225.js" crossorigin="anonymous"></script>
<script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/modernizr.min.js"></script>


    <script>
    var resizefunc = [];
    </script>
    <!-- jQuery  -->
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/jquery.min.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/detect.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/fastclick.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/jquery.slimscroll.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/jquery.blockUI.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/waves.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/wow.min.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/jquery.nicescroll.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/jquery.scrollTo.min.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/js/jquery.app.js"></script>
    <!-- jQuery  -->
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/moment/moment.js"></script>
    <!-- jQuery  -->
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/counterup/jquery.counterup.min.js"></script>
    <!-- jQuery  -->
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
    <!-- flot Chart -->
 {{--    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/flot-chart/jquery.flot.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/flot-chart/jquery.flot.time.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/flot-chart/jquery.flot.resize.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/flot-chart/jquery.flot.pie.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/flot-chart/jquery.flot.selection.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/flot-chart/jquery.flot.stack.js"></script>
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/plugins/flot-chart/jquery.flot.crosshair.js"></script> --}}
    <!-- jQuery  -->
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/pages/jquery.todo.js"></script>
    <!-- jQuery  -->
    <script src="{{url('/')}}/public/vandorAgentJsCss/assets/pages/jquery.chat.js"></script>
    <!-- jQuery  -->
    {{-- <script src="{{url('/')}}/public/vandorAgentJsCss/assets/pages/jquery.dashboard.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
       <script>
  $( function() {
    $( "#datepicker" ).datepicker({
     onSelect: function(selected) {
          $("#datepicker2").datepicker("option","minDate", selected)
        }
    });
  } );
  </script>
   <script>
  $( function() {
    $( "#datepicker2" ).datepicker({
     onSelect: function(selected) {
          $("#datepicker").datepicker("option","maxDate", selected)
        }
    });
  } );
</script>
    <script type="text/javascript">
    /* ==============================================

                Counter Up

                =============================================== */
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
    </script>


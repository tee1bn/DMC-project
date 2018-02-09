

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            @if(Auth::user()->phone_verification_token == 'verified')
                <button type="button" class="close" data-dismiss="modal">&times;</button>
          @endif
          <h4 class="modal-title">Phone Verification</h4>
        </div>
        <div class="modal-body">
          <p>Kindly enter the Code that is sent to your phone</p>


        <form method="post" action="{{route('verify-phone')}}">
                        {{ csrf_field() }}
            Enter Code:<input type="text" class="form-control" name="phone_verification_code">

                    @if($errors->any())
                                    <span class="help-block">
                                        <strong>{{ $errors->first() }}</strong>
                                    </span>
                    @endif

               

            <div class="clearfix"></div>
        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-default">Verify</button>
            <a href="{{route('resend-phonecode', Auth::User()->id)}}"><button class="btn btn-default">Resend Code</button></a>
        </div>
        </form>
        </div>

    
      </div>
      
    </div>
  </div>
  

  <script>

    function phone_verification_form() {
phone = '{{Auth::user()->phone_verification_token}}' ;

if(phone != 'verified'){

$('#myModal').modal({
    backdrop: 'static',
    keyboard: false
});

}


            }


    setTimeout(phone_verification_form, 1000);


</script>
   

    <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>



    <!-- jQuery -->
    <script src="{{asset('gentellela/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('gentellela/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('gentellela/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('gentellela/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('gentellela/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{asset('gentellela/vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('gentellela/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('gentellela/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('gentellela/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('gentellela/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('gentellela/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('gentellela/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('gentellela/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('gentellela/vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('gentellela/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{asset('gentellela/build/js/custom.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('gentellela/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('gentellela/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('gentellela/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

  </body>
</html>
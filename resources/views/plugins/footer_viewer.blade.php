  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <b>Version</b> 1.0.2
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 Vince Dale Alcantara.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script defer src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- SweetAlert --->
<script defer src="{{asset('/plugins/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/dist/js/adminlte.js')}}"></script>

<!-- AJAX CSRF -->
<script type="text/javascript">
  $(() => {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  });
</script>

<noscript>We are facing Script issues. Kindly enable JavaScript</noscript>

</body>
</html>

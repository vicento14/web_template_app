 <footer class="main-footer">
    <strong>Copyright &copy; 2023. Developed by: Vince Dale Alcantara</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.2
    </div>
  </footer>

@include('modals/logout_modal')
@include('modals/new_account')
@include('modals/update_account')
@include('modals/import_accounts')
@include('modals/confirm_delete_account_selected')

<!-- jQuery -->
<script src="{{asset('/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- SweetAlert2 -->
<script type="text/javascript" src="{{asset('/plugins/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/dist/js/adminlte.js')}}"></script>
<!-- Popup Center -->
<script src="{{asset('/dist/js/popup_center.js')}}"></script>
<!-- Export CSV -->
<script src="{{asset('/dist/js/export_csv.js')}}"></script>
<!-- Serialize -->
<script src="{{asset('/dist/js/serialize.js')}}"></script>

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

</body>
</html>

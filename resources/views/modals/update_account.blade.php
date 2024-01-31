<div class="modal fade bd-example-modal-xl" id="update_account" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <b>Update Account Details</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-4">
            <input type="hidden" id="id_account_update" class="form-control">
            <label>Employee No:</label>
            <input type="text" id="employee_no_update" class="form-control" autocomplete="off" style="height:45px; border: 1px solid black; font-size: 25px;">
          </div>
          <div class="col-4">
            <label>Full Name:</label>
            <input type="text" id="full_name_update" class="form-control" autocomplete="off" style="height:45px; border: 1px solid black; font-size: 25px;">
          </div>
          <div class="col-4">
            <label>Username:</label>
            <input type="text" id="username_update" class="form-control" autocomplete="off" style="height:45px; border: 1px solid black; font-size: 25px;">
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <label>Password:</label>
            <input type="password" id="password_update" class="form-control" autocomplete="off" style="height:45px; border: 1px solid black; font-size: 25px;">
          </div>
          <div class="col-4">
            <label>Section:</label>
            <input type="text" id="section_update" class="form-control" autocomplete="off" style="height:45px; border: 1px solid black;">
          </div>
           <div class="col-4">
            <label>User Type:</label>
            <select id="user_type_update" class="form-control" style="height:45px; border: 1px solid black;">
              <option value="">Select User Type</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
        </div>
        <br>
        <hr>
        <div class="row">
          <div class="col-9">
            <div class="float-left">
              <a href="#" class="btn btn-danger" onclick="delete_account()">Delete Account</a>
            </div>
          </div>
          <div class="col-3">
            <div class="float-right">
              <a href="#" class="btn btn-primary" onclick="update_account()">Update Account</a>
            </div>
          </div>
        </div>
      <!-- /.card-body -->
      </div>
    <!-- /.card -->
    </div>
  </div>
</div>

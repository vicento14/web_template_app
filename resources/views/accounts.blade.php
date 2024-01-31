@include('plugins/navbar')
@include('plugins/sidebar/admin_bar')

<!-- Main Sidebar Container -->
<section class="content">
  <div class="container-fluid">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Account Management</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Account Management</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="row mb-2">
        <div class="col-2">
          <a href="#" class="btn btn-info btn-block" data-toggle="modal" data-target="#new_account">Register Account</a>
        </div>
        <div class="col-2">
          <a href="#" class="btn btn-info btn-block" data-toggle="modal" data-target="#import_accounts">Import Account</a>
        </div>
        <div class="col-2">
          <a href="#" class="btn btn-info btn-block" onclick="export_employees()">Export Account</a>
        </div>
        <div class="col-2">
          <a href="#" class="btn btn-info btn-block" onclick="export_csv('accounts_table')">Export Account 2</a>
        </div>
        <div class="col-2">
          <button class="btn btn-info  btn-block btn-file">
            <form id="file_form" enctype="multipart/form-data">
              <span class="mx-0 my-0" id="loading_indicator"> Import Account 2 </span><input type="file" id="file2" name="file" onchange="upload_csv()" accept=".csv">
            </form>
          </button>
        </div>
        <div class="col-2">
          <a href="#" class="btn btn-info btn-block" onclick="export_employees3()">Export Account 3</a>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-2">
          <a href="#" class="btn btn-info btn-block" onclick="popup1()">Export Account 3 Popup</a>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          &ensp;
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title col-12">
                <div class="row">
                  <div class="col-lg-2 col-sm-3">
                    <span><b>Employee No:</b></span>
                    <input type="text" id="employee_no_search" class="form-control" autocomplete="off" style="height:45px; border: 1px solid black; font-size: 25px;">
                  </div>
                  <div class="col-lg-2 col-sm-3">
                    <span><b>Full Name:</b></span>
                    <input type="text" id="full_name_search" class="form-control" autocomplete="off" style="height:45px; border: 1px solid black; font-size: 25px;">
                  </div>
                  <div class="col-lg-2 col-sm-3">
                    <span><b>User Type:</b></span>
                    <select id="user_type_search" class="form-control" style="height:45px; border: 1px solid black; font-size: 15px;">
                      <option value="">Select User Type</option>
                      <option value="admin">Admin</option>
                      <option value="user">User</option>
                    </select>
                  </div>
                  <div class="col-lg-6 col-sm-3">
                    <div class="float-right">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="search_accounts()">Search <i class="fas fa-search"></i></button>
                    </div> 
                  </div>
                </div>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
              <table class="table table-head-fixed text-nowrap table-hover" id="accounts_table">
                <thead style="text-align:center;">
                  <th> # </th>
                  <th> Employee No. </th>
                  <th> Username </th>
                  <th> Full Name </th>
                  <th> Section </th>
                  <th> User Type </th>
                </thead>
                <tbody id="list_of_accounts" style="text-align:center;"></tbody>
              </table>
              <div class="row">
                <div class="col-6"></div>
                <div class="col-6">   
                  <div class="spinner" id="spinner" style="display:none;">
                    <div class="loader float-sm-center"></div>    
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title col-12">
                JQUERY AJAX Load
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
              <table class="table table-head-fixed text-nowrap table-hover" id="accounts_table2">
                <thead style="text-align:center;">
                  <th> # </th>
                  <th> Employee No. </th>
                  <th> Username </th>
                  <th> Full Name </th>
                  <th> Section </th>
                  <th> User Type </th>
                </thead>
                <tbody id="list_of_accounts2" style="text-align:center;"></tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div>
  </div>
</section>

@include('plugins/footer')
@include('plugins/js/accounts_script')

@include('plugins/navbar')
@include('plugins/sidebar/admin_bar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sample 1</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Sample 1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-2">
                    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#new_account"><i class="fas fa-plus-circle mr-2"></i>Register
                        Account</a>
                </div>
                <div class="col-2">
                    <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#import_accounts"><i class="fas fa-upload mr-2"></i>Import
                        Account</a>
                </div>
                <div class="col-2">
                    <a href="#" class="btn btn-secondary btn-block" onclick="export_employees()"><i class="fas fa-download mr-2"></i>Export Account</a>
                </div>
                <div class="col-2">
                    <a href="#" class="btn btn-info btn-block" id="export_csv"><i class="fas fa-download mr-2"></i>Export Account
                        2</a>
                </div>
                <div class="col-2">
                    <button class="btn btn-warning btn-block btn-file">
                        <form id="file_form" enctype="multipart/form-data">
                            <span class="mx-0 my-0" id="loading_indicator"><i class="fas fa-upload mr-2"></i> Import Account 2 </span><input type="file"
                                id="file2" name="file" onchange="upload_csv()" accept=".csv">
                        </form>
                    </button>
                </div>
                <div class="col-2">
                    <a href="#" class="btn btn-primary btn-block" onclick="export_employees3()"><i class="fas fa-download mr-2"></i>Export Account 3</a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-2">
                    <a href="#" class="btn btn-info btn-block" onclick="popup1()"><i class="fas fa-download mr-2"></i>Export Account 3 Popup</a>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#confirm_delete_account_selected" id="checkbox_control" disabled><i class="fas fa-trash mr-2"></i>Delete Checked</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user"></i> Accounts Table</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-3">
                                    <label>Employee No:</label>
                                    <input type="text" id="employee_no_search" class="form-control" autocomplete="off">
                                </div>
                                <div class="col-sm-3">
                                    <label>Full Name:</label>
                                    <input type="text" id="full_name_search" class="form-control" autocomplete="off">
                                </div>
                                <div class="col-sm-3">
                                    <label>User Type:</label>
                                    <select id="user_type_search" class="form-control">
                                        <option value="">Select User Type</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-block btn-primary" id="searchReqBtn"
                                        onclick="search_accounts()"><i class="fas fa-search mr-2"></i>Search</button>
                                </div>
                            </div>
                            <div class="table-responsive" style="height: 500px; overflow: auto; display:inline-block;">
                                <table class="table table-head-fixed text-nowrap table-hover" id="accounts_table">
                                    <thead style="text-align:center;">
                                        <th>
                                            <input type="checkbox" name="" id="check_all"  onclick="select_all_func()">
                                        </th>
                                        <th> # </th>
                                        <th> Employee No. </th>
                                        <th> Username </th>
                                        <th> Full Name </th>
                                        <th> Section </th>
                                        <th> User Type </th>
                                    </thead>
                                    <tbody id="list_of_accounts" style="text-align:center;"></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
</div>

@include('plugins/footer')
@include('plugins/js/sample1_script')

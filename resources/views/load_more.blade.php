@include('plugins/navbar')
@include('plugins/sidebar/user_bar')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Load More</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user/pagination') }}">Home</a></li>
                        <li class="breadcrumb-item active">Load More</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-file-alt"></i> Accounts Table</h3>
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
                                        onclick="search_accounts(1)"><i class="fas fa-search mr-2"></i>Search</button>
                                </div>
                            </div>
                            <div id="accounts_table_res" class="table-responsive"
                                style="height: 300px; overflow: auto; display:inline-block;">
                                <table id="accounts_table"
                                    class="table table-sm table-head-fixed text-nowrap table-hover">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th> # </th>
                                            <th> Employee No. </th>
                                            <th> Username </th>
                                            <th> Full Name </th>
                                            <th> Section </th>
                                            <th> User Type </th>
                                        </tr>
                                    </thead>
                                    <tbody id="list_of_accounts" style="text-align: center;">
                                        <tr>
                                            <td colspan="6" style="text-align:center;">
                                                <div class="spinner-border text-dark" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-sm-end">
                                <div class="dataTables_info" id="accounts_table_info" role="status" aria-live="polite">
                                </div>
                            </div>
                            <div class="d-flex justify-content-sm-center">
                                <button type="button" class="btn bg-gray-dark" id="btnNextPage" style="display:none;"
                                    onclick="get_next_page()">Load more</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
</div>

@include('plugins/footer')
@include('plugins/js/load_more_script')

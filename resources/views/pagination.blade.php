@include('plugins/navbar')
@include('plugins/sidebar/user_bar')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pagination</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user/pagination') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pagination</li>
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
                                        onclick="search_accounts(1, 0)"><i
                                            class="fas fa-search mr-2"></i>Search</button>
                                </div>
                            </div>
                            <div class="table-responsive" style="height: 400px; overflow: auto; display:inline-block;">
                                <table id="accounts_table"
                                    class="table table-sm table-head-fixed text-nowrap table-hover">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th id="c_th" style="cursor: pointer;" onclick="th_order_by(1)"> # <i
                                                    class="fas fa-sort-numeric-up ml-2"></i></th>
                                            <th id="employee_no_th" style="cursor: pointer;" onclick="th_order_by(2)">
                                                Employee No. </th>
                                            <th id="username_th" style="cursor: pointer;" onclick="th_order_by(4)">
                                                Username </th>
                                            <th id="fullname_th" style="cursor: pointer;" onclick="th_order_by(6)"> Full
                                                Name </th>
                                            <th id="section_th" style="cursor: pointer;" onclick="th_order_by(8)">
                                                Section </th>
                                            <th id="role_th" style="cursor: pointer;" onclick="th_order_by(10)"> User
                                                Type </th>
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
                            <div class="row">
                                <div class="col-sm-12 col-md-9 col-9">
                                    <div class="dataTables_info" id="accounts_table_info" role="status"
                                        aria-live="polite"></div>
                                    <input type="hidden" id="count_rows">
                                </div>
                                <div class="col-sm-12 col-md-1 col-1">
                                    <button type="button" id="btnPrevPage" class="btn bg-gray-dark btn-block"
                                        onclick="get_prev_page()">Prev</button>
                                </div>
                                <div class="col-sm-12 col-md-1 col-1">
                                    <input type="text" list="accounts_table_paginations" class="form-control"
                                        id="accounts_table_pagination">
                                    <datalist id="accounts_table_paginations"></datalist>
                                    <!-- <div class="dataTables_paginate paging_simple_numbers" id="accounts_table_pagination">
                  </div> -->
                                </div>
                                <div class="col-sm-12 col-md-1 col-1">
                                    <button type="button" id="btnNextPage" class="btn bg-gray-dark btn-block"
                                        onclick="get_next_page()">Next</button>
                                </div>
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
@include('plugins/js/pagination_script')

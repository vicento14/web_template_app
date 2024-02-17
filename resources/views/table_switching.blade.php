@include('plugins/navbar')
@include('plugins/sidebar/user_bar')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Table Switching</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user/pagination') }}">Home</a></li>
                        <li class="breadcrumb-item active">Table Switching</li>
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
                            <h3 class="card-title"><i class="fas fa-file-alt mr-2"></i>t_t1 Table</h3>
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
                            <div class="row mb-2" id="t_t1_breadcrumb">
                                <div class="col-12">
                                    <ol class="breadcrumb bg-white mb-0">
                                        <li class="breadcrumb-item"><a href="#" onclick="load_t_t1()">Back</a></li>
                                        <li class="breadcrumb-item active" id="lbl_c1"></li>
                                    </ol>
                                </div>
                            </div>
                            <div class="table-responsive" style="height: 400px; overflow: auto; display:inline-block;">
                                <table id="t_table" class="table table-sm table-head-fixed text-nowrap table-hover">
                                </table>
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
@include('plugins/js/table_switching_script')

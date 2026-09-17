@extends('Admin.main')

@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/schedule') }}'">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Schedule Leads</span>
                                <span class="info-box-number"> {{ $data['schedule_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/schedule') }}'">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Today's Schedule Leads</span>
                                <span class="info-box-number"> {{ $data['today_schedule_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/allleads') }}'">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Uncaptured Leads</span>
                                <span class="info-box-number"> {{ $data['uncapture_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/allleads') }}'">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Captured Leads</span>
                                <span class="info-box-number"> {{ $data['capture_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/list/hot') }}'">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="fa fa-fire"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Hot Leads</span>
                                <span class="info-box-number"> {{ $data['hot_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/list/warm') }}'">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fa fa-sun-o"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Warm Leads</span>
                                <span class="info-box-number"> {{ $data['warm_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>






                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/list/cold') }}'">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fa fa-snowflake-o"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Cold Leads</span>
                                <span class="info-box-number"> {{ $data['cold_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/list/dead') }}'">
                        <div class="info-box bg-secondary">
                            <span class="info-box-icon"><i class="fa fa-ban"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Dead Leads</span>
                                <span class="info-box-number"> {{ $data['dead_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/list/closed') }}'">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fa fa-check-circle-o"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Closed Leads</span>
                                <span class="info-box-number"> {{ $data['closed_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>


                    <div class="col-md-6 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/list/a_process') }}'">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Admin Processed Leads</span>
                                <span class="info-box-number"> {{ $data['a_process_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/admin/list/a_complete') }}'">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Admin Completed Leads</span>
                                <span class="info-box-number"> {{ $data['a_completed_lead'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>





                    <div class="col-md-4 col-sm-4 col-12">
                        <div class="info-box bg-primary">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Amount</span>
                                <span class="info-box-number"> <i class="fa fa-inr"></i> {{ $data['t_amount'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-4 col-12">
                        <div class="info-box bg-secondary">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Received Amount</span>
                                <span class="info-box-number"> <i class="fa fa-inr"></i> {{ $data['r_amount'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-4 col-12">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Due Amount</span>
                                <span class="info-box-number"> <i class="fa fa-inr"></i> {{ $data['t_amount']-$data['r_amount'] }}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    </div>


    <!-- /.content-wrapper -->
@endsection

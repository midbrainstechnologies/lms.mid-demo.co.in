@extends('LeadCreator.main')

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
                            <li class="breadcrumb-item"><a href="{{ url('/tele-caller') }}">Home</a></li>
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


                    <div class="col-md-6 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/schedule') }}'">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Schedule Leads</span>
                                <span class="info-box-number"> {{$data['schedule_lead']}}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-12"style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/schedule') }}'">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Today's Schedule Leads</span>
                                <span class="info-box-number"> {{$data['today_schedule_lead']}}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/transferred-list') }}'">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Uncaptured Leads</span>
                                <span class="info-box-number"> {{$data['uncapture_lead']}}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/captured-list') }}'">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Captured Leads</span>
                                <span class="info-box-number"> {{$data['capture_lead']}}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/list/new') }}'">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">New Leads</span>
                                <span class="info-box-number"> {{$data['new_lead']}}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12"style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/list/t_approve') }}'">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Approved Leads</span>
                                <span class="info-box-number"> {{$data['approve_lead']}}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>






                    <div class="col-md-3 col-sm-6 col-12"style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/list/t_process') }}'">
                        <div class="info-box bg-primary">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Process Leads</span>
                                <span class="info-box-number"> {{$data['process_lead']}}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/list/t_hot') }}'">
                        <div class="info-box bg-secondary">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Hot Leads</span>
                                <span class="info-box-number"> {{$data['hot_lead']}}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/list/t_complete') }}'">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Completed Leads</span>
                                <span class="info-box-number"> {{$data['complete_lead']}}</span>



                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/list/ringing') }}'">
                        <div class="info-box bg-primary">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Ringing Leads</span>
                                <span class="info-box-number"> {{$data['ringing']}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/list/callback') }}'">
                        <div class="info-box bg-secondary">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Call Back Leads</span>
                                <span class="info-box-number"> {{$data['callback']}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/list/switchoff') }}'">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Switch Off Leads</span>
                                <span class="info-box-number"> {{$data['switchoff']}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer;" onclick="window.location='{{ url('/tele-caller/list/t_delete') }}'">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Deleted Leads</span>
                                <span class="info-box-number"> {{$data['delete_lead']}}</span>



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

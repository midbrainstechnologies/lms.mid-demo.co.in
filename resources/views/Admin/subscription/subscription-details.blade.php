@extends('Admin.main')

@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Subscription</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Subscription</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row clearfix g-3">
                    <div class="col-sm-12">
                        @if (Session()->has('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Uff!</h5>
                                {{ Session()->get('error') }}
                            </div>
                        @endif
                        @if (Session()->has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Success!</h5>
                                {{ Session()->get('success') }}
                            </div>
                        @endif


                    </div>
                </div>
                <div class="row">

                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h4>Subscription Details</h4>


                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Business Name: </td>
                                            <td>{{ $business->name }}</td>
                                        </tr>

                                        <tr>
                                            <td>Business Email: </td>
                                            <td>{{ $business->email }}</td>
                                        </tr>

                                        <tr>
                                            <td>Plan Details</td>
                                            <td>
                                                Your subscription plan currently consists of:<br>
                                                <style>
                                                    .table-2 {
                border-collapse: collapse;
                width: 50%;
                margin: 20px 0px;
            }

            .table-2 th {
                font-size: 15px;
                padding: 0.45rem;
                background: linear-gradient(180deg, rgba(255, 219, 60, 0.9), rgba(255, 196, 0, 0.9));
                color: #333;
            }

            .table-2 tr{
                border-top-left-radius: 5px;
            }

            .table-2 td {
                font-size: 15px;
                padding: 0.35rem;
            }

            .table-2 tbody tr:nth-child(odd) {
                background-color: rgba(231, 231, 231, 0.4);
                text-align: center
            }

            .table-2 tbody tr:nth-child(even) {
                background-color: rgba(187, 187, 187, 0.712);
                text-align: center
            }
                                                </style>
                                                <table class="table-2 table-bordered">
                                                    <tbody>

                                                    <tr>
                                                        <td style="font-size: 18px;font-weight: 500;">1</td>
                                                        <td>Admin</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 18px;font-weight: 500;">{{ $business->lead_creator_limit }}</td>
                                                        <td>Lead Creators</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 18px;font-weight: 500;">{{ $business->telecaller_limit }}</td>
                                                        <td>Tele Callers</td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Plan Start Date: </td>
                                            <td style="font-weight: 600">
                                               {{ $business->plan_start_date }}
                                            </td>
                                        </tr>

                                        @php
                                            $endDate = \Carbon\Carbon::parse($business->plan_end_date);
                                            $daysRemaining = now()->diffInDays($endDate, false); // false = signed difference
                                        @endphp

                                        <tr>
                                            <td>Plan End Date: </td>
                                            <td style="font-weight: 600; {{ $daysRemaining <= 2 ? 'color: red;' : '' }}">
                                                {{ $business->plan_end_date }}

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>


                                @if ($daysRemaining <= 2)
                                    <p style="color:red; text-align: center; display: block;">
                                        Plan expiring soon. Access will be denied after plan expiry. Please contact the owner for further information or renewal.
                                    </p>
                                @endif


                            </div>
                        </div>


                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <div class="modal fade" id="modalAddUpdates" tabindex="-1" aria-labelledby="modalAddUpdatesLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAddUpdatesLabel">Update Profile</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                                        class="fa fa-times"></i></button>
                            </div>
                            <form method="post" action="{{ asset('admin/profileupdate') }}">
                                @csrf
                                <div class="modal-body">

                                    <div class="alert alert-danger" id="messageError" style="display: none;"></div>

                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Name</label>
                                        <input name="name" required id="name" autocomplete="off"
                                            value="{{ $user->name }}" minlength="2" type="text"
                                            class="form-control ps-2 form-control-line">
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Email Address</label>
                                        <input disabled required id="email_address" autocomplete="off"
                                            value="{{ $user->email }}" minlength="5" type="email"
                                            class="form-control ps-2 form-control-line">
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" value="Update Details" id="profile_update"
                                        class="btn btn-primary" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

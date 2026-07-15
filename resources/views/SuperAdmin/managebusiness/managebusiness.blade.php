@extends('SuperAdmin.main')

@section('body')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Business List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/super-admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Business List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <style>
            .story {
                width: 100%;
                margin: 1rem auto 0rem;
                background-color: #fff;
                 /* background: linear-gradient(180deg, rgba(255, 246, 204, 0.9), rgba(255, 233, 159, 0.9)); */
                /* font-size: 1.6rem; */
                border-radius: 3px;
                box-shadow: 0 3rem 6rem rgba(0, 0, 0, 0.1);
                padding: 1.5rem 1.5rem 1.5rem 1.5rem;
                /* transform: skewX(-12deg); */
            }
            .table-bordered td, .table-bordered th {
                border: 1px solid #ffffff;
            }

            .table {
                border-collapse: collapse;
                width: 100%;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
            }

            .table th {
                font-size: 15px;
                padding: 0.45rem;
                background: linear-gradient(180deg, rgba(255, 219, 60, 0.9), rgba(255, 196, 0, 0.9));
                color: #333;

            }

            .table tr{
                border-top-left-radius: 5px;
            }

            .table td {
                font-size: 15px;
                padding: 0.35rem;
            }

            .table tbody tr:nth-child(odd) {
                background-color: rgba(255, 241, 150, 0.4);

            }

            .table tbody tr:nth-child(even) {
                background-color: rgba(255, 224, 100, 0.712);
                /* Lighter orange */
            }
        </style>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row story">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Plan Name</th>
                                <th>Status</th>
                                <th>Plan Start Date</th>
                                <th>Plan End Date</th>
                                <th>Lead Creator Count</th>
                                <th>Tele Caller Count</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($businesses as $business)
                                <tr>
                                    <td>{{ $businesses->count() - $loop->index }}</td>
                                    <td>{{ $business->name }}</td>
                                    <td>{{ $business->plan_name }}</td>
                                    <td>
                                        @switch($business->status)
                                            @case('active')
                                                <span class="badge bg-success">Active</span>
                                            @break

                                            @case('suspended')
                                                <span class="badge bg-danger">Suspended</span>
                                            @break

                                            @case('trial')
                                                <span class="badge bg-warning text-dark">Trial</span>
                                            @break

                                            @case('inactive')
                                                <span class="badge bg-secondary">Inactive</span>
                                            @break

                                            @default
                                                <span class="badge bg-light text-dark">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td style="font-weight: 500;">
                                        {{ $business->plan_start_date ? $business->plan_start_date->format('d M Y') : '-' }}
                                    </td>
                                    <td style="font-weight: 500;">
                                        {{ $business->plan_end_date ? $business->plan_end_date->format('d M Y') : '-' }}
                                    </td>
                                    <td style="font-weight: 500;">{{ $business->lead_creator_limit }}
                                    </td>
                                    <td style="font-weight: 500;">{{ $business->telecaller_limit }}
                                    </td>


                                    <td>
                                        <a href="{{ route('businesses.edit', $business->id) }}" class="text-primary me-2"
                                            title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <form action="{{ route('businesses.destroy', $business->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger border-0 bg-transparent p-0"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this business?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No businesses found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>



                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->

        </div>
    @endsection

@extends('SuperAdmin.main')

@section('body')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Admin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Admin</li>
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
            /* font-size: 1.6rem; */
            border-radius: 3px;
            box-shadow: 0 3rem 6rem rgba(0, 0, 0, 0.1);
            padding: 2rem 2rem 2rem 2rem;
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
        <div class="content ">
            <div class="container-fluid">
                <div class="row story">

                    <!-- Dropdown Form -->
                    <form method="GET" action="{{ route('admin.list') }}">
                        <div class="row">
                        <div class="form-group col-md-12">
                            <label for="business_id">Select Business</label>
                            <select name="business_id" id="business_id" class="form-control" onchange="this.form.submit()">
                                <option value="">-- Select Business --</option>
                                @foreach ($businesses as $business)
                                    <option value="{{ $business->id }}"
                                        {{ $selectedBusinessId == $business->id ? 'selected' : '' }}>
                                        {{ $business->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </form>

                    <!-- Admin List -->
                    @if (!empty($admins))
                        <table class="table table-bordered mt-2 " >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Verification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ ucfirst($admin->user_role) }}</td>
                                        <td>{{ $admin->mobile }}</td>
                                        <td>{{ $admin->address1 }}</td>
                                        <td>
                                            @switch($admin->status)
                                                @case('1')
                                                    <span class="badge bg-success">Active</span>
                                                @break

                                                @case('0')
                                                    <span class="badge bg-danger">Inactive</span>
                                                @break

                                                @default
                                                    <span class="badge bg-light text-dark">Unknown</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($admin->verify)
                                                @case('1')
                                                    <span class="badge bg-success">Verified</span>
                                                @break

                                                @case('0')
                                                    <span class="badge bg-danger">Not Verified</span>
                                                @break

                                                @default
                                                    <span class="badge bg-light text-dark">Unknown</span>
                                            @endswitch
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.edit', $admin->id) }}" class="text-primary me-2" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger border-0 bg-transparent p-0"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this entry?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No admins found for this business.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @endif

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->

        </div>

    @endsection

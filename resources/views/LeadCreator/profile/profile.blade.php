@extends('Admin.main')

@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/lead-creater') }}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body profile-card">
                                <center class="mt-4">
                                    <div class="profile-photo"
                                        style="
                                        background: url('@if (auth()->user()->photo != '' or auth()->user()->photo != null) {{ url(auth()->user()->photo) }}@else{{ asset(env('APP_LOGO')) }} @endif');
                                        background-size: cover;
                                        background-position: center;
                                        border-radius: 50%;
                                        width: 180px;
                                        height: 180px;">
                                    </div>
                                    <h4 class="card-title mt-2" style="text-align: center;">{{ $user->name }}</h4>
                                    <h6 class="card-subtitle"></h6>
                                </center>

                                <hr>

                                <form action="{{ url('/lead-creater/profilephotoupload') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Upload Image</label>
                                        <input type="file" name="photo" id="photo" class="form-control" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Image uploading
                                            guidelines:</label>
                                        <ul>
                                            <li>Recommended file size is atleast 5MB or less</li>
                                            <li>Recommended resolution is atleast 600x600.</li>
                                            <li>Only accepts JPG, JPEG, PNG & GIF files.</li>
                                        </ul>
                                    </div>

                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary text-white btn-theme"
                                            name="update_picture" id="update_picture" value="Update Image" />
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h4>Personal Information</h4>


                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td> Name: </td>
                                            <td>{{ $user->name }}</td>
                                        </tr>

                                        <tr>
                                            <td>Email: </td>
                                            <td>{{ $user->email }}</td>
                                        </tr>

                                        <tr>
                                            <td>Role: </td>
                                            <td style="text-transform: capitalize">
                                                @if (auth()->user()->user_role == 'admin')
                                                    {{ 'Admin' }}
                                                @elseif (auth()->user()->user_role == 'lead-creater')
                                                    {{ 'Lead Creator' }}
                                                @endif
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-primary mx-auto mx-md-0 text-white btn-theme"
                                    data-toggle="modal" data-target="#modalAddUpdates" value="Edit Profile" />

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
                            <form method="post" action="{{ url('/lead-creater/profileupdate') }}">
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

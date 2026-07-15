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
                margin: 0rem auto 0rem;
                /* background-color: #fff; */
                background: linear-gradient(180deg, rgba(255, 186, 57, 0.719), rgba(255, 208, 55, 0.9));
                /* font-size: 1.6rem; */
                border-radius: 10px;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
                padding: 2rem 2rem 2rem 2rem;
                /* transform: skewX(-12deg); */
            }
            .story-2 {
                width: 100%;
                margin: 1rem auto 0rem;
                background-color: #fff;
                /* background: linear-gradient(180deg, rgba(255, 186, 57, 0.719), rgba(255, 208, 55, 0.9)); */
                /* font-size: 1.6rem; */
                border-radius: 10px;
                box-shadow: 0 3rem 6rem rgba(0, 0, 0, 0.1);
                padding: 2rem 2rem 2rem 2rem;
                /* transform: skewX(-12deg); */
            }

        </style>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row story-2">

                    <div class="container">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ isset($admin) ? route('admin.update', $admin->id) : route('admins.store') }}" method="POST" class="story">
                            @csrf

                            <div class="container">
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $admin->id ?? '' }}">

                                    {{-- Name --}}
                                    <div class="form-group col-md-4">
                                        <label for="name">Name *</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name') }}" required>
                                    </div>

                                    {{-- Email --}}
                                    <div class="form-group col-md-4">
                                        <label for="email">Email *</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" required>
                                    </div>

                                    {{-- Password --}}
                                    <div class="form-group col-md-4">
                                        <label for="password">Password *</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    {{-- Confirm Password --}}
                                    <div class="form-group col-md-4">
                                        <label for="password_confirmation">Confirm Password *</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>

                                    {{-- Mobile --}}
                                    <div class="form-group col-md-4">
                                        <label for="mobile">Mobile *</label>
                                        <input type="text" name="mobile" class="form-control"
                                            value="{{ old('mobile') }}" maxlength="15" required>
                                    </div>

                                    {{-- Address 1 --}}
                                    <div class="form-group col-md-4">
                                        <label for="address1">Address Line 1 *</label>
                                        <input type="text" name="address1" class="form-control"
                                            value="{{ old('address1') }}" required>
                                    </div>

                                    {{-- Address 2 --}}
                                    <div class="form-group col-md-4">
                                        <label for="address2">Address Line 2</label>
                                        <input type="text" name="address2" class="form-control"
                                            value="{{ old('address2') }}">
                                    </div>

                                    {{-- User Role --}}
                                    <div class="form-group col-md-4">
                                        <label for="user_role">User Role *</label>
                                        <select name="user_role" class="form-control" required>
                                            <option value="">-- Select Role --</option>
                                            <option value="admin" {{ old('user_role') == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            {{-- Uncomment and add other roles if needed --}}
                                            {{-- <option value="lead-creater" {{ old('user_role') == 'lead-creater' ? 'selected' : '' }}>Lead Creater</option>
                    <option value="tele-caller" {{ old('user_role') == 'tele-caller' ? 'selected' : '' }}>Tele Caller</option> --}}
                                        </select>
                                    </div>

                                    {{-- Business --}}
                                    <div class="form-group col-md-4">
                                        <label for="business_id">Business *</label>
                                        <select name="business_id" class="form-control" required>
                                            <option value="">-- Select Business --</option>
                                            @foreach ($businesses as $business)
                                                <option value="{{ $business->id }}"
                                                    {{ old('business_id') == $business->id ? 'selected' : '' }}>
                                                    {{ $business->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Create Admin</button>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    </div>
@endsection

@extends('SuperAdmin.main')

@section('body')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Business</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add New Business</li>
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

                        <form
                            action="{{ isset($business) ? route('businesses.update', $business->id) : route('businesses.store') }}"
                            method="POST" class="story">
                            @csrf
                            @if (isset($business))
                                @method('PUT')
                            @endif
                            <div class="row">

                                {{-- Business Info --}}
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label">Business Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $business->name ?? '') }}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="email" class="form-label">Business Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email', $business->email ?? '') }}" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">Select Status</option>
                                        <option value="active"
                                            {{ old('status', $business->status ?? '') == 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="suspended"
                                            {{ old('status', $business->status ?? '') == 'suspended' ? 'selected' : '' }}>
                                            Suspended</option>
                                        <option value="trial"
                                            {{ old('status', $business->status ?? '') == 'trial' ? 'selected' : '' }}>Trial
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $business->status ?? '') == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Subscription Info --}}
                                <div class="mb-3 col-md-4">
                                    <label for="plan_name" class="form-label">Plan Name</label>
                                    <input type="text" name="plan_name" id="plan_name" class="form-control"
                                        value="{{ old('plan_name', $business->plan_name ?? '') }}" required>
                                    @error('plan_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="plan_start_date" class="form-label">Plan Start Date</label>
                                    <input type="date" name="plan_start_date" id="plan_start_date" class="form-control"
                                        value="{{ old('plan_start_date', isset($business) && $business->plan_start_date ? $business->plan_start_date->format('Y-m-d') : '') }}"
                                        required>
                                    @error('plan_start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="plan_end_date" class="form-label">Plan End Date</label>
                                    <input type="date" name="plan_end_date" id="plan_end_date" class="form-control"
                                        value="{{ old('plan_end_date', isset($business) && $business->plan_end_date ? $business->plan_end_date->format('Y-m-d') : '') }}"
                                        required>
                                    @error('plan_end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4" style="display: none;">
                                    <label for="price" class="form-label">Subscription Price</label>
                                    <input type="number" name="price" id="price" class="form-control" step="0.01"
                                        value="{{ old('price', $business->price ?? '') }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="lead_creator_limit" class="form-label">Lead Creator Limit</label>
                                    <input type="number" name="lead_creator_limit" id="lead_creator_limit"
                                        class="form-control"
                                        value="{{ old('lead_creator_limit', $business->lead_creator_limit ?? 1) }}"
                                        required min="1">
                                    @error('lead_creator_limit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="telecaller_limit" class="form-label">Telecaller Limit</label>
                                    <input type="number" name="telecaller_limit" id="telecaller_limit"
                                        class="form-control"
                                        value="{{ old('telecaller_limit', $business->telecaller_limit ?? 5) }}" required
                                        min="0">
                                    @error('telecaller_limit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($business) ? 'Update Business' : 'Add Business' }}
                            </button>
                        </form>

                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    </div>
@endsection

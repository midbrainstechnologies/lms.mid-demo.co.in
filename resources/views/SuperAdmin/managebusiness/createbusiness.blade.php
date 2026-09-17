@extends('SuperAdmin.main')

@section('body')

<div class="content-wrapper modern-page">

    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="modern-page-header">

                <div>
                    <div class="page-title-row">
                        <div class="page-title-icon">
                            <i class="fas fa-building"></i>
                        </div>

                        <div>
                            <h1 class="modern-page-title">
                                {{ isset($business) ? 'Edit Business' : 'Add New Business' }}
                            </h1>

                            <p class="modern-page-subtitle">
                                {{ isset($business)
                                    ? 'Update business information and subscription settings.'
                                    : 'Create a new business account and configure its subscription.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <ol class="modern-breadcrumb">
                    <li>
                        <a href="{{ url('/super-admin') }}">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </li>

                    <li>
                        <i class="fas fa-chevron-right"></i>
                    </li>

                    <li class="active">
                        {{ isset($business) ? 'Edit Business' : 'Add Business' }}
                    </li>
                </ol>

            </div>

        </div>
    </div>


    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="modern-alert success-alert">
                    <div class="alert-icon">
                        <i class="fas fa-check"></i>
                    </div>

                    <div>
                        <strong>Success</strong>
                        <div>{{ session('success') }}</div>
                    </div>

                    <button type="button"
                            class="alert-close"
                            onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif


            <form
                action="{{ isset($business)
                    ? route('businesses.update', $business->id)
                    : route('businesses.store') }}"
                method="POST">

                @csrf

                @if (isset($business))
                    @method('PUT')
                @endif


                <!-- =========================
                     BUSINESS INFORMATION
                ========================== -->

                <div class="modern-card">

                    <div class="modern-card-header">

                        <div class="section-icon">
                            <i class="fas fa-building"></i>
                        </div>

                        <div>
                            <h3>Business Information</h3>
                            <p>
                                Basic information about the business account.
                            </p>
                        </div>

                    </div>


                    <div class="modern-card-body">

                        <div class="row">

                            <!-- Business Name -->
                            <div class="col-md-6 form-group-modern">

                                <label for="name">
                                    Business Name
                                    <span>*</span>
                                </label>

                                <div class="input-wrapper">

                                    <i class="fas fa-building input-icon"></i>

                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="modern-input"
                                        placeholder="Enter business name"
                                        value="{{ old('name', $business->name ?? '') }}"
                                        required>

                                </div>

                                @error('name')
                                    <small class="modern-error">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            <!-- Business Email -->
                            <div class="col-md-6 form-group-modern">

                                <label for="email">
                                    Business Email
                                    <span>*</span>
                                </label>

                                <div class="input-wrapper">

                                    <i class="fas fa-envelope input-icon"></i>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="modern-input"
                                        placeholder="business@example.com"
                                        value="{{ old('email', $business->email ?? '') }}"
                                        required>

                                </div>

                                @error('email')
                                    <small class="modern-error">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            <!-- Status -->
                            <div class="col-md-6 form-group-modern">

                                <label for="status">
                                    Account Status
                                    <span>*</span>
                                </label>

                                <div class="input-wrapper">

                                    <i class="fas fa-circle-check input-icon"></i>

                                    <select
                                        name="status"
                                        id="status"
                                        class="modern-input modern-select"
                                        required>

                                        <option value="">
                                            Select status
                                        </option>

                                        <option value="active"
                                            {{ old('status', $business->status ?? '') == 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="suspended"
                                            {{ old('status', $business->status ?? '') == 'suspended' ? 'selected' : '' }}>
                                            Suspended
                                        </option>

                                        <option value="trial"
                                            {{ old('status', $business->status ?? '') == 'trial' ? 'selected' : '' }}>
                                            Trial
                                        </option>

                                        <option value="inactive"
                                            {{ old('status', $business->status ?? '') == 'inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>

                                    </select>

                                </div>

                                @error('status')
                                    <small class="modern-error">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =========================
                     SUBSCRIPTION
                ========================== -->

                <div class="modern-card">

                    <div class="modern-card-header">

                        <div class="section-icon purple">
                            <i class="fas fa-credit-card"></i>
                        </div>

                        <div>
                            <h3>Subscription</h3>
                            <p>
                                Configure the business subscription plan.
                            </p>
                        </div>

                    </div>


                    <div class="modern-card-body">

                        <div class="row">

                            <!-- Plan Name -->
                            <div class="col-md-4 form-group-modern">

                                <label for="plan_name">
                                    Plan Name
                                    <span>*</span>
                                </label>

                                <div class="input-wrapper">

                                    <i class="fas fa-layer-group input-icon"></i>

                                    <input
                                        type="text"
                                        name="plan_name"
                                        id="plan_name"
                                        class="modern-input"
                                        placeholder="e.g. Professional"
                                        value="{{ old('plan_name', $business->plan_name ?? '') }}"
                                        required>

                                </div>

                                @error('plan_name')
                                    <small class="modern-error">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            <!-- Start Date -->
                            <div class="col-md-4 form-group-modern">

                                <label for="plan_start_date">
                                    Plan Start Date
                                    <span>*</span>
                                </label>

                                <div class="input-wrapper">

                                    <i class="far fa-calendar input-icon"></i>

                                    <input
                                        type="date"
                                        name="plan_start_date"
                                        id="plan_start_date"
                                        class="modern-input"
                                        value="{{ old(
                                            'plan_start_date',
                                            isset($business) && $business->plan_start_date
                                                ? $business->plan_start_date->format('Y-m-d')
                                                : ''
                                        ) }}"
                                        required>

                                </div>

                                @error('plan_start_date')
                                    <small class="modern-error">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            <!-- End Date -->
                            <div class="col-md-4 form-group-modern">

                                <label for="plan_end_date">
                                    Plan End Date
                                    <span>*</span>
                                </label>

                                <div class="input-wrapper">

                                    <i class="far fa-calendar input-icon"></i>

                                    <input
                                        type="date"
                                        name="plan_end_date"
                                        id="plan_end_date"
                                        class="modern-input"
                                        value="{{ old(
                                            'plan_end_date',
                                            isset($business) && $business->plan_end_date
                                                ? $business->plan_end_date->format('Y-m-d')
                                                : ''
                                        ) }}"
                                        required>

                                </div>

                                @error('plan_end_date')
                                    <small class="modern-error">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =========================
                     USER LIMITS
                ========================== -->

                <div class="modern-card">

                    <div class="modern-card-header">

                        <div class="section-icon green">
                            <i class="fas fa-users"></i>
                        </div>

                        <div>
                            <h3>User Limits</h3>
                            <p>
                                Set the maximum number of users available for this business.
                            </p>
                        </div>

                    </div>


                    <div class="modern-card-body">

                        <div class="row">

                            <!-- Lead Creator -->
                            <div class="col-md-6 form-group-modern">

                                <label for="lead_creator_limit">
                                    Lead Creator Limit
                                    <span>*</span>
                                </label>

                                <div class="input-wrapper">

                                    <i class="fas fa-user-plus input-icon"></i>

                                    <input
                                        type="number"
                                        name="lead_creator_limit"
                                        id="lead_creator_limit"
                                        class="modern-input"
                                        placeholder="Enter limit"
                                        value="{{ old(
                                            'lead_creator_limit',
                                            $business->lead_creator_limit ?? 1
                                        ) }}"
                                        min="1"
                                        required>

                                </div>

                                <small class="field-help">
                                    Maximum number of lead creators allowed.
                                </small>

                                @error('lead_creator_limit')
                                    <small class="modern-error">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            <!-- Telecaller -->
                            <div class="col-md-6 form-group-modern">

                                <label for="telecaller_limit">
                                    Telecaller Limit
                                    <span>*</span>
                                </label>

                                <div class="input-wrapper">

                                    <i class="fas fa-headset input-icon"></i>

                                    <input
                                        type="number"
                                        name="telecaller_limit"
                                        id="telecaller_limit"
                                        class="modern-input"
                                        placeholder="Enter limit"
                                        value="{{ old(
                                            'telecaller_limit',
                                            $business->telecaller_limit ?? 5
                                        ) }}"
                                        min="0"
                                        required>

                                </div>

                                <small class="field-help">
                                    Maximum number of telecallers allowed.
                                </small>

                                @error('telecaller_limit')
                                    <small class="modern-error">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =========================
                     ACTION BAR
                ========================== -->

                <div class="form-actions">

                    <a href="{{ route('managebusiness') }}"
                       class="modern-btn secondary-btn">

                        <i class="fas fa-arrow-left"></i>

                        Cancel

                    </a>


                    <button type="submit"
                            class="modern-btn primary-btn">

                        <i class="fas fa-check"></i>

                        {{ isset($business) ? 'Update Business' : 'Create Business' }}

                    </button>

                </div>

            </form>

        </div>
    </div>

</div>


<style>

    /* =====================================
       MODERN BUSINESS FORM
    ===================================== */

    .modern-page {
        background: #f6f7fb;
        min-height: calc(100vh - 57px);
    }


    /* PAGE HEADER */

    .modern-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 10px 0 22px;
    }

    .page-title-row {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .page-title-icon {
        width: 45px;
        height: 45px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 18px;
    }

    .modern-page-title {
        margin: 0;
        color: #111827;
        font-size: 26px;
        font-weight: 700;
        letter-spacing: -0.4px;
    }

    .modern-page-subtitle {
        margin: 4px 0 0;
        color: #6b7280;
        font-size: 13px;
    }


    /* BREADCRUMB */

    .modern-breadcrumb {
        display: flex;
        align-items: center;
        gap: 9px;
        list-style: none;
        margin: 0;
        padding: 9px 13px;
        background: #fff;
        border: 1px solid #e8ebf1;
        border-radius: 9px;
        font-size: 13px;
    }

    .modern-breadcrumb a {
        color: #4f46e5;
        text-decoration: none;
    }

    .modern-breadcrumb i {
        font-size: 10px;
        color: #9ca3af;
    }

    .modern-breadcrumb .active {
        color: #6b7280;
    }


    /* ALERT */

    .modern-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding: 13px 15px;
        border-radius: 11px;
        border: 1px solid #bbf7d0;
        background: #f0fdf4;
        color: #166534;
        font-size: 13px;
    }

    .alert-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #dcfce7;
    }

    .alert-close {
        margin-left: auto;
        border: 0;
        background: transparent;
        color: #6b7280;
        cursor: pointer;
    }


    /* CARD */

    .modern-card {
        margin-bottom: 18px;
        background: #fff;
        border: 1px solid #e6e9ef;
        border-radius: 14px;
        box-shadow: 0 3px 15px rgba(15, 23, 42, .04);
        overflow: hidden;
    }


    /* CARD HEADER */

    .modern-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 18px 21px;
        border-bottom: 1px solid #eef0f4;
    }

    .modern-card-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
    }

    .modern-card-header p {
        margin: 3px 0 0;
        color: #9ca3af;
        font-size: 12px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #eef2ff;
        color: #4f46e5;
    }

    .section-icon.purple {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .section-icon.green {
        background: #ecfdf5;
        color: #059669;
    }


    /* CARD BODY */

    .modern-card-body {
        padding: 21px;
    }


    /* FORM */

    .form-group-modern {
        margin-bottom: 20px;
    }

    .form-group-modern label {
        display: block;
        margin-bottom: 7px;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
    }

    .form-group-modern label span {
        color: #ef4444;
        margin-left: 2px;
    }


    /* INPUT */

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 13px;
        pointer-events: none;
        z-index: 2;
    }

    .modern-input {
        width: 100%;
        height: 43px;
        padding: 0 13px 0 39px;
        border: 1px solid #dfe3ea;
        border-radius: 9px;
        background: #fff;
        color: #1f2937;
        font-size: 13px;
        outline: none;
        transition: all .2s ease;
        box-shadow: none !important;
    }

    .modern-input::placeholder {
        color: #b0b6c1;
    }

    .modern-input:hover {
        border-color: #cbd1dc;
    }

    .modern-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .10) !important;
    }

    .modern-select {
        appearance: auto;
        cursor: pointer;
    }


    /* HELP TEXT */

    .field-help {
        display: block;
        margin-top: 6px;
        color: #9ca3af;
        font-size: 11px;
    }


    /* ERRORS */

    .modern-error {
        display: block;
        margin-top: 6px;
        color: #dc2626;
        font-size: 11px;
    }


    /* ACTIONS */

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        padding: 3px 0 30px;
    }

    .modern-btn {
        min-height: 42px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all .2s ease;
    }

    .primary-btn {
        background: #4f46e5;
        color: #fff;
        box-shadow: 0 3px 8px rgba(79, 70, 229, .18);
    }

    .primary-btn:hover {
        background: #4338ca;
        color: #fff;
        transform: translateY(-1px);
    }

    .secondary-btn {
        background: #fff;
        border-color: #dfe3ea;
        color: #4b5563;
    }

    .secondary-btn:hover {
        background: #f9fafb;
        color: #111827;
        border-color: #cbd1dc;
    }


    /* RESPONSIVE */

    @media (max-width: 767px) {

        .modern-page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .modern-breadcrumb {
            width: 100%;
        }

        .modern-page-title {
            font-size: 22px;
        }

        .modern-card-header {
            padding: 16px;
        }

        .modern-card-body {
            padding: 16px;
        }

        .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .modern-btn {
            width: 100%;
        }

    }

</style>

@endsection

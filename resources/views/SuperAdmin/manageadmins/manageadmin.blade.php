@extends('SuperAdmin.main')

@section('body')

<div class="content-wrapper modern-page">

    <!-- =========================================
         PAGE HEADER
    ========================================== -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="modern-page-header">

                <div class="page-title-row">

                    <div class="page-title-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>

                    <div>
                        <h1 class="modern-page-title">
                            {{ isset($admin) ? 'Edit Admin' : 'Create Admin' }}
                        </h1>

                        <p class="modern-page-subtitle">
                            {{ isset($admin)
                                ? 'Update administrator information and access.'
                                : 'Create a new administrator and assign business access.'
                            }}
                        </p>
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

                    <li>
                        <a href="{{ route('admin.list') }}">
                            Admin Management
                        </a>
                    </li>

                    <li>
                        <i class="fas fa-chevron-right"></i>
                    </li>

                    <li class="active">
                        {{ isset($admin) ? 'Edit Admin' : 'Create Admin' }}
                    </li>

                </ol>

            </div>

        </div>
    </div>


    <!-- =========================================
         MAIN CONTENT
    ========================================== -->
    <div class="content">

        <div class="container-fluid">


            <!-- SUCCESS MESSAGE -->

            @if (session('success'))

                <div class="modern-alert success-alert">

                    <div class="alert-icon">
                        <i class="fas fa-check"></i>
                    </div>

                    <div>
                        <strong>Success</strong>

                        <div>
                            {{ session('success') }}
                        </div>
                    </div>

                    <button
                        type="button"
                        class="alert-close"
                        onclick="this.parentElement.remove()">

                        <i class="fas fa-times"></i>

                    </button>

                </div>

            @endif


            <!-- VALIDATION ERRORS -->

            @if ($errors->any())

                <div class="modern-alert error-alert">

                    <div class="alert-icon">
                        <i class="fas fa-exclamation"></i>
                    </div>

                    <div>

                        <strong>Please check the following:</strong>

                        <ul class="error-list">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                    <button
                        type="button"
                        class="alert-close"
                        onclick="this.parentElement.remove()">

                        <i class="fas fa-times"></i>

                    </button>

                </div>

            @endif


            <!-- =========================================
                 FORM CARD
            ========================================== -->

            <div class="modern-card admin-form-card">

                <div class="modern-card-header">

                    <div class="form-header-left">

                        <div class="section-icon purple">
                            <i class="fas fa-user-shield"></i>
                        </div>

                        <div>

                            <h3>
                                Administrator Information
                            </h3>

                            <p>
                                Enter the administrator's account and business details.
                            </p>

                        </div>

                    </div>

                    <div class="required-note">
                        * Required fields
                    </div>

                </div>


                <form
                    action="{{ isset($admin)
                        ? route('admin.update', $admin->id)
                        : route('admins.store') }}"
                    method="POST">

                    @csrf

                    @if (isset($admin))
                        @method('PUT')
                    @endif


                    <input
                        type="hidden"
                        name="id"
                        value="{{ $admin->id ?? '' }}">


                    <div class="modern-form-body">


                        <!-- =================================
                             ACCOUNT INFORMATION
                        ================================== -->

                        <div class="form-section">

                            <div class="form-section-title">

                                <div class="form-section-icon">
                                    <i class="fas fa-user"></i>
                                </div>

                                <div>

                                    <h4>Account Information</h4>

                                    <p>
                                        Basic login and administrator details.
                                    </p>

                                </div>

                            </div>


                            <div class="row">

                                <!-- NAME -->

                                <div class="col-md-4">

                                    <div class="modern-form-group">

                                        <label for="name">
                                            Full Name
                                            <span>*</span>
                                        </label>

                                        <div class="input-wrapper">

                                            <i class="fas fa-user input-icon"></i>

                                            <input
                                                type="text"
                                                name="name"
                                                id="name"
                                                class="modern-input"
                                                placeholder="Enter full name"
                                                value="{{ old('name', $admin->name ?? '') }}"
                                                required>

                                        </div>

                                        @error('name')
                                            <small class="field-error">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                </div>


                                <!-- EMAIL -->

                                <div class="col-md-4">

                                    <div class="modern-form-group">

                                        <label for="email">
                                            Email Address
                                        </label>

                                        <div class="input-wrapper">

                                            <i class="fas fa-envelope input-icon"></i>

                                            <input
                                                type="email"
                                                name="email"
                                                id="email"
                                                class="modern-input"
                                                placeholder="admin@example.com"
                                                value="{{ old('email', $admin->email ?? '') }}"
                                                required>

                                        </div>

                                        @error('email')
                                            <small class="field-error">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                </div>


                                <!-- MOBILE -->

                                <div class="col-md-4">

                                    <div class="modern-form-group">

                                        <label for="mobile">
                                            Mobile Number
                                            <span>*</span>
                                        </label>

                                        <div class="input-wrapper">

                                            <i class="fas fa-phone input-icon"></i>

                                            <input
                                                type="text"
                                                name="mobile"
                                                id="mobile"
                                                class="modern-input"
                                                placeholder="Enter mobile number"
                                                value="{{ old('mobile', $admin->mobile ?? '') }}"
                                                maxlength="15"
                                                required>

                                        </div>

                                        @error('mobile')
                                            <small class="field-error">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                </div>


                                <!-- PASSWORD -->

                                <div class="col-md-6">

                                    <div class="modern-form-group">

                                        <label for="password">

                                            {{ isset($admin) ? 'New Password' : 'Password' }}

                                            @if (!isset($admin))
                                                <span>*</span>
                                            @endif

                                        </label>

                                        <div class="input-wrapper">

                                            <i class="fas fa-lock input-icon"></i>

                                            <input
                                                type="password"
                                                name="password"
                                                id="password"
                                                class="modern-input password-input"
                                                placeholder="{{ isset($admin) ? 'Leave blank to keep current password' : 'Enter password' }}"
                                                {{ !isset($admin) ? 'required' : '' }}>

                                            <button
                                                type="button"
                                                class="password-toggle"
                                                onclick="togglePassword('password', this)">

                                                <i class="fas fa-eye"></i>

                                            </button>

                                        </div>

                                        @error('password')
                                            <small class="field-error">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                </div>


                                <!-- CONFIRM PASSWORD -->

                                <div class="col-md-6">

                                    <div class="modern-form-group">

                                        <label for="password_confirmation">

                                            Confirm Password

                                            @if (!isset($admin))
                                                <span>*</span>
                                            @endif

                                        </label>

                                        <div class="input-wrapper">

                                            <i class="fas fa-lock input-icon"></i>

                                            <input
                                                type="password"
                                                name="password_confirmation"
                                                id="password_confirmation"
                                                class="modern-input password-input"
                                                placeholder="Confirm password"
                                                {{ !isset($admin) ? 'required' : '' }}>

                                            <button
                                                type="button"
                                                class="password-toggle"
                                                onclick="togglePassword('password_confirmation', this)">

                                                <i class="fas fa-eye"></i>

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- =================================
                             ACCESS & BUSINESS
                        ================================== -->

                        <div class="form-section">

                            <div class="form-section-title">

                                <div class="form-section-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>

                                <div>

                                    <h4>Access & Business</h4>

                                    <p>
                                        Define the administrator's role and business access.
                                    </p>

                                </div>

                            </div>


                            <div class="row">

                                <!-- ROLE -->

                                <div class="col-md-6">

                                    <div class="modern-form-group">

                                        <label for="user_role">
                                            User Role
                                            <span>*</span>
                                        </label>

                                        <div class="input-wrapper">

                                            <i class="fas fa-user-shield input-icon"></i>

                                            <select
                                                name="user_role"
                                                id="user_role"
                                                class="modern-input modern-select"
                                                required>

                                                <option value="">
                                                    Select user role
                                                </option>

                                                <option
                                                    value="admin"
                                                    {{ old('user_role', $admin->user_role ?? '') == 'admin'
                                                        ? 'selected'
                                                        : '' }}>

                                                    Administrator

                                                </option>

                                            </select>

                                            <i class="fas fa-chevron-down select-arrow"></i>

                                        </div>

                                        @error('user_role')
                                            <small class="field-error">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                </div>


                                <!-- BUSINESS -->

                                <div class="col-md-6">

                                    <div class="modern-form-group">

                                        <label for="business_id">
                                            Business
                                            <span>*</span>
                                        </label>

                                        <div class="input-wrapper">

                                            <i class="fas fa-building input-icon"></i>

                                            <select
                                                name="business_id"
                                                id="business_id"
                                                class="modern-input modern-select"
                                                required>

                                                <option value="">
                                                    Select business
                                                </option>

                                                @foreach ($businesses as $business)

                                                    <option
                                                        value="{{ $business->id }}"
                                                        {{ old('business_id', $admin->business_id ?? '') == $business->id
                                                            ? 'selected'
                                                            : '' }}>

                                                        {{ $business->name }}

                                                    </option>

                                                @endforeach

                                            </select>

                                            <i class="fas fa-chevron-down select-arrow"></i>

                                        </div>

                                        @error('business_id')
                                            <small class="field-error">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- =================================
                             ADDRESS
                        ================================== -->

                        <div class="form-section">

                            <div class="form-section-title">

                                <div class="form-section-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>

                                <div>

                                    <h4>Address Information</h4>

                                    <p>
                                        Administrator's business or contact address.
                                    </p>

                                </div>

                            </div>


                            <div class="row">

                                <!-- ADDRESS 1 -->

                                <div class="col-md-6">

                                    <div class="modern-form-group">

                                        <label for="address1">
                                            Address Line 1
                                            <span>*</span>
                                        </label>

                                        <div class="input-wrapper">

                                            <i class="fas fa-map-marker-alt input-icon"></i>

                                            <input
                                                type="text"
                                                name="address1"
                                                id="address1"
                                                class="modern-input"
                                                placeholder="Enter address"
                                                value="{{ old('address1', $admin->address1 ?? '') }}"
                                                required>

                                        </div>

                                        @error('address1')
                                            <small class="field-error">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>

                                </div>


                                <!-- ADDRESS 2 -->

                                <div class="col-md-6">

                                    <div class="modern-form-group">

                                        <label for="address2">
                                            Address Line 2
                                        </label>

                                        <div class="input-wrapper">

                                            <i class="fas fa-map-marker-alt input-icon"></i>

                                            <input
                                                type="text"
                                                name="address2"
                                                id="address2"
                                                class="modern-input"
                                                placeholder="Apartment, area, landmark etc."
                                                value="{{ old('address2', $admin->address2 ?? '') }}">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                    </div>


                    <!-- =================================
                         FORM FOOTER
                    ================================== -->

                    <div class="modern-form-footer">

                        <a
                            href="{{ route('admin.list') }}"
                            class="modern-btn secondary-btn">

                            <i class="fas fa-arrow-left"></i>

                            Cancel

                        </a>


                        <button
                            type="submit"
                            class="modern-btn primary-btn">

                            <i class="fas {{ isset($admin) ? 'fa-save' : 'fa-plus' }}"></i>

                            {{ isset($admin) ? 'Update Admin' : 'Create Admin' }}

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<style>

/* =====================================================
   PAGE
===================================================== */

.modern-page {
    background: #f6f7fb;
    min-height: calc(100vh - 57px);
}


/* =====================================================
   PAGE HEADER
===================================================== */

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

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #eef2ff;
    color: #4f46e5;

    font-size: 18px;
}

.modern-page-title {
    margin: 0;

    color: #111827;

    font-size: 26px;
    font-weight: 700;

    letter-spacing: -.4px;
}

.modern-page-subtitle {
    margin: 4px 0 0;

    color: #6b7280;

    font-size: 13px;
}


/* =====================================================
   BREADCRUMB
===================================================== */

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
    font-size: 9px;
    color: #9ca3af;
}

.modern-breadcrumb .active {
    color: #6b7280;
}


/* =====================================================
   CARD
===================================================== */

.modern-card {
    margin-bottom: 20px;

    background: #fff;

    border: 1px solid #e6e9ef;

    border-radius: 14px;

    box-shadow: 0 3px 15px rgba(15, 23, 42, .04);

    overflow: hidden;
}

.modern-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 20px 24px;

    border-bottom: 1px solid #edf0f4;
}

.form-header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.modern-card-header h3 {
    margin: 0;

    color: #1f2937;

    font-size: 16px;
    font-weight: 700;
}

.modern-card-header p {
    margin: 4px 0 0;

    color: #9ca3af;

    font-size: 12px;
}

.section-icon {
    width: 39px;
    height: 39px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #f5f3ff;
    color: #7c3aed;
}

.required-note {
    color: #9ca3af;
    font-size: 11px;
}


/* =====================================================
   FORM BODY
===================================================== */

.modern-form-body {
    padding: 25px 24px 5px;
}


/* =====================================================
   FORM SECTION
===================================================== */

.form-section {
    padding-bottom: 25px;
    margin-bottom: 25px;

    border-bottom: 1px solid #edf0f4;
}

.form-section:last-child {
    margin-bottom: 0;
    border-bottom: 0;
}

.form-section-title {
    display: flex;
    align-items: center;
    gap: 10px;

    margin-bottom: 22px;
}

.form-section-icon {
    width: 30px;
    height: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: #f8fafc;

    color: #6366f1;

    font-size: 12px;
}

.form-section-title h4 {
    margin: 0;

    color: #374151;

    font-size: 13px;
    font-weight: 700;
}

.form-section-title p {
    margin: 2px 0 0;

    color: #9ca3af;

    font-size: 11px;
}


/* =====================================================
   FORM GROUP
===================================================== */

.modern-form-group {
    margin-bottom: 19px;
}

.modern-form-group label {
    display: block;

    margin-bottom: 7px;

    color: #374151;

    font-size: 12px;
    font-weight: 600;
}

.modern-form-group label span {
    color: #ef4444;
}


/* =====================================================
   INPUT
===================================================== */

.input-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;

    left: 14px;
    top: 50%;

    transform: translateY(-50%);

    color: #9ca3af;

    font-size: 12px;

    pointer-events: none;

    z-index: 2;
}

.modern-input {
    width: 100%;
    height: 43px;

    padding: 0 14px 0 38px;

    background: #fff;

    border: 1px solid #dfe3ea;

    border-radius: 9px;

    color: #374151;

    font-size: 13px;

    outline: none;

    transition: all .18s ease;
}

.modern-input::placeholder {
    color: #b4bac4;
}

.modern-input:hover {
    border-color: #cbd1dc;
}

.modern-input:focus {
    border-color: #6366f1;

    box-shadow:
        0 0 0 3px rgba(99, 102, 241, .09);
}

.modern-select {
    padding-right: 40px;

    appearance: none;

    cursor: pointer;
}

.select-arrow {
    position: absolute;

    right: 14px;
    top: 50%;

    transform: translateY(-50%);

    color: #9ca3af;

    font-size: 9px;

    pointer-events: none;
}


/* =====================================================
   PASSWORD
===================================================== */

.password-input {
    padding-right: 42px;
}

.password-toggle {
    position: absolute;

    right: 11px;
    top: 50%;

    transform: translateY(-50%);

    width: 28px;
    height: 28px;

    border: 0;
    background: transparent;

    color: #9ca3af;

    cursor: pointer;
}

.password-toggle:hover {
    color: #4f46e5;
}


/* =====================================================
   ERROR
===================================================== */

.field-error {
    display: block;

    margin-top: 5px;

    color: #dc2626;

    font-size: 11px;
}


/* =====================================================
   ALERT
===================================================== */

.modern-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;

    margin-bottom: 18px;

    padding: 13px 15px;

    border-radius: 10px;

    font-size: 12px;

    position: relative;
}

.success-alert {
    background: #ecfdf5;

    border: 1px solid #d1fae5;

    color: #047857;
}

.error-alert {
    background: #fef2f2;

    border: 1px solid #fee2e2;

    color: #b91c1c;
}

.alert-icon {
    width: 25px;
    height: 25px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 7px;

    background: rgba(255,255,255,.7);
}

.alert-close {
    margin-left: auto;

    border: 0;
    background: transparent;

    color: currentColor;

    opacity: .6;

    cursor: pointer;
}

.alert-close:hover {
    opacity: 1;
}

.error-list {
    margin: 5px 0 0;
    padding-left: 17px;
}


/* =====================================================
   FORM FOOTER
===================================================== */

.modern-form-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;

    gap: 10px;

    padding: 17px 24px;

    background: #fafbfc;

    border-top: 1px solid #edf0f4;
}


/* =====================================================
   BUTTONS
===================================================== */

.modern-btn {
    height: 40px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 0 17px;

    border-radius: 8px;

    font-size: 12px;
    font-weight: 600;

    text-decoration: none;

    cursor: pointer;

    transition: all .18s ease;
}

.primary-btn {
    border: 1px solid #4f46e5;

    background: #4f46e5;

    color: #fff;

    box-shadow: 0 3px 8px rgba(79,70,229,.18);
}

.primary-btn:hover {
    background: #4338ca;

    border-color: #4338ca;

    color: #fff;

    transform: translateY(-1px);
}

.secondary-btn {
    border: 1px solid #dfe3ea;

    background: #fff;

    color: #6b7280;
}

.secondary-btn:hover {
    background: #f8fafc;

    color: #374151;

    border-color: #cbd1dc;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 767px) {

    .modern-page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .modern-breadcrumb {
        width: 100%;

        overflow-x: auto;

        white-space: nowrap;
    }

    .modern-page-title {
        font-size: 22px;
    }

    .modern-card-header {
        align-items: flex-start;

        flex-direction: column;

        gap: 10px;
    }

    .modern-form-body {
        padding: 20px 16px 5px;
    }

    .modern-form-footer {
        padding: 15px 16px;

        justify-content: stretch;
    }

    .modern-btn {
        flex: 1;
    }

}

</style>


<script>

function togglePassword(inputId, button) {

    const input = document.getElementById(inputId);

    const icon = button.querySelector('i');

    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');

    } else {

        input.type = 'password';

        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');

    }

}

</script>

@endsection

@extends('SuperAdmin.main')

@section('body')

<div class="content-wrapper modern-profile-page">

    <!-- =========================================
         PAGE HEADER
    ========================================== -->

    <div class="content-header">
        <div class="container-fluid">

            <div class="profile-page-header">

                <div class="page-heading">

                    <div class="page-heading-icon">
                        <i class="fas fa-user"></i>
                    </div>

                    <div>
                        <h1>My Profile</h1>

                        <p>
                            Manage your account information and profile picture.
                        </p>
                    </div>

                </div>


                <div class="modern-breadcrumb">

                    <a href="{{ url('/super-admin') }}">
                        <i class="fas fa-home"></i>
                        Home
                    </a>

                    <i class="fas fa-chevron-right"></i>

                    <span>Profile</span>

                </div>

            </div>

        </div>
    </div>


    <!-- =========================================
         CONTENT
    ========================================== -->

    <div class="content">

        <div class="container-fluid">


            <!-- =====================================
                 ALERTS
            ====================================== -->

            @if (Session()->has('error'))

                <div class="profile-alert profile-alert-danger">

                    <div class="profile-alert-icon">
                        <i class="fas fa-exclamation"></i>
                    </div>

                    <div>
                        <strong>Something went wrong</strong>

                        <p>
                            {{ Session()->get('error') }}
                        </p>
                    </div>

                    <button
                        type="button"
                        class="alert-close"
                        onclick="this.parentElement.remove()">

                        <i class="fas fa-times"></i>

                    </button>

                </div>

            @endif


            @if (Session()->has('success'))

                <div class="profile-alert profile-alert-success">

                    <div class="profile-alert-icon">
                        <i class="fas fa-check"></i>
                    </div>

                    <div>
                        <strong>Success</strong>

                        <p>
                            {{ Session()->get('success') }}
                        </p>
                    </div>

                    <button
                        type="button"
                        class="alert-close"
                        onclick="this.parentElement.remove()">

                        <i class="fas fa-times"></i>

                    </button>

                </div>

            @endif


            <!-- =====================================
                 PROFILE LAYOUT
            ====================================== -->

            <div class="row profile-layout">


                <!-- =================================
                     PROFILE CARD
                ================================== -->

                <div class="col-xl-4 col-lg-5">

                    <div class="profile-card">

                        <!-- PROFILE COVER -->

                        <div class="profile-cover">

                            <div class="profile-cover-shape shape-one"></div>
                            <div class="profile-cover-shape shape-two"></div>

                        </div>


                        <!-- PROFILE INFO -->

                        <div class="profile-card-body">

                            <div class="profile-image-wrapper">

                                <div
                                    class="profile-image"
                                    style="
                                        background: url('@if (auth()->user()->photo != '' or auth()->user()->photo != null) {{ url(auth()->user()->photo) }}@else{{ asset(env('APP_LOGO')) }} @endif');
                                        background-size: cover;
                                        "

                                    >
                                </div>

                                <div class="profile-online-dot"></div>

                            </div>


                            <h2 class="profile-name">
                                {{ $user->name }}
                            </h2>


                            <div class="profile-role">

                                <i class="fas fa-shield-alt"></i>

                                @if (auth()->user()->user_role == 'admin')
                                    Administrator
                                @elseif (auth()->user()->user_role == 'delivery')
                                    Delivery
                                @elseif (auth()->user()->user_role == 'super-admin')
                                    Super Administrator
                                @else
                                    {{ ucfirst(auth()->user()->user_role) }}
                                @endif

                            </div>


                            <div class="profile-email">

                                <i class="fas fa-envelope"></i>

                                {{ $user->email }}

                            </div>


                            <div class="profile-divider"></div>


                            <!-- UPLOAD PHOTO -->

                            <form
                                action="{{ asset('super-admin/profilephotoupload') }}"
                                method="POST"
                                enctype="multipart/form-data">

                                @csrf


                                <div class="upload-title">

                                    <div class="upload-icon">
                                        <i class="fas fa-camera"></i>
                                    </div>

                                    <div>

                                        <h4>Profile Picture</h4>

                                        <p>
                                            Update your account photo
                                        </p>

                                    </div>

                                </div>


                                <label
                                    for="photo"
                                    class="upload-box">

                                    <i class="fas fa-cloud-upload-alt"></i>

                                    <strong>
                                        Choose a new image
                                    </strong>

                                    <span>
                                        JPG, JPEG, PNG or GIF
                                    </span>

                                    <small>
                                        Recommended: 600 × 600px
                                    </small>

                                </label>


                                <input
                                    type="file"
                                    name="photo"
                                    id="photo"
                                    accept=".jpg,.jpeg,.png,.gif"
                                    hidden
                                    required>


                                <div
                                    id="selected-file"
                                    class="selected-file"
                                    style="display:none;">

                                    <i class="fas fa-image"></i>

                                    <span id="file-name"></span>

                                </div>


                                <button
                                    type="submit"
                                    class="profile-primary-btn">

                                    <i class="fas fa-upload"></i>

                                    Update Profile Picture

                                </button>

                            </form>


                            <div class="upload-guidelines">

                                <div class="guideline">

                                    <i class="fas fa-check"></i>

                                    Maximum size: 5MB

                                </div>

                                <div class="guideline">

                                    <i class="fas fa-check"></i>

                                    Recommended: 600 × 600px

                                </div>

                                <div class="guideline">

                                    <i class="fas fa-check"></i>

                                    JPG, JPEG, PNG & GIF

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =================================
                     PERSONAL INFORMATION
                ================================== -->

                <div class="col-xl-8 col-lg-7">

                    <div class="information-card">


                        <!-- CARD HEADER -->

                        <div class="information-header">

                            <div class="information-title">

                                <div class="information-icon">
                                    <i class="fas fa-user-circle"></i>
                                </div>

                                <div>

                                    <h3>Personal Information</h3>

                                    <p>
                                        Your account details and administrator information.
                                    </p>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="edit-profile-btn"
                                data-toggle="modal"
                                data-target="#modalAddUpdates">

                                <i class="fas fa-pen"></i>

                                Edit Profile

                            </button>

                        </div>


                        <!-- INFORMATION -->

                        <div class="information-body">


                            <!-- NAME -->

                            <div class="info-item">

                                <div class="info-item-icon">
                                    <i class="fas fa-user"></i>
                                </div>

                                <div class="info-content">

                                    <span class="info-label">
                                        Full Name
                                    </span>

                                    <strong>
                                        {{ $user->name }}
                                    </strong>

                                </div>

                            </div>


                            <!-- EMAIL -->

                            <div class="info-item">

                                <div class="info-item-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>

                                <div class="info-content">

                                    <span class="info-label">
                                        Email Address
                                    </span>

                                    <strong>
                                        {{ $user->email }}
                                    </strong>

                                </div>

                            </div>


                            <!-- ROLE -->

                            <div class="info-item">

                                <div class="info-item-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>

                                <div class="info-content">

                                    <span class="info-label">
                                        Account Role
                                    </span>

                                    <strong>

                                        @if (auth()->user()->user_role == 'admin')

                                            <span class="role-badge">
                                                <i class="fas fa-user-shield"></i>
                                                Administrator
                                            </span>

                                        @elseif (auth()->user()->user_role == 'delivery')

                                            <span class="role-badge">
                                                <i class="fas fa-truck"></i>
                                                Delivery
                                            </span>

                                        @elseif (auth()->user()->user_role == 'super-admin')

                                            <span class="role-badge">
                                                <i class="fas fa-crown"></i>
                                                Super Administrator
                                            </span>

                                        @else

                                            <span class="role-badge">
                                                {{ ucfirst(auth()->user()->user_role) }}
                                            </span>

                                        @endif

                                    </strong>

                                </div>

                            </div>


                            <!-- ACCOUNT STATUS -->

                            <div class="info-item">

                                <div class="info-item-icon">
                                    <i class="fas fa-circle-check"></i>
                                </div>

                                <div class="info-content">

                                    <span class="info-label">
                                        Account Status
                                    </span>

                                    <strong>

                                        <span class="status-badge">
                                            <span class="status-dot"></span>
                                            Active
                                        </span>

                                    </strong>

                                </div>

                            </div>


                        </div>


                        <!-- ACCOUNT SECURITY -->

                        <div class="security-section">

                            <div class="security-icon">

                                <i class="fas fa-lock"></i>

                            </div>

                            <div class="security-content">

                                <h4>
                                    Keep your account secure
                                </h4>

                                <p>
                                    Make sure your account information is always up to date.
                                </p>

                            </div>

                            <button
                                type="button"
                                class="security-btn"
                                data-toggle="modal"
                                data-target="#modalAddUpdates">

                                Update Details

                            </button>

                        </div>


                    </div>

                </div>


            </div>

        </div>

    </div>


    <!-- =========================================
         EDIT PROFILE MODAL
    ========================================== -->

    <div
        class="modal fade"
        id="modalAddUpdates"
        tabindex="-1"
        aria-labelledby="modalAddUpdatesLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modern-modal">

                <div class="modern-modal-header">

                    <div class="modal-heading">

                        <div class="modal-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>

                        <div>

                            <h4 id="modalAddUpdatesLabel">
                                Update Profile
                            </h4>

                            <p>
                                Update your personal information.
                            </p>

                        </div>

                    </div>


                    <button
                        type="button"
                        class="modern-modal-close"
                        data-dismiss="modal">

                        <i class="fas fa-times"></i>

                    </button>

                </div>


                <form
                    method="POST"
                    action="{{ asset('super-admin/profileupdate') }}">

                    @csrf


                    <div class="modern-modal-body">

                        <div
                            class="modal-error"
                            id="messageError"
                            style="display:none;">
                        </div>


                        <!-- NAME -->

                        <div class="modal-form-group">

                            <label for="name">
                                Full Name
                            </label>

                            <div class="modal-input-wrapper">

                                <i class="fas fa-user"></i>

                                <input
                                    name="name"
                                    required
                                    id="name"
                                    autocomplete="off"
                                    value="{{ $user->name }}"
                                    minlength="2"
                                    type="text"
                                    placeholder="Enter your name">

                            </div>

                        </div>


                        <!-- EMAIL -->

                        <div class="modal-form-group">

                            <label for="email_address">
                                Email Address
                            </label>

                            <div class="modal-input-wrapper disabled-input">

                                <i class="fas fa-envelope"></i>

                                <input
                                    disabled
                                    required
                                    id="email_address"
                                    autocomplete="off"
                                    value="{{ $user->email }}"
                                    minlength="5"
                                    type="email">

                            </div>

                            <small>
                                Email address cannot be changed from here.
                            </small>

                        </div>

                    </div>


                    <div class="modern-modal-footer">

                        <button
                            type="button"
                            class="modal-cancel-btn"
                            data-dismiss="modal">

                            Cancel

                        </button>


                        <button
                            type="submit"
                            id="profile_update"
                            class="modal-save-btn">

                            <i class="fas fa-save"></i>

                            Update Details

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


</div>


<style>

/* =====================================================
   MAIN
===================================================== */

.modern-profile-page {
    background: #f6f7fb;
    min-height: calc(100vh - 57px);
}


/* =====================================================
   PAGE HEADER
===================================================== */

.profile-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 8px 0 22px;
}

.page-heading {
    display: flex;
    align-items: center;
    gap: 13px;
}

.page-heading-icon {
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

.page-heading h1 {
    margin: 0;

    color: #111827;

    font-size: 26px;
    font-weight: 700;
}

.page-heading p {
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

    padding: 9px 13px;

    background: #fff;

    border: 1px solid #e7eaf0;

    border-radius: 9px;

    font-size: 12px;
}

.modern-breadcrumb a {
    color: #4f46e5;
    text-decoration: none;
}

.modern-breadcrumb span {
    color: #6b7280;
}

.modern-breadcrumb i {
    color: #9ca3af;
    font-size: 9px;
}


/* =====================================================
   ALERT
===================================================== */

.profile-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;

    margin-bottom: 18px;

    padding: 13px 15px;

    border-radius: 10px;

    position: relative;
}

.profile-alert-success {
    background: #ecfdf5;
    border: 1px solid #d1fae5;
    color: #047857;
}

.profile-alert-danger {
    background: #fef2f2;
    border: 1px solid #fee2e2;
    color: #b91c1c;
}

.profile-alert-icon {
    width: 28px;
    height: 28px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 8px;

    background: rgba(255,255,255,.8);
}

.profile-alert strong {
    display: block;
    font-size: 12px;
}

.profile-alert p {
    margin: 3px 0 0;
    font-size: 12px;
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


/* =====================================================
   PROFILE LAYOUT
===================================================== */

.profile-layout {
    row-gap: 20px;
}


/* =====================================================
   PROFILE CARD
===================================================== */

.profile-card {
    background: #fff;

    border: 1px solid #e6e9ef;

    border-radius: 15px;

    overflow: hidden;

    box-shadow: 0 3px 15px rgba(15,23,42,.04);
}

.profile-cover {
    height: 115px;

    position: relative;

    overflow: hidden;

    background:
        linear-gradient(
            135deg,
            #4338ca,
            #6366f1,
            #8b5cf6
        );
}

.profile-cover-shape {
    position: absolute;

    border-radius: 50%;

    background: rgba(255,255,255,.09);
}

.shape-one {
    width: 180px;
    height: 180px;

    right: -50px;
    top: -100px;
}

.shape-two {
    width: 130px;
    height: 130px;

    left: -55px;
    bottom: -90px;
}


/* =====================================================
   PROFILE BODY
===================================================== */

.profile-card-body {
    padding: 0 25px 25px;

    text-align: center;
}

.profile-image-wrapper {
    position: relative;

    width: 112px;
    height: 112px;

    margin: -56px auto 14px;
}

.profile-image {
    width: 112px;
    height: 112px;

    border-radius: 50%;

    background-color: #fff;

    background-size: cover;
    background-position: center;

    border: 5px solid #fff;

    box-shadow:
        0 5px 20px rgba(15,23,42,.16);
}

.profile-online-dot {
    position: absolute;

    width: 17px;
    height: 17px;

    right: 6px;
    bottom: 7px;

    background: #22c55e;

    border: 3px solid #fff;

    border-radius: 50%;
}

.profile-name {
    margin: 0;

    color: #111827;

    font-size: 20px;
    font-weight: 700;
}

.profile-role {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    margin-top: 7px;

    padding: 5px 10px;

    background: #eef2ff;

    border-radius: 20px;

    color: #4f46e5;

    font-size: 11px;
    font-weight: 600;
}

.profile-email {
    margin-top: 10px;

    color: #6b7280;

    font-size: 12px;
}

.profile-email i {
    margin-right: 5px;
    color: #9ca3af;
}

.profile-divider {
    height: 1px;

    margin: 22px 0;

    background: #edf0f4;
}


/* =====================================================
   UPLOAD
===================================================== */

.upload-title {
    display: flex;
    align-items: center;

    gap: 10px;

    text-align: left;

    margin-bottom: 13px;
}

.upload-icon {
    width: 35px;
    height: 35px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #f5f3ff;

    color: #7c3aed;

    font-size: 13px;
}

.upload-title h4 {
    margin: 0;

    color: #374151;

    font-size: 13px;
    font-weight: 700;
}

.upload-title p {
    margin: 2px 0 0;

    color: #9ca3af;

    font-size: 10px;
}

.upload-box {
    display: flex;
    flex-direction: column;
    align-items: center;

    gap: 4px;

    padding: 19px 10px;

    background: #fafbff;

    border: 1px dashed #cfd5e2;

    border-radius: 10px;

    cursor: pointer;

    transition: .2s;
}

.upload-box:hover {
    background: #f5f3ff;

    border-color: #8b5cf6;
}

.upload-box > i {
    margin-bottom: 4px;

    color: #6366f1;

    font-size: 22px;
}

.upload-box strong {
    color: #374151;

    font-size: 12px;
}

.upload-box span {
    color: #6b7280;

    font-size: 10px;
}

.upload-box small {
    color: #9ca3af;

    font-size: 9px;
}

.selected-file {
    display: flex;
    align-items: center;

    gap: 7px;

    margin-top: 8px;

    padding: 8px 10px;

    background: #f5f3ff;

    border-radius: 7px;

    color: #6d28d9;

    font-size: 10px;

    text-align: left;
}

.profile-primary-btn {
    width: 100%;

    height: 39px;

    margin-top: 11px;

    border: 0;

    border-radius: 8px;

    background: #4f46e5;

    color: #fff;

    font-size: 11px;
    font-weight: 600;

    cursor: pointer;

    transition: .2s;
}

.profile-primary-btn:hover {
    background: #4338ca;

    transform: translateY(-1px);

    box-shadow: 0 4px 10px rgba(79,70,229,.2);
}

.profile-primary-btn i {
    margin-right: 6px;
}


/* =====================================================
   GUIDELINES
===================================================== */

.upload-guidelines {
    margin-top: 14px;

    text-align: left;
}

.guideline {
    display: flex;
    align-items: center;

    gap: 7px;

    margin-top: 6px;

    color: #9ca3af;

    font-size: 9px;
}

.guideline i {
    color: #22c55e;
}


/* =====================================================
   INFORMATION CARD
===================================================== */

.information-card {
    background: #fff;

    border: 1px solid #e6e9ef;

    border-radius: 15px;

    overflow: hidden;

    box-shadow: 0 3px 15px rgba(15,23,42,.04);
}

.information-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 21px 24px;

    border-bottom: 1px solid #edf0f4;
}

.information-title {
    display: flex;
    align-items: center;

    gap: 11px;
}

.information-icon {
    width: 39px;
    height: 39px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 16px;
}

.information-title h3 {
    margin: 0;

    color: #1f2937;

    font-size: 16px;
    font-weight: 700;
}

.information-title p {
    margin: 3px 0 0;

    color: #9ca3af;

    font-size: 11px;
}

.edit-profile-btn {
    display: inline-flex;
    align-items: center;

    gap: 7px;

    height: 36px;

    padding: 0 13px;

    border: 1px solid #dfe3ea;

    border-radius: 8px;

    background: #fff;

    color: #4f46e5;

    font-size: 11px;
    font-weight: 600;

    cursor: pointer;

    transition: .2s;
}

.edit-profile-btn:hover {
    background: #f5f3ff;

    border-color: #c4b5fd;
}


/* =====================================================
   INFORMATION BODY
===================================================== */

.information-body {
    padding: 5px 24px;
}

.info-item {
    display: flex;
    align-items: center;

    gap: 14px;

    padding: 18px 0;

    border-bottom: 1px solid #f0f2f5;
}

.info-item:last-child {
    border-bottom: 0;
}

.info-item-icon {
    width: 39px;
    height: 39px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #f8fafc;

    color: #64748b;

    font-size: 13px;
}

.info-content {
    display: flex;
    flex-direction: column;

    gap: 3px;
}

.info-label {
    color: #9ca3af;

    font-size: 10px;

    text-transform: uppercase;

    letter-spacing: .3px;
}

.info-content strong {
    color: #374151;

    font-size: 13px;
    font-weight: 600;
}


/* =====================================================
   BADGES
===================================================== */

.role-badge {
    display: inline-flex;
    align-items: center;

    gap: 5px;

    padding: 5px 9px;

    background: #eef2ff;

    color: #4f46e5;

    border-radius: 6px;

    font-size: 10px;
}

.status-badge {
    display: inline-flex;
    align-items: center;

    gap: 6px;

    padding: 5px 9px;

    background: #ecfdf5;

    color: #059669;

    border-radius: 6px;

    font-size: 10px;
}

.status-dot {
    width: 6px;
    height: 6px;

    background: #10b981;

    border-radius: 50%;
}


/* =====================================================
   SECURITY
===================================================== */

.security-section {
    display: flex;
    align-items: center;

    gap: 12px;

    margin: 15px 24px 22px;

    padding: 15px;

    background: #f8faff;

    border: 1px solid #e5e9ff;

    border-radius: 10px;
}

.security-icon {
    width: 37px;
    height: 37px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 13px;
}

.security-content {
    flex: 1;
}

.security-content h4 {
    margin: 0;

    color: #374151;

    font-size: 12px;
    font-weight: 700;
}

.security-content p {
    margin: 3px 0 0;

    color: #9ca3af;

    font-size: 10px;
}

.security-btn {
    height: 33px;

    padding: 0 11px;

    border: 1px solid #d9dded;

    background: #fff;

    color: #4f46e5;

    border-radius: 7px;

    font-size: 10px;
    font-weight: 600;

    cursor: pointer;
}


/* =====================================================
   MODAL
===================================================== */

.modern-modal {
    background: #fff;

    border-radius: 14px;

    overflow: hidden;

    border: 1px solid #e5e7eb;

    box-shadow: 0 20px 50px rgba(15,23,42,.18);
}

.modern-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 18px 20px;

    border-bottom: 1px solid #edf0f4;
}

.modal-heading {
    display: flex;
    align-items: center;

    gap: 10px;
}

.modal-icon {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eef2ff;

    color: #4f46e5;

    border-radius: 9px;
}

.modal-heading h4 {
    margin: 0;

    color: #1f2937;

    font-size: 15px;
    font-weight: 700;
}

.modal-heading p {
    margin: 2px 0 0;

    color: #9ca3af;

    font-size: 10px;
}

.modern-modal-close {
    width: 30px;
    height: 30px;

    border: 0;

    border-radius: 7px;

    background: #f8fafc;

    color: #6b7280;

    cursor: pointer;
}

.modern-modal-close:hover {
    background: #f1f5f9;
    color: #111827;
}

.modern-modal-body {
    padding: 20px;
}

.modal-form-group {
    margin-bottom: 17px;
}

.modal-form-group:last-child {
    margin-bottom: 0;
}

.modal-form-group label {
    display: block;

    margin-bottom: 7px;

    color: #374151;

    font-size: 11px;
    font-weight: 600;
}

.modal-input-wrapper {
    position: relative;
}

.modal-input-wrapper i {
    position: absolute;

    left: 12px;
    top: 50%;

    transform: translateY(-50%);

    color: #9ca3af;

    font-size: 11px;
}

.modal-input-wrapper input {
    width: 100%;

    height: 41px;

    padding: 0 12px 0 35px;

    border: 1px solid #dfe3ea;

    border-radius: 8px;

    outline: none;

    color: #374151;

    font-size: 12px;
}

.modal-input-wrapper input:focus {
    border-color: #6366f1;

    box-shadow: 0 0 0 3px rgba(99,102,241,.08);
}

.disabled-input {
    opacity: .65;
}

.modal-form-group small {
    display: block;

    margin-top: 5px;

    color: #9ca3af;

    font-size: 9px;
}

.modern-modal-footer {
    display: flex;
    justify-content: flex-end;

    gap: 8px;

    padding: 14px 20px;

    background: #fafbfc;

    border-top: 1px solid #edf0f4;
}

.modal-cancel-btn,
.modal-save-btn {
    height: 37px;

    padding: 0 14px;

    border-radius: 8px;

    font-size: 11px;
    font-weight: 600;

    cursor: pointer;
}

.modal-cancel-btn {
    border: 1px solid #dfe3ea;

    background: #fff;

    color: #6b7280;
}

.modal-save-btn {
    border: 1px solid #4f46e5;

    background: #4f46e5;

    color: #fff;
}

.modal-save-btn:hover {
    background: #4338ca;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width: 991px) {

    .profile-page-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 12px;
    }

    .modern-breadcrumb {
        width: 100%;
    }

}

@media(max-width: 575px) {

    .page-heading h1 {
        font-size: 22px;
    }

    .information-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 13px;
    }

    .edit-profile-btn {
        width: 100%;
        justify-content: center;
    }

    .security-section {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .security-content {
        min-width: calc(100% - 55px);
    }

    .security-btn {
        width: 100%;
    }

}

</style>


<script>

document.getElementById('photo')?.addEventListener('change', function () {

    const selectedFile = document.getElementById('selected-file');
    const fileName = document.getElementById('file-name');

    if (this.files.length > 0) {

        fileName.textContent = this.files[0].name;

        selectedFile.style.display = 'flex';

    } else {

        selectedFile.style.display = 'none';

    }

});

</script>

@endsection

@extends('SuperAdmin.main')

@section('body')

<div class="content-wrapper modern-page">

    <!-- ==============================
         PAGE HEADER
    =============================== -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="modern-page-header">

                <div class="page-title-row">

                    <div class="page-title-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>

                    <div>
                        <h1 class="modern-page-title">
                            Admin Management
                        </h1>

                        <p class="modern-page-subtitle">
                            Manage administrators and access for your businesses.
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

                    <li class="active">
                        Admin Management
                    </li>

                </ol>

            </div>

        </div>
    </div>


    <!-- ==============================
         MAIN CONTENT
    =============================== -->
    <div class="content">

        <div class="container-fluid">


            <!-- ==============================
                 BUSINESS SELECTOR
            =============================== -->
            <div class="modern-card business-selector-card">

                <div class="modern-card-body">

                    <form method="GET"
                          action="{{ route('admin.list') }}">

                        <div class="business-selector">

                            <div class="selector-left">

                                <div class="selector-icon">
                                    <i class="fas fa-building"></i>
                                </div>

                                <div>
                                    <div class="selector-label">
                                        Business
                                    </div>

                                    <div class="selector-description">
                                        Select a business to view its administrators.
                                    </div>
                                </div>

                            </div>


                            <div class="selector-control">

                                <div class="select-wrapper">

                                    <i class="fas fa-building select-icon"></i>

                                    <select
                                        name="business_id"
                                        id="business_id"
                                        class="modern-select"
                                        onchange="this.form.submit()">

                                        <option value="">
                                            Select Business
                                        </option>

                                        @foreach ($businesses as $business)

                                            <option
                                                value="{{ $business->id }}"
                                                {{ $selectedBusinessId == $business->id ? 'selected' : '' }}>

                                                {{ $business->name }}

                                            </option>

                                        @endforeach

                                    </select>

                                    <i class="fas fa-chevron-down select-arrow"></i>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            <!-- ==============================
                 ADMIN LIST
            =============================== -->

            @if (!empty($admins))

                <div class="modern-card">

                    <!-- Table Header -->

                    <div class="modern-card-header table-card-header">

                        <div class="table-header-left">

                            <div class="section-icon purple">
                                <i class="fas fa-users-cog"></i>
                            </div>

                            <div>

                                <h3>
                                    Administrators
                                </h3>

                                <p>
                                    Manage administrators associated with this business.
                                </p>

                            </div>

                        </div>


                        @if ($selectedBusinessId)

                            <div class="admin-count">

                                <i class="fas fa-users"></i>

                                {{ count($admins) }}
                                {{ count($admins) == 1 ? 'Admin' : 'Admins' }}

                            </div>

                        @endif

                    </div>


                    <!-- Table -->

                    <div class="modern-table-wrapper">

                        <table class="modern-table">

                            <thead>

                                <tr>

                                    <th>
                                        Administrator
                                    </th>

                                    <th>
                                        Role
                                    </th>

                                    <th>
                                        Mobile
                                    </th>

                                    <th>
                                        Address
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Verification
                                    </th>

                                    <th class="actions-column">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($admins as $admin)

                                    <tr>

                                        <!-- Administrator -->

                                        <td>

                                            <div class="admin-info">

                                                <div class="admin-avatar">

                                                    {{ strtoupper(substr($admin->name, 0, 1)) }}

                                                </div>

                                                <div>

                                                    <div class="admin-name">
                                                        {{ $admin->name }}
                                                    </div>

                                                    <div class="admin-email">
                                                        {{ $admin->email }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        <!-- Role -->

                                        <td>

                                            <span class="role-badge">

                                                <i class="fas fa-user-shield"></i>

                                                {{ ucfirst($admin->user_role) }}

                                            </span>

                                        </td>


                                        <!-- Mobile -->

                                        <td>

                                            <div class="table-value">

                                                <i class="fas fa-phone"></i>

                                                {{ $admin->mobile ?: '-' }}

                                            </div>

                                        </td>


                                        <!-- Address -->

                                        <td>

                                            <div class="address-value"
                                                 title="{{ $admin->address1 }}">

                                                {{ $admin->address1 ?: '-' }}

                                            </div>

                                        </td>


                                        <!-- Status -->

                                        <td>

                                            @switch($admin->status)

                                                @case('1')

                                                    <span class="status-badge active">

                                                        <span class="status-dot"></span>

                                                        Active

                                                    </span>

                                                @break


                                                @case('0')

                                                    <span class="status-badge inactive">

                                                        <span class="status-dot"></span>

                                                        Inactive

                                                    </span>

                                                @break


                                                @default

                                                    <span class="status-badge unknown">

                                                        Unknown

                                                    </span>

                                            @endswitch

                                        </td>


                                        <!-- Verification -->

                                        <td>

                                            @switch($admin->verify)

                                                @case('1')

                                                    <span class="status-badge verified">

                                                        <i class="fas fa-check-circle"></i>

                                                        Verified

                                                    </span>

                                                @break


                                                @case('0')

                                                    <span class="status-badge not-verified">

                                                        <i class="fas fa-exclamation-circle"></i>

                                                        Not Verified

                                                    </span>

                                                @break


                                                @default

                                                    <span class="status-badge unknown">

                                                        Unknown

                                                    </span>

                                            @endswitch

                                        </td>


                                        <!-- Actions -->

                                        <td>

                                            <div class="table-actions">

                                                <a
                                                    href="{{ route('admin.edit', $admin->id) }}"
                                                    class="table-action edit"
                                                    title="Edit Admin">

                                                    <i class="fas fa-pen"></i>

                                                </a>


                                                <form
                                                    action="{{ route('admin.destroy', $admin->id) }}"
                                                    method="POST"
                                                    class="delete-form">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="table-action delete"
                                                        title="Delete Admin"
                                                        onclick="return confirm('Are you sure you want to delete this entry?')">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td
                                            colspan="7"
                                            class="empty-state">

                                            <div class="empty-icon">

                                                <i class="fas fa-users-slash"></i>

                                            </div>

                                            <div class="empty-title">
                                                No administrators found
                                            </div>

                                            <div class="empty-description">
                                                There are no admins associated with this business.
                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


            @elseif($selectedBusinessId)

                <!-- No admin state -->

                <div class="modern-card">

                    <div class="empty-state standalone">

                        <div class="empty-icon">

                            <i class="fas fa-users-slash"></i>

                        </div>

                        <div class="empty-title">
                            No administrators found
                        </div>

                        <div class="empty-description">
                            This business currently doesn't have any administrators.
                        </div>

                    </div>

                </div>


            @else

                <!-- Select business state -->

                <div class="modern-card">

                    <div class="empty-state standalone">

                        <div class="empty-icon">

                            <i class="fas fa-building"></i>

                        </div>

                        <div class="empty-title">
                            Select a business
                        </div>

                        <div class="empty-description">
                            Choose a business above to view its administrators.
                        </div>

                    </div>

                </div>

            @endif


        </div>

    </div>

</div>


<style>

/* =====================================================
   MODERN ADMIN MANAGEMENT
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
    font-size: 10px;
    color: #9ca3af;
}

.modern-breadcrumb .active {
    color: #6b7280;
}


/* =====================================================
   CARD
===================================================== */

.modern-card {
    margin-bottom: 18px;

    background: #fff;

    border: 1px solid #e6e9ef;

    border-radius: 14px;

    box-shadow: 0 3px 15px rgba(15, 23, 42, .04);

    overflow: hidden;
}

.modern-card-body {
    padding: 21px;
}


/* =====================================================
   BUSINESS SELECTOR
===================================================== */

.business-selector {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 25px;
}

.selector-left {
    display: flex;
    align-items: center;
    gap: 13px;
}

.selector-icon {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #eef2ff;
    color: #4f46e5;

    font-size: 16px;
}

.selector-label {
    color: #1f2937;

    font-size: 14px;
    font-weight: 700;
}

.selector-description {
    margin-top: 3px;

    color: #9ca3af;

    font-size: 12px;
}

.selector-control {
    width: 360px;
}

.select-wrapper {
    position: relative;
}

.select-icon {
    position: absolute;

    left: 14px;
    top: 50%;

    transform: translateY(-50%);

    color: #9ca3af;

    font-size: 13px;

    z-index: 2;
}

.modern-select {
    width: 100%;
    height: 43px;

    padding: 0 40px 0 39px;

    border: 1px solid #dfe3ea;
    border-radius: 9px;

    background: #fff;

    color: #374151;

    font-size: 13px;

    outline: none;

    cursor: pointer;

    appearance: none;

    transition: .2s ease;
}

.modern-select:hover {
    border-color: #cbd1dc;
}

.modern-select:focus {
    border-color: #6366f1;

    box-shadow:
        0 0 0 3px rgba(99, 102, 241, .10);
}

.select-arrow {
    position: absolute;

    right: 14px;
    top: 50%;

    transform: translateY(-50%);

    color: #9ca3af;

    font-size: 10px;

    pointer-events: none;
}


/* =====================================================
   TABLE CARD HEADER
===================================================== */

.table-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 18px 21px;
}

.table-header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.table-card-header h3 {
    margin: 0;

    font-size: 16px;
    font-weight: 700;

    color: #1f2937;
}

.table-card-header p {
    margin: 3px 0 0;

    color: #9ca3af;

    font-size: 12px;
}

.section-icon {
    width: 38px;
    height: 38px;

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

.admin-count {
    display: flex;
    align-items: center;
    gap: 7px;

    padding: 7px 11px;

    background: #f8fafc;

    border: 1px solid #e5e7eb;

    border-radius: 8px;

    color: #6b7280;

    font-size: 12px;
    font-weight: 600;
}


/* =====================================================
   TABLE
===================================================== */

.modern-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.modern-table {
    width: 100%;

    margin: 0;

    border-collapse: collapse;

    white-space: nowrap;
}

.modern-table thead th {
    padding: 12px 18px;

    background: #f8fafc;

    border-top: 1px solid #eef0f4;
    border-bottom: 1px solid #e5e7eb;

    color: #6b7280;

    font-size: 11px;
    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .4px;
}

.modern-table tbody td {
    padding: 14px 18px;

    border-bottom: 1px solid #f0f1f4;

    color: #374151;

    font-size: 13px;

    vertical-align: middle;
}

.modern-table tbody tr {
    transition: background .15s ease;
}

.modern-table tbody tr:hover {
    background: #fafbff;
}

.modern-table tbody tr:last-child td {
    border-bottom: 0;
}


/* =====================================================
   ADMIN INFO
===================================================== */

.admin-info {
    display: flex;
    align-items: center;
    gap: 11px;
}

.admin-avatar {
    width: 38px;
    height: 38px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 14px;
    font-weight: 700;
}

.admin-name {
    color: #1f2937;

    font-size: 13px;
    font-weight: 600;
}

.admin-email {
    margin-top: 2px;

    color: #9ca3af;

    font-size: 11px;
}


/* =====================================================
   ROLE
===================================================== */

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 6px 9px;

    border-radius: 7px;

    background: #f5f3ff;

    color: #6d28d9;

    font-size: 11px;
    font-weight: 600;
}

.role-badge i {
    font-size: 10px;
}


/* =====================================================
   TABLE VALUES
===================================================== */

.table-value {
    display: flex;
    align-items: center;
    gap: 7px;

    color: #4b5563;
}

.table-value i {
    color: #9ca3af;

    font-size: 11px;
}

.address-value {
    max-width: 190px;

    overflow: hidden;

    text-overflow: ellipsis;

    color: #6b7280;
}


/* =====================================================
   STATUS
===================================================== */

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 6px 9px;

    border-radius: 7px;

    font-size: 11px;
    font-weight: 600;
}

.status-dot {
    width: 6px;
    height: 6px;

    border-radius: 50%;
}

.status-badge.active {
    background: #ecfdf5;
    color: #047857;
}

.status-badge.active .status-dot {
    background: #10b981;
}

.status-badge.inactive {
    background: #fef2f2;
    color: #b91c1c;
}

.status-badge.inactive .status-dot {
    background: #ef4444;
}

.status-badge.verified {
    background: #ecfdf5;
    color: #047857;
}

.status-badge.not-verified {
    background: #fff7ed;
    color: #c2410c;
}

.status-badge.unknown {
    background: #f3f4f6;
    color: #6b7280;
}


/* =====================================================
   ACTIONS
===================================================== */

.actions-column {
    text-align: right;
}

.table-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 6px;
}

.table-action {
    width: 32px;
    height: 32px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    border: 1px solid transparent;

    text-decoration: none;

    cursor: pointer;

    transition: all .18s ease;
}

.table-action.edit {
    background: #eef2ff;
    color: #4f46e5;
}

.table-action.edit:hover {
    background: #e0e7ff;
    color: #4338ca;
}

.table-action.delete {
    background: #fef2f2;
    color: #dc2626;
}

.table-action.delete:hover {
    background: #fee2e2;
    color: #b91c1c;
}

.delete-form {
    display: inline;
    margin: 0;
}


/* =====================================================
   EMPTY STATE
===================================================== */

.empty-state {
    padding: 55px 20px !important;

    text-align: center;

    color: #6b7280;
}

.empty-state.standalone {
    padding: 70px 20px;
}

.empty-icon {
    width: 55px;
    height: 55px;

    margin: 0 auto 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 14px;

    background: #f3f4f6;

    color: #9ca3af;

    font-size: 20px;
}

.empty-title {
    color: #374151;

    font-size: 14px;
    font-weight: 700;
}

.empty-description {
    margin-top: 5px;

    color: #9ca3af;

    font-size: 12px;
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
    }

    .modern-page-title {
        font-size: 22px;
    }

    .business-selector {
        flex-direction: column;
        align-items: stretch;
    }

    .selector-control {
        width: 100%;
    }

    .table-card-header {
        align-items: flex-start;
        gap: 15px;
        flex-direction: column;
    }

    .admin-count {
        align-self: flex-start;
    }

}
</style>

@endsection

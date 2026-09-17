@extends('SuperAdmin.main')

@section('body')

<div class="content-wrapper">

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-building"></i>
                    Business List
                </h1>
                <p class="page-subtitle">
                    Manage and monitor all registered businesses
                </p>
            </div>

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/super-admin') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    Business List
                </li>
            </ol>
        </div>
    </div>
</div>

<style>
    /* =========================
       PAGE
    ========================= */

    .content-wrapper {
        background: #f5f7fb;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 10px 0 20px;
    }

    .page-title {
        margin: 0;
        font-size: 27px;
        font-weight: 700;
        color: #1f2937;
        letter-spacing: -0.4px;
    }

    .page-title i {
        margin-right: 9px;
        color: #4f46e5;
    }

    .page-subtitle {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .breadcrumb {
        margin: 0;
        padding: 10px 15px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    }

    .breadcrumb a {
        color: #4f46e5;
        text-decoration: none;
    }

    /* =========================
       MAIN CARD
    ========================= */

    .business-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid #e9edf5;
        box-shadow:
            0 4px 15px rgba(15, 23, 42, 0.05),
            0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 15px;
    }

    .card-heading {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
    }

    .business-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 27px;
        padding: 0 9px;
        margin-left: 7px;
        border-radius: 20px;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 13px;
        font-weight: 700;
    }

    /* =========================
       TABLE
    ========================= */

    .table-responsive {
        border-radius: 10px;
        overflow-x: auto;
    }

    .business-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 950px;
    }

    .business-table thead th {
        background: #f8fafc;
        color: #64748b;
        border-top: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        border-left: none;
        border-right: none;
        padding: 14px 13px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.45px;
        white-space: nowrap;
    }

    .business-table thead th:first-child {
        border-left: 1px solid #e5e7eb;
        border-radius: 9px 0 0 0;
    }

    .business-table thead th:last-child {
        border-right: 1px solid #e5e7eb;
        border-radius: 0 9px 0 0;
    }

    .business-table tbody tr {
        transition: all 0.2s ease;
    }

    .business-table tbody tr:hover {
        background: #f8faff !important;
    }

    .business-table tbody td {
        padding: 14px 13px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #edf0f5;
        border-left: none;
        border-right: none;
        vertical-align: middle;
        white-space: nowrap;
    }

    .business-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ID */

    .business-id {
        width: 55px;
        color: #94a3b8 !important;
        font-weight: 600;
        font-size: 13px !important;
    }

    /* Business Name */

    .business-name {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .business-avatar {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 15px;
        flex-shrink: 0;
    }

    .business-name-text {
        font-weight: 650;
        color: #1f2937;
    }

    /* Plan */

    .plan-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 7px;
        background: #f1f5f9;
        color: #475569;
        font-size: 13px;
        font-weight: 600;
    }

    /* =========================
       STATUS
    ========================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }

    .status-active {
        background: #ecfdf3;
        color: #15803d;
    }

    .status-active .status-dot {
        background: #22c55e;
    }

    .status-suspended {
        background: #fef2f2;
        color: #dc2626;
    }

    .status-suspended .status-dot {
        background: #ef4444;
    }

    .status-trial {
        background: #fffbeb;
        color: #b45309;
    }

    .status-trial .status-dot {
        background: #f59e0b;
    }

    .status-inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .status-inactive .status-dot {
        background: #94a3b8;
    }

    .status-unknown {
        background: #f3f4f6;
        color: #6b7280;
    }

    .status-unknown .status-dot {
        background: #9ca3af;
    }

    /* =========================
       DATE
    ========================= */

    .date-value {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #475569;
        font-weight: 500;
    }

    .date-value i {
        color: #94a3b8;
        font-size: 13px;
    }

    /* =========================
       LIMITS
    ========================= */

    .limit-value {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        padding: 5px 9px;
        border-radius: 7px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        color: #334155;
        font-weight: 700;
    }

    /* =========================
       ACTIONS
    ========================= */

    .actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid transparent;
        transition: all 0.2s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .edit-btn {
        background: #eef2ff;
        color: #4f46e5;
    }

    .edit-btn:hover {
        background: #4f46e5;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .delete-btn {
        background: #fef2f2;
        color: #ef4444;
    }

    .delete-btn:hover {
        background: #ef4444;
        color: #ffffff;
        transform: translateY(-1px);
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .empty-state {
        text-align: center;
        padding: 55px 20px !important;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        font-size: 25px;
    }

    .empty-title {
        margin: 0 0 5px;
        font-size: 16px;
        font-weight: 700;
        color: #374151;
    }

    .empty-text {
        margin: 0;
        color: #94a3b8;
        font-size: 13px;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .breadcrumb {
            width: 100%;
        }

        .business-card {
            padding: 15px;
        }

        .card-top {
            align-items: flex-start;
        }

        .page-title {
            font-size: 23px;
        }
    }
</style>

<!-- Main Content -->
<div class="content">
    <div class="container-fluid">

        <div class="business-card">

            <!-- Card Header -->
            <div class="card-top">
                <div>
                    <h3 class="card-heading">
                        All Businesses
                        <span class="business-count">
                            {{ $businesses->count() }}
                        </span>
                    </h3>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">

                <table class="business-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Business</th>
                            <th>Plan</th>
                            <th>Status</th>
                            <th>Plan Start</th>
                            <th>Plan End</th>
                            <th>Lead Creators</th>
                            <th>Tele Callers</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($businesses as $business)

                            <tr>

                                <!-- ID -->
                                <td class="business-id">
                                    {{ $businesses->count() - $loop->index }}
                                </td>

                                <!-- Business -->
                                <td>
                                    <div class="business-name">

                                        <div class="business-avatar">
                                            <i class="fas fa-building"></i>
                                        </div>

                                        <span class="business-name-text">
                                            {{ $business->name }}
                                        </span>

                                    </div>
                                </td>

                                <!-- Plan -->
                                <td>
                                    <span class="plan-badge">
                                        <i class="fas fa-layer-group mr-1"></i>
                                        {{ $business->plan_name }}
                                    </span>
                                </td>

                                <!-- Status -->
                                <td>

                                    @switch($business->status)

                                        @case('active')
                                            <span class="status-badge status-active">
                                                <span class="status-dot"></span>
                                                Active
                                            </span>
                                        @break

                                        @case('suspended')
                                            <span class="status-badge status-suspended">
                                                <span class="status-dot"></span>
                                                Suspended
                                            </span>
                                        @break

                                        @case('trial')
                                            <span class="status-badge status-trial">
                                                <span class="status-dot"></span>
                                                Trial
                                            </span>
                                        @break

                                        @case('inactive')
                                            <span class="status-badge status-inactive">
                                                <span class="status-dot"></span>
                                                Inactive
                                            </span>
                                        @break

                                        @default
                                            <span class="status-badge status-unknown">
                                                <span class="status-dot"></span>
                                                Unknown
                                            </span>

                                    @endswitch

                                </td>

                                <!-- Start Date -->
                                <td>
                                    <span class="date-value">
                                        <i class="far fa-calendar-alt"></i>

                                        {{ $business->plan_start_date
                                            ? $business->plan_start_date->format('d M Y')
                                            : '-' }}
                                    </span>
                                </td>

                                <!-- End Date -->
                                <td>
                                    <span class="date-value">
                                        <i class="far fa-calendar-alt"></i>

                                        {{ $business->plan_end_date
                                            ? $business->plan_end_date->format('d M Y')
                                            : '-' }}
                                    </span>
                                </td>

                                <!-- Lead Creator -->
                                <td>
                                    <span class="limit-value">
                                        {{ $business->lead_creator_limit }}
                                    </span>
                                </td>

                                <!-- Tele Caller -->
                                <td>
                                    <span class="limit-value">
                                        {{ $business->telecaller_limit }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td>

                                    <div class="actions">

                                        <a href="{{ route('businesses.edit', $business->id) }}"
                                           class="action-btn edit-btn"
                                           title="Edit Business">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="{{ route('businesses.destroy', $business->id) }}"
                                              method="POST"
                                              style="display:inline;">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="action-btn delete-btn"
                                                    title="Delete Business"
                                                    onclick="return confirm('Are you sure you want to delete this business?')">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="empty-state">

                                    <div class="empty-icon">
                                        <i class="fas fa-building"></i>
                                    </div>

                                    <h4 class="empty-title">
                                        No Businesses Found
                                    </h4>

                                    <p class="empty-text">
                                        There are currently no businesses registered.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>
```

</div>

@endsection

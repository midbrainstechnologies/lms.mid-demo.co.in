@extends('LeadCreator.main')

@section('body')

<style>
    /* =========================================
       MODERN LEAD DASHBOARD
    ========================================= */

    .lead-dashboard {
        padding: 10px 0 30px;
    }

    .dashboard-heading {
        margin-bottom: 24px;
    }

    .dashboard-heading h1 {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.5px;
    }

    .dashboard-heading p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    /* =========================
       STAT CARD
    ========================= */

    .lead-stat-card {
        position: relative;
        display: flex;
        align-items: center;
        min-height: 118px;
        padding: 20px;
        margin-bottom: 20px;

        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;

        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);

        cursor: pointer;
        overflow: hidden;

        transition:
            transform .2s ease,
            box-shadow .2s ease,
            border-color .2s ease;
    }

    .lead-stat-card:hover {
        transform: translateY(-4px);
        border-color: #cbd5e1;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.09);
    }

    /* Decorative background */
    .lead-stat-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        right: -35px;
        bottom: -45px;

        border-radius: 50%;

        background: var(--card-color);
        opacity: .06;
    }

    /* Icon */
    .lead-stat-icon {
        width: 52px;
        height: 52px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 13px;

        background: var(--card-bg);
        color: var(--card-color);

        font-size: 21px;

        margin-right: 15px;
    }

    /* Content */
    .lead-stat-content {
        min-width: 0;
    }

    .lead-stat-label {
        display: block;

        color: #64748b;
        font-size: 13px;
        font-weight: 500;

        margin-bottom: 5px;
    }

    .lead-stat-number {
        display: block;

        color: #0f172a;
        font-size: 27px;
        line-height: 1;
        font-weight: 750;
    }

    /* =========================
       COLORS
    ========================= */

    .stat-indigo {
        --card-color: #6366f1;
        --card-bg: #eef2ff;
    }

    .stat-blue {
        --card-color: #3b82f6;
        --card-bg: #eff6ff;
    }

    .stat-emerald {
        --card-color: #10b981;
        --card-bg: #ecfdf5;
    }

    .stat-amber {
        --card-color: #f59e0b;
        --card-bg: #fffbeb;
    }

    .stat-rose {
        --card-color: #f43f5e;
        --card-bg: #fff1f2;
    }

    .stat-purple {
        --card-color: #8b5cf6;
        --card-bg: #f5f3ff;
    }

    .stat-cyan {
        --card-color: #06b6d4;
        --card-bg: #ecfeff;
    }

    .stat-slate {
        --card-color: #64748b;
        --card-bg: #f1f5f9;
    }

    /* =========================
       SECTION
    ========================= */

    .dashboard-section {
        margin-top: 10px;
        margin-bottom: 12px;
    }

    .dashboard-section-title {
        display: flex;
        align-items: center;
        gap: 10px;

        color: #334155;
        font-size: 14px;
        font-weight: 700;

        margin-bottom: 14px;
    }

    .dashboard-section-title span {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #6366f1;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 767px) {

        .dashboard-heading h1 {
            font-size: 22px;
        }

        .lead-stat-card {
            min-height: 105px;
            padding: 16px;
            border-radius: 13px;
        }

        .lead-stat-icon {
            width: 46px;
            height: 46px;
            font-size: 18px;
        }

        .lead-stat-number {
            font-size: 23px;
        }

        .lead-stat-label {
            font-size: 12px;
        }
    }
</style>


<div class="content-wrapper">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="dashboard-heading">

                <h1>Dashboard</h1>

                <p>
                    Overview of your leads and today's activities
                </p>

            </div>

        </div>
    </div>


    <!-- Main Content -->
    <div class="content">

        <div class="container-fluid lead-dashboard">


            {{-- ================================
                SCHEDULE
            ================================= --}}

            <div class="dashboard-section">

                <div class="dashboard-section-title">
                    <span></span>
                    Schedule
                </div>

                <div class="row">

                    {{-- Scheduled --}}
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-indigo"
                            onclick="window.location='{{ url('/tele-caller/schedule') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-calendar"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Schedule Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['schedule_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Today's Scheduled --}}
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-amber"
                            onclick="window.location='{{ url('/tele-caller/schedule') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-clock-o"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Today's Schedule Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['today_schedule_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================
                LEAD OVERVIEW
            ================================= --}}

            <div class="dashboard-section">

                <div class="dashboard-section-title">
                    <span></span>
                    Lead Overview
                </div>

                <div class="row">

                    {{-- Uncaptured --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-emerald"
                            onclick="window.location='{{ url('/tele-caller/transferred-list') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-inbox"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Uncaptured Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['uncapture_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Captured --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-cyan"
                            onclick="window.location='{{ url('/tele-caller/captured-list') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-check-circle"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Total Captured Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['capture_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- New --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-blue"
                            onclick="window.location='{{ url('/tele-caller/list/new') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-star"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    New Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['new_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Approved --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-purple"
                            onclick="window.location='{{ url('/tele-caller/list/t_approve') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-check"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Approved Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['approve_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Process --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-indigo"
                            onclick="window.location='{{ url('/tele-caller/list/t_process') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-spinner"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Process Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['process_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Hot --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-rose"
                            onclick="window.location='{{ url('/tele-caller/list/t_hot') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-fire"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Hot Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['hot_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Completed --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-emerald"
                            onclick="window.location='{{ url('/tele-caller/list/t_complete') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-check-circle-o"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Completed Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['complete_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================
                CALL STATUS
            ================================= --}}

            <div class="dashboard-section">

                <div class="dashboard-section-title">
                    <span></span>
                    Call Status
                </div>

                <div class="row">

                    {{-- Ringing --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-blue"
                            onclick="window.location='{{ url('/tele-caller/list/ringing') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-phone"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Ringing Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['ringing'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Callback --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-purple"
                            onclick="window.location='{{ url('/tele-caller/list/callback') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-phone-square"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Call Back Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['callback'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Switch Off --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-amber"
                            onclick="window.location='{{ url('/tele-caller/list/switchoff') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-power-off"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Switch Off Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['switchoff'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Deleted --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

                        <div
                            class="lead-stat-card stat-rose"
                            onclick="window.location='{{ url('/tele-caller/list/t_delete') }}'">

                            <div class="lead-stat-icon">
                                <i class="fa fa-trash"></i>
                            </div>

                            <div class="lead-stat-content">

                                <span class="lead-stat-label">
                                    Deleted Leads
                                </span>

                                <span class="lead-stat-number">
                                    {{ $data['delete_lead'] }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

</div>

@endsection

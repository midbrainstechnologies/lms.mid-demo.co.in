<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\LeadMS;
use App\Models\LeadRemainder;
use App\Models\PaymentTaken;
use App\Models\ServiceTaken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        date_default_timezone_set("Asia/Kolkata");
        $seo = [
            'title'         =>  "Dashboard",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Dashboard',
            'description'   => 'Dashboard',
            'author'        => env('COMPANYNAME'),
        ];
        $data = [
            'business_count' => \App\Models\Business::where('status', 'active')->count(),
            'capture_lead'          => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->count(),
            'hot_lead'              => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'hot')->count(),
            'warm_lead'             => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'warm')->count(),
            'cold_lead'             => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'cold')->count(),
            'dead_lead'             => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'dead')->count(),
            'closed_lead'           => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'closed')->count(),
            'schedule_lead'         => LeadRemainder::select()->where('status', '1')->where('is_delete', '0')->where('user_id', Auth::user()->id)->count(),
            'today_schedule_lead'   => LeadRemainder::select()->where('status', '1')->where('is_delete', '0')->where('next_date',date('Y-m-d'))->where('user_id', Auth::user()->id)->count(),
            'a_process_lead'        => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'a_process')->count(),
            'a_completed_lead'      => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'a_complete')->count(),
            't_amount'              => ServiceTaken::select()->where('status', '1')->sum('payment'),
            'r_amount'              => PaymentTaken::select()->where('status','1')->sum('payment'),
        ];

        return view('SuperAdmin.dashboard.index',compact('seo','data'));

    }
}

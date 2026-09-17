<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $business_id = Auth::user()->business_id;
        $data = [
            'uncapture_lead'        => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '0')->where('business_id', $business_id)->count(),
            'capture_lead'          => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('business_id', $business_id)->count(),
            'hot_lead'              => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'hot')->where('business_id', $business_id)->count(),
            'warm_lead'             => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'warm')->where('business_id', $business_id)->count(),
            'cold_lead'             => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'cold')->where('business_id', $business_id)->count(),
            'dead_lead'             => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'dead')->where('business_id', $business_id)->count(),
            'closed_lead'           => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'closed')->where('business_id', $business_id)->count(),
            'schedule_lead'         => LeadRemainder::select()->where('status', '1')->where('is_delete', '0')->where('user_id', Auth::user()->id)->where('business_id', $business_id)->count(),
            'today_schedule_lead'   => LeadRemainder::select()->where('status', '1')->where('is_delete', '0')->where('next_date',date('Y-m-d'))->where('user_id', Auth::user()->id)->where('business_id', $business_id)->count(),
            'a_process_lead'        => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'a_process')->where('business_id', $business_id)->count(),
            'a_completed_lead'      => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('lead_type', 'a_complete')->where('business_id', $business_id)->count(),
            't_amount'              => ServiceTaken::select()->where('status', '1')->where('business_id', $business_id)->sum('payment'),
            'r_amount'              => PaymentTaken::select()->where('status','1')->where('business_id', $business_id)->sum('payment'),
        ];



        return view('Admin.dashboard.index',compact('seo','data'));

    }
}

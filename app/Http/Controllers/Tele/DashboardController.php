<?php

namespace App\Http\Controllers\Tele;

use App\Http\Controllers\Controller;
use App\Models\LeadMS;
use App\Models\LeadRemainder;
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
            'uncapture_lead' => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '0')->where('user_id', Auth::user()->id)->count(),
            'capture_lead' => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('user_id', Auth::user()->id)->count(),
            'hot_lead' => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('user_id', Auth::user()->id)->where('lead_type', 'hot')->count(),
            'warm_lead' => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('user_id', Auth::user()->id)->where('lead_type', 'warm')->count(),
            'cold_lead' => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('user_id', Auth::user()->id)->where('lead_type', 'cold')->count(),
            'dead_lead' => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('user_id', Auth::user()->id)->where('lead_type', 'dead')->count(),
            'closed_lead' => LeadMS::select()->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('user_id', Auth::user()->id)->where('lead_type', 'closed')->count(),
            'schedule_lead' => LeadRemainder::select()->where('status', '1')->where('is_delete', '0')->where('user_id', Auth::user()->id)->count(),
            'today_schedule_lead' => LeadRemainder::select()->where('status', '1')->where('is_delete', '0')->where('next_date',date('Y-m-d'))->where('user_id', Auth::user()->id)->count(),
        ];

        return view('Tele.dashboard.index',compact('seo','data'));
    }
}

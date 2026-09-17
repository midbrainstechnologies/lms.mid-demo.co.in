<?php

namespace App\Http\Controllers\LeadCreator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $seo = [
            'title'         =>  "Dashboard",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Dashboard',
            'description'   => 'Dashboard',
            'author'        => env('COMPANYNAME'),
        ];

        return view('LeadCreator.dashboard.index',compact('seo'));
    }
}

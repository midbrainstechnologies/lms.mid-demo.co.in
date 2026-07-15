<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
{
    $seo = [
        'title'         => "Subscription Details",
        'favicon'       => url(env('APP_FAVICON')),
        'logo'          => url(env('APP_LOGO')),
        'keyword'       => 'Subscription Details',
        'description'   => 'Subscription Details',
        'author'        => env('COMPANYNAME'),
    ];

    $user = Auth::user();

    $business = Business::find($user->business_id);

    return view('Admin.subscription.subscription-details', compact('seo', 'user', 'business'));
}

}

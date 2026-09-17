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

class ManageBusinessController extends Controller
{
    public function index()
    {

        if (auth()->user()->user_role === 'super-admin') {
            $businesses = Business::orderBy('id', 'desc')->get();
        } else {
            abort(403, 'Unauthorized');
        }



        date_default_timezone_set("Asia/Kolkata");
        $seo = [
            'title'         =>  "Manage Business",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Dashboard',
            'description'   => 'Dashboard',
            'author'        => env('COMPANYNAME'),
        ];



        return view('SuperAdmin.managebusiness.managebusiness', compact('seo', 'businesses'));
    }

    public function toggleStatus($id)
    {
        $business = Business::findOrFail($id);
        $business->status = $business->status == 1 ? 0 : 1;
        $business->save();

        return response()->json([
            'success' => true,
            'status' => $business->status
        ]);
    }

    public function create()
    {
        return view('SuperAdmin.managebusiness.createbusiness');
    }

    public function storeBusiness(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|in:active,suspended,trial,inactive',
            'plan_name' => 'required|string|max:255',
            'plan_start_date' => 'required|date',
            'plan_end_date' => 'required|date|after_or_equal:plan_start_date|after_or_equal:today',
            'lead_creator_limit' => 'required|integer|min:1',
            'telecaller_limit' => 'required|integer|min:0',
        ]);

        Business::create($request->only(
            'name',
            'email',
            'status',
            'plan_name',
            'plan_start_date',
            'plan_end_date',
            'lead_creator_limit',
            'telecaller_limit'
        ));

        return redirect()->route('businesses.create')->with('success', 'Business added successfully with subscription.');
    }

    public function edit($id)
    {
        $business = Business::findOrFail($id);
        return view('SuperAdmin.managebusiness.createbusiness', compact('business'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|in:active,suspended,trial,inactive',
            'plan_name' => 'required|string|max:255',
            'plan_start_date' => 'required|date',
            'plan_end_date' => 'required|date|after_or_equal:plan_start_date|after_or_equal:today',
            'lead_creator_limit' => 'required|integer|min:1',
            'telecaller_limit' => 'required|integer|min:0',
        ]);

        $business = Business::findOrFail($id);
        $business->update($request->only(
            'name',
            'email',
            'status',
            'plan_name',
            'plan_start_date',
            'plan_end_date',
             'lead_creator_limit',
            'telecaller_limit'
        ));

        return redirect()->route('managebusiness')->with('success', 'Business updated successfully.');
    }

    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();

        return redirect()->route('managebusiness')->with('success', 'Business deleted successfully.');
    }

}

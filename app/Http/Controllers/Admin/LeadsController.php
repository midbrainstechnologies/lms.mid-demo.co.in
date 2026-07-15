<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryMaster;
use App\Models\Leads;
use App\Models\LeadStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LeadsController extends Controller
{
     public function leadview($id)
    {
        try {
            $seo = [
                'title'         =>  "Lead Details",
                'favicon'       =>  url(env('APP_FAVICON')),
                'logo'          =>  url(env('APP_LOGO')),
                'keyword'       => "Lead Details",
                'description'   => "Lead Details",
                'author'        => env('COMPANYNAME'),
            ];

            $leadId = Crypt::decrypt($id);

            $leads = Leads::select()
                ->where('status', '1')
                ->where('is_delete', '0')
                ->where('business_id', Auth::user()->business_id) // Restrict by business
                ->where('id', $leadId)
                ->first();

            if (!$leads) {
                return redirect()->back()->with('error', 'Lead not found or unauthorized');
            }

            $remarks = LeadStatus::select()
                ->where('status', '1')
                ->where('is_delete', '0')
                ->where('lead_id', $leadId)
                ->orderBy('date', 'desc')
                ->get();

            return view('Admin.leadlist.view', compact('seo', 'leads', 'remarks'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }

    public function leadedit($id)
    {
        try {
            $seo = [
                'title'         =>  "Lead Details Edit",
                'favicon'       =>  url(env('APP_FAVICON')),
                'logo'          =>  url(env('APP_LOGO')),
                'keyword'       => "Lead Details Edit",
                'description'   => "Lead Details Edit",
                'author'        => env('COMPANYNAME'),
            ];

            $leadId = Crypt::decrypt($id);

            $categorymaster = CategoryMaster::select()
                ->where('status','1')
                ->where('is_delete','0')
                ->where('business_id', Auth::user()->business_id) // Restrict by business
                ->orderby('id','desc')
                ->get();

            $leads = Leads::select()
                ->where('status', '1')
                ->where('is_delete', '0')
                ->where('business_id', Auth::user()->business_id) // Restrict by business
                ->where('id', $leadId)
                ->first();

            if (!$leads) {
                return redirect()->back()->with('error', 'Lead not found or unauthorized');
            }

            return view('Admin.leadlist.edit', compact('seo', 'categorymaster', 'leads'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }

    public function add(Request $request, $id)
    {
        date_default_timezone_set("Asia/Kolkata");

        $validate = $request->validate([
            'master_type'           => 'required',
            'name'                  => 'required',
            'mobile'                => 'required',
        ]);

        try {
            $leadId = Crypt::decrypt($id);

            // Ensure this lead belongs to current admin's business
            $lead = Leads::where('id', $leadId)
                ->where('business_id', Auth::user()->business_id)
                ->first();

            if (!$lead) {
                return redirect()->back()->with('error', 'Unauthorized or Lead not found');
            }

            if ($request->master_type == "other") {
                $datam = [
                    'name'          => $request->master_type_name,
                    'business_id'   => Auth::user()->business_id, // Link to business
                    'created_by'    => Auth::user()->id,
                    'created_at'    => NOW(),
                    'updated_at'    => NOW(),
                ];

                $master = CategoryMaster::create($datam);
                $msterid = $master->id;
            } else {
                $msterid = $request->master_type;
            }

            $data = [
                'masterid'          => $msterid,
                'created_by'        => Auth::user()->id,
                'business_id'       => Auth::user()->business_id,
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'email'             => $request->email,
                'company'           => $request->company,
                'source'            => $request->source,
                'title'             => $request->title,
                'description'       => $request->description,
                'updated_at'        => NOW(),
            ];

            $insert = Leads::where('id', $leadId)->update($data);

            $ds = [
                'lead_id'   => $leadId,
                'user_id'   => Auth::user()->id,
                'remarks'   => 'Lead Information Updated',
                'icon'      => 'fa-check',
                'bgcolor'   => 'blue',
                'date'      => date('Y-m-d'),
                'created_at'=> NOW(),
                'updated_at'=> NOW(),
            ];

            LeadStatus::insert($ds);

            if ($insert) {
                return redirect()->back()->with('success', "Lead Updated");
            } else {
                return redirect()->back()->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }
}

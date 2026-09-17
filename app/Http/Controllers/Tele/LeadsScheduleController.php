<?php

namespace App\Http\Controllers\Tele;

use App\Http\Controllers\Controller;
use App\Models\LeadRemainder;
use App\Models\Leads;
use App\Models\LeadStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LeadsScheduleController extends Controller
{
    public function leads(Request $request)
    {
        try {
            $seo = [
                'title'         =>  "New Lead List",
                'favicon'       =>  url(env('APP_FAVICON')),
                'logo'          =>  url(env('APP_LOGO')),
                'keyword'       => "New Lead List",
                'description'   => "New Lead List",
                'author'        => env('COMPANYNAME'),
            ];
            $l_type = '';
            $mylead = LeadRemainder::select()->where('status', '1')->where('is_delete', '0');

            $mylead = $mylead->where('user_id', Auth::user()->id)->get();

            $myleads = array();
            foreach ($mylead as $key) {
                $myleads[] = $key['lead_id'];
            }

            $leads = Leads::select()->where('status', '1')->where('is_delete', '0')->whereIn('id', $myleads);
            if ((!empty($request->date_from)) and (!empty($request->date_to))) {
                $leads = $leads->whereBetween('created_at', [$request->date_from . ' 00:01:01', $request->date_to . ' 23:59:59']);
            }
            $leads = $leads->orderby('id', 'desc')->get();

            return view('Tele.leadstatus.schedule', compact('seo', 'leads','l_type'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }
    public function delete(Request $request)
    {
        try {
            date_default_timezone_set("Asia/Kolkata");
            $id  = Crypt::decrypt($request->id_delete);
            $update = LeadRemainder::where('lead_id', $id)->where('user_id', Auth::user()->id)->update(['is_delete' => '1']);
            $ds = [
                'lead_id' => $id,
                'user_id' => Auth::user()->id,
                'remarks' => 'Lead schedule removed from '.Auth::user()->name.' Panels',
                'icon'    => 'fa-times',
                'bgcolor' => 'danger',
                'date'      => date('Y-m-d'),
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ];
            LeadStatus::insert($ds);
            if ($update) {
                return redirect()->back()->with('success', "Leads Schedule Remove From Your Panel");
            } else {
                return redirect()->back()->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }
}

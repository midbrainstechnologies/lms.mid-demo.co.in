<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadMarking;
use App\Models\LeadMS;
use App\Models\LeadRemainder;
use App\Models\Leads;
use App\Models\LeadStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LeadsStatusController extends Controller
{
    public function leads(Request $request, $type)
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
            $l_type = LeadMarking::LABELS[$type] ?? '';
            $mylead = LeadMS::select('lead_id')->where('status', '1')->where('is_delete', '0')->where('is_captured', '1');
            if (!empty($type)) {
                $mylead = $mylead->where('lead_type', $type);
            }
            if(!empty($request->user)){
                $mylead = $mylead->where('user_id',Crypt::decrypt($request->user));
            }
            // $mylead = $mylead->where('user_id', Auth::user()->id);
            $mylead = $mylead->get();

            $myleads = array();
            foreach ($mylead as $key) {
                $myleads[] = $key['lead_id'];
            }

            $leads = Leads::select()->where('status', '1')->where('is_delete', '0')->whereIn('id', $myleads);
            if ((!empty($request->date_from)) and (!empty($request->date_to))) {
                $leads = $leads->whereBetween('created_at', [$request->date_from . ' 00:01:01', $request->date_to . ' 23:59:59']);
            }
            $leads = $leads->orderby('id', 'desc')->get();
            $telecaller = User::select()->where('user_role', 'tele-caller')->where('status', '1')->where('is_delete', '0')->where('verify', '1')->where('block', '0')->orderby('id', 'desc')->get();
            return view('Admin.leadlist.list', compact('seo', 'leads','l_type','telecaller'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }
    public function leadupdate(Request $request){

        $validate = $request->validate([
            'leadid'                        => 'required',
            'status'                        => 'required|in:hot,warm,cold,dead,closed',
            'remarks'                       => 'required',
            'is_schedule'                   => 'required',
            'schedule'                      => !empty($request->is_schedule)?(($request->is_schedule == "yes")?'required':''):'',
        ]);

        try{
            date_default_timezone_set("Asia/Kolkata");
            $type = $request->status;
            $l_type = LeadMarking::LABELS[$type];
            //->where('user_id',Auth::user()->id)
            LeadMS::where('lead_id',$request->leadid)->where('is_delete','0')->where('status','1')->update([
                'lead_type' => $type,
            ]);

            $ds = [
                'lead_id' => $request->leadid,
                'user_id' => Auth::user()->id,
                'remarks' => "Lead Marked <b>$l_type</b> by remarks:- $request->remarks",
                'icon'    => 'fa-envelope',
                'bgcolor' => LeadMarking::BGCOLORS[$type],
                'date'      => date('Y-m-d'),
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ];
            LeadStatus::insert($ds);
            LeadRemainder::where('lead_id',$request->leadid)->where('user_id',Auth::user()->id)->update([
                'status'    => '0',
                'is_delete'    => '1',
            ]);
            if($request->is_schedule == "yes"){
                $data_r = [
                    'lead_id'   => $request->leadid,
                    'user_id'   => Auth::user()->id,
                    'remarks'   => $request->remarks,
                    'next_date' => $request->schedule,
                ];



                LeadRemainder::create($data_r);
                $dsr = [
                    'lead_id' => $request->leadid,
                    'user_id' => Auth::user()->id,
                    'remarks' => "Lead Marked for next review on ".date('M d, Y', strtotime($request->schedule)),
                    'icon'    => 'fa-envelope',
                    'bgcolor' => 'yellow',
                    'date'      => date('Y-m-d'),
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ];
                LeadStatus::insert($dsr);
            }
            return redirect()->back()->with('success', "Status Updated");

        }catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }
}

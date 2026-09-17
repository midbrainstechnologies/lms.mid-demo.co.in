<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryMaster;
use App\Models\LeadMarking;
use App\Models\LeadMS;
use App\Models\LeadRemainder;
use App\Models\Leads;
use App\Models\LeadStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MyStatusController extends Controller
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
            $l_type = '';
            $mylead = LeadMS::select('lead_id')->where('status', '1')->where('is_delete', '0')->where('is_captured', '1');
            if (!empty($type)) {
                $mylead = $mylead->where('lead_type', $type);
                if($type == "closed"){
                    $l_type = 'Closed ';
                }else if($type == "a_process"){
                    $l_type = 'Under Process ';
                }else if($type == "a_complete"){
                    $l_type = 'Completed ';
                }
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
            $telecaller = User::select()->where('user_role', 'tele-caller')->where('status', '1')->where('is_delete', '0')->where('verify', '1')->where('block', '0')->orderby('id', 'desc')->where('business_id', Auth::user()->business_id)->get();
            return view('Admin.mystatus.mylist', compact('seo', 'leads','l_type','telecaller'));
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

            $categorymaster = CategoryMaster::select()->where('status','1')->where('is_delete','0')->orderby('id','desc')->get();
            $leads = Leads::select()->where('status', '1')->where('is_delete', '0')->where('id', Crypt::decrypt($id))->first();

            return view('Admin.mystatus.edit',compact('seo','categorymaster','leads'));

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }

    public function add(Request $request,$id)
    {
        date_default_timezone_set("Asia/Kolkata");
        $validate = $request->validate([
            'master_type'           => 'required',
            'name'                  => 'required',
            'mobile'                => 'required',
        ]);

        try {
            if($request->master_type == "other"){
                $datam = [
                    'name'          => $request->master_type_name,
                    'created_by'    => Auth::user()->id,
                    'created_at'    => NOW(),
                    'updated_at'    => NOW(),
                ];

                $master = CategoryMaster::create($datam);
                $msterid = $master->id;
            }else{
                $msterid = $request->master_type;
            }

            $data = [
                'masterid'          => $msterid,
                'created_by'        => Auth::user()->id,
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'email'             => $request->email,
                'company'           => $request->company,
                'source'            => $request->source,
                'title'             => $request->title,
                'description'       => $request->description,
                'age'               => $request->age,
                'is_married'        => $request->is_married,
                'occupation'        => $request->occupation,
                'is_xerox'          => $request->is_xerox,
                'come_from'         => $request->come_from,
                'problem'           => $request->problem,
                'problem_detail'    => $request->problem_detail,
                'addr'              => $request->addr,
                'updated_at'        => NOW(),

            ];
            $insert = Leads::where('id',Crypt::decrypt($id))->update($data);

            $ds = [
                'lead_id' => Crypt::decrypt($id),
                'user_id' => Auth::user()->id,
                'remarks' => 'Lead Information Updated By Admin',
                'icon'    => 'fa-check',
                'bgcolor' => 'blue',
                'date'      => date('Y-m-d'),
                'created_at' => NOW(),
                'updated_at' => NOW(),
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




            $leads = Leads::select()->where('status', '1')->where('is_delete', '0')->where('id', Crypt::decrypt($id))->first();

            $remarks = LeadStatus::select()->where('status', '1')->where('is_delete', '0')->where('lead_id', Crypt::decrypt($id))->orderBy('date', 'desc')->get();

            return view('Admin.mystatus.view', compact('seo', 'leads', 'remarks'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }

    public function leadupdate(Request $request){

        // This single route is shared by two different dropdowns: Admin's general lead
        // detail (Hot/Warm/Cold/Dead/Closed markings) and the My Status billing detail
        // (Closed/Under Process/Completed), so it must accept both sets of values.
        $validate = $request->validate([
            'leadid'                        => 'required',
            'status'                        => 'required|in:hot,warm,cold,dead,closed,a_process,a_complete',
            'remarks'                       => 'required',
            'is_schedule'                   => 'required',
            'schedule'                      => !empty($request->is_schedule)?(($request->is_schedule == "yes")?'required':''):'',
        ]);

        try{
            date_default_timezone_set("Asia/Kolkata");
            $type = $request->status;
            if($type == "a_process"){
                $l_type = 'Under Process ';
            }else if($type == "a_complete"){
                $l_type = 'Completed ';
            }else{
                $l_type = LeadMarking::LABELS[$type];
            }

            LeadMS::where('lead_id',$request->leadid)->where('is_delete','0')->where('status','1')->update([
                'lead_type' => $type,
            ]);

            $ds = [
                'lead_id' => $request->leadid,
                'user_id' => Auth::user()->id,
                'remarks' => "Lead Marked <b>$l_type</b> by remarks:- $request->remarks",
                'icon'    => 'fa-envelope',
                'bgcolor' => 'yellow',
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

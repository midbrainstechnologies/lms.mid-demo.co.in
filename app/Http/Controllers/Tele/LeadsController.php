<?php

namespace App\Http\Controllers\Tele;

use App\Http\Controllers\Controller;
use App\Models\CategoryMaster;
use App\Models\LeadMS;
use App\Models\Leads;
use App\Models\LeadStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LeadsController extends Controller
{
    const TEMPERATURE_LABELS = [
        'hot'  => 'Hot',
        'warm' => 'Warm',
        'cold' => 'Cold',
        'dead' => 'Dead',
    ];

    const TEMPERATURE_BGCOLORS = [
        'hot'  => 'red',
        'warm' => 'orange',
        'cold' => 'aqua',
        'dead' => 'gray',
    ];

    public function allLeads(Request $request)
    {
        try {
            $seo = [
                'title'         =>  "All Leads",
                'favicon'       =>  url(env('APP_FAVICON')),
                'logo'          =>  url(env('APP_LOGO')),
                'keyword'       => "All Leads",
                'description'   => "All Leads",
                'author'        => env('COMPANYNAME'),
            ];

            $mylead = LeadMS::select('lead_id', 'lead_temperature')->where('status', '1')->where('is_delete', '0')->where('user_id', Auth::user()->id)->get();

            $myleads = array();
            $temperatures = array();
            foreach ($mylead as $key) {
                $myleads[] = $key['lead_id'];
                $temperatures[$key['lead_id']] = $key['lead_temperature'];
            }

            $leads = Leads::select()->where('status', '1')->where('is_delete', '0')->whereIn('id', $myleads);
            if ((!empty($request->date_from)) and (!empty($request->date_to))) {
                $leads = $leads->whereBetween('created_at', [$request->date_from . ' 00:01:01', $request->date_to . ' 23:59:59']);
            }
            $leads = $leads->orderby('id', 'desc')->get();

            return view('Tele.lead.allleads', compact('seo', 'leads', 'temperatures'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }

    public function markTemperature(Request $request)
    {
        $request->validate([
            'lead_id'     => 'required',
            'temperature' => 'required|in:hot,warm,cold,dead',
        ]);

        try {
            $update = LeadMS::where('lead_id', $request->lead_id)->where('user_id', Auth::user()->id)->where('is_delete', '0')->where('status', '1')->update([
                'lead_temperature' => $request->temperature,
            ]);

            if (!$update) {
                return redirect()->back()->with('error', "Server Error");
            }

            $label = self::TEMPERATURE_LABELS[$request->temperature];

            LeadStatus::create([
                'business_id' => Auth::user()->business_id,
                'date'        => date('Y-m-d'),
                'lead_id'     => $request->lead_id,
                'user_id'     => Auth::user()->id,
                'icon'        => 'fa-thermometer-half',
                'bgcolor'     => self::TEMPERATURE_BGCOLORS[$request->temperature],
                'remarks'     => "Lead Marked <b>$label</b> by " . Auth::user()->name,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            return redirect()->back()->with('success', "Lead Marked As $label");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }

    public function transferred(Request $request)
    {
        $seo = [
            'title'         =>  "Transferred Lead List",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => "Transferred Lead List",
            'description'   => "Transferred Lead List",
            'author'        => env('COMPANYNAME'),
        ];


        $mylead = LeadMS::select('lead_id')->where('status', '1')->where('is_delete', '0')->where('is_captured', '0')->where('user_id', Auth::user()->id)->get();

        $myleads = array();
        foreach ($mylead as $key) {
            $myleads[] = $key['lead_id'];
        }

        $leads = Leads::select()->where('status', '1')->where('is_delete', '0')->whereIn('id', $myleads);
        if ((!empty($request->date_from)) and (!empty($request->date_to))) {
            $leads = $leads->whereBetween('created_at', [$request->date_from . ' 00:01:01', $request->date_to . ' 23:59:59']);
        }
        $leads = $leads->orderby('id', 'desc')->get();

        return view('Tele.lead.transferred', compact('seo', 'leads'));
    }
    public function capture(Request $request)
    {
        try {
            $arrayleads = $request->leads;

            foreach ($arrayleads as $key) {
                LeadMS::where('lead_id', $key)->where('user_id', Auth::user()->id)->update([
                    'is_captured'   => '1',
                    'capture_time'  => NOW(),
                ]);

                $ds = [
                    'lead_id' => $key,
                    'user_id' => Auth::user()->id,
                    'remarks' => 'Lead Captured',
                    'icon'    => 'fa-thumbs-up',
                    'bgcolor' => 'green',
                    'date'      => date('Y-m-d'),
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ];

                $datas[] = $ds;
            }
            LeadStatus::insert($datas);

            return redirect()->back()->with('success', "Leads Captured Successfully");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }

    public function captured(Request $request)
    {
        try {
            $seo = [
                'title'         =>  "Captured Lead List",
                'favicon'       =>  url(env('APP_FAVICON')),
                'logo'          =>  url(env('APP_LOGO')),
                'keyword'       => "Captured Lead List",
                'description'   => "Captured Lead List",
                'author'        => env('COMPANYNAME'),
            ];


            $mylead = LeadMS::select('lead_id')->where('status', '1')->where('is_delete', '0')->where('is_captured', '1')->where('user_id', Auth::user()->id)->get();

            $myleads = array();
            foreach ($mylead as $key) {
                $myleads[] = $key['lead_id'];
            }

            $leads = Leads::select()->where('status', '1')->where('is_delete', '0')->whereIn('id', $myleads);
            if ((!empty($request->date_from)) and (!empty($request->date_to))) {
                $leads = $leads->whereBetween('created_at', [$request->date_from . ' 00:01:01', $request->date_to . ' 23:59:59']);
            }
            $leads = $leads->orderby('id', 'desc')->get();

            return view('Tele.lead.captured', compact('seo', 'leads'));
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

            return view('Tele.lead.view', compact('seo', 'leads', 'remarks'));
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

            return view('Tele.lead.edit',compact('seo','categorymaster','leads'));

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
                'updated_at'        => NOW(),

            ];
            $insert = Leads::where('id',Crypt::decrypt($id))->update($data);

            $ds = [
                'lead_id' => Crypt::decrypt($id),
                'user_id' => Auth::user()->id,
                'remarks' => 'Lead Information Updated',
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

    public function delete(Request $request)
    {
        try {
            $id  = Crypt::decrypt($request->id_delete);
            $update = LeadMS::where('lead_id', $id)->where('user_id', Auth::user()->id)->update(['is_delete' => '1']);
            $ds = [
                'lead_id' => $id,
                'user_id' => Auth::user()->id,
                'remarks' => 'Lead Deleted From '.Auth::user()->name.' Panels',
                'icon'    => 'fa-trash',
                'bgcolor' => 'danger',
                'date'      => date('Y-m-d'),
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ];
            LeadStatus::insert($ds);
            if ($update) {
                return redirect()->back()->with('success', "Leads Deleted From Your Panel");
            } else {
                return redirect()->back()->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }
}

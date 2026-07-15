<?php

namespace App\Http\Controllers\LeadCreator;

use App\Http\Controllers\Controller;
use App\Models\CategoryMaster;
use App\Models\Leads;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LeadController extends Controller
{
    public function create(){

        $seo = [
            'title'         =>  "New Lead",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Create Lead',
            'description'   => 'Create Lead',
            'author'        => env('COMPANYNAME'),
        ];

        $categorymaster = CategoryMaster::select()->where('status','1')->where('is_delete','0')->orderby('id','desc')->get();

        return view('LeadCreator.create.index',compact('seo','categorymaster'));

    }

    public function getapi(Request $request){
        try {
            $data = [
                'plateform'         => 'facebook',
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'email'             => $request->email,
                'source'            => 'online',
                'title'             => $request->otherdata,
                'description'       => $request->response,
                'created_at'        => NOW(),
                'updated_at'        => NOW(),

            ];
            $insert = Leads::create($data);
            if ($insert) {
                return ['status'=> true];
            } else {
                return ['status'=> false];
            }
        } catch (\Throwable $th) {
            return ['status'=> false];
        }
    }

    public function add(Request $request)
    {
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
                'business_id'       => Auth::user()->business_id,
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'email'             => $request->email,
                'company'           => $request->company,
                'source'            => $request->source,
                'title'             => $request->title,
                'description'       => $request->description,
                'created_at'        => NOW(),
                'updated_at'        => NOW(),

            ];
            $insert = Leads::create($data);
            if ($insert) {
                return redirect('/lead-creater/create')->with('success', "Lead Created");
            } else {
                return redirect('/lead-creater/create')->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect('/lead-creater/create')->with('error', "Server Error");
        }
    }

    public function myleads(){
        $seo = [
            'title'         =>  "My Lead",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'My Lead',
            'description'   => 'My Lead',
            'author'        => env('COMPANYNAME'),
        ];
        $leads = Leads::select()->where('created_by',Auth::user()->id)->where('status','1')->where('is_delete','0')->orderby('id','desc')->get();
        $telecaller = User::select()->where('user_role', 'tele-caller')->where('status', '1')->where('is_delete', '0')->where('verify', '1')->where('block', '0')->orderby('id', 'desc')->get();
        return view('LeadCreator.lead.index',compact('seo','leads','telecaller'));
    }

    public function delete(Request $request)
    {
        try {
            $id  = Crypt::decrypt($request->id_delete);
            $update = Leads::where('id', $id)->update(['is_delete' => '1']);
            if ($update) {
                return redirect('/lead-creater/myleads')->with('success', "Leads Deleted");
            } else {
                return redirect('/lead-creater/myleads')->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect('/lead-creater/myleads')->with('error', "Server Error");
        }
    }




    public function onlineview(Request $request)
    {
        $seo = [
            'title'         =>  "Online Lead List",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => "Online Lead List",
            'description'   => "Online Lead List",
            'author'        => env('COMPANYNAME'),
        ];

        $leads = Leads::select()->where('plateform','!=', 'creator')->where('status', '1')->where('is_delete', '0');
        if((!empty($request->date_from)) and (!empty($request->date_to))){
            $leads = $leads->whereBetween('created_at',[$request->date_from.' 00:01:01',$request->date_to.' 23:59:59']);
        }
        $leads = $leads->orderby('id', 'desc')->get();

        $telecaller = User::select()->where('user_role', 'tele-caller')->where('status', '1')->where('is_delete', '0')->where('verify', '1')->where('block', '0')->orderby('id', 'desc')->get();

        return view('LeadCreator.lead.online_list', compact('seo', 'leads', 'telecaller'));
    }
}

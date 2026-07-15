<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadMS;
use App\Models\Leads;
use App\Models\PaymentTaken;
use App\Models\Service;
use App\Models\ServiceTaken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AddServiceController extends Controller
{
    public function index($id)
    {
        try {
            $data = array();
            $seo = [
                'title'         =>  "Service",
                'description'   =>  "Service",
                'keywords'      =>  "Service",
                'author'        =>  "Service",
                'image'         =>  env('APP_LOGO'),
            ];
            $getid = Crypt::decrypt($id);
            $user = LeadMS::select()->where('lead_id', $getid)->orderby('id', 'desc')->first();
            $items = Service::select()->where('status', '1')->orderby('id', 'desc')->get();

            $services = ServiceTaken::select()->where('status', '1')->where('leadid', $getid)->orderby('id', 'desc')->get();
            $pay = PaymentTaken::select()->where('status', '1')->where('leadid', $getid)->orderby('id', 'desc')->get();

            return view('Admin.mystatus.service', compact('seo', 'user', 'items', 'services', 'pay'));
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Server Error, Contact Administrator");
        }
    }

    public function print($id)
    {
        $seo = [
            'title'         =>  "Visiter Enquiry",
            'description'   =>  "Visiter Enquiry",
            'keywords'      =>  "Visiter Enquiry",
            'author'        =>  "Visiter Enquiry",
            'image'         =>  env('APP_LOGO'),
        ];
        $getid = Crypt::decrypt($id);
        $user = LeadMS::select()->where('lead_id', $getid)->where('status', '1')->where('is_delete', '0')->orderby('id', 'desc')->first();
        $mainuser = Leads::select()->where('id', $getid)->where('status', '1')->where('is_delete', '0')->orderby('id', 'desc')->first();
        $items = Service::select()->where('status', '1')->orderby('id', 'desc')->get();

        $services = ServiceTaken::select()->where('status', '1')->where('leadid', $getid)->orderby('id', 'asc')->get();
        $pay = PaymentTaken::select()->where('status', '1')->where('leadid', $getid)->orderby('id', 'desc')->get();

        return view('Admin.mystatus.print', compact('seo', 'user', 'items', 'services', 'pay', 'mainuser'));
    }
    public function gen(Request $request, $id)
    {
        try {
            $getid = Crypt::decrypt($id);
            $res = [
                'leadid' => $getid,
                'serviceid' => $request->item,
                'payment' => $request->price,
                'remarks' => $request->remarks,
                'status'  => '1',
            ];
            ServiceTaken::create($res);
            return redirect()->back()->with('success', 'Service Added...');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Server Error, Contact Administrator");
        }
    }
    public function gend(Request $request, $id)
    {
        try {
            $getid = Crypt::decrypt($id);

            ServiceTaken::where('id', $getid)->delete();
            return redirect()->back()->with('success', 'Service Deleted...');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Server Error, Contact Administrator");
        }
    }
    public function pay(Request $request, $id)
    {
        try {
            $getid = Crypt::decrypt($id);
            $res = [
                'leadid' => $getid,
                'payment' => $request->price,
                'remarks' => $request->remarks,
                'status'  => '1',
            ];
            PaymentTaken::create($res);
            return redirect()->back()->with('success', 'Payment Received...');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Server Error, Contact Administrator");
        }
    }
    public function payd(Request $request, $id)
    {
        try {
            $getid = Crypt::decrypt($id);

            PaymentTaken::where('id', $getid)->delete();
            return redirect()->back()->with('success', 'Payment Deleted...');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Server Error, Contact Administrator");
        }
    }
}

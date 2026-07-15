<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadMS;
use App\Models\Leads;
use App\Models\LeadStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;

class LeadlistController extends Controller
{
    public function creatorview(Request $request)
    {
        $seo = [
            'title'         =>  "Creator's Lead List",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => "Creator's Lead List",
            'description'   => "Creator's Lead List",
            'author'        => env('COMPANYNAME'),
        ];

        $businessId = Auth::user()->business_id;

        $leads = Leads::select()->where('plateform', 'creator')->where('status', '1')->where('is_delete', '0');
        if((!empty($request->date_from)) and (!empty($request->date_to))){
            $leads = $leads->whereBetween('created_at',[$request->date_from.' 00:01:01',$request->date_to.' 23:59:59']);
        }
        if(!empty($request->user)){
            $leads = $leads->where('created_by',Crypt::decrypt($request->user));
        }
        $leads = $leads->orderby('id', 'desc')->get();

        $telecaller = User::select()->where('user_role', 'tele-caller')->where('status', '1')->where('is_delete', '0')->where('verify', '1')->where('block', '0')->where('business_id', $businessId)->orderby('id', 'desc')->get();

        return view('Admin.leadlist.creator_list', compact('seo', 'leads', 'telecaller'));
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

        return view('Admin.leadlist.online_list', compact('seo', 'leads', 'telecaller'));
    }

    public function upload(){
        $seo = [
            'title'         =>  "Upload Lead List",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => "Upload Lead List",
            'description'   => "Upload Lead List",
            'author'        => env('COMPANYNAME'),
        ];

        return view('Admin.leadlist.upload', compact('seo'));
    }
    public function uploaddata(Request $request)
{
    if ($request->hasFile('excel')) {
        $data = $request->file('excel');
        $fileExtension = $data->getClientOriginalExtension();
        $formats = ['xls', 'xlsx', 'ods', 'csv'];

        if (!in_array($fileExtension, $formats)) {
            return back()->with("error", 'The uploaded file format is not allowed.');
        }

        $path = $request->file('excel')->getRealPath();
        $reader = new ReaderXlsx();
        $spreadsheet = $reader->load($path);
        $sheetData = $spreadsheet->getActiveSheet();
        $worksheetinfo = $reader->listWorksheetInfo($path);
        $totalrows = $worksheetinfo[0]['totalRows'];

        $businessId = Auth::user()->business_id;

        for ($i = 2; $i <= $totalrows; $i++) {
            $sr   = $sheetData->getCell('A' . $i)->getValue() ?? '';
            $name = $sheetData->getCell('B' . $i)->getValue() ?? '';
            $mobile = $sheetData->getCell('C' . $i)->getValue() ?? '';
            $email = $sheetData->getCell('D' . $i)->getValue() ?? '';
            $source = 'Excelsheet';
            $title  = $sheetData->getCell('E' . $i)->getValue() ?? '';
            $description =
                ($sheetData->getCell('F' . $i)->getValue() ?? '') . ' ' .
                ($sheetData->getCell('G' . $i)->getValue() ?? '') . ' ' .
                ($sheetData->getCell('H' . $i)->getValue() ?? '') . ' ' .
                ($sheetData->getCell('I' . $i)->getValue() ?? '') . ' ' .
                ($sheetData->getCell('J' . $i)->getValue() ?? '');

            if (!empty($name) && !empty($mobile)) {
                $data = [
                    'name'        => $name,
                    'mobile'      => $mobile,
                    'email'       => $email,
                    'source'      => $source,
                    'title'       => $title,
                    'description' => $description,
                    'business_id' => $businessId, // ✅ Assign business id
                    'created_by'  => Auth::user()->id,
                    'plateform'   => 'creator',
                    'status'      => '1',
                    'is_delete'   => '0',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];

                Leads::insert($data);
            }
        }

        return back()->with("success", 'File Uploaded Successfully');
    } else {
        return back()->with("error", 'Please upload file');
    }
}


    public function transfer(Request $request)
    {
        try {
            $arrayleads = $request->leads;
            $telecaller = $request->telecaller;

            $data = $datas = array();
            foreach ($arrayleads as $key) {
                $dt = [
                    'lead_id' => $key,
                    'user_id' => $telecaller,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ];
                $data[] = $dt;


                $ds = [
                    'lead_id' => $key,
                    'user_id' => Auth::user()->id,
                    'remarks' => 'Lead Transferred',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                    'date'      => date('Y-m-d'),
                ];

                $datas[] = $ds;
            }

            LeadMS::insert($data);
            LeadStatus::insert($datas);

            return redirect()->back()->with('success', "Leads Transferred Successfully");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }

    public function allleads(Request $request)
    {
        $seo = [
            'title'         =>  "Online Lead List",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => "Online Lead List",
            'description'   => "Online Lead List",
            'author'        => env('COMPANYNAME'),
        ];

        $leads = Leads::select()->where('status', '1')->where('is_delete', '0');
        if((!empty($request->date_from)) and (!empty($request->date_to))){
            $leads = $leads->whereBetween('created_at',[$request->date_from.' 00:01:01',$request->date_to.' 23:59:59']);
        }
        $leads = $leads->orderby('id', 'desc')->get();

        $telecaller = User::select()->where('user_role', 'tele-caller')->where('status', '1')->where('is_delete', '0')->where('verify', '1')->where('block', '0')->orderby('id', 'desc')->get();

        return view('Admin.leadlist.allleads', compact('seo', 'leads', 'telecaller'));
    }

    public function delete(Request $request)
    {
        try {
            $id  = Crypt::decrypt($request->id_delete);
            $update = Leads::where('id', $id)->update(['is_delete' => '1']);
            if ($update) {
                return redirect()->back()->with('success', "Leads Deleted");
            } else {
                return redirect()->back()->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }
}

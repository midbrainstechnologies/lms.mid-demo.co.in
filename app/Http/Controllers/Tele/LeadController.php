<?php

namespace App\Http\Controllers\Tele;

use App\Http\Controllers\Controller;
use App\Models\CategoryMaster;
use App\Models\LeadMS;
use App\Models\Leads;
use App\Models\LeadStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;

class LeadController extends Controller
{
    private function guardCanCreateLead()
    {
        if (Auth::user()->can_create_lead != '1') {
            return redirect('/tele-caller/dashboard')->with('error', "You don't have permission to create leads. Please contact your Admin.");
        }

        return null;
    }

    public function create()
    {
        // Admin/Business owner must have explicitly allowed this Telecaller to create leads.
        if ($redirect = $this->guardCanCreateLead()) {
            return $redirect;
        }

        $seo = [
            'title'         =>  "New Lead",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Create Lead',
            'description'   => 'Create Lead',
            'author'        => env('COMPANYNAME'),
        ];

        $categorymaster = CategoryMaster::select()->where('status','1')->where('is_delete','0')->orderby('id','desc')->get();

        return view('Tele.lead.create', compact('seo', 'categorymaster'));
    }

    public function add(Request $request)
    {
        if ($redirect = $this->guardCanCreateLead()) {
            return $redirect;
        }

        $validate = $request->validate([
            'master_type'           => 'required',
            'name'                  => 'required',
            'mobile'                => 'required',
        ]);

        date_default_timezone_set("Asia/Kolkata");

        try {
            if ($request->master_type == "other") {
                $datam = [
                    'name'          => $request->master_type_name,
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
                'created_at'        => NOW(),
                'updated_at'        => NOW(),
            ];

            $lead = Leads::create($data);

            if ($lead) {
                // Assign the lead straight to this telecaller so it shows up in their own lead lists.
                LeadMS::create([
                    'business_id'   => Auth::user()->business_id,
                    'lead_id'       => $lead->id,
                    'user_id'       => Auth::user()->id,
                    'lead_type'     => 'new',
                    'is_captured'   => '0',
                    'created_at'    => NOW(),
                    'updated_at'    => NOW(),
                ]);

                LeadStatus::create([
                    'business_id'   => Auth::user()->business_id,
                    'date'          => date('Y-m-d'),
                    'lead_id'       => $lead->id,
                    'user_id'       => Auth::user()->id,
                    'icon'          => 'fa-plus',
                    'bgcolor'       => 'green',
                    'remarks'       => 'Lead Created By ' . Auth::user()->name,
                    'created_at'    => NOW(),
                    'updated_at'    => NOW(),
                ]);

                return redirect('/tele-caller/create')->with('success', "Lead Created");
            } else {
                return redirect('/tele-caller/create')->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect('/tele-caller/create')->with('error', "Server Error");
        }
    }

    public function upload()
    {
        if ($redirect = $this->guardCanCreateLead()) {
            return $redirect;
        }

        $seo = [
            'title'         =>  "Upload Lead List",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => "Upload Lead List",
            'description'   => "Upload Lead List",
            'author'        => env('COMPANYNAME'),
        ];

        return view('Tele.lead.upload', compact('seo'));
    }

    public function uploaddata(Request $request)
    {
        if ($redirect = $this->guardCanCreateLead()) {
            return $redirect;
        }

        if (!$request->hasFile('excel')) {
            return back()->with("error", 'Please upload file');
        }

        $data = $request->file('excel');
        $fileExtension = $data->getClientOriginalExtension();
        $formats = ['xls', 'xlsx', 'ods', 'csv'];

        if (!in_array($fileExtension, $formats)) {
            return back()->with("error", 'The uploaded file format is not allowed.');
        }

        date_default_timezone_set("Asia/Kolkata");

        try {
            $path = $request->file('excel')->getRealPath();
            $reader = new ReaderXlsx();
            $spreadsheet = $reader->load($path);
            $sheetData = $spreadsheet->getActiveSheet();
            $worksheetinfo = $reader->listWorksheetInfo($path);
            $totalrows = $worksheetinfo[0]['totalRows'];

            $businessId = Auth::user()->business_id;
            $created = 0;

            for ($i = 2; $i <= $totalrows; $i++) {
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

                if (empty($name) || empty($mobile)) {
                    continue;
                }

                $lead = Leads::create([
                    'name'        => $name,
                    'mobile'      => $mobile,
                    'email'       => $email,
                    'source'      => $source,
                    'title'       => $title,
                    'description' => $description,
                    'business_id' => $businessId,
                    'created_by'  => Auth::user()->id,
                    'plateform'   => 'creator',
                    'status'      => '1',
                    'is_delete'   => '0',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);

                if ($lead) {
                    // Assign each uploaded lead straight to this telecaller, same as single Create Lead.
                    LeadMS::create([
                        'business_id'   => $businessId,
                        'lead_id'       => $lead->id,
                        'user_id'       => Auth::user()->id,
                        'lead_type'     => 'new',
                        'is_captured'   => '0',
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);

                    LeadStatus::create([
                        'business_id'   => $businessId,
                        'date'          => date('Y-m-d'),
                        'lead_id'       => $lead->id,
                        'user_id'       => Auth::user()->id,
                        'icon'          => 'fa-plus',
                        'bgcolor'       => 'green',
                        'remarks'       => 'Lead Uploaded By ' . Auth::user()->name,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);

                    $created++;
                }
            }

            return back()->with("success", $created . ' Lead(s) Uploaded Successfully');
        } catch (\Throwable $th) {
            return back()->with("error", "Server Error");
        }
    }
}

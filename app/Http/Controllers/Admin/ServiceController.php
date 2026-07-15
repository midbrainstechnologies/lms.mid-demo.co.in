<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ServiceController extends Controller
{
    public function index($id = null)
    {
        $data = array();
        $seo = [
            'title'         =>  "Service",
            'description'   =>  "Service",
            'keywords'      =>  "Service",
            'author'        =>  "Service",
            'image'         =>  env('APP_LOGO'),
        ];
        $service = Service::select()->where('is_delete','0')->orderby('id', 'desc')->get();
        if (!empty($id)) {
            $getid = Crypt::decrypt($id);
            $data  = Service::select()->where('id', $getid)->first();
        }
        return view('Admin.service.service', compact('seo', 'service','data'));
    }

    public function add(Request $request, $id = null)
    {
        $validated = $request->validate([
            'name'          => 'required',
            'seq'           => 'required',
        ]);
        try {


            if (!empty($id)) {
                $getid = Crypt::decrypt($id);
                $data = Service::select()->where('id', $getid)->first();

                $data = [
                    'name'       => $request->name,
                    'seq'       => $request->seq,
                ];

                Service::where('id', $getid)->update($data);
                return redirect('/admin/service')->with("success", "Service Updated...");
            } else {
                $full_path_photo = "";
                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $path_photo = env('IMGPATH');
                    $name = "Service_Photo" . "_" . time() . "_" . rand(10000000000, 99999999999) . "_" . time() . '.' . $request->file->getClientOriginalExtension();
                    $img = $image->move($path_photo, $name);
                    $full_path_photo = $path_photo . "/" . $name;
                }
                $data = [
                    'status'    => "1",
                    'seq'       => $request->seq,
                    'name'       => $request->name,
                    'is_home'     => '1',
                    'is_menu'     => '1',
                ];
                Service::create($data);
                return redirect()->back()->with("success", "Service Created...");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Server Error, Contact Administrator");
        }
    }
    public function deactive($id)
    {
        try {
            $getid = Crypt::decrypt($id);

            Service::where('id', $getid)->update(['status' => '0']);
            return redirect()->back()->with("success", "Service Deactive...");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Server Error, Contact Administrator");
        }
    }
    public function active($id)
    {
        try {
            $getid = Crypt::decrypt($id);

            Service::where('id', $getid)->update(['status' => '1']);
            return redirect()->back()->with("success", "Service Active...");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Server Error, Contact Administrator");
        }
    }
    public function delete(Request $request)
    {
        try {
            $getid = Crypt::decrypt($request->id_delete);

            Service::where('id', $getid)->update(['is_delete' => '1']);
            return redirect("/admin/service")->with("success", "Service Deleted...");
        } catch (\Throwable $th) {
            return redirect("/admin/service")->with("error", "Server Error, Contact Administrator");
        }
    }
}

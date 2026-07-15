<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Business;

class ManageAdminController extends Controller
{
    public function index()
    {
        $businesses = Business::all();
        return view('SuperAdmin.manageadmins.manageadmin', compact('businesses'));
    }


    public function create()
    {
        $businesses = Business::where('status', 'active')
    ->orderBy('name', 'asc')
    ->get();
        return view('SuperAdmin.manageadmins.manageadmin', compact('businesses'));
    }

    public function store(Request $request)
    {
        $id = $request->id;

        $rules = [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email' . ($id ? ',' . $id : ''),
            'mobile'       => 'required|string|max:15',
            'address1'     => 'required|string|max:255',
            'address2'     => 'nullable|string|max:255',
            'user_role'    => 'required|in:tele-caller,lead-creater,admin,super-admin',
            'business_id'  => 'required|exists:businesses,id',
        ];

        if ($id) {
            // For edit, password is optional
            $rules['password'] = 'nullable|string|min:6|confirmed';
        } else {
            // For create, password is required
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        $request->validate($rules);

        if ($id) {

            $user = User::findOrFail($id);
            $user->update([
                'name'         => $request->name,
                'email'        => $request->email,
                'mobile'       => $request->mobile,
                'address1'     => $request->address1,
                'address2'     => $request->address2,
                'user_role'    => $request->user_role,
                'business_id'  => $request->business_id,
                'password'     => $request->password
                                    ? Hash::make($request->password)
                                    : $user->password
            ]);

            $message = 'Admin updated successfully.';
        } else {
            // Create new user
            User::create([
                'name'         => $request->name,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
                'mobile'       => $request->mobile,
                'address1'     => $request->address1,
                'address2'     => $request->address2,
                'user_role'    => $request->user_role,
                'business_id'  => $request->business_id
            ]);

            $message = 'Admin created successfully.';
        }

        return redirect()
            ->route('admin.list')
            ->with('success', $message);
    }


    public function edit($id)
    {
        $seo = [
            'title'       => "Edit Admin",
            'favicon'     => url(env('APP_FAVICON')),
            'logo'        => url(env('APP_LOGO')),
            'keyword'     => "Edit Admin",
            'description' => "Edit Admin",
            'author'      => env('COMPANYNAME'),
        ];

        $admin = User::findOrFail($id);
        $businesses = Business::where('status', 'active')->orderBy('name', 'asc')->get();

        return view('SuperAdmin.manageadmins.manageadmin', compact('seo', 'admin', 'businesses'));
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $id,
            'password'     => 'nullable|string|min:6|confirmed',
            'mobile'       => 'required|string|max:15',
            'address1'     => 'required|string|max:255',
            'address2'     => 'nullable|string|max:255',
            'user_role'    => 'required|in:tele-caller,lead-creater,admin,super-admin',
            'business_id'  => 'required|exists:businesses,id',
        ]);

        $user->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'mobile'       => $request->mobile,
            'address1'     => $request->address1,
            'address2'     => $request->address2,
            'user_role'    => $request->user_role,
            'business_id'  => $request->business_id,
            'password'     => $request->password
                                ? Hash::make($request->password)
                                : $user->password
        ]);

        return redirect()
            ->route('admin.list')
            ->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->user_role === 'super-admin') {
            return redirect()
                ->route('admin.list')
                ->with('error', 'You cannot delete a Super Admin.');
        }

        $user->delete();

        return redirect()
            ->route('admin.list')
            ->with('success', 'Admin deleted successfully.');
    }

    public function adminList(Request $request)
    {
        $seo = [
            'title'       => "Admin List",
            'favicon'     => url(env('APP_FAVICON')),
            'logo'        => url(env('APP_LOGO')),
            'keyword'     => "Admin List",
            'description' => "Admin List",
            'author'      => env('COMPANYNAME'),
        ];

        $businesses = Business::where('status', 'active')->orderBy('name', 'asc')->get();

        $selectedBusinessId = $request->business_id;

        $admins = [];
        if ($selectedBusinessId) {
            $admins = User::where('business_id', $selectedBusinessId)
                ->whereIn('user_role', ['admin'])
                ->get();
        }

        return view('SuperAdmin.manageadmins.adminlist', compact('seo', 'businesses', 'admins', 'selectedBusinessId'));
    }


}

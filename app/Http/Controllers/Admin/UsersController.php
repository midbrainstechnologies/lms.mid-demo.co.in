<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;

class UsersController extends Controller
{
    public function index($type = null, $id = null)
    {
        // Super Admin Dashboard (can see everything)
        if (auth()->check() && auth()->user()->user_role === 'super-admin') {
            return view('SuperAdmin.Dashboard.index', [
                'seo' => [
                    'title'       => "Super Admin Dashboard",
                    'favicon'     => url(env('APP_FAVICON')),
                    'logo'        => url(env('APP_LOGO')),
                    'keyword'     => 'Super Admin',
                    'description' => 'Super Admin Dashboard',
                    'author'      => env('COMPANYNAME'),
                ]
            ]);
        }

        $seo = [
            'title'       => "User's",
            'favicon'     => url(env('APP_FAVICON')),
            'logo'        => url(env('APP_LOGO')),
            'keyword'     => 'User',
            'description' => 'User',
            'author'      => env('COMPANYNAME'),
        ];

        $data = null;

        // If viewing a specific user, restrict to same business
        if ($id != null) {
            $id  = Crypt::decrypt($id);

            $data = User::where('id', $id)
                ->where('business_id', Auth::user()->business_id)
                ->firstOrFail();
        }

        // Fetch all users except admins, only from same business
        $userlist = User::where('user_role', '!=', 'admin')
            ->where('business_id', Auth::user()->business_id)
            ->where('is_delete', '0');

        if (!empty($type)) {
            $userlist = $userlist->where('user_role', $type);
        }

        $userlist = $userlist->orderBy('id', 'desc')->get();

        return view('Admin.users.index', compact('seo', 'userlist', 'data'));
    }


    public function view($id = null)
    {
        $data = array();

        $seo = [
            'title'         =>  "User's",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'User',
            'description'   => 'User',
            'author'        => env('COMPANYNAME'),
        ];
        if ($id != null) {
            $id  = Crypt::decrypt($id);
            $data = User::select()->where('id', $id)->first();
        }


        return view('Admin.users.view', compact('seo', 'data'));
    }
    public function block($id)
    {
        try {
            $id  = Crypt::decrypt($id);
            $update = User::where('id', $id)->update(['block' => '1']);
            if ($update) {
                return redirect()->back()->with('success', "Profile Blocked");
            } else {
                return redirect()->back()->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }
    public function unblock($id)
    {
        try {
            $id  = Crypt::decrypt($id);
            $update = User::where('id', $id)->update(['block' => '0']);
            if ($update) {
                return redirect()->back()->with('success', "Profile Unblocked");
            } else {
                return redirect()->back()->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }

    public function active($id)
    {
        try {
            $id  = Crypt::decrypt($id);
            $update = User::where('id', $id)->update(['status' => '1']);
            if ($update) {
                return redirect()->back()->with('success', "Profile Active");
            } else {
                return redirect()->back()->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }
    public function deactive($id)
    {
        try {
            $id  = Crypt::decrypt($id);
            $update = User::where('id', $id)->update(['status' => '0']);
            if ($update) {
                return redirect()->back()->with('success', "Profile Deactive");
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
            $update = User::where('id', $id)->update(['is_delete' => '1']);
            if ($update) {
                return redirect()->back()->with('success', "Profile Deleted");
            } else {
                return redirect()->back()->with('error', "Server Error");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Server Error");
        }
    }


    public function add(Request $request)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'email'      => 'required|email|max:255',
        'mobile'     => 'required|string|max:15',
        'add1'       => 'required|string|max:255',
        'user_role'  => 'required|in:tele-caller,lead-creater,admin',
        'add2'       => 'nullable|string|max:255',
        'is_billing' => 'nullable|boolean',
        'is_online'  => 'nullable|boolean',
        'can_create_lead' => 'nullable|boolean',
    ]);

    try {
        // Prevent duplicate email
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', "Email already exists, kindly reset password.");
        }

        $business_id = Auth::user()->business_id;
        $business = Business::findOrFail($business_id);


        if ($request->user_role === 'tele-caller') {
            $count = User::where('business_id', $business_id)->where('user_role', 'tele-caller')->count();
            if ($count >= $business->telecaller_limit) {
                return redirect()->back()->with('error', "Telecaller limit reached for your subscription plan.");
            }
        }

        if ($request->user_role === 'lead-creater') {
            $count = User::where('business_id', $business_id)->where('user_role', 'lead-creater')->count();
            if ($count >= $business->lead_creator_limit) {
                return redirect()->back()->with('error', "Lead Creator limit reached for your subscription plan.");
            }
        }

        $data = [
            'name'        => $request->name,
            'email'       => $request->email,
            'mobile'      => $request->mobile,
            'address1'    => $request->add1,
            'address2'    => $request->add2,
            'user_role'   => $request->user_role,
            'is_billing'  => $request->is_billing ?? 0,
            'is_online'   => $request->is_online ?? 0,
            'can_create_lead' => $request->user_role === 'tele-caller' ? ($request->can_create_lead ?? 0) : 0,
            'business_id' => $business_id,
        ];

        User::create($data);

        return redirect()->back()->with('success', "User profile created successfully.");
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', "Server error: " . $th->getMessage());
    }
}


    public function update(Request $request, $id)
{
    $id = Crypt::decrypt($id);

    $request->validate([
        'name'       => 'required|string|max:255',
        'email'      => 'required|email|max:255',
        'mobile'     => 'required|string|max:15',
        'add1'       => 'required|string|max:255',
        'user_role'  => 'required|in:tele-caller,lead-creater,admin',
        'add2'       => 'nullable|string|max:255',
        'is_billing' => 'nullable|boolean',
        'is_online'  => 'nullable|boolean',
        'can_create_lead' => 'nullable|boolean',
    ]);

    try {
        if (User::where('email', $request->email)->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', "Email already exists, kindly reset password.");
        }

        $business_id = Auth::user()->business_id;
        $business = Business::findOrFail($business_id);

        $user = User::where('id', $id)->where('business_id', $business_id)->firstOrFail();

        // 🔒 If role is being changed, check limits
        if ($user->user_role !== $request->user_role) {
            if ($request->user_role === 'tele-caller') {
                $count = User::where('business_id', $business_id)->where('user_role', 'tele-caller')->count();
                if ($count >= $business->telecaller_limit) {
                    return redirect()->back()->with('error', "Telecaller limit reached for this business.");
                }
            }

            if ($request->user_role === 'lead-creater') {
                $count = User::where('business_id', $business_id)->where('user_role', 'lead-creater')->count();
                if ($count >= $business->lead_creator_limit) {
                    return redirect()->back()->with('error', "Lead Creator limit reached for this business.");
                }
            }
        }

        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'mobile'     => $request->mobile,
            'address1'   => $request->add1,
            'address2'   => $request->add2,
            'user_role'  => $request->user_role,
            'is_billing' => $request->is_billing ?? 0,
            'is_online'  => $request->is_online ?? 0,
            'can_create_lead' => $request->user_role === 'tele-caller' ? ($request->can_create_lead ?? 0) : 0,
        ];

        $user->update($data);

        return redirect()->back()->with('success', "User profile updated successfully.");
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', "Server error: " . $th->getMessage());
    }
}


}

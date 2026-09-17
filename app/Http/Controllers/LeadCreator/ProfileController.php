<?php

namespace App\Http\Controllers\LeadCreator;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profileview(){
        $seo = [
            'title'         =>  "Profile",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Profile',
            'description'   => 'Profile',
            'author'        => env('COMPANYNAME'),
        ];
        $user = User::select()->where('id',Auth::user()->id)->first();

        return view('LeadCreator.profile.profile',compact('seo','user'));
    }
    public function profilephotoupload(Request $request){
        $user = User::select()->where('id',Auth::user()->id)->first();
        $full_path_photo = $user->photo;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $path_photo = env('PHOTOPATH');
            $name = "User_Photo"."_".time()."_".rand(10000000000,99999999999)."_".time().'.'.$request->photo->getClientOriginalExtension();
            $img = $image->move($path_photo, $name);
            $full_path_photo = $path_photo."/".$name;
        }
        $update = User::where('id', Auth::user()->id)->update([
            'photo'  => $full_path_photo,
        ]);
        if ($update) {
            return redirect('/lead-creater/profile')->with('success', "Profile Photo Change Successfully");
        } else {
            return redirect('/lead-creater/profile')->with('error', "Server Error");
        }
    }
    public function profileupdate(Request $request){
        $update = User::where('id', Auth::user()->id)->update([
            'name'  => $request->name,
        ]);
        if ($update) {
            return redirect('/lead-creater/profile')->with('success', "Profile Updated Successfully");
        } else {
            return redirect('/lead-creater/profile')->with('error', "Server Error");
        }
    }

    public function changepassword(){
        $seo = [
            'title'         =>  "Change Password",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Change Password',
            'description'   => 'Change Password',
            'author'        => env('COMPANYNAME'),
        ];

        return view('LeadCreator.profile.changepassword',compact('seo'));
    }
    public function changepasswordsubmit(Request $request){
        $validate = $request->validate([
            'password'              => 'required|min:8|required_with:confirmpassword|same:confirmpassword',
            'confirmpassword'       => 'required|min:8|required_with:password|same:password',
        ]);

        $update = User::where('id', Auth::user()->id)->update([
            'password'  => Hash::make($request->password),
        ]);

        $datanotification = [
            'photo'             =>  '',
            'user_id'           =>  Auth::user()->id,
            'short_line'        =>  'You have changed your Password.',
            'link'              =>  '#',
            'created_at'        =>  Now()
        ];
        Notification::create($datanotification);

        if ($update) {
            return redirect('/lead-creater/changepassword')->with('success', "Password Change Successfully");
        } else {
            return redirect('/lead-creater/changepasswordd')->with('error', "Server Error");
        }
    }
}

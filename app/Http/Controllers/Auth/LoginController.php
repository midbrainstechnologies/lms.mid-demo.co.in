<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forgot;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function loginview()
    {

        $seo = [
            'title'         =>  "Login",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Login',
            'description'   => 'Login',
            'author'        => env('COMPANYNAME'),
        ];



        return view('Auth.login', compact('seo'));
    }

    public function login(Request $request)
{
    $request->validate([
        'email'    => 'required',
        'password' => 'required'
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();

        if ($user->business && $user->business->status !== 'active') {
            Auth::logout();
            return redirect('/login')->with('error', "Your business subscription is {$user->business->status}. Please contact support.");
        }

        if ($user->status != 1) {
            Auth::logout();
            return redirect('/login')->with('error', "User not active.");
        }

        if ($user->block == 0) {
            if ($user->verify == 1) {
                if ($user->is_delete == 0) {
                    // Role-based redirects
                    if ($user->user_role == "super-admin") {
                        return redirect('/super-admin/dashboard');
                    } elseif ($user->user_role == "tele-caller") {
                        return redirect('/tele-caller/dashboard');
                    } elseif ($user->user_role == "lead-creater") {
                        return redirect('/lead-creater/dashboard');
                    } elseif ($user->user_role == "admin") {
                        return redirect('/admin/dashboard');
                    } else {
                        Auth::logout();
                        return redirect('/login')->with('error', "User can't verify. Try to connect.");
                    }
                } else {
                    Auth::logout();
                    return redirect('/login')->with('error', "User already deleted.");
                }
            } else {
                Auth::logout();
                return redirect('/login')->with('error', "User isn't verified.");
            }
        } else {
            Auth::logout();
            return redirect('/login')->with('error', "User is blocked.");
        }
    } else {
        return redirect('/login')->with('error', "Incorrect Username Or Password.");
    }
}



    public function forgotview()
    {

        $seo = [
            'title'         =>  "Forgot",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Forgot',
            'description'   => 'Forgot',
            'author'        => env('COMPANYNAME'),
        ];



        return view('Auth.forgot', compact('seo'));
    }

    public function forgot(Request $request)
    {
        $validate = $request->validate([
            'email'         => 'required',
        ]);

        $getusercount = User::select()->where('email', $request->email)->count();
        $getuser = User::select()->where('email', $request->email)->first();
        if ($getusercount > 0) {
            if ($getuser->block == 0) {
                if ($getuser->verify == 1) {
                    if ($getuser->is_delete == 0) {

                        $tokan1 = rand(1000000000000, 9999999999999999);
                        $tokan2 = rand(1000000000000, 9999999999999999);

                        $insertforgot = Forgot::create([
                            'user_id'   => $getuser->id,
                            'status'    => '1',
                            'email'     =>  $getuser->email,
                            'key_one'   => $tokan1,
                            'key_two'   => $tokan2
                        ]);

                        $link = url('/reset-password/' . $tokan1 . "/" . $tokan2);

                        $datatomail = [
                            'url'   => $link
                        ];

                        Mail::to($request->email)->send(new \App\Mail\ForgotMail($datatomail));

                        if ($insertforgot) {
                            return redirect('/forgot-password')->with('success', "Mail Send Successfully");
                        } else {
                            return redirect('/forgot-password')->with('error', "Server Error");
                        }
                    } else {
                        return redirect('/forgot-password')->with('error', "User already deleted");
                    }
                } else {
                    return redirect('/forgot-password')->with('error', "User isn't verify");
                }
            } else {
                return redirect('/forgot-password')->with('error', "User is blocked");
            }
        } else {
            return redirect('/forgot-password')->with('error', "User not found");
        }
    }

    public function resetview()
    {

        $seo = [
            'title'         =>  "Reset",
            'favicon'       =>  url(env('APP_FAVICON')),
            'logo'          =>  url(env('APP_LOGO')),
            'keyword'       => 'Reset',
            'description'   => 'Reset',
            'author'        => env('COMPANYNAME'),
        ];



        return view('Auth.reset', compact('seo'));
    }

    public function reset(Request $request, $token1, $token2)
    {
        $validate = $request->validate([
            'email'                 => 'required',
            'password'              => 'required|min:8|required_with:confirmpassword|same:confirmpassword',
            'confirmpassword'       => 'required|min:8|required_with:password|same:password',
        ]);

        $getresetcount = Forgot::select()->where('email', $request->email)->where('key_one', $token1)->where('key_two', $token2)->where('status', '1')->count();

        if ($getresetcount == 0) {
            return redirect('/reset-password')->with('error', "Invalid Reset Link");
        }
        $getreset = Forgot::select()->where('email', $request->email)->where('key_one', $token1)->where('key_two', $token2)->where('status', '1')->first();

        $update = User::where('email', $getreset->email)->where('id', $getreset->user_id)->update([
            'password'  => Hash::make($request->password),
        ]);

        $datanotification = [
            'photo'             =>  '',
            'user_id'           =>  $getreset->user_id,
            'short_line'        =>  'You have reset your Password.',
            'link'              =>  '#',
            'created_at'        =>  Now()
        ];
        Notification::create($datanotification);
        Forgot::where('id', $getreset->id)->update(['status' => '0']);
        if ($update) {
            return redirect('/login')->with('success', "Password Reset Successfully");
        } else {
            return redirect('/forgot-password')->with('error', "Server Error");
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success', "Log-out Successfully");
    }
}

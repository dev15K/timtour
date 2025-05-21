<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function processLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('admin.home'));
        }
        $url_callback = $request->input('url_callback');
        return view('auth.login', compact('url_callback'));
    }

    public function login(Request $request)
    {
        try {
            $loginRequest = $request->input('login_request');
            $password = $request->input('password');
            $url_callback = $request->input('url_callback');

            $credentials = [
                'password' => $password,
            ];

            if (filter_var($loginRequest, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $loginRequest)->first();
                $credentials['email'] = $loginRequest;
            } else {
                $user = User::where('phone', $loginRequest)->first();
                if ($user) {
                    $credentials['phone'] = $loginRequest;
                } else {
                    $user = User::where('username', $loginRequest)->first();
                    $credentials['username'] = $loginRequest;
                }
            }

            if (!$user) {
                toast('User not found!', 'error', 'top-right');
                return redirect()->back();
            } else {
                if ($user->status == UserStatus::INACTIVE) {
                    toast('User is inactive!', 'error', 'top-right');
                    return redirect()->back();
                } else if ($user->status == UserStatus::BLOCKED) {
                    toast('User has been blocked!', 'error', 'top-right');
                    return redirect()->back();
                } else if ($user->status == UserStatus::DELETED) {
                    toast('User is deleted!', 'error', 'top-right');
                    return redirect()->back();
                }
            }

            if (Auth::attempt($credentials)) {
                if ($url_callback) {
                    return redirect()->to($url_callback);
                }

                return redirect()->route('home');
            }
            toast('Login fail! Please check email or password', 'error', 'top-right');
            return redirect()->back();
        } catch (\Exception $exception) {
            toast($exception->getMessage(), 'error', 'top-right');
            return redirect()->back();
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return redirect(route('auth.processLogin'));
        } catch (\Exception $exception) {
            return redirect(route('auth.processLogin'));
        }
    }
}

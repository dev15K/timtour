<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function processLogin()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $loginRequest = $request->input('email');
            $password = $request->input('password');

            $credentials = [
                'email' => $loginRequest,
                'password' => $password,
            ];

            $user = User::where('email', $loginRequest)->first();
            if (!$user) {
                toast('Account not found!', 'error', 'top-left');
                return back();
            }

            switch ($user->status) {
                case UserStatus::ACTIVE:
                    break;
                case UserStatus::INACTIVE:
                    toast('Account not active!', 'error', 'top-left');
                    return back();
                case UserStatus::BLOCKED:
                    toast('Account has been blocked!', 'error', 'top-left');
                    return back();
                case UserStatus::DELETED:
                    toast('Account has been deleted!', 'error', 'top-left');
                    return back();
            }

            if (Auth::attempt($credentials)) {
                toast('Welcome ' . $user->email, 'success', 'top-left');
                return redirect(route('home'));
            }
            toast('Email or password incorrect', 'error', 'top-left');
            return back();
        } catch (\Exception $exception) {
            toast('Error, Please try again!', 'error', 'top-left');
            return back();
        }
    }

    public function logout()
    {
        try {
            if (Auth::check()) {
                $user = Auth::user();
                $user->token = null;
                $user->save();
            }
            Auth::logout();
            return redirect(route('home'));
        } catch (\Exception $exception) {
            return redirect(route('home'));
        }
    }
}

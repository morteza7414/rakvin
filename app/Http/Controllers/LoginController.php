<?php

namespace App\Http\Controllers;

use App\Models\Architect;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'max:14'],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $remember = $request->remember ? true : false;
        $mobile = $request->mobile;
        $password = $request->password;

        if (Auth::attempt(['mobile' => $mobile, 'password' => $password], $remember)) {
            return redirect()->intended(route('home'));
        } else {
            throw ValidationException::withMessages([
                'password' => ['کاربری با این مشخضات یافت نشد']
            ]);
        }
    }


    public function logout()
    {
        \auth()->logout();
        return redirect(route('login'));
    }
}

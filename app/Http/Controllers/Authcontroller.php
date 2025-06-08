<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// یوز کردن request های هر فرم
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class Authcontroller extends Controller
{
    public function showloginform(){
        return view('auth.login');
    }
    public function showregisterform(){
        return view('auth.register');
    }
    public function register(RegisterRequest $request){
        $validatedData = $request->validated();
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('login')->with('ثبت نام موفق بود لطفا وارد شوید (:');
    }

    public function login(LoginRequest $request){

        $credentials = $request()->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'اطلاعات وارد شده صحیح نمی باشد',
        ])->onlyInput('email');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('showloginform');
    }
}

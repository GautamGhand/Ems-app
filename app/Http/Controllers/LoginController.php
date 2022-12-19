<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
                'email' => 'required|email',
                'password'=> 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if(Auth::user()->is_emailactive && Auth::user()->is_active) {
                return redirect('/');
            }
            Auth::logout();
            return back()->with('error', 'User Is Not Active');
        }

        return back()->with('error', 'Incorrect Details');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

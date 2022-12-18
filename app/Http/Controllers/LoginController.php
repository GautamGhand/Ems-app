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

        $user = User::where('email', $request->email)->first(); 

        if ($user) {
            if ($user->is_emailactive && $user->is_active) {
                if (Auth::attempt($credentials)) {
                    return redirect('/');
                }
                return back()->with('error', 'Incorrect Details');
            }
        }
        return back()->with('error', 'User Not Found');  
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

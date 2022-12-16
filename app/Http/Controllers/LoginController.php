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
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password'=> 'required'
            ]
        );

        $user = User::where('email', $request->email)->first(); 

        if ($user) {

            if (Attendance::where('user_id', $user->id)->first() == null) {
                Attendance::create([
                    'user_id' => $user->id,
                    'status' => 'absent',
                    'attendance_date' => now()->toDateString()
                ]);
            }

            if ($user->is_emailactive) {
                if (Auth::attempt($credentials))
                {
                    return redirect('/');

                }
                return back()->with('success', 'Incorrect Details');
            }
        }
        return back()->with('success', 'User Not Found');
        
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

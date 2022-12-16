<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeeAttendanceController extends Controller
{
    public function index()
    {
        return view('employee.index', [
            'leaves' => Leave::with('user')
                ->visibleTo()
                ->get()
        ]);
    }

    public function attendances()
    {
        return view('employee.attendances', [
            'attendances' => Attendance::visibleTo()->get()
        ]);
    }

    public function store(User $user)
    {

        if ($user->attendances()
            ->todayattendancedate()
            ->first()) {
            return back()->with('error', 'Your Attendance has been done for today');
        }
        elseif ($user->attendances()->AbsentDate()->first()) {
            $user->attendances()
                ->AbsentDate()
                ->first()
                ->update([
                'status' => Attendance::PRESENT,
            ]);

            return back()->with('success', 'Your Attendance has marked Successfully');
        }
        else
        {
            Attendance::create([
                'user_id' => Auth::id(),
                'status' => Attendance::PRESENT,
                'attendance_date' => now()->toDateString()
            ]);
            return back()->with('success', 'Your Attendance has marked Successfully');
        }

    }
}

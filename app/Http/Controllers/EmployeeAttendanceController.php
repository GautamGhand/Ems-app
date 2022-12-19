<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if(Attendance::latestattendancedate()->first()) {
            $last_attendance = Attendance::latestattendancedate()->first()->attendance_date;
            $previous = Carbon::parse($last_attendance);
            $latest = Carbon::parse(now()->toDateString());
            $days = $latest->diffInDays($previous);
        }
        else {
            $days = 0;
        }
    
        if ($user->attendances()
                ->todayattendancedate()
                ->first()) {

            return back()->with('error', 'Your Attendance has been done for today');
        } 
        elseif ($days > 1) {
            for ($i = 1; $i < $days; $i++) {
                $date = date_modify(now(), '-' . $i . 'day');
                    Attendance::create([
                        'user_id' => Auth::id(),
                        'status' => Attendance::ABSENT,
                        'attendance_date' => $date
                    ]);
            }
        }
        Attendance::create([
            'user_id' => Auth::id(),
            'status' => Attendance::PRESENT,
            'attendance_date' => now()->toDateString()
        ]);
        return back()->with('success', 'Your Attendance has marked Successfully');
    }
    public function attendance(User $user)
    {
        return view('users.attendances',[
            'attendances' => $user->attendances()->get()
        ]);
    }
}


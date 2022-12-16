<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Notifications\EmployeeLeaveNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class EmployeeLeaveController extends Controller
{
    public function create()
    {
        return view('employee.leave');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'subject' => 'required|min:5|max:255',
            'description' => 'required|min:10',
            'leave_dates' => 'required|after:today',
        ]);

        $attributes += [
            'user_id' => Auth::id()
        ];
     
        if (Leave::exists($request)->first()) {
            return back()->with('error', 'You Have Taken Leave for This Date');
        }
        Leave::create($attributes);

        return back()->with('success', 'Leave Applied Successfully');
    }
}

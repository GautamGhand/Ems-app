<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use App\Notifications\EmployeeLeaveApprovedNotification;
use App\Notifications\EmployeeLeaveRejectedNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class EmployeeLeaveStatusController extends Controller
{
    public function index()
    {
        return view('employee.leave-request', [
          'leaves' => Leave::Status()->with('user')->get()
        ]);
    }
    public function approved(Leave $leave)
    {
        $leave->update([
            'status' => Leave::APPROVED
        ]);

        Attendance::create([
            'user_id' => $leave->user_id,
            'attendance_date' => $leave->leave_dates,
            'status' => Attendance::LEAVE
        ]);

        $user = User::find($leave->user_id);

        Notification::Send($user, new EmployeeLeaveApprovedNotification());

        return back()->with('success', 'Leave Approved Successfully');

    }
    public function rejected(Leave $leave)
    {
        $leave->update([
            'status' => Leave::REJECTED
        ]);

        $user = User::find($leave->user_id);

        Notification::Send($user, new EmployeeLeaveRejectedNotification());

        return back()->with('success', 'Leave Rejected Successfully');
    }
}

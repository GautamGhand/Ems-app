<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attendance extends Model
{
    use HasFactory;

    const LEAVE = 'leave';
    const PRESENT = 'present';
    const ABSENT = 'absent';

    protected $fillable = [
        'user_id',
        'status',
        'attendance_date',
        'penality'
    ];

    public function scopeTodayAttendanceDate($query)
    {
        return $query->where('user_id', Auth::id())
            ->where('attendance_date', now()->toDateString())
            ->where('status','present');
    }

    public function scopeAbsentDate($query)
    {
        return $query->where('user_id', Auth::id())
            ->where('attendance_date', now()->toDateString());
    }

    public function scopeVisibleTo($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function scopeLatestPresentDate($query)
    {
        return $query->where('user_id', Auth::id())
            ->where('status', 'present')
            ->orderBy('attendance_date', 'desc');
    }
    public function scopeLatestLeaveDate($query)
    {
        return $query->where('user_id', Auth::id())
            ->where('status', 'leave')
            ->orderBy('attendance_date', 'desc');
    }
    
}

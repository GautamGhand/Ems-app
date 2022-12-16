<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'leave_dates',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeExists($query,$request)
    {
        $query->where('user_id', Auth::id())
            ->where('leave_dates', $request['leave_dates']);
    }

    public function scopeVisibleTo($query)
    {
        return $query->where('user_id', Auth::id());
    }
    public function scopeStatus($query)
    {
        return $query->where('status', 'pending');
    }
}

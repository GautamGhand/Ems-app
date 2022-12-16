<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ADMIN = 1;
    const EMPLOYEE = 2;

    protected $fillable = [
        'name'
    ];

    public function scopeEmployee($query)
    {
        return $query->where('name', 'employee')->pluck('id');
    }
}

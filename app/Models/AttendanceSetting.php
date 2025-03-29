<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'late_limit',
        'holidays',
        'holiday_days',
        'check_in_deadline',
        'check_out_deadline',
    ];

    public $timestamps = false;

    protected $casts = [
        'holidays' => 'array', // JSON akan otomatis dikonversi ke array
        'holiday_days' => 'array', // JSON akan otomatis dikonversi ke array
    ];
}

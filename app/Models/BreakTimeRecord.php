<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTimeRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'break_type',
        'time_period',
        'time_started',
        'time_ended',
        'duration',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

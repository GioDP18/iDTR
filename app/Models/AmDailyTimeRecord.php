<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmDailyTimeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'arrival_am',
        'departure_am',
        'late_am',
        'hours_worked_am',
        'date'
    ];
}

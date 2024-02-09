<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmDailyTimeRecord extends Model
{
    use HasFactory;
  

    protected $fillable = [
        'users_id',
        'arrival_pm',
        'departure_pm',
        'late_pm',
        'hours_worked_pm',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

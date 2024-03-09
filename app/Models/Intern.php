<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'firstname' ,
        'middlename',
        'lastname',
        'gender',
        'birthdate',
        'email',
        'status',
        'breatetime_status',
        'avatar',
        'target_hours',
        'completed_hours',
        'remaining_hours',
        'total_hours_worked_am',
        'total_hours_worked_pm',
    ];

    public function logs(){
        return $this->hasMany(AuditLog::class);
    }
}

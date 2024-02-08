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
    ];
}

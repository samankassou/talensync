<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'date_of_birth',
        'gender',
        'phone',
        'email',
        'date_of_joining',
        'position'
    ];
}

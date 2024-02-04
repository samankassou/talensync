<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'job_position_id'
    ];

    public function JobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }
}

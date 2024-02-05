<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'end_date',
        'employee_id',
        'is_current'
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];


    public function owner(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}

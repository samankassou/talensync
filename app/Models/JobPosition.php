<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}

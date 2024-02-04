<?php

namespace App\Models;

use App\Enums\JobPostStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_published',
        'banner',
        'city_id',
        'expiry_date',
        'status'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'status' => JobPostStatus::class,
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}

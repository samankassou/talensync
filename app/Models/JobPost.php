<?php

namespace App\Models;

use App\Enums\JobPostStatus;
use App\Enums\JobPostContractType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'status',
        'available_positions',
        'publish_date',
        'contract_type'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'status' => JobPostStatus::class,
        'contract_type' => JobPostContractType::class
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true)
            ->where('status', JobPostStatus::Published);
    }
}

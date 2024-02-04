<?php

namespace App\Models;

use App\Enums\CandidateStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'date_of_birth',
        'gender',
        'phone',
        'email',
        'job_post_id',
        'resume',
        'status',
        'city_id',
    ];

    protected $casts = [
        'status' => CandidateStatus::class,
    ];

    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(JobPost::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_postings';
    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];

     public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function designation()
    {
        return $this->belongsTo(\App\Models\Designation::class);
    }

    public function districts()
    {
        return $this->belongsToMany(\App\Models\District::class, 'district_job', 'job_id', 'district_id')
            ->withTimestamps();
    }

    public function createdBy(): MorphTo
    {
        return $this->morphTo();
    }


}

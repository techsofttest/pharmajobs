<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphTo;

use Illuminate\Support\Str;

class Job extends Model
{
    protected $table = 'job_postings';
    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

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

    public function applications()
    {
        return $this->hasMany(JobApplication::class,'job_posting_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {

            $slug = Str::slug($job->title);

            $originalSlug = $slug;
            $count = 1;

            while (self::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $job->slug = $slug;
        });

    }


}

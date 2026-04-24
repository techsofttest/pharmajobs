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

    public function scopeRecommended($query, $employee)
    {
        if (!$employee || !$employee->employee) {
            return $query->whereRaw('1 = 0'); // No results
        }

        $designationId = $employee->employee->designation_id;
        $locationIds = $employee->employee->locations->pluck('id')->toArray();

        return $query->where('designation_id', $designationId)
            ->whereHas('locations', function ($q) use ($locationIds) {
                $q->whereIn('locations.id', $locationIds);
            });
    }

     public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function designation()
    {
        return $this->belongsTo(\App\Models\Designation::class);
    }

    public function locations()
    {
        return $this->belongsToMany(\App\Models\Location::class, 'job_posting_locations', 'job_id', 'location_id')
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

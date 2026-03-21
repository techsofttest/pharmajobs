<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Location extends Model
{
    protected $fillable = ['state_id', 'name', 'slug'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }


    protected static function booted(): void
    {
        static::creating(function ($location) {
            if (empty($location->slug)) {
                $location->slug = self::generateUniqueSlug(
                    $location->name,
                    $location->state_id
                );
            }
        });

        static::updating(function ($location) {
            if ($location->isDirty('name')) {
                $location->slug = self::generateUniqueSlug(
                    $location->name,
                    $location->state_id,
                    $location->id
                );
            }
        });
    }

    protected static function generateUniqueSlug($name, $stateId, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (
            self::where('state_id', $stateId)
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }


    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_posting_locations');
    }

}

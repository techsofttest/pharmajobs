<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['state_id', 'name', 'slug'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($district) {
            if (empty($district->slug)) {
                $district->slug = self::generateUniqueSlug(
                    $district->name,
                    $district->state_id
                );
            }
        });

        static::updating(function ($district) {
            if ($district->isDirty('name')) {
                $district->slug = self::generateUniqueSlug(
                    $district->name,
                    $district->state_id,
                    $district->id
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

}

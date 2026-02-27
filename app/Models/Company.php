<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $guarded =[];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public static function booted()
    {

    static::creating(function($model){
        if (empty($model->slug)) {
        $model->slug = static::generateUniqueSlug($model->name);
        }
    }); 

    }

    protected static function generateUniqueSlug(string $value): string
    {
        $slug = Str::slug($value);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;

    }

}

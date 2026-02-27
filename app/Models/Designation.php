<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $guarded =[];


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

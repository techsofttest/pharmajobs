<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Profile extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guarded = [];

    // ... any other existing methods


    public function employee()
    {
        return $this->hasOne(ProfileEmployee::class);
    }


    public function employer()
    {
        return $this->hasOne(ProfileEmployer::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}

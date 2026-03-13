<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileEmployer extends Model
{
    
    protected $guarded = [];


    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}

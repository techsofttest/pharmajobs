<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{

    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo(Job::class,'job_posting_id');
    }

    public function employee()
    {
        return $this->belongsTo(Profile::class,'profile_id');
    }

}

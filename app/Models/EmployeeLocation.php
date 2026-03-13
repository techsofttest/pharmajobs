<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLocation extends Model
{
    protected $guarded = [];

    public function profileEmployee()
    {
        return $this->belongsTo(ProfileEmployee::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}

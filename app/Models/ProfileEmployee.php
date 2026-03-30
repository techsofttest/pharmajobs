<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileEmployee extends Model
{
   protected $guarded = [];

   public function profile()
   {
      return $this->belongsTo(Profile::class);
   }

   public function category()
   {
      return $this->belongsTo(Category::class, 'category_id');
   }

   public function designation()
   {
      return $this->belongsTo(Designation::class, 'designation_id');
   }

   public function locations()
   {
      
    return $this->belongsToMany(
        Location::class,
        'employee_locations',
        'profile_employee_id',
        'district_id'
    );

   }


   public function hasResume()
   {
      return !empty($this->cv);
   }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VandorDetailsModel extends Model
{
    use HasFactory;
    protected $table = 'vandor_deatils';
    protected $guarded = [];

    public function country_name()
    {
        return $this->hasOne('App\Models\Country','id','office_country');
    }
    public function personal_country_name()
    {
         return $this->hasOne('App\Models\Country','id','country');
    }
}

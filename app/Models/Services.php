<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

     public function serviceCategoryDetails(){
        return $this->hasOne('App\Models\Service_Crud', 'service_id', 'id');
    }

}

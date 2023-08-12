<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor_services extends Model
{
    use HasFactory;

    protected $table = 'vendor_services';
    protected $guarded = [];

    public function serviceDetails(){
        return $this->hasOne('App\Models\Services', 'id', 'service_id');
    }

     public function categoryDetails(){
         return $this->hasOne('App\Models\Category_Crud', 'id', 'category');
    }
}

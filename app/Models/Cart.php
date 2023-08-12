<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'package_id',
        'category_id',
        'price',
        'quantity',
        'total_price',
        'time',
        'order_date',
        'order_end_date',
        'user_id',
        'system_id',
        'days'
    ];


    public function serviceDetails(){
        return $this->hasOne('App\Models\Services', 'id', 'service_id');
    }

    public function packageDetails(){
        return $this->hasOne('App\Models\Package', 'id', 'package_id');
    }

     public function categoryDetails(){
        return $this->hasOne('App\Models\Category_Crud', 'id', 'category_id');
    }
}

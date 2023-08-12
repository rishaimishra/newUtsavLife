<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function scopeUpcoming($query){
        return $query->where('order_status',1);
    }
    public function scopeCanceled($query){
        return $query->where('order_status',2);
    }
    public function scopeCompleted($query){
        return $query->where('order_status',3);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

     public function CustomerDetails(){
        return $this->hasOne('App\Models\User', 'id', 'customer_user_id');
    }

    public function serviceDetails(){
        return $this->hasOne('App\Models\Services', 'id', 'services');
    }

    public function packageDetails(){
        return $this->hasOne('App\Models\Package', 'id', 'package_id');
    }


     public function categoryDetails(){
        return $this->hasOne('App\Models\Category_Crud', 'id', 'category_id');
    }

     public function VandorDetails(){
        return $this->hasOne('App\Models\User', 'id', 'vendor_user_id');
    }

    public function reason()
    {
        return $this->hasOne('App\Models\VandorRejectOrder', 'order_id', 'id');
    }
}

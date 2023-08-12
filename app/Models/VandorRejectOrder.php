<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VandorRejectOrder extends Model
{
    use HasFactory;

    protected $table = 'vandor_rejected_orders';
    protected $guarded = [];

     public function venodrDetails(){
        return $this->hasOne('App\Models\User', 'id', 'vandor_id');
    }
}

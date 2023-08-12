<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead_management extends Model
{
    use HasFactory;

    public function serviceDetails(){
        return $this->hasOne('App\Models\Services', 'id', 'services');
    }

    public function categoryDetails(){
        return $this->hasOne('App\Models\Category_Crud', 'id', 'category_id');
    }

     public function agentDetails(){
        return $this->hasOne('App\Models\User', 'id', 'agent_id');
    }
}

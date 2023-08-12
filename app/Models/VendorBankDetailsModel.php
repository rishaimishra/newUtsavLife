<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBankDetailsModel extends Model
{
    use HasFactory;

    protected $table = 'vandor_bank_details';
    protected $guarded = [];

    // public function serviceDetails(){
    //     return $this->hasOne('App\Models\Services', 'id', 'service_id');
    // }
}

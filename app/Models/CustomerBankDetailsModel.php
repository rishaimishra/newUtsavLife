<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBankDetailsModel extends Model
{
    use HasFactory;

    // customer_bank_details
     protected $table = 'customer_bank_details';
    protected $guarded = [];
}

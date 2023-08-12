<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToAddress extends Model
{
    use HasFactory;
     protected $table = 'user_to_address';
    protected $guarded = [];
}

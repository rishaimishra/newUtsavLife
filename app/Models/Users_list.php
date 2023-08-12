<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;


 class Users_list extends Model
{
    use  Notifiable;
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeCustomer($query){
        return $query->where('user_type',3);
    }
    public function scopeVendor($query){
        return $query->where('user_type',4);
    }
    public function scopeAgent($query){
        return $query->where('user_type',5);
    }
}

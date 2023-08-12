<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// class User extends \TCG\Voyager\Models\User implements JWTSubject


class User extends \TCG\Voyager\Models\User

{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function scopeCustomer($query){
        return $query->where('role_id',2);
    }
    public function scopeVendor($query){
        return $query->where('role_id',3);
    }
    public function scopeAgent($query){
        return $query->where('role_id',4);
    }

     public function VandorDetails(){ 
        return $this->hasOne('App\Models\VandorDetailsModel', 'vandor_id', 'id');
    }

     public function VandorServiceDetails(){ 
        return $this->hasOne('App\Models\Vendor_services', 'vendor_user_id', 'id');
    }

    public function country_name()
    {
        return $this->hasOne('App\Models\Country','id','country');
    }
   
    
}
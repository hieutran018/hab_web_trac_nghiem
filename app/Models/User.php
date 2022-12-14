<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ranking;
use App\Models\SocialAccount;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    public $timestamps = false;
    

    protected $fillable = [
        'display_name',
        'avatar',
        'phone_number',
        'email',
        'password',
        'address',
        'dateOfBirth',
        'email_verified_at',
        'token',
        'isAdmin',
        'life_heart',
        'isSubAdmin',
        'status'
    ];
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $hidden = array('password');
    // protected $hidden = array('phone_number',
    //     'email',
    //     'password',
    //     'address',
    //     'dateOfBirth',
    //     'email_verified_at',
    //     'token',
    //     'isAdmin',
    //     'life_heart',
    //     'isSubAdmin',
    //     'status','password','created_at', 'updated_at','deleted_at');
   

    public function ranking()
    {
        return $this->hasOne(Ranking::class, 'user_id','id');
    }
    public function social()
    {
        return $this->hasOne(SocialAccount::class, 'user_id','id');
    }
}
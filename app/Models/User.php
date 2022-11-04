<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ranking;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'last_name',
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

    public function ranking()
    {
        return $this->hasOne(Ranking::class, 'user_id');
    }
}
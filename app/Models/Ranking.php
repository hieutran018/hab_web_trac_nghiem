<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Ranking extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = ['user_id','score_single','score_challenge'];
    protected $primaryKey = 'id';
    protected $table = 'ranking';
    protected $hidden = array('avatar','first_name',
        'last_name','phone_number',
        'email',
        'password',
        'address',
        'dateOfBirth',
        'email_verified_at',
        'token',
        'isAdmin',
        'life_heart',
        'isSubAdmin',
        'status','password','created_at', 'updated_at','deleted_at');
   

    public function user()
    {
        return  $this->belongsTo(User::class,'user_id','id')->select('fist_name','last_name','avatar');
    }
}
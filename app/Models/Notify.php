<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id_request','content_id','user_id_confirm','status','match_id'];
    protected $primaryKey = 'id';
    protected $table = 'notifications';
}
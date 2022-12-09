<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'proivder',
        'provider_id',
        'user_id',
    ];
    protected $primaryKey = 'id';
    protected $table = 'social_accounts';
}
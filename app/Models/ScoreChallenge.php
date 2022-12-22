<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreChallenge extends Model
{
    use HasFactory;

    protected $fillable = ['match_id',
                            'user_id_from',
                            'user_id_to',
                            'point_user_id_from',
                            'point_user_id_to',
                            'user_id_win'];
                            
    protected $primaryKey = 'id';
    protected $table = 'match_detail_challenges';
    protected $hidden = array(
        'created_at', 'updated_at','deleted_at');
}
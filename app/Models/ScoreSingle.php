<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreSingle extends Model
{
    use HasFactory;

    protected $fillable = ['match_id','score'];
    protected $primaryKey = 'id';
    protected $table = 'match_detail_single';
    protected $hidden = array(
        'created_at', 'updated_at','deleted_at');
}
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

    public function user()
    {
        return  $this->belongsTo(User::class)->select('first_name', 'last_name','avatar');
    }
}
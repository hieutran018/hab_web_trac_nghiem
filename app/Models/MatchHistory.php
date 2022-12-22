<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TopicQuestion;

class MatchHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id','topic_question_id','level_id','game_mode'];
    protected $primaryKey = 'id';
    protected $table = 'matches';
    protected $hidden = array(
        'updated_at','deleted_at');

    public function levels(){
        return  $this->hasMany(Level::class);
    }
   
    

    
}
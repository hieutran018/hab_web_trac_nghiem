<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TopicQuestion;
use App\Models\Level;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = ['question_content','topic_id','level_id'];
    protected $primaryKey = 'id';
    protected $table = 'questions';

    protected $hidden = array(
        'created_at', 'updated_at','deleted_at');

    public function answer()
    {
        return $this->hasMany(Answer::class,'question_id','id')->select('id','answer_content','isTrue','question_id');
    }
    public function topic_question(){
        return  $this->belongsTo(TopicQuestion::class,'topic_id','id')->select('topic_question_name');
    }
    public function level(){
        return  $this->belongsTo(Level::class,'level_id','id')->select('level_name');
    }
    
}
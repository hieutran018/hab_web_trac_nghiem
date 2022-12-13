<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = ['answer_content','question_id','isTrue'];
    protected $primaryKey = 'id';
    protected $table = 'answer_questions';

    public function topic_question(){
        return  $this->belongsTo(Question::class,'question_id','id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
    
class TopicQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = ['topic_question_name','description','image'];
    protected $primaryKey = 'id';
    protected $table = 'topic_questions';

    public function matchhistory()
    {
        return $this->belongsTo(MatchHistory::class);
    }
}
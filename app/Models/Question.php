<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = ['question_content','topic_id','level_id','status'];
    protected $primaryKey = 'id';
    protected $table = 'questions';

    public function answer()
    {
        return $this->hasMany('App\Post');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAnswer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['match_id','question_id','answer_id'];
    protected $primaryKey = 'id';
    protected $table = 'history_answers';
    
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\NewsCategories;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;


    public $timestamps = false;

    protected $fillable = ['title','content','image','user_id','news_category_id','status'];
    protected $primaryKey = 'id';
    protected $table = 'news';

    public function user()
    {
    return $this->belongsTo(User::class)->select('display_name');
    }

    public function newscategory()
    {
        return  $this->belongsTo(NewsCategories::class,'news_category_id','id')->select('news_category_name');
    }
}
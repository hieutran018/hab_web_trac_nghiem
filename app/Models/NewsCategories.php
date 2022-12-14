<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategories extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = ['news_category_name','description'];
    protected $primaryKey = 'id';
    protected $table = 'news_categories';

    // protected $hidden = array('created_at', 'updated_at ','deleted_at','status');
}
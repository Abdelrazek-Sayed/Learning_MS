<?php

namespace App\Http\Controllers\Api\Modules\Topics;

use App\Http\Controllers\Api\Modules\Categories\Category;
use App\Http\Controllers\Api\Modules\Questions\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'category_id', 'status'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'question_id','id');
    }
}

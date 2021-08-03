<?php

namespace App\Http\Controllers\Api\Modules\Questions;

use App\Http\Controllers\Api\Modules\Answers\Answer;
use App\Http\Controllers\Api\Modules\Topics\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['question', 'difficulty', 'topic_id'];

    const easy = 1;
    const medium = 2;
    const high = 3;
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    // public function certificateAnswer()
    // {
    //     return $this->hasMany(Answer::class, 'question_id','id');
    // }
}

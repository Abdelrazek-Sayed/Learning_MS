<?php

namespace App\Http\Controllers\Api\Modules\UserAnswers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAnswer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'parent_id'];
}


<?php

namespace App\Http\Controllers\Api\Modules\Categories;

use App\Http\Controllers\Api\Modules\Topics\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'parent_id'];


    public function category()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'category_id');
    }
}

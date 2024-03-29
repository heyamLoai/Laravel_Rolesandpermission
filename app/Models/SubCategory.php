<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function subCategories(){
        return $this->hasMany(Task::class, 'sub_category_id','id');
    }
}

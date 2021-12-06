<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'slug', 'description', 'parent_id', 'is_active'];

    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'category_id', 'place_id', 'published'];

    public function category()
    {
        return $this->hasOne(Categorie::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['name', 'coordinates', 'visited'];

    public function category()
    {
        return $this->hasOne(Categorie::class);
    }
}

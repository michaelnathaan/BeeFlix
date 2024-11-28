<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    protected $guarded = [];

    public function movie(){
        return $this->hasMany(Movies::class);
    }
}

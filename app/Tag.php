<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable= ['name'];

    public function posts(){
        
        return $this->belongstoMany(Post::class);
    }
}

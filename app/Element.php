<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = ['name', 'image', 'image_pattern', 'description'];
    public function categories(){
        return $this->belongsToMany('App\Category', 'element_categories');
    }
    public function signs(){
        return $this->hasMany('App\Sign');
    }
}

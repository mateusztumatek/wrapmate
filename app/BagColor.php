<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BagColor extends Model
{

    protected $fillable = ['image', 'hex_color'];
    public function pages(){
        return $this->belongsToMany('App\Page', 'colors_pages');
    }
}

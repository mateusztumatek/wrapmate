<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BagConfig extends Model
{
    protected $fillable = ['type', 'size', 'weight', 'package', 'price', 'url'];
    public function pages(){
        return $this->belongsToMany('App\Page', 'config_pages', 'bag_config_id', 'page_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
class Po extends Model
{
    use Translatable;

    protected $fillable = ['type', 'title', 'content', 'image', 'url'];
    protected $table = 'pos';
    protected $translatable = ['title', 'content'];
    public function pages(){
        return $this->belongsToMany('App\Page', 'pos_pages');
    }

}

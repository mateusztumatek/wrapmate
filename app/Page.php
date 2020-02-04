<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Page extends Model
{
    use Translatable;
    protected $fillable = ['parent_id', 'title', 'page_description', 'content', 'image', 'active', 'slug', 'banner_title', 'banner_description', 'banner_redirect', 'display_gallery', 'data'];
    protected $translatable = ['page_description', 'title', 'content'];

    public function parent(){
        return $this->belongsTo('App\Page', 'parent_id');
    }
    public function getLink(){
        if($this->parent_id){
            $page = Page::find($this->parent_id);
            if($page){
                return route('page', ['slug' => $page->slug.'/'.$this->slug]);
            }else{
                return route('page', ['slug' => $this->slug]);
            }
        }else{
            return route('page', ['slug' => $this->slug]);
        }
    }
}

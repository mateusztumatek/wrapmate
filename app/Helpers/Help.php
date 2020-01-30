<?php

namespace App\Helpers;


class Help
{
    public static function getPageTitle($vars){
        if(array_key_exists('page', $vars) && $vars['page']->title) return $vars['page']->title;
        if(setting('site.title')) return setting('site.title');
        return config('app.name', 'Laravel');
    }

    public static function getPageDescription($vars){
        if(array_key_exists('page', $vars)){
            if($vars['page']->page_description){
                return $vars['page']->page_description;
            }
            if($vars['page']->content){
                return substr(strip_tags($vars['page']->content), 0, 100);
            }
        }
        if(setting('site.description')) return setting('site.description');
        return config('app.name', 'Laravel');
    }
}

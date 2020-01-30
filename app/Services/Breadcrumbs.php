<?php
namespace App\Services;
use App\Page;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class Breadcrumbs{

    public static function getBreadcrumbs(){
        $breadcrumbs = collect();
        $breadcrumbs->push([
            'link' => url('/'),
            'name' => 'Strona główna'
        ]);
        if(Route::currentRouteName() == 'page'){
            $slug = Request::route()->parameters();
            if(array_key_exists('slug', $slug)){
                $slug = $slug['slug'];
                $slugs = explode('/', $slug);
                foreach ($slugs as $slug){
                    $page = Page::where('slug', $slug)->first();
                    if($page){
                        $breadcrumbs->push([
                            'link' => $page->getLink(),
                            'name' => $page->title
                        ]);
                    }
                }
            }
        }
        return $breadcrumbs;
    }
}

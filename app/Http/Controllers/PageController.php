<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function show(Request $request, $slug){
        $slugs = explode('/', $slug);
        if(array_key_exists(0, $slugs)){
            $s = $slugs[0];
        }
        if(array_key_exists(1, $slugs)){
            $s = $slugs[1];
        }
        $page = Page::where('slug', $s)->first();
        if(($locale = App::getLocale()) != 'pl'){
            $page = $page->translate($locale, 'pl');
        }
        if(!$page) return back()->withErrors('Strona nie zostala znaleziona');
        /*    BANNER CONTENT    */
        $banner = (object) array();
        $banner->title = $page->banner_title;
        $banner->content = $page->banner_description;
        $banner->url = $page->banner_redirect;
        $banner->image = $page->image;

        /*    END BANNER CONTENT    */
        return view('page.single', compact('page', 'banner'));
    }
}

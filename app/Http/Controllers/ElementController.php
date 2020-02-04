<?php

namespace App\Http\Controllers;

use App\Category;
use App\Element;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function index(Request $request){
        $elements = Element::where('name', '!=', null);
        if($request->categories){
            $elements = $elements->whereHas('categories', function($q)use($request){
                foreach($request->categories as $key => $c){
                    if($key == 0) $q->where('category_id', $c);
                    if($key > 0) $q->orWhere('category_id', $c);
                }
            });
        }else{
            $categories = Category::get();
            $categories = $categories->groupBy('type');
        }
        $elements = $elements->with('signs')->paginate();
        if(!isset($categories)) $categories = null;
        return response()->json(['elements' => $elements, 'categories' => $categories]);
    }
}

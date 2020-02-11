<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class KreatorController extends Controller
{
    public function index(Request $request){
        $page = Page::where('slug', 'kreator')->first();

        return view('creator.index', compact('page'));
    }
}

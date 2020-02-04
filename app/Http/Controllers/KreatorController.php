<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KreatorController extends Controller
{
    public function index(Request $request){
        return view('creator.index');
    }
}

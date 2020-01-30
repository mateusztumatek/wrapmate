<?php

namespace App\Http\Controllers;

use App\BagConfig;
use App\Page;
use Illuminate\Http\Request;

class BagConfigController extends Controller
{
    public function index(Request $request){
        $configs = BagConfig::where(function ($q) use ($request){
            if($request->page_id){
                $q->whereHas('pages', function ($qp)use($request){
                   $qp->where('page_id', $request->page_id);
                });
            }
            if($request->size){
                $q->where('size', $request->size);
            }
            if($request->weight){
                $q->where('weight', $request->weight);
            }
            if($request->package){
                $q->where('package', $request->package);
            }
        })->get();
        return response()->json($configs);
    }
}

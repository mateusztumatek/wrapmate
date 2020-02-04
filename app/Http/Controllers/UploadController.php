<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function upload(Request $request, $path){

        $arr = collect();
        if($request->allFiles()){
            $date = Carbon::now();
            foreach ($request->allFiles() as $file){
                $image = $file;
                if($image->getClientOriginalExtension() == "" || $image->getClientOriginalExtension() == null) $filename = md5(Str::random(60)).'.jpg';
                else $filename = md5(Str::random(60)).'.'.$image->getClientOriginalExtension();
                /* Making directory for small Image */

                $path = $path.'/'.$date->format('F').$date->format('Y').'/';
                if(!\Illuminate\Support\Facades\File::exists(storage_path('app/public/'.$path))){
                    \Illuminate\Support\Facades\File::makeDirectory(storage_path('app/public/'.$path), 493, true);
                }

                $image->move(storage_path('app/public/'.$path), $filename);
                $arr->push($path.'/'.$filename);
            }

        }else{
            return response()->json(['message' => 'Field' .$path.' not found'],  404);
        }
        return response()->json(json_decode($arr));
    }
}

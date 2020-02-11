<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getBrands(){
        $cache_name = 'brands_api';
        $brands = Cache::get($cache_name);
        if(!$brands){
            $endpoint = 'http://www.ccvision.de/ResellerStore/WebSearch/car-special';
            $xml = simplexml_load_file($endpoint);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            $data  = $array['brands']['brand'];
            $brands = collect();
            foreach ($data as $brand){
                $brands->push((object) $brand['@attributes']);
            }
            Cache::put($cache_name, $brands, Carbon::now()->addDay(1));
        }
        return response()->json($brands);
    }
    public function getModels(Request $request){
        $validation = Validator::make($request->all(), [
            'brand_id' => 'required'
        ]);
        if($validation->fails()) return response()->json(['errors' => $validation->errors()], 400);
        $cache_name = 'models.'.$request->brand_id;
        $models = Cache::get($cache_name);
        if(!$models || $request->cache == 0){
            try{
                $endpoint = 'http://www.ccvision.de/ResellerStore/WebSearch/car-special?brand='.$request->brand_id;
                $xml = simplexml_load_file($endpoint);
            }catch(\Exception $e){
                return response()->json(['errors' => ['Api error, cannot open '.$endpoint.' url']], 400);
            }
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            $data = $array['models']['model'];
            if(array_key_exists(0, $data)){
                $models = collect();
                foreach ($data as $brand){
                    if(array_key_exists('@attributes', $brand)){
                        $models->push((object) $brand['@attributes']);
                    }
                }
                Cache::put($cache_name, $models, Carbon::now()->addDay(1));
            }elseif(array_key_exists('@attributes', $data)){
                $models = collect();
                $models->push((object) $data['@attributes']);
            }
        }
        return response()->json($models);
    }
    public function modelItems(Request $request, $id){
        $endpoint = 'http://www.ccvision.de/ResellerStore/WebSearch/car-special?model='.$id;
        try{
            $xml = simplexml_load_file($endpoint);
        }catch(\Exception $e){return response()->json(['errors' => ['Api error, cannot open '.$endpoint.' url']], 400);}
        $cache_name = 'model_items.'.$id;
        $items = Cache::get($cache_name);
        if(!$items || $request->cache == 0){
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            $data = $array['items']['item'];
            if(array_key_exists(0, $data)){
                $items = collect();
                foreach ($data as $brand){
                    if(array_key_exists('@attributes', $brand)){
                        $items->push((object) $brand['@attributes']);
                    }
                }
                Cache::put($cache_name, $items, Carbon::now()->addDay(1));
            }elseif(array_key_exists('@attributes', $data)){
                $items = collect();
                $items->push((object) $data['@attributes']);
            }
            Cache::put($cache_name, $items, Carbon::now()->addDay());
        }
        return response()->json($items);
    }
}

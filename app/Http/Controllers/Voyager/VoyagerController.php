<?php

namespace App\Http\Controllers\Voyager;

use App\BagConfig;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;

class VoyagerController extends BaseVoyagerController
{
    public function copy(\Illuminate\Http\Request $request){
        $request->validate([
            'type' => 'required',
            'id' => 'required'
        ]);
        if($request->type == 'bag_configs'){
            $elem = BagConfig::find($request->id);
            $copy = BagConfig::create($elem->toArray());
            return redirect()->to(url('/admin/bag-configs/'.$copy->id.'/edit'));
        }
    }
}

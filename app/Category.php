<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $fillable = ['type', 'name', 'image'];
    public function getTypeAttribute($data){
        $to_return = null;

        if(request()->route() && request()->route()->getPrefix() != '/admin'){
            switch ($data){
                case 'type':
                    $to_return = 'Typ';
                    break;
                case 'year':
                    $to_return = 'Rocznik';
                    break;
            }
        }
        if(!$to_return) return $data;
        return $to_return;
    }
    use SoftDeletes;
}

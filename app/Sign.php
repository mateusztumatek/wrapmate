<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    protected $fillable = ['element_id', 'sign', 'price', 'dimmensions'];
}

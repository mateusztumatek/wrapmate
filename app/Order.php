<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['email', 'name', 'city', 'street', 'postal', 'info', 'project', 'amount', 'paid', 'payment_link', 'status', 'uuid'];
    public function getProjectAttribute($data){
        return ($data)? unserialize($data) : null;
    }
}

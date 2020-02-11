<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['email', 'name', 'city', 'street', 'postal', 'info', 'project', 'amount', 'paid', 'payment_link', 'status', 'uuid', 'payment_method', 'group_id'];
    public function getProjectAttribute($data){
        return ($data)? unserialize($data) : null;
    }
    public function getStatusSlug(){
        switch ($this->status){
            case 'new':
                return 'Nowe';
                break;
            case 'in-progress':
                return 'W trakcie realizacji';
                break;
            case 'done':
                return 'Zrealizowane';
                break;
            case 'canceled':
                return 'Anulowane';
                break;
        }
    }
}

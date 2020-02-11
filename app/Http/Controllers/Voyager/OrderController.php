<?php

namespace App\Http\Controllers\Voyager;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends VoyagerBaseController
{
    public function show(Request $request, $id){
        $order = Order::where('id', $id)->first();
        if(!$order) return back()->withErrors(['Nie ma takiego zamówienia']);
        return redirect(url('/orders/'.$order->uuid));
    }
}

<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'postal' => 'required',
        ]);
        $val = Validator::make($request->project['model'],[
            'id' => 'required|exists:elements,id'
        ]);
        if($val->fails()) return response()->json(['errors' => $val->errors()], 400);
        foreach ($request->project['files'] as $file){
            $val = Validator::make($file, [
                'file' => ['required', function($field, $data, $fail){
                    if(!file_exists(storage_path('/app/public/'.$data))) $fail('Taki plik nie istnieje');
                }]
            ]);
            if($val->fails()) return response()->json(['errors' => $val->errors()], 400);
        }

        $amount = 0;
        foreach($request->project['files'] as $file){
            $amount = $amount + $file['sign']['price'];
        }
        $request->request->set('project', serialize($request->project));
        $request->request->set('amount', $amount);
        $request->request->set('uuid', md5(Str::random(50)));
        $order = Order::create($request->all());
        return response()->json(['redirect' => route('orders.show', ['id' => $order->uuid])]);
    }
    public function show(Request $request, $uuid){
        $order = Order::where('uuid', $uuid)->first();
        if(!$order) return redirect(url('/'))->withErrors(['Nie ma takiego zamówienia']);
        return view('orders.show', compact('order'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderController
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $relation = ['items', 'users'];
        if($user->hasRole('penjual')) {
            $data['order'] = Order::whereHas('items', function($query) use ($user) {
                $query->where('users_id', $user->id);
            })->searchWithRelations($request, 'items', ['users_id'])->paginator($request);
            $data['order'] = Order::whereHas('items', function($query) use ($user) {
                $query->where('users_id', $user->id);
            })->searchWithRelations($request, 'users', ['nama'])->paginator($request);
        } else if($user->hasRole('pembeli')){
            $data['order'] = Order::where('users_id', $user->id)
            ->searchWithRelations($request, 'items', ['users_id'])->paginator($request);
            $data['order'] = Order::where('users_id', $user->id)
            ->searchWithRelations($request, 'users', ['nama'])->paginator($request);
        } else {
            $data['order'] = Order::with($relation)
            ->searchWithRelations($request, 'items', ['nama'])->paginator($request);
            $data['order'] = Order::with($relation)
            ->searchWithRelations($request, 'users', ['nama'])->paginator($request);
        }
        $data['item'] = Item::whereHas('orders')->get();
        return view('fp.Order.index', compact('data'));
    }

    // public function create()
    // {
    //     return view('fp.Order.create');
    // }

    public function store(NewOrderRequest $request)
    {
        //dd($request->all());
        $validatedData = $request->validated();
        $order = Order::create($validatedData);
        //dd($order);
        return redirect()->route('order.index', $order->id)->with('success', 'Order "'.$order->nama.'" sukses ditambahkan');
    }

    public function show(Order $order)
    {
        $data['order'] = $order;
        return view('fp.Order.show', compact('data'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        //dd($request->all());
        $validatedData = $request->validated();
        $order->update($validatedData);
        return redirect()->route('order.index', $order->id);
    }

    // public function destroy(Order $order)
    // {
    //     $order->delete();
    //     return redirect()->route('Order.index')->with('success', 'Order "' . $order->nama . '" sukses dihapus".');
    // }
}

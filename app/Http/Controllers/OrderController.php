<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController
{
    public function index(Request $request)
    {
        $data['order'] = $query = Order::with('items')->search($request)->paginator($request);
        return view('tugas4.Order.index', compact('data'));
    }

    public function create()
    {
        return view('tugas4.Order.create');
    }

    public function store(OrderRequest $request)
    {
        $validatedData = $request->validated();
        $order = Order::create($validatedData);
        return redirect()->route('Order.index', $order->id)->with('success', 'Order "'.$order->nama.'" sukses ditambahkan');
    }

    public function show(Order $order)
    {
        $data['order'] = $order;
        return view('tugas4.Order.show', compact('data'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('Order.index')->with('success', 'Order "' . $order->nama . '" sukses dihapus".');
    }
}

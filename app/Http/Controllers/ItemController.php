<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{
    public function beli(Item $item)
    {
        if (Gate::denies('buy-item')) {
            abort(403, 'Anda tidak diizinkan untuk membeli item ini');
        }

        // Logic for buying items

        $item->update(['stok' => $item->stok - 1]);

        return redirect('/item');
    }
    public function index(Request $request)
    {
        $relation = 'kategoris'; 

        // LAZY LOADING
        // $data['item'] = Item::SearchWithRelations($request, $relation, ['nama'])->paginator($request);

        // EAGER LOADING
        $data['item'] = Item::with($relation)
        ->searchWithRelations($request, $relation, ['nama'])->paginator($request);

        return view('tugas4.item.index', compact('data'));
    }

    public function create()
    {
        $data['kategori'] = Kategori::all();
        return view('tugas4.item.create',compact('data'));
    }

    public function store(NewItemRequest $request)
    {
        $validatedData = $request->validated();
        unset($validatedData['kategori']);
        $item = Item::create($validatedData);
        $item->kategoris()->attach($request->input('kategori'));

        return redirect()->route('item.index')->with('success', 'Item "' . $item->nama . '" sukses ditambahkan.');
    }

    public function show(Item $item)
    {
        $data['item'] = $item;
        return view('tugas4.item.show', compact('data'));
    }

    public function edit(Item $item) 
    {
        $data['item'] = $item;
        $data['item-kategori'] = $item->kategoris->pluck('id')->toArray();
        $data['kategori'] = Kategori::all();
        return view('tugas4.item.edit', compact('data'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $validatedData = $request->validated();
        unset($validatedData['kategori']);
        $item->update($validatedData);
        $item->kategoris()->sync($request->input('kategori'));
        return redirect()->route('item.index', $item->id)->with('success', 'item "'.$item->nama.'" sukses diubah');
    }

    public function destroy(Item $item)
    {
        $item->kategoris()->detach();
        $item->delete();
        return redirect()->route('item.index')->with('success', 'Item "' . $item->nama . '" sukses dihapus".');
    }
}

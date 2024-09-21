<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $relation = 'kategoris'; 

        // LAZY LOADING
        // $data['buku'] = Buku::SearchWithRelations($request, $relation, ['nama'])->paginator($request);

        // EAGER LOADING
        $data['item'] = Item::with($relation)
        ->searchWithRelations($request, $relation, ['nama'])->paginator($request);

        return view('tugas2.item.index', compact('data'));
    }

    public function create()
    {
        $data['kategori'] = Kategori::all();
        return view('tugas2.item.create',compact('data'));
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
        return view('tugas2.item.show', compact('data'));
    }

    public function edit(Item $item) 
    {
        $data['item'] = $item;
        $data['item-kategori'] = $item->kategoris->pluck('id')->toArray();
        $data['kategori'] = Kategori::all();
        return view('tugas2.item.edit', compact('data'));
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

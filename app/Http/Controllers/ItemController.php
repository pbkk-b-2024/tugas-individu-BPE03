<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $relation = ['kategoris', 'users']; 

        // LAZY LOADING
        // $data['item'] = Item::SearchWithRelations($request, $relation, ['nama'])->paginator($request);

        // EAGER LOADING
        if (auth()->user()->hasRole('penjual')) {
            $data['item'] = Item::where('users_id', auth()->user()->id)
            ->searchWithRelations($request, 'kategoris', ['nama'])->paginator($request);
            $data['item'] = Item::where('users_id', auth()->user()->id)
            ->searchWithRelations($request, 'users', ['nama'])->paginator($request);
        } else {
            $data['item'] = Item::with($relation)
        ->searchWithRelations($request, 'kategoris', ['nama'])->paginator($request);
        $data['item'] = Item::with($relation)
        ->searchWithRelations($request, 'users', ['nama'])->paginator($request);
        }

        return view('fp.item.index', compact('data'));
    }

    public function create()
    {
        $data['kategori'] = Kategori::all();
        $data['penjual'] = User::role('penjual')->get();
        return view('fp.item.create',compact('data'));
    }

    public function store(NewItemRequest $request)
    {
       // dd($request->all());
        if($request->filled('users_id')) {
            $validatedData['users_id'] = $request->users_id;
        } else {
            $validatedData['users_id'] = Auth::id();
        }
        $validatedData = $request->validated();
        unset($validatedData['kategori']);
        if($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images/item', 'public');
        }

        $item = Item::create($validatedData);
        $item->kategoris()->attach($request->input('kategori'));
        
        return redirect()->route('item.index')->with('success', 'Item "' . $item->nama . '" sukses ditambahkan.');
    }

    public function show(Item $item)
    {
        $data['item'] = $item;
        return view('fp.item.show', compact('data'));
    }

    public function edit(Item $item) 
    {
        $data['item'] = $item;
        $data['item-kategori'] = $item->kategoris->pluck('id')->toArray();
        $data['kategori'] = Kategori::all();
        return view('fp.item.edit', compact('data'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        //dd($request->all());
        $validatedData = $request->validated();
        unset($validatedData['kategori']);
        if($request->hasFile('image')) {
            if ($item->image) {
                Storage::delete($item->image);
            }
            $validatedData['image'] = $request->file('image')->store('images/item', 'public');
        }
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

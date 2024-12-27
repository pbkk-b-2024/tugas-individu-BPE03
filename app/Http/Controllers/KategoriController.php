<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if($user->hasRole('penjual')) {
            $data['kategori'] = Kategori::whereHas('items', function($query) use ($user) {
                $query->where('users_id', $user->id);
            })->withCount(['items' => function ($query) use ($user) {
                $query->where('users_id', $user->id); // Count only items sold by the seller
            }])->search($request)->paginator($request);
        } else {
            $data['kategori'] = $query = Kategori::with('items')->search($request)->paginator($request);
        }
        return view('fp.kategori.index', compact('data'));
    }

    public function create()
    {
        return view('fp.kategori.create');
    }

    public function store(KategoriRequest $request)
    {
        $validatedData = $request->validated();
        $kategori = Kategori::create($validatedData);
        return redirect()->route('kategori.index', $kategori->id)->with('success', 'kategori "'.$kategori->nama.'" sukses ditambahkan');
    }

    public function show(Kategori $kategori)
    {
        $data['kategori'] = $kategori;
        return view('fp.kategori.show', compact('data'));
    }

    public function edit(Kategori $kategori)
    {
        $data['kategori'] = $kategori;
        return view('fp.kategori.edit', compact('data'));
    }

    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $validatedData = $request->validated();
        $kategori->update($validatedData);
        return redirect()->route('kategori.index', $kategori->id)->with('success', 'kategori "'.$kategori->nama.'" sukses diubah');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori "' . $kategori->nama . '" sukses dihapus".');
    }
}

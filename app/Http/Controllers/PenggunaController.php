<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController
{
    public function index(Request $request)
    {
        $data['pengguna'] = $query = Pengguna::with('items')->search($request)->paginator($request);
        return view('tugas2.Pengguna.index', compact('data'));
    }

    public function create()
    {
        return view('tugas2.Pengguna.create');
    }

    public function store(NewPenggunaRequest $request)
    {
        $validatedData = $request->validated();
        $pengguna = Pengguna::create($validatedData);
        return redirect()->route('Pengguna.index', $pengguna->id)->with('success', 'Pengguna "'.$pengguna->nama.'" sukses ditambahkan');
    }

    public function show(Pengguna $pengguna)
    {
        $data['pengguna'] = $pengguna;
        return view('tugas2.Pengguna.show', compact('data'));
    }

    public function edit(Pengguna $pengguna)
    {
        $data['pengguna'] = $pengguna;
        return view('tugas2.Pengguna.edit', compact('data'));
    }

    public function update(UpdatePenggunaRequest $request, Pengguna $pengguna)
    {
        $validatedData = $request->validated();
        $pengguna->update($validatedData);
        return redirect()->route('Pengguna.index', $pengguna->id)->with('success', 'Pengguna "'.$pengguna->nama.'" sukses diubah');
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();
        return redirect()->route('Pengguna.index')->with('success', 'Pengguna "' . $pengguna->nama . '" sukses dihapus".');
    }
}

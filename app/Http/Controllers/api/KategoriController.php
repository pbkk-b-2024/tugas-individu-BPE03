<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\KategoriRequest;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController
{
    public function index(Request $request)
    {
        $kategoris = $query = Kategori::with('items')->search($request)->paginator($request);
        $kategoris = KategoriResource::collection($kategoris);
        return $kategoris;
    }

    public function store(KategoriRequest $request)
    {
        $validatedData = $request->validated();
        $kategori = Kategori::create($validatedData);
        return (new KategoriResource($kategori))->additional([
            'message' => 'success',
        ]);
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);
        if(!$kategori) {
            return response()->json([
                'message' => 'kategori not found',
            ])
            ->setStatusCode(404);
        }
        return new KategoriResource($kategori);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        if(!$kategori) {
            return response()->json([
                'message' => 'kategori not found',
            ])
            ->setStatusCode(404);
        }
        $validatedData = $request->validated();
        $kategori->update($validatedData);
        return (new KategoriResource($kategori))->additional([
            'message' => 'success',
        ]);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if(!$kategori) {
            return response()->json([
                'message' => 'kategori not found',
            ])
            ->setStatusCode(404);
        }
        $deleted = $kategori->delete();
        return response()->json([
            'message' => $deleted ? 'success' : 'failed',
        ]);
    }
}

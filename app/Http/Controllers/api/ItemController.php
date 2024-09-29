<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\NewItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $relation = 'kategoris'; 

        // LAZY LOADING
        // $data['item'] = Item::SearchWithRelations($request, $relation, ['nama'])->paginator($request);

        // EAGER LOADING
        $items = Item::with($relation)
        ->searchWithRelations($request, $relation, ['nama'])->paginator($request);

        $items = ItemResource::collection($items);
        return $items->additional([
            'message' => 'success',
        ]);
    }

    public function store(NewItemRequest $request)
    {
        $validated = $request->validated();
        unset($validated['kategoris']);
        $item = Item::create($validated);
        $item->kategoris()->attach($request->input('kategoris'));
        return (new ItemResource($item))->additional([
            'message' => 'success',
        ]);
    }

    public function show($id)
    {
        $item = Item::with('kategoris')->find($id);

        if(!$item) {
            return response()->json([
                'message' => 'item not found',
            ])
            ->setStatusCode(404);
        }
        return (new ItemResource($item))->additional([
            'message' => 'success',
        ]);
    }

    public function update(UpdateItemRequest $request, $id)
    {
        $validated = $request->validated();
        unset($validated['kategoris']);
        $item = Item::find($id);
        if(!$item) {
            return response()->json([
                'message' => 'item not found',
            ])
            ->setStatusCode(404);
        }
        $item->update($validated);
        $item->kategoris()->sync($request->input('kategoris'));
        return (new ItemResource($item))->additional([
            'message' => 'success',
        ]);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        if(!$item) {
            return response()->json([
                'message' => 'item not found',
            ])
            ->setStatusCode(404);
        }
        $item->delete();
        return response()->json([
            'message' => 'success',
        ]);
    }
}

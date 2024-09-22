<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController
{
    public function index(Request $request)
    {
        $data['review'] = $query = Review::with('items')->search($request)->paginator($request);
        return view('tugas3.Review.index', compact('data'));
    }

    public function create()
    {
        return view('tugas3.Review.create');
    }

    public function store(ReviewRequest $request)
    {
        $validatedData = $request->validated();
        $review = Review::create($validatedData);
        return redirect()->route('Review.index', $review->id)->with('success', 'Review "'.$review->nama.'" sukses ditambahkan');
    }

    public function show(Review $review)
    {
        $data['review'] = $review;
        return view('tugas3.Review.show', compact('data'));
    }

    public function edit(Review $review)
    {
        $data['review'] = $review;
        return view('tugas3.Review.edit', compact('data'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('Review.index')->with('success', 'Review "' . $review->nama . '" sukses dihapus".');
    }
}

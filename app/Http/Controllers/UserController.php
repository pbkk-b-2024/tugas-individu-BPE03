<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\user;
use Illuminate\Http\Request;

class UserController
{
    public function index(Request $request)
    {
        $data['user'] = $query = user::with('items')->search($request)->paginator($request);
        return view('fp.user.index', compact('data'));
    }

    public function create()
    {
        return view('fp.user.create');
    }

    public function store(NewUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = user::create($validatedData);
        return redirect()->route('user.index', $user->id)->with('success', 'user "'.$user->nama.'" sukses ditambahkan');
    }

    public function show(user $user)
    {
        $data['user'] = $user;
        return view('fp.user.show', compact('data'));
    }

    public function edit(user $user)
    {
        $data['user'] = $user;
        return view('fp.user.edit', compact('data'));
    }

    public function update(UpdateUserRequest $request, user $user)
    {
        $validatedData = $request->validated();
        $user->update($validatedData);
        return redirect()->route('user.index', $user->id)->with('success', 'user "'.$user->nama.'" sukses diubah');
    }

    public function destroy(user $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'user "' . $user->nama . '" sukses dihapus".');
    }
}

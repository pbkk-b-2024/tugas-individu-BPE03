<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController
{
    public function show(Request $request){
        if (Auth::check()) {
            return redirect()->back();
        }else{
            return view('auth.register');
        }
    }

    public function show_penjual(Request $request){
        if (Auth::check()) {
            return redirect()->back();
        }else{
            return view('auth.register_penjual');
        }
    }

    public function register(Request $request)
    {
        //dd($this->validator($request->all())->validate());
        $validated = $this->validator($request->all())->validate();
       // dd($validated);
        $user = $this->create($validated);
        Auth::attempt($request->only('email', 'password'));
        return redirect()->intended('/');
    }

    public function register_penjual(Request $request)
    {
        //dd($this->validator($request->all())->validate());
        $validated = $this->validator($request->all())->validate();
       // dd($validated);
        $user = $this->create_penjual($validated);
        Auth::attempt($request->only('email', 'password'));
        return redirect()->intended('/');
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('pembeli');
        if($user->hasRole('pembeli')){
            return $user;
        }
        return $user;
    }

    protected function create_penjual(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('penjual');
        if($user->hasRole('penjual')){
            return $user;
        }
    }

    protected function validator(array $data)
    {
        //dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}

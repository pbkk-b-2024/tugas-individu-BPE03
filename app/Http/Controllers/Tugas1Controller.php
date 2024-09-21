<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Number;

class Tugas1Controller extends Controller
{
    public function GanjilGenap(Request $request)
    {
        $num = [];
        if ($request->has('n')) {
            $validatedData = $request->validate([
                'n' => 'required|integer|min:1',
            ]);

            $n = $validatedData['n'];
            $num = Number::getGanjilGenap($n);
        }
        return view('tugas1.ganjilgenap', compact('num'));
    }

    public function Fibonacci(Request $request)
    {
        $num = [];
        if ($request->has('n')) {
            $validatedData = $request->validate([
                'n' => 'required|integer|min:1',
            ]);

            $n = $validatedData['n'];
            $num = Number::getFibonacci($n);
        }
        return view('tugas1.fibonacci', compact('num'));
    }

    public function Prima(Request $request)
    {
        $num = [];
        if ($request->has('n')) {
            $validatedData = $request->validate([
                'n' => 'required|integer|min:1',
            ]);

            $n = $validatedData['n'];
            $num = Number::getPrima($n);
        }
        return view('tugas1.prima', compact('num'));
    }

    public function param1($param1 = ''){
        $data['param1'] = $param1;
        return view('tugas1.param1',compact('data'));
    }
}

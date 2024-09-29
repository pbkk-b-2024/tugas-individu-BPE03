<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

class LogoutController
{
    public function __invoke(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Tokens revoked']);
    }
}

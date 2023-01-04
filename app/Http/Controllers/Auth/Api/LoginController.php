<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $required = ['password', 'email'];

        foreach ($required as $req) {
            if (!$request[$req]) {
                return response()->json([
                    'error' => [
                        'message' => 'Missing ' . $req,
                    ],
                ], 400);
            }
        }

        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials))
            abort(401, 'Authentication failed, Invalid credentials');

        $token = auth()->user()->createToken('auth_token');
        return response()->json(['token' => $token->plainTextToken]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete(); //remove todos os tokens do usuário
        return response()->json([], 204);
    }
}

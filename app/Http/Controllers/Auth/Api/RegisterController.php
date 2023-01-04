<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        $required = ['name', 'password', 'email'];

        foreach ($required as $req) {
            if (!$request[$req]) {
                return response()->json([
                    'error' => [
                        'message' => 'Missing ' . $req,
                    ],
                ], 400);
            }
        }
        $userData = $request->only(['name', 'email', 'password']);
        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData))
            abort(500, 'Register failed');

        return response()->json(['user' => $user]);
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($credentials))
        {
            return response()->json([
                'message' => 'E-mail or password are incorrect.'
            ], 401);
        }

        $token = auth()->user()->createToken('auth');

        return response()->json([
            'message' => 'User sucessfully authenticated.',
            'token'   => $token->plainTextToken
        ], 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'User sucessfully disconnected.'
        ]);
    }
}

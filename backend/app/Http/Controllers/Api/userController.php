<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function register (Request $request)
    {
        if (auth()->check()) {
        // User is already authenticated, redirect or handle accordingly
        return 'already logged in';
    }

    $token = $request->bearerToken();
    if ($token) {
        return response()->json(['message' => 'Unauthorized. You cannot register while authenticated.'], 401);
    }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'phone_number' => ['required','regex:/^01\d{9}$/'],
            'address' => ['required','string', 'max:255'],
            'role' => ['required','in:seller,buyer'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return 'user has been created';     
    }
}

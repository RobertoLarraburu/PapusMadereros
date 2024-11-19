<?php

// app/Http/Controllers/LoginController.php

// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{// LoginController.php
public function login(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');

    $user = User::where('email', $email)->first();

    if ($user && password_verify($password, $user->password)) {
        // Devolver información del usuario junto con el éxito
        return response()->json([
            'success' => true,
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ]);
    } else {
        return response()->json(['success' => false]);
    }
}
}
<?php

// app/Http/Controllers/LoginController.php

// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            // Login successful, return a success response
            return response()->json(['success' => true]);
        } else {
            // Login failed, return an error response
            return response()->json(['success' => false]);
        }
    }
}
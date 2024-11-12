<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Verificar si el correo ya existe
        $existingUser = User::where('email', $request->input('email'))->first();
        if ($existingUser) {
            // Retorna un error si el correo ya está registrado
            return response()->json(['success' => false, 'message' => 'Este correo ya está registrado'], 409);
        }

        // Crear nuevo usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = ($request->input('password'));
        $user->save();

        return response()->json(['success' => true, 'message' => 'Usuario creado exitosamente'], 201);
    }
}

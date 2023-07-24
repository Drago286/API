<?php

// app/Http/Controllers/Auth/CustomResetPasswordController.php (Backend)

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'SAP' => 'required|string',
            'newPassword' => 'required|string|min:8',
        ]);

        $SAP = $request->input('SAP');
        $newPassword = $request->input('newPassword');

        // Buscar al usuario por su SAP en la base de datos
        $user = User::where('SAP', $SAP)->first();

        if ($user) {
            // Actualizar la contraseña del usuario y establecer su estado en "deshabilitado"
            $user->password = Hash::make($newPassword);
            $user->status = 'deshabilitado';
            $user->save();

            return response()->json([
                'message' => 'Contraseña actualizada correctamente',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }
    }
}
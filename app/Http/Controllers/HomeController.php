<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->rol === 'administrador') {
            $users = User::all();
            return view('home', ['users' => $users]);
        } elseif ($user->rol === 'cliente') {
            return view('home');
        } else {
            // Otro rol desconocido o sin permisos
            abort(403);
        }
    }

    /**
     * Update the status of a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, User $user)
    {
        // Verificar si el usuario autenticado es un administrador
        if (Auth::user()->rol === 'administrador') {
            // Validar la solicitud
            $request->validate([
                'status' => 'required|in:habilitado,deshabilitado',
            ]);

            // Actualizar el estado del usuario
            $user->update(['status' => $request->status]);

            // Redireccionar al panel de administrador con un mensaje
            return redirect()->route('home')->with('success', 'Estado del usuario actualizado correctamente.');
        }

        // Si el usuario no es administrador, redireccionar con un mensaje de error
        return redirect()->route('home')->with('error', 'No tienes permisos para realizar esta acción.');
    }
}

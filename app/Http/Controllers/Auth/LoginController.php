<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'SAP';
    }
    //Funcion que verifica la credenciales de inicio de sesion en el frontEnd
    public function loginApi(Request $request)
    {
        $request->validate([
            'SAP' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('SAP', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'status' => $user->status, // Agregar el atributo "status" a la respuesta
            ], 200);
        }

        // Agregar una verificación adicional para el usuario no encontrado
        $user = User::where('SAP', $request->SAP)->first();
        if (!$user) {
            return response()->json(['error' => 'usuario_no_encontrado'], 404);
        }

        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }
}

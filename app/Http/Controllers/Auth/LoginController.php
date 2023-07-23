<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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

    public function loginApi(Request $request)
    {
        $request->validate([
            'SAP' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('SAP', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Inicio de sesión exitoso'], 200);
        }

        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request)
    {
        // Validar datos de entrada
        $credentials = $request->validate([
            'email' => 'required|email',
            'contrasenia' => 'required|string',
        ]);

        // Por seguridad, cerrar cualquier sesion previa
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Buscar usuario
        $usuario = Usuario::where('email', $credentials['email'])->first();

        if (!$usuario) {
            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no son correctas.',
            ]);
        }

        // Verificar contrasena
        if (!Hash::check($credentials['contrasenia'], $usuario->contrasenia)) {
            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no son correctas.',
            ]);
        }

        // Verificar relación con empleado
        $empleado = $usuario->empleado;

        if (!$empleado || $empleado->status !== 'activo') {
            return back()->withErrors([
                'email' => 'Empleado inactivo o eliminado.',
            ]);
        }

        // Actualizar el ultimo inicio de sesion
        $usuario->update([
            'ultimo_inicio_sesion' => now(),
        ]);

        // Autenticar usuario
        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }


    public function logout(Request $request)
    {
        // Cerrar sesion del usuario
        Auth::guard('web')->logout();

        // Destruir sesión completamente
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireccionar al login
        return redirect('/login');
    }

}
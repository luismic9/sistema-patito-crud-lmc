<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    public function share(Request $request): array
    {
        $user = $request->user();

        if ($user) {
            // Forzar la relacion con el empleado
            $user->load('empleado');
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user ? [
                    'id' => $user->id,
                    'nombre' => $user->nombre,
                    'email' => $user->email,
                    'area_departamento' => $user->area_departamento,
                    'puesto' => $user->puesto,

                    'empleado' => $user->empleado ? [
                        'id' => $user->empleado->id,
                        'nombre' => $user->empleado->nombre,
                        'apellido_paterno' => $user->empleado->apellido_paterno,
                        'apellido_materno' => $user->empleado->apellido_materno,
                        'telefono' => $user->empleado->telefono_contacto,
                        'email_contacto' => $user->empleado->email_contacto,
                    ] : null,

                    'nombre_mostrar' => $user->empleado
                        ? $user->empleado->nombre
                        : $user->nombre,
                ] : null,
            ],

            'flash' => [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

/**
 * [!] - Existen dos roles para los usuario - 
 * [1] administrador
 *      Puede realizar todas las acciones de crud
 * [2] normal
 *      Solamente puede consultar informacion no tienen acceso a actualizar, eliminar,
 *      o crear nuevos empleados. El sistema muestra un mensaje indicando que no cuentan con los privilegios
 *      suficiente, ademas un usuario normal no puede acceder escribiendo la ruta directa en el navegador.
 */


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::orderBy('created_at', 'desc')->paginate(10);
        
        return Inertia::render('Empleados/Index', [
            'empleados' => $empleados,
            'filters' => request()->all(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarioActual = auth()->user();
        if ($this->esAdministrador($usuarioActual->roll)) {
            return Inertia::render('Empleados/Create');
        } else {
            abort(403, 'No tienes permiso para crear empleados, solo usuarios con el roll de "Administrador" pueden realizar esta acción');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100',
            'telefono_contacto' => 'required|string|max:15',
            'email_contacto' => 'required|string|max:100',
            'calle' => 'required|string|max:100',
            'numero' => 'required|string|max:10',
            'colonia' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:5',
            'ciudad' => 'required|string|max:100',
            'estado' => 'required|string|max:50',
            'pais' => 'required|string|max:50',
            'area_departamento' => 'required|string|max:150',
            'puesto' => 'required|string|max:100',
            'fecha_ingreso' =>'required|date',
        ]);

        Empleado::create($validated); 

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        // Todos los usuarios pueden visualizar
        $empleado->load('usuario');

        return Inertia::render('Empleados/Show', [
            'empleado' => $empleado,
            'usuario' => $empleado->usuario,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {   
        $usuarioActual = auth()->user();
        if ($this->esAdministrador($usuarioActual->roll)) {
            return Inertia::render('Empleados/Edit', [
                'empleado' => $empleado,
            ]);
        } else {
            abort(403, 'No tienes permiso para modificar empleados, solo usuarios con el roll de "Administrador" pueden realizar esta acción');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $this->authorize('update', $empleado);

        $validated = $request->validate([
            // ... tus validaciones actuales
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100',
            'telefono_contacto' => 'required|string|max:15',
            'email_contacto' => 'required|string|max:100',
            'calle' => 'required|string|max:100',
            'numero' => 'required|string|max:10',
            'colonia' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:5',
            'ciudad' => 'required|string|max:100',
            'estado' => 'required|string|max:50',
            'pais' => 'required|string|max:50',
            'area_departamento' => 'required|string|max:150',
            'puesto' => 'required|string|max:100',
            'fecha_ingreso' =>'required|date',
        ]);

        $empleado->update($validated);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        
        $usuarioActual = auth()->user();
        if ($this->esAdministrador($usuarioActual->roll)){
            $empleado->update([
                'status' => 'inactivo'
            ]);
    
            return redirect()->route('empleados.index')
                ->with('success', 'Empleado desactivado exitosamente');
        } else {
            abort(403, 'No tienes permiso para eliminar empleados, solo usuarios con el roll de "Administrador" pueden realizar esta acción');
        }

    }

    public function reactivate(Empleado $empleado)
    {
        
        //Ejecutar si el usuario tiene el roll de adminsitrador
        $usuarioActual = auth()->user();
        if ($this->esAdministrador($usuarioActual->roll)) {
            $this->authorize('update', $empleado);
                $empleado->update([
                'status' => 'activo'
            ]);

            return redirect()->route('empleados.index')
                ->with('success', 'Empleado reactivado exitosamente');
        } else { // No tiene privilegios
            abort(403, 'No tienes permiso para reactivar empleados, solo usuarios con el roll de "Administrador" pueden realizar esta acción');
        }
    }

    private function esAdministrador($roll)
    {
        return ($roll === 'administrador');
    }

}

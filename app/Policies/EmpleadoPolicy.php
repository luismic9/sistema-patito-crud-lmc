<?php

namespace App\Policies;

use App\Models\Empleado;
use App\Models\Usuario;

class EmpleadoPolicy
{
    // Solo los usuarios con el roll 'Administrador pueden hacer todas las acciones de CRUD'
    private function esAdministrador($roll)
    {
        return ($roll ===  'administrador');
    }
    /**
     * Determine if the user can view the model.
     */
    public function view(Usuario $usuario, Empleado $empleado): bool
    {
        // Verifica si el usuario tiene relación con este empleado
        return $usuario->empleado_id === $empleado->id;
    }

    /**
     * Determine if the user can update the model.
     */
    public function update(Usuario $usuario, Empleado $empleado): bool
    {
        // Solo puede actualizar si tiene el roll de administrador
        if ($this->esAdministrador($usuario->roll)) {
            return true;
        }
        return $usuario->empleado_id === $empleado->id;
    }

    /**
     * Determine if the user can delete the model.
     */
    public function delete(Usuario $usuario, Empleado $empleado): bool
    {
        // Solo puede eliminar si tiene el roll de administrador
        if ($this->esAdministrador($usuario->roll)) {
            return true;
        }
        return $usuario->empleado_id === $empleado->id;
    }

    /**
     * Determine if the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }
}
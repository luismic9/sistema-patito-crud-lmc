<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'empleado_id',
        'email',
        'contrasenia',
        'ultimo_inicio_sesion'
    ];

    protected $hidden = [
        'contrasenia',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'contrasenia' => 'hashed',
    ];

    /**
     * Sobrescribir el campo de contrasena para Laravel
     */
    public function getAuthPassword()
    {
        return $this->contrasenia;
    }

   public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

}

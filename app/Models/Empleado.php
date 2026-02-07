<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono_contacto',
        'email_contacto',
        'calle',
        'numero',
        'colonia',
        'codigo_postal',
        'ciudad',
        'estado',
        'pais',
        'area_departamento',
        'puesto',
        'fecha_ingreso',
        'status'
    ];

    // Generar usuarios relacionados
    protected static function booted()
    {
        static::created(function ($empleado) {
            $empleado->crearUsuarioAsociado();
        });
    }

    public function crearUsuarioAsociado()
    {
        $email = $this->generarEmail(); // Email generado mediante una funcion personalizada
        $nombreUsuario = strstr($email, '@', true); // extrae antes del @ para el nombre del usuario
        
        /* Contraseña por defecto (por practicidad la dejamos asi)
            Siendo que lo ideal seria generarlas de forma aleatorea, como esta funcion que hice aqui
                -> private function generarContrasenia()
        */
        $contrasenia = 'patito123'; 
        
        Usuario::create([
            'nombre' => $nombreUsuario,
            'email' => $email,
            'contrasenia' => bcrypt($contrasenia),
            'empleado_id' => $this->id,
        ]);
    }
    /** 
     * Generar direcciones de correo electronico, con la siguiente logica:
     * [1] Primer letra del nombre
     * [2] Apellido paterno completo
     * [3] Primer letra del apellido materno
     * [4] Si ya existe un usuario correo igual enotnces agrega un numero
    */
    public function generarEmail()
    {
        $nombreBase = strtolower($this->nombre[0] . $this->apellido_paterno . $this->apellido_materno[0]);
        $dominio = '@patito.com';
        $email = $nombreBase . $dominio;
        
        // [?] Ya existe un usuario con el mismo correo
        $contador = 1;
        while (Usuario::where('email', $email)->exists()) {
            $email = $nombreBase . $contador . $dominio;
            $contador++;
        }
        
        return $email;
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'empleado_id');
    }

    // funcion para generar contrasenas
    private function generarContrasenia() {
        $mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $minusculas = 'abcdefghijklmnopqrstuvwxyz';
        $numeros = '0123456789';
        
        $caracteresPermitidos = $mayusculas . $minusculas . $numeros;
        $longitudTotal = strlen($caracteresPermitidos);
        
        $contrasenia = '';
        
        // Generar 8 caracteres aleatorios
        for ($i = 0; $i < 8; $i++) {
            // obtengo un indice de forma aleatorea
            $indice = random_int(0, $longitudTotal - 1);
            $contrasenia .= $caracteresPermitidos[$indice];
        }
        
        return $contrasenia;
    }

}

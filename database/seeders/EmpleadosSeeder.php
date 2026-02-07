<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('empleados')->insert([
            [
                'nombre' => 'Administrador',
                'apellido_paterno' => 'Sistema',
                'apellido_materno' => 'Root',
                'telefono_contacto' => '5551234567',
                'email_contacto' => 'admin.root@correo.com',
                'calle' => 'Av. Principal',
                'numero' => '123',
                'colonia' => 'Centro',
                'codigo_postal' => '01000',
                'ciudad' => 'Xalapa',
                'estado' => 'Veracruz',
                'pais' => 'Mexico',
                'area_departamento' => 'Sistemas',
                'puesto' => 'Administrador del Sistema',
                'fecha_ingreso' => now(),
                'status' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Gerente 
            [
                'nombre' => 'Gerente',
                'apellido_paterno' => 'Administracion',
                'apellido_materno' => 'Patito',
                'telefono_contacto' => '5551234567',
                'email_contacto' => 'admin.gerente@correo.com',
                'calle' => 'Av. Principal',
                'numero' => '123',
                'colonia' => 'Centro',
                'codigo_postal' => '01000',
                'ciudad' => 'Xalapa',
                'estado' => 'Veracruz',
                'pais' => 'Mexico',
                'area_departamento' => 'Administracion',
                'puesto' => 'Auxiliar de Administracion',
                'fecha_ingreso' => now(),
                'status' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Auxiliar
            [
                'nombre' => 'Auxiliar',
                'apellido_paterno' => 'Administracion',
                'apellido_materno' => 'Patito',
                'telefono_contacto' => '5551234567',
                'email_contacto' => 'admin.auxiliar@correo.com',
                'calle' => 'Av. Principal',
                'numero' => '123',
                'colonia' => 'Centro',
                'codigo_postal' => '01000',
                'ciudad' => 'Xalapa',
                'estado' => 'Veracruz',
                'pais' => 'Mexico',
                'area_departamento' => 'Administracion',
                'puesto' => 'Auxiliar de Administracion',
                'fecha_ingreso' => now(),
                'status' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Empleados de prueba con seeder 
            [
                'nombre' => 'Luis',
                'apellido_paterno' => 'Miguel',
                'apellido_materno' => 'Conde',
                'telefono_contacto' => '884569759',
                'email_contacto' => 'luismi@correo.com',
                'calle' => 'Priv. Miguel Hidalgo',
                'numero' => '117',
                'colonia' => 'Insurgentes',
                'codigo_postal' => '91365',
                'ciudad' => 'Coatepec',
                'estado' => 'Veracruz',
                'pais' => 'Mexico',
                'area_departamento' => 'Sistemas',
                'puesto' => 'Desarrollador de Software',
                'fecha_ingreso' => now(),
                'status' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana',
                'apellido_paterno' => 'Garcia',
                'apellido_materno' => 'Lopez',
                'telefono_contacto' => '5551234567',
                'email_contacto' => 'ana.garcia@correo.com',
                'calle' => 'Av. Revolucion',
                'numero' => '845',
                'colonia' => 'Del Valle',
                'codigo_postal' => '03100',
                'ciudad' => 'Ciudad de Mexico',
                'estado' => 'CDMX',
                'pais' => 'Mexico',
                'area_departamento' => 'Recursos Humanos',
                'puesto' => 'Gerente de RH',
                'fecha_ingreso' => now()->subYears(2),
                'status' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
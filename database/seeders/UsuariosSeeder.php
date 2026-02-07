<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        // Mapa usuario => email del empleado
        $usuarios = [
            [
                'nombre' => 'root',
                'email' => 'root@patito.com',
                'password' => 'password',
                'roll' => 'administrador',
                'empleado_email' => 'admin.root@correo.com',
            ],
            [
                'nombre' => 'gerente',
                'email' => 'gerente@patito.com',
                'password' => 'password',
                'roll' => 'administrador',
                'empleado_email' => 'admin.gerente@correo.com',
            ],
            [
                'nombre' => 'auxiliar',
                'email' => 'auxiliar@patito.com',
                'password' => 'password',
                'roll' => 'administrador',
                'empleado_email' => 'admin.auxiliar@correo.com',
            ],
            [
                'nombre' => 'lmiguelc',
                'email' => 'lmiguelc@patito.com',
                'password' => 'patito123',
                'roll' => 'normal',
                'empleado_email' => 'luismi@correo.com',
            ],
            [
                'nombre' => 'agarcial',
                'email' => 'agarcial@patito.com',
                'password' => 'patito123',
                'roll' => 'normal',
                'empleado_email' => 'ana.garcia@correo.com',
            ],
        ];

        foreach ($usuarios as $data) {
            $empleado = DB::table('empleados')
                ->where('email_contacto', $data['empleado_email'])
                ->first();

            if (!$empleado) {
                $this->command->warn("Empleado no encontrado: {$data['empleado_email']}");
                continue;
            }

            DB::table('usuarios')->insert([
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'empleado_id' => $empleado->id,
                'contrasenia' => Hash::make($data['password']),
                'roll' => $data['roll'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('telefono_contacto', 15);
            $table->string('email_contacto');
            $table->string('calle');
            $table->string('numero');
            $table->string('colonia');
            $table->string('codigo_postal');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('pais')->default('Mexico');
            $table->string('area_departamento');
            $table->string('puesto');
            $table->date('fecha_ingreso')->nullable();
            $table->enum('status', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
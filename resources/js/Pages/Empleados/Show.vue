<template>
    <AppLayout>
        <v-container fluid>
        <!-- HEADER -->
        <v-list-item-subtitle>
        </v-list-item-subtitle>
        <v-row justify="center" class="mb-6">
            <v-col cols="12" md="10">
            <v-row align="center">
                <v-col cols="12" md="8">
                <div class="d-flex align-center">
                    <v-avatar size="40" color="primary" class="me-4">
                        <span class="text-h6 font-weight-bold text-white">
                        {{ empleado.nombre.charAt(0) }}
                        </span>
                    </v-avatar>

                    <div>
                        <div class="text-h6 font-weight-bold">
                        {{ empleado.nombre + ' ' + empleado.apellido_paterno + ' ' + empleado.apellido_materno }}
                        </div>
                        <div class="text-body-2 text-primary">
                        {{ empleado.puesto }} · {{ empleado.area_departamento }}
                        </div>
                    </div>
                </div>
                </v-col>
                <v-col cols="12" md="4" class="text-right">
                <v-btn
                    variant="tonal"
                    color="purple"
                    prepend-icon="mdi-arrow-left"
                    @click="regresar"
                >
                    Volver
                </v-btn>
                </v-col>
            </v-row>
            </v-col>
        </v-row>

        <v-divider class="mb-8" />

        <!-- CONTENIDO -->
        <v-row justify="center">
            <v-col cols="12" md="10">
            <v-row>

                <!-- PERFIL -->
                <v-col cols="12" md="5">
                <v-list density="comfortable">

                    <v-list-subheader class="text-primary font-weight-bold">
                    Información Personal
                    </v-list-subheader>

                    <v-list-item prepend-icon="mdi-account">
                    <v-list-item-title>Nombre</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ empleado.nombre }}
                    </v-list-item-subtitle>
                    </v-list-item>
                    
                    <v-list-item prepend-icon="mdi-account-supervisor">
                    <v-list-item-title>Apellido Pateron</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ empleado.apellido_paterno }}
                    </v-list-item-subtitle>
                    </v-list-item>
                    
                    <v-list-item prepend-icon="mdi-account-supervisor-outline">
                    <v-list-item-title>Apellido Maeterno</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ empleado.apellido_materno }}
                    </v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-phone">
                    <v-list-item-title>Teléfono</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ empleado.telefono_contacto }}
                    </v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-email">
                    <v-list-item-title>Email</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ empleado.email_contacto }}
                    </v-list-item-subtitle>
                    </v-list-item>

                    <v-divider class="my-4" />

                    <v-list-subheader class="text-primary font-weight-bold">
                    Información Laboral
                    </v-list-subheader>

                    <v-list-item prepend-icon="mdi-email">
                    <v-list-item-title>Correo</v-list-item-title>
                    <v-list-item-subtitle>  
                        {{ empleado.usuario.email }}
                    </v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-domain">
                    <v-list-item-title>Departamento</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ empleado.area_departamento }}
                    </v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-briefcase">
                    <v-list-item-title>Puesto</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ empleado.puesto }}
                    </v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-calendar">
                    <v-list-item-title>Fecha de Ingreso</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ formatFecha(empleado.fecha_ingreso) }}
                    </v-list-item-subtitle>
                    </v-list-item>

                </v-list>
                </v-col>

                <!-- DOMICILIO -->
                <v-col cols="12" md="7">
                <v-list density="comfortable">

                    <v-list-subheader class="text-primary font-weight-bold">
                    Domicilio
                    </v-list-subheader>

                    <v-list-item prepend-icon="mdi-map-marker">
                    <v-list-item-title>Calle</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ empleado.calle }} #{{ empleado.numero }}
                    </v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-home-city">
                    <v-list-item-title>Colonia</v-list-item-title>
                    <v-list-item-subtitle>{{ empleado.colonia }}</v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-mailbox">
                    <v-list-item-title>Código Postal</v-list-item-title>
                    <v-list-item-subtitle>{{ empleado.codigo_postal }}</v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-city">
                    <v-list-item-title>Ciudad</v-list-item-title>
                    <v-list-item-subtitle>{{ empleado.ciudad }}</v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-map">
                    <v-list-item-title>Estado</v-list-item-title>
                    <v-list-item-subtitle>{{ empleado.estado }}</v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item prepend-icon="mdi-earth">
                    <v-list-item-title>País</v-list-item-title>
                    <v-list-item-subtitle>{{ empleado.pais }}</v-list-item-subtitle>
                    </v-list-item>

                </v-list>
                </v-col>

            </v-row>

            <v-divider class="my-6" />

            <!-- SISTEMA -->
            <div class="d-flex justify-center gap-3">
                <v-chip color="primary" variant="tonal" prepend-icon="mdi-calendar">
                Creado: {{ formatFechaHora(empleado.created_at) }}
                </v-chip>

                <v-chip color="warning" variant="tonal" prepend-icon="mdi-calendar-edit">
                Actualizado: {{ formatFechaHora(empleado.updated_at) }}
                </v-chip>

                <v-chip color="success" variant="tonal" prepend-icon="mdi-login">
                Ultimo Acceso al Sistema: {{ (empleado.usuario.ultimo_inicio_sesion) === null ? 'Sin coincidencias' : formatFechaHora(empleado.usuario.ultimo_inicio_sesion) }}
                </v-chip>
            </div>

            </v-col>
        </v-row>

        </v-container>
        
    </AppLayout>
</template>


<script setup>
import { computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

const props = defineProps({
    empleado: Object,
});

// solo fecha
const formatFecha = (fecha) => {
    return new Date(fecha).toLocaleDateString('es-MX', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
}
// fecha con tiempo
const formatFechaHora = (fecha) => {
    return new Date(fecha).toLocaleDateString('es-MX', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};

const regresar = () => {
  router.get('/empleados');
};
</script>


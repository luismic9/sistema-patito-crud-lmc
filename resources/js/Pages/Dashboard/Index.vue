<template>
    <AppLayout>
        <v-container fluid>

        <!-- HEADER -->
        <v-row justify="center" class="mb-6">
            <v-col cols="12" md="10">
            <div class="d-flex align-center gap-3">
                <v-icon size="36" color="primary">mdi-view-dashboard</v-icon>
                <div>
                <div class="text-h6 font-weight-bold">Dashboard</div>
                <div class="text-body-2 text-grey">
                    Sistema de Gesti&oacute;n de Empleados · Patito S.A.
                </div>
                </div>
            </div>
            </v-col>
        </v-row>

        <!-- BIENVENIDA -->
        <v-row justify="center" class="mb-6">
            <v-col cols="12" md="10">
            <v-alert
                variant="tonal"
                color="primary"
                icon="mdi-hand-wave"
            >
                Hola, <strong>
                    {{ 
                        $page.props.auth.user.empleado.nombre 
                      + ' '
                      + $page.props.auth.user.empleado.apellido_paterno
                      + ' '
                      + $page.props.auth.user.empleado.apellido_materno
                    }}
                </strong>,
                desde aquí puedes gestionar la información del sistema.
            </v-alert>
            </v-col>
        </v-row>

        <!-- ACCIONES PRINCIPALES -->
        <v-row justify="center">
            <v-col cols="12" md="10">
            <v-row>

                <!-- EMPLEADOS -->
                <v-col cols="12" md="6">
                <v-sheet
                    elevation="2"
                    rounded="lg"
                    class="pa-6 text-center"
                >
                    <v-icon
                    icon="mdi-account-multiple"
                    size="56"
                    color="primary"
                    />

                    <div class="text-h6 font-weight-medium mt-3">
                    Empleados
                    </div>

                    <div class="text-body-2 text-grey">
                    Consulta, crea y administra la información de los empleados
                    </div>

                    <v-btn
                        color="primary"
                        size="large"
                        class="mt-4"
                        @click="irAEmpleados()"
                        prepend-icon="mdi-arrow-right"
                    >
                        Ir a Empleados
                    </v-btn>

                </v-sheet>
                </v-col>

                <!-- CUENTA -->
                <v-col cols="12" md="6">
                <v-sheet
                    elevation="2"
                    rounded="lg"
                    class="pa-6 text-center"
                >
                    <v-icon
                    icon="mdi-account-circle"
                    size="56"
                    color="success"
                    />

                    <div class="text-h6 font-weight-medium mt-3">
                    Tu Cuenta
                    </div>

                    <div class="text-body-2">
                    {{ 
                        $page.props.auth.user.empleado.nombre 
                      + ' '
                      + $page.props.auth.user.empleado.apellido_paterno
                      + ' '
                      + $page.props.auth.user.empleado.apellido_materno
                    }}
                    </div>

                    <div class="text-caption text-grey">
                    {{ usuario.email }}
                    </div>
                </v-sheet>
                </v-col>

            </v-row>
            </v-col>
        </v-row>

        </v-container>
    </AppLayout>
</template>


<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3'; // Importamos el router
import { onMounted, onUnmounted } from 'vue';

defineProps({
    usuario: Object
});

let popstateHandler;

onMounted(() => {
    // Verificar autenticacion al cargar
    popstateHandler = function(event) {
        router.reload({ only: ['usuario'] });
    };
    
    window.addEventListener('popstate', popstateHandler);
});

onUnmounted(() => {
    window.removeEventListener('popstate', popstateHandler);
});

const irAEmpleados = () => {
    router.get('/empleados');
};

</script>
<template>
    <AppLayout>
        <v-container fluid>

        <!-- HEADER -->
        <v-row justify="center" class="mb-6">
            <v-col cols="12" md="10">
            <v-row align="center">
                <v-col cols="12" md="8">
                <div class="d-flex align-center gap-3">
                    <v-icon size="36" color="primary">
                    mdi-account-multiple
                    </v-icon>
                    <div>
                    <div class="text-h6 font-weight-bold">
                        Gestión de Empleados
                    </div>
                    <div class="text-body-2 text-grey">
                        Administración y control del personal
                    </div>
                    </div>
                </div>
                </v-col>

                <v-col cols="12" md="4" class="text-right">
                <v-btn
                    color="primary"
                    prepend-icon="mdi-plus"
                    @click="irACrear"
                >
                    Nuevo Empleado
                </v-btn>
                </v-col>
            </v-row>
            </v-col>
        </v-row>

        <!-- TABLA -->
        <v-row justify="center">
            <v-col cols="12" md="10">
            <v-table hover>
                <thead>
                <tr>
                    <th title="Nombre completo del empleado">Empleado</th>
                    <th title="Estado del empleado (Activo | Eliminado[Inactivo])">Estado</th>
                    <th title="Telefono personal">Contacto</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>

                <tbody>
                <tr
                    v-for="empleado in empleados.data"
                    :key="empleado.id"
                    :class="empleado.status === 'inactivo' ? 'fila-inactiva' : ''"
                >
                    <td>
                    <div class="font-weight-medium">
                        {{ empleado.nombre }}
                        {{ empleado.apellido_paterno }}
                        {{ empleado.apellido_materno }}
                    </div>
                    <div class="text-caption text-grey">
                        {{ empleado.email_contacto }}
                    </div>
                    </td>

                    <td >
                        <v-chip :color="empleado.status === 'activo' ? 'green' : 'red'" small>
                            {{ empleado.status.charAt(0).toUpperCase() + empleado.status.slice(1) }}
                        </v-chip>
                    </td>

                    <td>
                    {{ empleado.telefono_contacto }}
                    </td>

                    <td>
                    {{ empleado.area_departamento }}
                    </td>

                    <td>
                    {{ empleado.ciudad }}
                    </td>
                    <!-- Botones -->
                    <td class="text-center">
                        <div v-if="empleado.status === 'activo'">
                            <v-btn
                                icon
                                size="small"
                                variant="tonal"
                                color="info"
                                @click="verEmpleado(empleado.id)"
                                title="Haga clic para ver detalles del empleado"
                            >
                                <v-icon>mdi-eye</v-icon>
                            </v-btn>
        
                            <v-btn
                                icon
                                size="small"
                                variant="tonal"
                                color="warning"
                                class="mx-1"
                                @click="editarEmpleado(empleado.id)"
                                title="Haga click para editar"
                            >
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
        
                            <v-btn
                                icon
                                size="small"
                                variant="tonal"
                                color="error"
                                @click="confirmarEliminar(empleado)"
                                title="Haga click para elminar al empleado"
                            >
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                            
                        </div>
                        <div v-else-if="empleado.status === 'inactivo'">
                            <v-btn
                                icon
                                size="small"
                                variant="tonal"
                                color="info"
                                @click="verEmpleado(empleado.id)"
                                title="Haga clic para ver detalles del empleado"
                            >
                                <v-icon>mdi-eye</v-icon>
                            </v-btn>
                            <v-btn
                                icon
                                size="small"
                                variant="tonal"
                                color="success"
                                @click="confirmarReactivar(empleado)"
                                title="Haga click para activar nuevamente al empleado"
                            >
                                <v-icon>mdi-restore</v-icon>
                            </v-btn>
                        </div>
                    </td> <!-- Termina el el td -->
                </tr>
                </tbody>
            </v-table>
            </v-col>
        </v-row>

        <!-- PAGINACIÓN -->
        <v-row justify="center" class="mt-6">
            <v-col cols="12" md="10" class="d-flex justify-center">
            <v-pagination
                v-model="currentPage"
                :length="empleados.last_page"
                total-visible="6"
                @update:modelValue="cambiarPagina"
            />
            </v-col>
        </v-row>

        </v-container>

        <!-- DIALOGO ELIMINAR -->
        <v-dialog v-model="dialogEliminar" max-width="420">
        <v-card>
            <v-card-title class="d-flex align-center gap-2">
            <v-icon color="error">mdi-alert</v-icon>
            Confirmar Eliminación
            </v-card-title>

            <v-card-text>
            ¿Deseas eliminar al empleado
            <strong>{{ empleadoSeleccionado?.nombre + ' ' + empleadoSeleccionado?.apellido_paterno + ' ' + empleadoSeleccionado?.apellido_materno }}</strong>?
            <br />
            </v-card-text>

            <v-card-actions>
            <v-spacer />
            <v-btn variant="text" @click="dialogEliminar = false">
                Cancelar
            </v-btn>
            <v-btn
                color="error"
                variant="flat"
                :loading="eliminando"
                @click="eliminarEmpleado"
            >
                Eliminar
            </v-btn>
            </v-card-actions>
        </v-card>
        </v-dialog>
        
        <!-- DIALOGO REACTIVAR -->
        <v-dialog v-model="dialogReactivar" max-width="420">
        <v-card>
            <v-card-title class="d-flex align-center gap-2">
            <v-icon color="warning">mdi-alert</v-icon>
            Confirmar Reactivaci&oacute;n
            </v-card-title>

            <v-card-text>
            ¿Deseas reactivar al empleado
            <strong>{{ empleadoSeleccionado?.nombre + ' ' + empleadoSeleccionado?.apellido_paterno + ' ' + empleadoSeleccionado?.apellido_materno }}</strong>?
            <br />
            </v-card-text>

            <v-card-actions>
            <v-spacer />
            <v-btn variant="text" @click="dialogReactivar = false">
                Cancelar
            </v-btn>
            <v-btn
                color="warning"
                variant="flat"
                :loading="reactivando"
                @click="reactivarEmpleado"
            >
                Reactivar
            </v-btn>
            </v-card-actions>
        </v-card>
        </v-dialog>
        
        <!-- SNACKBAR -->
        <v-snackbar
        v-model="mostrarExito"
        color="success"
        timeout="3000"
        >
        {{ mensajeExito }}
        </v-snackbar>

    </AppLayout>
</template>



<script setup>
import { ref, watch, onMounted } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

const props = defineProps({
    empleados: Object,
    filters: Object,
});

const dialogEliminar = ref(false);
const empleadoSeleccionado = ref(null);
const eliminando = ref(false);
const dialogReactivar = ref(false);
const reactivando = ref(false);
const mostrarExito = ref(false);
const mensajeExito = ref('');
const currentPage = ref(props.empleados.current_page);

// Mostrar mensaje
onMounted(() => {
    const flash = usePage().props.flash;
    if (flash.success) {
        mensajeExito.value = flash.success;
        mostrarExito.value = true;
    }
});

// ====================================
// METODOS PARA NAVEGACION
// ====================================
const irACrear = () => {
    router.get('/empleados/create');
};

const verEmpleado = (id) => {
    router.get(`/empleados/${id}`);
};

const editarEmpleado = (id) => {
    router.get(`/empleados/${id}/edit`);
};

const cambiarPagina = (page) => {
    router.get('/empleados', { page }, {
        preserveState: true,
        replace: true,
    });
};

const confirmarEliminar = (empleado) => {
    empleadoSeleccionado.value = empleado;
    dialogEliminar.value = true;
};

const eliminarEmpleado = () => {
    if (!empleadoSeleccionado.value) return;
    
    eliminando.value = true;
    router.delete(`/empleados/${empleadoSeleccionado.value.id}`, {
        onSuccess: () => {
            dialogEliminar.value = false;
            empleadoSeleccionado.value = null;
            eliminando.value = false;
        },
        onError: () => {
            eliminando.value = false;
        },
    });
};

// Reactivar a un empleado (Es mejor implementar un borrado logico a eliminar un registro)
const confirmarReactivar = (empleado) => {
    empleadoSeleccionado.value = empleado;
    dialogReactivar.value = true;
}

const reactivarEmpleado = () => {
    if (!empleadoSeleccionado.value) return;

    reactivando.value = true;
    
    router.post(`/empleados/${empleadoSeleccionado.value.id}/reactivate`, {}, {
        onSuccess: () => {
            dialogReactivar.value = false;
            empleadoSeleccionado.value = null;
            reactivando.value = false;
        },
        onError: () => {
            reactivando.value = false;
        }
    });
}


</script>

<style scoped>
    .fila-inactiva {
    background-color: #fff5f5 !important;
    opacity: 0.7;
    }

    .fila-inactiva:hover {
    background-color: #ffeaea !important;
    opacity: 0.9;
    }
</style>
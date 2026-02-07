<template>
    <AppLayout>
        <v-container fluid>

        <!-- HEADER -->
        <v-row justify="center" class="mb-4">
            <v-col cols="12" md="9">
                <div class="d-flex align-center justify-space-between">
                    <div class="d-flex align-center gap-2">
                        <v-icon color="success">mdi-account-plus</v-icon>
                        <div>
                            <div class="text-h6 font-weight-bold text-success">
                                Nuevo Empleado
                            </div>
                            <div class="text-body-2 text-grey">
                                Registro de un nuevo colaborador en el sistema
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <v-btn
                            variant="tonal"
                            color="purple"
                            prepend-icon="mdi-arrow-left"
                            @click="regresar"
                        >
                            Volver
                        </v-btn>
                    </div>
                </div>
            </v-col>
        </v-row>
        
        <v-row justify="center" class="mb-4">
            <v-col cols="12" md="9">
            <v-alert
                type="success"
                variant="tonal"
                density="compact"
                icon="mdi-information-outline"
            >
                Completa la informaci&oacute;n requerida para dar de alta al empleado.
            </v-alert>
            </v-col>
        </v-row>

        <v-form @submit.prevent="submit">
            <v-row justify="center">
            <v-col cols="12" md="9">

                <!-- INFORMACION PERSONAL -->
                <div class="text-subtitle-1 font-weight-medium mb-2 text-success">
                Información Personal
                </div>
                <v-divider class="mb-4" />

                <v-row dense>
                <v-col cols="12" md="4">
                    <v-text-field
                    v-model="form.nombre"
                    label="Nombre"
                    :error-messages="errors.nombre"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="4">
                    <v-text-field
                    v-model="form.apellido_paterno"
                    label="Apellido Paterno"
                    :error-messages="errors.apellido_paterno"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="4">
                    <v-text-field
                    v-model="form.apellido_materno"
                    label="Apellido Materno"
                    :error-messages="errors.apellido_materno"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="6">
                    <v-text-field
                    v-model="form.telefono_contacto"
                    label="Teléfono"
                    :error-messages="errors.telefono_contacto"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="6">
                    <v-text-field
                    v-model="form.email_contacto"
                    label="Email"
                    type="email"
                    :error-messages="errors.email_contacto"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>
                </v-row>

                <!-- INFORMACION LABORAL -->
                <div class="text-subtitle-1 font-weight-medium mt-6 mb-2 text-success">
                Información Laboral
                </div>
                <v-divider class="mb-4" />

                <v-row dense>
                <v-col cols="12" md="4">
                    <v-text-field
                    v-model="form.area_departamento"
                    label="Departamento"
                    :error-messages="errors.area_departamento"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="4">
                    <v-text-field
                    v-model="form.puesto"
                    label="Puesto"
                    :error-messages="errors.puesto"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="4">
                    <v-text-field
                    v-model="form.fecha_ingreso"
                    label="Fecha de Ingreso"
                    type="date"
                    :error-messages="errors.fecha_ingreso"
                    :max="maxDate"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>
                </v-row>

                <!-- DIRECCION -->
                <div class="text-subtitle-1 font-weight-medium mt-6 mb-2 text-success">
                Direcci&oacute;n
                </div>
                <v-divider class="mb-4" />

                <v-row dense>
                <v-col cols="12" md="6">
                    <v-text-field v-model="form.calle" label="Calle" density="compact" variant="outlined" />
                </v-col>

                <v-col cols="12" md="2">
                    <v-text-field v-model="form.numero" label="Número" density="compact" variant="outlined" />
                </v-col>

                <v-col cols="12" md="4">
                    <v-text-field v-model="form.colonia" label="Colonia" density="compact" variant="outlined" />
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field v-model="form.codigo_postal" label="C.P." density="compact" variant="outlined" />
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field v-model="form.ciudad" label="Ciudad" density="compact" variant="outlined" />
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field v-model="form.estado" label="Estado" density="compact" variant="outlined" />
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field v-model="form.pais" label="País" density="compact" variant="outlined" />
                </v-col>
                </v-row>

                <!-- BOTONES -->
                <div class="d-flex justify-end mt-6 gap-3">
                <v-btn variant="text" @click="regresar">
                    Cancelar
                </v-btn>

                <v-btn
                    color="success"
                    type="submit"
                    :loading="processing"
                    prepend-icon="mdi-check"
                >
                    Registrar Empleado
                </v-btn>
                </div>

            </v-col>
            </v-row>
        </v-form>

        </v-container>
    </AppLayout>
</template>



<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

const form = ref({
    nombre: '',
    telefono_contacto: '',
    email_contacto: '',
    calle: '',
    numero: '',
    colonia: '',
    codigo_postal: '',
    ciudad: '',
    estado: '',
    pais: 'Mexico',
    area_departamento: '',
});

const errors = ref({});
const processing = ref(false);

const submit = () => {
    processing.value = true;
    errors.value = {};
    
    router.post('/empleados', form.value, {
        onSuccess: () => {
        processing.value = false;
        },
        onError: (err) => {
        errors.value = err;
        processing.value = false;
        },
    });
};

const regresar = () => {
    router.get('/empleados');
};
</script>
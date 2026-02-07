<template>
    <AppLayout>
        <v-container fluid>

        <!-- HEADER -->
        <v-row justify="center" class="mb-4">
            <v-col cols="12" md="9">
                <div class="d-flex align-center gap-2">
                    <v-icon color="primary">mdi-account-edit</v-icon>
                <div>
                    <div class="text-h6 font-weight-bold">
                        Editar Empleado
                    </div>
                        <div class="text-body-2 text-grey">
                            {{ empleado.nombre }}
                            {{ empleado.apellido_paterno }}
                            {{ empleado.apellido_materno }}
                        </div>
                    </div>
                    <v-col cols="12" md="10" class="text-right">
                        <v-btn
                            variant="tonal"
                            color="purple"
                            prepend-icon="mdi-arrow-left"
                            @click="regresar"
                        >
                            Volver
                    </v-btn>
                    </v-col>
                </div>
            </v-col>
        </v-row>

        <v-form @submit.prevent="submit">

            <v-row justify="center">
            <v-col cols="12" md="9">

                <!-- INFORMACIÓN PERSONAL -->
                <div class="text-subtitle-1 font-weight-medium mb-2 text-primary">
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
                <div class="text-subtitle-1 font-weight-medium mt-6 mb-2 text-primary">
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
                <div class="text-subtitle-1 font-weight-medium mt-6 mb-2 text-primary">
                Dirección
                </div>
                <v-divider class="mb-4" />

                <v-row dense>
                <v-col cols="12" md="6">
                    <v-text-field
                    v-model="form.calle"
                    label="Calle"
                    :error-messages="errors.calle"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="2">
                    <v-text-field
                    v-model="form.numero"
                    label="Número"
                    :error-messages="errors.numero"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="4">
                    <v-text-field
                    v-model="form.colonia"
                    label="Colonia"
                    :error-messages="errors.colonia"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                    v-model="form.codigo_postal"
                    label="C.P."
                    :error-messages="errors.codigo_postal"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                    v-model="form.ciudad"
                    label="Ciudad"
                    :error-messages="errors.ciudad"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                    v-model="form.estado"
                    label="Estado"
                    :error-messages="errors.estado"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                    v-model="form.pais"
                    label="País"
                    :error-messages="errors.pais"
                    density="compact"
                    variant="outlined"
                    />
                </v-col>
                </v-row>

                <!-- BOTONES -->
                <div class="d-flex justify-end mt-6 gap-3">
                <v-btn
                    variant="text"
                    @click="regresar"
                >
                    Cancelar
                </v-btn>

                <v-btn
                    color="primary"
                    type="submit"
                    :loading="processing"
                >
                    Guardar Cambios
                </v-btn>
                </div>

            </v-col>
            </v-row>
        </v-form>

        </v-container>
    </AppLayout>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

const props = defineProps({
    empleado: Object,
});

const form = ref({
    nombre: props.empleado.nombre,
    apellido_paterno: props.empleado.apellido_paterno,
    apellido_materno: props.empleado.apellido_materno,
    telefono_contacto: props.empleado.telefono_contacto,
    email_contacto: props.empleado.email_contacto,
    calle: props.empleado.calle,
    numero: props.empleado.numero,
    colonia: props.empleado.colonia,
    codigo_postal: props.empleado.codigo_postal,
    ciudad: props.empleado.ciudad,
    estado: props.empleado.estado,
    pais: props.empleado.pais,
    area_departamento: props.empleado.area_departamento,
    puesto: props.empleado.puesto,
    fecha_ingreso: props.empleado.fecha_ingreso,
});

const errors = ref({});
const processing = ref(false);

const submit = () => {
    processing.value = true;
    errors.value = {};
    
    router.put(`/empleados/${props.empleado.id}`, form.value, {
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
}
</script>
<template>
    <v-app>
        <!-- Barra de navegacion -->
        <v-app-bar color="primary" density="compact">
            <v-app-bar-title>
                <v-icon icon="mdi-duck" class="mr-2"></v-icon>
                Sistema de Empleados - Patito S.A.
            </v-app-bar-title>

            <template v-if="$page.props.auth.user">
                <v-btn 
                    prepend-icon="mdi-view-dashboard" 
                    variant="text"
                    @click="dashboard"
                >
                Dashboard
                </v-btn>
                <v-btn 
                    prepend-icon="mdi-account-multiple" 
                    variant="text"
                    @click="empleados"
                    >
                Empleados
                </v-btn>
                
                <v-spacer></v-spacer>
                
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-btn variant="text" v-bind="props">
                        <v-icon icon="mdi-account-circle" class="mr-2"></v-icon>
                        {{ 
                            $page.props.auth.user.empleado.nombre 
                        + ' '
                        + $page.props.auth.user.empleado.apellido_paterno
                        + ' '
                        + $page.props.auth.user.empleado.apellido_materno
                        }}
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item @click="logout">
                        <v-list-item-title>
                            <v-icon icon="mdi-logout" class="mr-2"></v-icon>
                            Cerrar Sesi&oacute;n
                        </v-list-item-title>
                        </v-list-item>
                    </v-list>
                    </v-menu>
            </template>
        </v-app-bar>

        <!-- Contenido principal -->
        <v-main>
            <v-container fluid class="pa-6">
                <slot />
            </v-container>
        </v-main>

        <!-- Pie de página -->
        <v-footer app color="grey-lighten-3" class="text-center">
            <v-container>
                <span class="text-caption">© 2024 Patito S.A. de C.V. - Sistema de Gesti&oacute;n de Empleados - Autor: Luis Miguel Conde</span>
            </v-container>
        </v-footer>
    </v-app>
</template>

<script setup>

import { router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const page = usePage()

const logout = () => {
    router.post('/logout', {}, {
        onFinish: () => {
            window.location.href = '/login';
        }
    });
};

const dashboard = () => {
    router.get('/dashboard');
}

const empleados = () => {
    router.get('/empleados');
}

</script>
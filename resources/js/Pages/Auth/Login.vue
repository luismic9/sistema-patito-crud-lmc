<template>
	<v-container
		fluid
		class="d-flex align-center justify-center"
		style="min-height: 100vh; background: linear-gradient(135deg, #1976d2, #0d47a1);"
	>
    <v-row justify="center" class="w-100">
		<v-col cols="12" sm="8" md="5" lg="4">

			<v-card elevation="12" rounded="xl" class="pa-4">

			<!-- HEADER -->
			<v-card-text class="text-center pt-6">
				<v-avatar size="64" color="primary" class="mb-3 elevation-4">
				<v-icon size="34" color="white">
					mdi-duck
				</v-icon>
				</v-avatar>

				<div class="text-h5 font-weight-bold mb-1">
				Patito S.A
				</div>
				<div class="text-body-2 text-medium-emphasis">
				Bienvenido de nuevo
				</div>
			</v-card-text>

			<v-divider class="my-2" />

			<!-- ERROR -->
			<v-card-text v-if="errorMessage" class="pb-0">
				<v-alert
				type="error"
				variant="tonal"
				density="comfortable"
				icon="mdi-alert-circle-outline"
				>
				{{ errorMessage }}
				</v-alert>
			</v-card-text>

			<!-- FORM -->
			<v-card-text>
				<v-form @submit.prevent="submit">
				<v-text-field
					v-model="form.email"
					label="Correo electrónico"
					type="email"
					prepend-inner-icon="mdi-email-outline"
					:error-messages="errors.email"
					density="comfortable"
					variant="outlined"
					hide-details="auto"
					class="mb-3"
				/>

				<v-text-field
					v-model="form.contrasenia"
					label="Contraseña"
					type="password"
					prepend-inner-icon="mdi-lock-outline"
					:error-messages="errors.contrasenia"
					density="comfortable"
					variant="outlined"
					hide-details="auto"
					class="mb-4"
				/>

				<v-btn
					type="submit"
					color="primary"
					size="large"
					block
					class="text-none font-weight-medium"
					:loading="processing"
					:disabled="!form.email || !form.contrasenia"
					prepend-icon="mdi-login"
				>
					Iniciar sesi&oacute;n
				</v-btn>
				</v-form>
			</v-card-text>

			<v-divider class="my-2" />

			<v-card-text class="text-center text-caption text-medium-emphasis">
				© {{ new Date().getFullYear() }} Patito S.A. | Autor: Luis Miguel Conde
			</v-card-text>

			</v-card>

		</v-col>
		</v-row>
	</v-container>
</template>


<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
    errors: Object
});

defineOptions({
  	layout: null,
})

const form = ref({
  	email: '',
  	contrasenia: '',
})

const processing = ref(false)
const errors = ref({})
const generalError = ref('')

const errorMessage = computed(() => {
	if (generalError.value) return generalError.value
	if (Object.keys(errors.value).length) {
		return 'Credenciales de acceso invalidas.'
	}
	return ''
})

const submit = () => {
	errors.value = {}
	generalError.value = ''

	// Validación de campos vacíos
	if (!form.value.email) {
		errors.value.email = 'El correo es obligatorio'
	}

	if (!form.value.contrasenia) {
		errors.value.contrasenia = 'La contraseña es obligatoria'
	}

	// Si hay errores, no hay porque continuar
	if (Object.keys(errors.value).length > 0) {
		return
	}

	processing.value = true

	router.post('/login', form.value, {
		onFinish: () => {
		processing.value = false
		},
		onError: (err) => {
		errors.value = err || {}
		generalError.value = 'Credenciales de acceso invalidas.'
		},
	})
}

</script>

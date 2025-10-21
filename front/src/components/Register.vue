<template>
    <v-form @submit='useRegisterForm'>
        <section class='name'>
            <p>Registrarse</p>
        </section>
        <v-text-field
            class='input-with-margin-bottom'
            prepend-inner-icon='mdi-email'
            label='Correo electrónico'
            hint='Introduce tu correo electrónico'
            name='userEmail'
            :rules='[requiredRule, validEmailRule]'
        />
        <v-text-field
            class='input-with-margin-bottom'
            prepend-inner-icon='mdi-account'
            label='Nombre de usuario'
            hint='Introduce tu nombre de usuario'
            name='userName'
            :rules='[requiredRule, validUserNameRule]'
        />
        <v-text-field
            prepend-inner-icon='mdi-key-variant'
            label='Contraseña'
            hint='Introduce tu contraseña'
            name='userPassword'
            type='password'
            :rules='[requiredRule, validUserPasswordRule]'
        />
        <v-file-input label='Foto de perfil (Opcional)'/>
        <div class='bottom'>
            <v-btn 
                type='submit'
                :loading='authStore.loading'
            >
                Registrarse
            </v-btn>
            <p>¿Ya tienes una cuenta? <span @click="router.push('/login')">Inicia sesión</span></p>
            <p>{{ authStore.registerSuccessMessage }}</p>
            <p>{{ authStore.registerErrorMessage }}</p>
        </div>
    </v-form>
</template>
<script setup lang='ts'>
// Vue
import { Router, useRouter } from 'vue-router'

// Stores
import { useAuthStore } from '@/stores/auth'

// Composables
import { useValidateForm } from '@/composables/auth/useValidateForm'
import { useRegisterForm } from '@/composables/auth/useRegisterForm'

const authStore = useAuthStore()

const { requiredRule, validEmailRule, validUserNameRule, validUserPasswordRule } = useValidateForm()

const router: Router = useRouter()



</script>
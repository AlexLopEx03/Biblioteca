<template>
    <v-form @submit='handleLoginForm'>
        <section class='name'>
            <p>Iniciar sesión</p>
        </section>
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
        <div class='bottom'>
            <v-btn 
                type='submit'
                :loading='authStore.loading'
            >
                Iniciar sesión
            </v-btn>
            <p>¿No tienes una cuenta? <span @click="router.push('/register')">Regístrate</span></p>
            <p>{{ authStore.loginErrorMessage }}</p>
        </div>
    </v-form>
</template>
<script setup lang='ts'>
// Vue
import { type Router, useRouter } from 'vue-router'

// Stores
import { useAuthStore } from '@/stores/auth'

// Composables
import { useValidateForm } from '@/composables/auth/useValidateForm'
import { useLoginForm } from '@/composables/auth/useLoginForm'

const authStore = useAuthStore()

const { requiredRule, validUserNameRule, validUserPasswordRule } = useValidateForm()

const router: Router = useRouter()

const handleLoginForm = async (event: SubmitEvent) => {
    event.preventDefault()
    await useLoginForm(event, router)
}

</script>
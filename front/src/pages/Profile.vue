<template>
    <main class='profile'>
        <Navbar />
        <v-card class='profile-data' v-if='!profileStore.updateForm'>
            <h2>Perfil de usuario</h2>
            <br>
            <img :src="`http://localhost:80${profileStore.userImage}`"/>
            <p>Nombre de usuario: {{ profileStore.userName }}</p>
            <p>Correo electrónico: {{ profileStore.userEmail }}</p>
            <br>
            <v-btn @click='profileStore.updateForm = !profileStore.updateForm' theme='light'>Actualizar perfil</v-btn>
            <br>
            <v-btn @click='handleLogout(router)'>Cerrar sesión</v-btn>
        </v-card>
        <v-card class='update-form' v-if='profileStore.updateForm'>
            <v-form>
                <h2>Actualizar usuario</h2>
                <v-text-field 
                    label='Correo electrónico' 
                    :value="profileStore.userEmail" 
                    prepend-inner-icon='mdi-email'
                    :rules='[requiredRule, validEmailRule]'
                />
                <v-text-field 
                    label='Nombre de usuario' 
                    :value="profileStore.userName" 
                    prepend-inner-icon='mdi-account'
                    :rules='[requiredRule, validUserNameRule]'
                />
                <v-file-input label='Nueva imágen de perfil'/>
                <v-btn @click='profileStore.updateForm = !profileStore.updateForm'>Cancelar</v-btn>
                <v-btn type='submit' theme='light'>Actualizar usuario</v-btn>
            </v-form>
        </v-card>
    </main>
</template>
<script setup lang='ts'>
// Vue
import { onMounted } from 'vue'
import { useRouter, type Router } from 'vue-router'

// Styles
import '@/styles/Profile.css'

// Composables
import { useValidateForm } from '@/composables/auth/useValidateForm'

// Components
import Navbar from '@/components/Navbar.vue'

// Stores
import { useProfileStore } from '@/stores/profile'
import { useAuthStore } from '@/stores/auth'

const profileStore = useProfileStore()
const authStore = useAuthStore()

onMounted(async () => {
    await profileStore.getProfileData()
})

const { requiredRule, validEmailRule, validUserNameRule } = useValidateForm()

const router: Router = useRouter()

const handleLogout = async (router: Router) => {
    await authStore.logout()
    router.push('/login')
}

</script>
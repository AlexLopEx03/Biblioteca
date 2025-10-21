<template>
    <nav class='navbar'>
        <span @click="router.push('/home')" v-show='!auth.authenticated' class='logo'>Home</span>
        <span @click="router.push('/login')" v-show='!auth.authenticated'>Login</span>
        <span @click="router.push('/register')" v-show='!auth.authenticated'>Register</span>
        <span @click="router.push('/dashboard')" v-show='auth.authenticated'>Dashboard</span>
        <v-icon @click="router.push('/profile')" v-show='auth.authenticated' size='50'>mdi-account-circle</v-icon>
    </nav>
</template>
<script setup lang='ts'>
// Vue
import { Router, useRouter } from 'vue-router'

// Stores
import { useAuthStore } from '@/stores/auth'

const router: Router = useRouter()

const auth = useAuthStore()

</script>
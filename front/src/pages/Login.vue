<template>
    <main class='login'>
        <Navbar />
        <Login />
    </main>
</template>
<script setup lang='ts'>
// Styles
import '@/styles/Login.css'

// Components
import Login from '@/components/Login.vue'
import Navbar from '@/components/Navbar.vue'

</script>
<template>
    <main class='home'>
        <Navbar />
        <SearchBar />
        <Books />
    </main>
</template>
<script setup lang='ts'>
// Styles
import '@/styles/Home.css'

// Components
import Navbar from '@/components/Navbar.vue'
import SearchBar from '@/components/SearchBar.vue'
import Books from '@/components/Books.vue'

</script>
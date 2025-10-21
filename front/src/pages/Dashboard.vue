<template>
    <main class='dashboard'>
        <Navbar />
        <SearchBar />
        <Books />
    </main>
</template>
<script setup lang='ts'>
// Vue
import { onMounted } from 'vue'

// Styles
import '@/styles/Dashboard.css'

// Components
import Navbar from '@/components/Navbar.vue'
import Books from '@/components/Books.vue'
import SearchBar from '@/components/SearchBar.vue'

// Stores
import { useBookStore } from '@/stores/books'
import { useAuthStore } from '@/stores/auth'

const bookStore = useBookStore()
const authStore = useAuthStore()

onMounted(async () => {
    if(authStore.authenticated){
        await bookStore.getAllUserBooks()
    }else{
        await bookStore.getAllBooks()
    }
})

</script>
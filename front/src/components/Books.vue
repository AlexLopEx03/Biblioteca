<template>
    <div class='books'>
        <Book
            v-for="book in bookStore.books"
            :key="book.id"
            :book="book"
        />
    </div>
</template>
<script setup lang='ts'>
// Vue
import { onMounted } from 'vue'

// Stores
import { useBookStore } from '@/stores/books'
import { useAuthStore } from '@/stores/auth'

// Components
import Book from '@/components/Book.vue'


const bookStore = useBookStore()
const authStore = useAuthStore()

onMounted(async () => {
    if(authStore.authenticated){
        await bookStore.getAllUserBooks()
    }else{
        
    }
})

</script>
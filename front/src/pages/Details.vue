<template>
    <main class='details'>
        <Navbar />
        <v-card class='book-details' v-if='book'>
            <p>Título: {{ book.title }}</p>
            <img 
                :src="book.image"
                @error="event => event.target.src = 'https://upload.wikimedia.org/wikipedia/commons/3/36/Open_bible_01_01.svg'"
            />
            <p>{{ book.description }}</p>
            <br/>
            <p>Categoría: {{ book.category }}</p>
            <p>Autor: {{ book.author }}</p>
            <p>Año: {{ book.year }}</p>
            <p>url: <a :href="book.url">{{ book.url }}</a></p>
            <p>Visitas: {{ book.visits ?? 0 }}</p>
            <p>{{ bookStore.likes }} Me gusta <v-icon>mdi-thumb-up</v-icon></p>
            <v-btn @click='bookStore.addBookLike({ bookId: Number(route.query.book) })' v-show='authStore.authenticated'>Añadir me gusta</v-btn>
        </v-card>
    </main>
</template>
<script setup lang='ts'>
// Vue
import { computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'

// Components
import Navbar from '@/components/Navbar.vue'

// Stores
import { useBookStore } from '@/stores/books'
import { useAuthStore } from '@/stores/auth'

const bookStore = useBookStore()
const authStore = useAuthStore()

const route = useRoute()

const book = computed(() => {
    return bookStore.books.find((book) => book.id == route.query.book)
})

onMounted(async () => {
    bookStore.likes = 0
    await bookStore.getAllBooks()
    await bookStore.addBookVisit({ bookId: Number(route.query.book) })
    await bookStore.getBookLikes({ bookId: Number(route.query.book) })
})
</script>
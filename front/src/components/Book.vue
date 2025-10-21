<template>
    <v-card class='book' @click="router.push(`/details?book=${book.id}`)" elevation='24'>
        <p>{{ book.title }}</p>
        <img 
            :src="book.image"
            @error="event => event.target.src = 'https://upload.wikimedia.org/wikipedia/commons/3/36/Open_bible_01_01.svg'"
        />
        <p>{{ book.description }}</p>
    </v-card>
</template>
<script setup lang='ts'>
// Vue
import { type Router, useRouter } from 'vue-router'

interface Book{
    id: string,
    user_id: number,
    title: string,
    description: string,
    author: string,
    image: string,
    category: string,
    url: string,
    year: string | number
    visits: number
}

const props = defineProps<{
    book: Book
}>()

const router: Router = useRouter()

</script>
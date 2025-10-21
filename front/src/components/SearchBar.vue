<template>
    <div class='search-bar'>
        <v-text-field
            label='Buscador de libros'
            prepend-inner-icon='mdi-magnify'
            @input='useSearchBar'
        />
    </div>
</template>
<script setup lang='ts'>
import { useSearchBar } from '@/composables/books/useSearchBar';

</script>
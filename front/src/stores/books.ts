import { defineStore } from 'pinia'

// Stores
import BooksService from '@/services/books'

export const useBookStore = defineStore('book', {
    state: () => ({
        books: [],
        likes: 0
    }),
    actions: {
        async getAllBooks(){
            const response: { books: Object[], message: string, success: boolean, status: number } = await BooksService.getAllBooks()
            if(response.success){
                this.books = response.books
            }
        },
        async getAllUserBooks(){
            const response: { books: Object[], message: string, success: boolean, status: number } = await BooksService.getAllUserBooks()
            if(response.success){
                this.books = response.books
            }
        },
        async addBookVisit({ bookId }: { bookId: number }){
            await BooksService.addBookVisit({ bookId })
        },
        async getBookLikes({ bookId }: { bookId: number }): Promise<{ likes: number }>{
            const response: { likes: number, message: string, success: boolean, status: number } = await BooksService.getBookLikes({ bookId })
            this.likes = response.likes
            return {
                likes: response.likes
            }
        },
        async addBookLike({ bookId }: { bookId: number }): Promise<void>{
            const response: { message: string, success: boolean, status: number } = await BooksService.addBookLike({ bookId })
        },
        async searchBooks({ text }: { text: string }): Promise<void>{
            const bookStore = useBookStore()
            const response: { sugestedBooks: Object[], message: string, success: boolean, status: number } = await BooksService.searchBooks({ text })
            if(response.success){
                bookStore.books = response.sugestedBooks
            }else{
                console.warn('Error searching books')
            }
        }
    }
})
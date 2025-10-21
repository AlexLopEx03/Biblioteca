import api from '@/services/axios'

import { type AxiosResponse } from 'axios'

const ENDPOINT: string = '/book'

class BooksService{
    getAllBooks = async (): Promise<{ books: Object[], message: string, success: boolean, status: number }> => {
        const response: AxiosResponse<{ books: Object[], message: string, success: boolean }> = await api.get(`${ENDPOINT}/getAllBooks`)
        return {
            books: response.data.books,
            message: response.data.message,
            success: response.data.success,
            status: response.status
        }
    }
    getAllUserBooks = async (): Promise<{ books: Object[], message: string, success: boolean, status: number }> => {
        const response: AxiosResponse<{ books: Object[], message: string, success: boolean }> = await api.get(`${ENDPOINT}/getAllUserBooks`)
        return {
            books: response.data.books,
            message: response.data.message,
            success: response.data.success,
            status: response.status
        }
    }
    addBookVisit = async ({ bookId }: { bookId: number }): Promise<void> => {
        await api.post(`${ENDPOINT}/addBookVisit`, {
            bookId: bookId
        })
    }
    searchBooks = async ({ text }: { text: string }): Promise<{ sugestedBooks: Object[], message: string, success: boolean, status: number }> => {
        const response: AxiosResponse<{ sugestedBooks: Object[], message: string, success: boolean }> = await api.post(`${ENDPOINT}/searchBooks`, {
            text: text
        })
        return {
            sugestedBooks: response.data.sugestedBooks,
            message: response.data.message,
            success: response.data.success,
            status: response.status
        }
    }
    getBookLikes = async ({ bookId }: { bookId: number }): Promise<{ likes: number, message: string, success: boolean, status: number }> => {
        const response: AxiosResponse<{ likes: number, message: string, success: boolean }> = await api.post(`${ENDPOINT}/getBookLikes`, {
            bookId: bookId
        })
        return {
            likes: response.data.likes,
            message: response.data.message,
            success: response.data.success,
            status: response.status
        }
    }
    addBookLike = async ({ bookId }: { bookId: number }): Promise<{ message: string, success: boolean, status: number }> => {
        const response: AxiosResponse<{ message: string, success: boolean }> = await api.post(`${ENDPOINT}/addBookLike`, {
            bookId: bookId
        })
        return {
            message: response.data.message,
            success: response.data.success,
            status: response.status
        }
    }
}

export default new BooksService()
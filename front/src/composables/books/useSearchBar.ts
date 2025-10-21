// Stores
import { useBookStore } from '@/stores/books'

export const useSearchBar = async (event: InputEvent): Promise<void> => {
    const bookStore = useBookStore()
    const response = await bookStore.searchBooks({ text: event.target.value })
    console.log(response)
}
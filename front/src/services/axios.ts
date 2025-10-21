import axios, { type AxiosInstance, type InternalAxiosRequestConfig } from 'axios'

const API_URL: string = import.meta.env.VITE_API_URL || 'http://localhost/biblioteca/api'

const api: AxiosInstance = axios.create({
    baseURL: API_URL,
    withCredentials: true,
    headers: {
        'Content-Type': 'application/json'
    },
    validateStatus: (status: number) => {
        return (status >= 200 && status < 300) || status === 400 || status === 401 || status === 404 || status === 409 || status === 422
    },
    timeout: 8000
})

api.interceptors.request.use((config: InternalAxiosRequestConfig): InternalAxiosRequestConfig => {
    if(config.url && !config.url.endsWith('.php')){
        config.url += '.php'
    }
    return config
})

// api.interceptors.request.use((config: InternalAxiosRequestConfig) => {
//     config.headers.Authorization = `Bearer ${localStorage.getItem('token')}`
//     return config
// })

export default api
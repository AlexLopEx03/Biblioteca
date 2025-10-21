import api from '@/services/axios'

import { type AxiosResponse } from 'axios'

const ENDPOINT: string = '/auth'

class AuthService{
    checkAuth = async (): Promise<boolean> => {
        const response: AxiosResponse<{ message: string, success: boolean }> = await api.get(`${ENDPOINT}/checkAuth`)
        return response.data.success
    }
    login = async (
        { userName, userPassword }: { userName: string, userPassword: string }
    ): Promise<{ message: string, success: boolean, status: number }> => {
        const response: AxiosResponse<{ message: string, success: boolean }> = await api.post(`${ENDPOINT}/login`, {
            userName: userName,
            userPassword: userPassword
        })
        return {
            message: response.data.message,
            success: response.data.success,
            status: response.status
        }
    }
    register = async ({ userName, userPassword, userEmail }: { userName: string, userPassword: string, userEmail: string }): Promise<{ message: string, success: boolean, status: number }> => {
        const response: AxiosResponse<{ message: string, success: boolean }> = await api.post(`${ENDPOINT}/register`, {
            userName: userName,
            userPassword: userPassword,
            userEmail: userEmail
        })
        return {
            message: response.data.message,
            success: response.data.success,
            status: response.status
        }
    }
    logout = async (): Promise<{ message: string, success: boolean, status: number }> => {
        const response: AxiosResponse<{ message: string, success: boolean, status: number }> = await api.delete(`${ENDPOINT}/logout`)
        return {
            message: response.data.message,
            success: response.data.success,
            status: response.status
        }
    }
}

export default new AuthService()
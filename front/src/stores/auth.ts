// Vue
import { defineStore } from 'pinia'

// Services
import AuthService from '@/services/auth'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authenticated: !!localStorage.getItem('authenticated'),
        loading: false,

        loginSuccess: false,
        loginSuccessMessage: null,
        loginError: false,
        loginErrorMessage: null,
        
        registerSuccess: false,
        registerSuccessMessage: null,
        registerError: false,
        registerErrorMessage: null,
    }),
    actions: {
        async checkAuth(){
            if(await AuthService.checkAuth()){
                localStorage.setItem('authenticated', 'true')
            }else{
                localStorage.removeItem('authenticated')
            }
        },
        async login(
            { userName, userPassword }: { userName: string, userPassword: string }
        ): Promise<{ message: string, success: boolean, status: number }>{
            const response: { message: string, success: boolean, status: number } = await AuthService.login({ userName, userPassword })
            if(response.success){
                localStorage.setItem('authenticated', 'true')
            }
            return {
                message: response.message,
                success: response.success,
                status: response.status
            }
        },
        async register(
            { userName, userPassword, userEmail }: { userName: string, userPassword: string, userEmail: string }
        ): Promise<{ message: string, success: boolean, status: number }>{
            const response: { message: string, success: boolean, status: number } = await AuthService.register({ userName, userPassword, userEmail })
            return {
                message: response.message,
                success: response.success,
                status: response.status
            }
        },
        async logout(): Promise<boolean>{
            const response: { message: string, success: boolean, status: number } = await AuthService.logout()
            this.authenticated = false
            localStorage.removeItem('authenticated')
            return response.success
        },
        resetState(): void{
            this.loginSuccess = false
            this.loginSuccessMessage = null
            this.loginError = false
            this.registerErrorMessage = null

            this.registerSuccess = false
            this.registerSuccessMessage = null
            this.registerError = false
            this.registerErrorMessage = null
        }
    }
})
// Vue
import { Router } from 'vue-router'

// Stores
import { useAuthStore } from '@/stores/auth'

export const useLoginForm = async (event: SubmitEvent, router: Router): Promise<void> => {
    event.preventDefault()
    const auth = useAuthStore()
    auth.resetState()
    auth.loading = true
    try{
        const formData: FormData = new FormData(event.target as HTMLFormElement)
        const data: { userName: string, userPassword: string } = {
            userName: formData.get('userName').toString() || '',
            userPassword: formData.get('userPassword').toString() || ''
        }
        const { userName, userPassword } = data

        const { message, success, status } = await auth.login({ userName, userPassword })
        if(success){
            auth.loginSuccess = true
            router.push('/dashboard')
        }else{
            auth.loginError = true
            console.warn(`${message}`)
            if(status === 409 || status === 422){
                auth.loginErrorMessage = 'Error al iniciar sesión, los datos no son válidos'
            }
        }
    }catch(error){
        console.error(`Unexpected error at useloginForm: ${error}`)
    }finally{
        auth.loading = false
    }
}
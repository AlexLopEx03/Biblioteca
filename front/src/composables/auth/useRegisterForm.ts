// Stores
import { useAuthStore } from '@/stores/auth'

export const useRegisterForm = async (event: SubmitEvent): Promise<void> => {
    event.preventDefault()
    const auth = useAuthStore()
    auth.resetState()
    auth.loading = true
    try{
        const formData: FormData = new FormData(event.target as HTMLFormElement)
        const data: { userName: string, userPassword: string, userEmail: string } = {
            userName: formData.get('userName').toString() || '',
            userPassword: formData.get('userPassword').toString() || '',
            userEmail: formData.get('userEmail').toString() || ''
        }
        const { userName, userPassword, userEmail } = data

        const { message, success, status } = await auth.register({ userName, userPassword, userEmail })
        if(success){
            auth.registerSuccess = true
            auth.registerSuccessMessage = 'Se ha registrado con éxito'
        }else{
            auth.registerError = true
            console.warn(`${message}`)
            if(status === 409 || status === 422){
                auth.registerErrorMessage = 'Error en el registro, los datos no son válidos'
            }
            // if(status === 409){
            //     auth.registerErrorMessage = 'Error en el registro, el usuario ya existe'
            // }else if(status === 422){
            //     auth.registerErrorMessage = 'Error en el registro, los datos no son válidos'
            // }
        }
    }catch(error){
        console.error(`Unexpected error at useRegisterForm: ${error}`)
    }finally{
        auth.loading = false
    }
}
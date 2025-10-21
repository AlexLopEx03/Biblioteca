export const useValidateForm = () => {
    const requiredRule = (value: string): boolean | string => {
        return !!value || 'Campo obligatorio'
    }
    const validEmailRule = (value: string): boolean | string => {
        return /^[a-zA-Z0-9._%+-Ññ]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value) || 'Formato de correo inválido'
    }
    const validUserNameRule = (value: string): boolean | string => {
        if(value.length < 2 || value.length > 20) return 'Debe contener entre 2 y 20 caracteres'
        if(!/^[a-zA-Z0-9_Ññ]+$/.test(value)) return 'Solo se permiten letras, números y guiones bajos'
        return true
    }
    const validUserPasswordRule = (value: string): boolean | string => {
        if(value.length < 8) return 'Longitud mínima de 8 caracteres'
        if(value.length > 64) return 'Longitud máxima de 64 caracteres'
        if(!/[a-zñ]/.test(value)) return 'Debe contener almenos una letra minúscula'
        if(!/[A-ZÑ]/.test(value)) return 'Debe contener almenos una letra mayúscula'
        if(!/[0-9]/.test(value)) return 'Debe contener al menos un número'
        if(!/[^a-zA-Z0-9]/.test(value)) return 'Debe contener almenos un caracter especial'
        if(/\s/.test(value)) return 'No se admiten espacios en blanco'
        return true
    }
    return { requiredRule, validEmailRule, validUserNameRule, validUserPasswordRule }
}
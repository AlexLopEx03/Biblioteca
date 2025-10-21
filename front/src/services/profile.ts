import api from '@/services/axios'

import { type AxiosResponse } from 'axios'

const ENDPOINT: string = '/profile'

class ProfileService{
    async getProfileData(): Promise<{ userName: string, userEmail: string, userImage: string, message: string, success: boolean, status: number }>{
        const response: AxiosResponse<{ userName: string, userEmail: string, userImage: string, message: string, success: boolean }> = await api.get(`${ENDPOINT}/getProfileData`)
        return {
            userName: response.data.userName,
            userEmail: response.data.userEmail,
            userImage: response.data.userImage,
            message: response.data.message,
            success: response.data.success,
            status: response.status
        }
    }
    async updateProfile({  }){

    }
}

export default new ProfileService()
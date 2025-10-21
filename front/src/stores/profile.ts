import { defineStore } from 'pinia'

// Services
import ProfileService from '@/services/profile'

export const useProfileStore = defineStore('profile', {
    state: () => ({
        userName: null,
        userEmail: null,
        userImage: null,

        updateForm: false
    }),
    actions: {
        async getProfileData(): Promise<void>{
            const response = await ProfileService.getProfileData()
            this.userName = response.userName
            this.userEmail = response.userEmail
            this.userImage = response.userImage
        },
        async updateProfile({ userEmail, userName }: { userEmail: string, userName: string }){
            
        }
    }
})
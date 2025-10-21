// Vue
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createRouter, createWebHistory, type Router } from 'vue-router'

// Components
import App from '@/App.vue'

// Stores
import { useAuthStore } from '@/stores/auth'

// Styles
import '@/styles/App.css'

// Vuetify
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const app = createApp(App)

app.use(createPinia())

const auth = useAuthStore()

const router: Router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: () => {
                return auth.authenticated ? '/dashboard' : '/home'
            }
        },
        {
            path: '/home',
            component: () => import('@/pages/Home.vue')
        },
        {
            path: '/login',
            component: () => import('@/pages/Login.vue')
        },
        {
            path: '/register',
            component: () => import('@/pages/Register.vue')
        },
        {
            path: '/details',
            component: () => import('@/pages/Details.vue')
        },
        {
            path: '/dashboard',
            component: () => import('@/pages/Dashboard.vue')
        },
        {
            path: '/profile',
            component: () => import('@/pages/Profile.vue')
        }
    ]
})
app.use(router)

const vuetify = createVuetify({
	components,
	directives,
	theme: {
		defaultTheme: 'dark'
	}
})
app.use(vuetify)

app.mount('#app')
import axiosClient from '@/axios'
import { defineStore } from 'pinia'
import router from '@/router'

export const userStore = defineStore('storeId', {
    // arrow function recommended for full type inference
    state: () => {
        return {
            user: null,
            token:localStorage.getItem('token') || null,
            // isLogin: false
        }
    },
    getters: {
        isLogin: (state) => !!state.token,   
        userRole:(state)=>state.user?.role || null
    },
    actions: {
        async fetchUser() {
            try {
                    //   localStorage.removeItem("token");
                const userData = await axiosClient.get('api/user')
                console.log("here")
                console.log(userData.data)
                this.user = userData.data.data
                // this.isLogin = true
            } catch (error) {
                console.log(error)
            }

        },
        async login(loginData) {
            try {
                const response = await axiosClient.post('api/login', loginData)

                localStorage.setItem('token', response.data.token)
                this.token=response.data.token

                await this.fetchUser()

                console.log('Logged in user:', this.user)

                router.push({ name: 'home' })
            } catch (error) {
                console.log('Login failed', error.response.data)
                throw error
            }
        },

        logout() {
            axiosClient.get('api/logout')
                .then((response) => {
                    // this.isLogin = false
                    this.user=null
                    this.token=null
                    console.log("Before remove:", localStorage.getItem("token"))
                    localStorage.removeItem("token")
                    console.log("After remove:", localStorage.getItem("token"))
                    router.push({ name: 'login' })
                })
                .catch(error=>{
                    console.log(error)
                })
        }

    }
})

import axios from "axios"

const axiosClient=axios.create({
    // baseURL:'http://localhost:8000',
    baseURL:import.meta.env.VITE_API_BASE_URL
    // withCredentials:true
    // withXSRFToken:true
})

axiosClient.interceptors.request.use((config)=>{
    config.headers.Authorization=`Bearer ${localStorage.getItem('token')}`
    return config
})

export default axiosClient
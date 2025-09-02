import axios from "axios"

const axiosClient=axios.create({
    baseURL:'http://localhost:8000',
    withCredentials:true,
    withXSRFToken:true
})

axiosClient.interceptors.request.use((config)=>{
    config.headers.Authorization=`Bearer ${localStorage.getItem('token')}`
    return config
})

export default axiosClient
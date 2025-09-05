import { defineStore } from "pinia";
import axiosClient from "@/axios";

export const useProductStore=defineStore('product',{
    state:()=>({
        products:[],
        category:[],
        // meta:{},
        links:{},
        loading:false,
        error:null
    }),
    getters:{
        getProductById(state){
            return (id)=>{
                const product=state.products.find((p)=>p.id==id)
                return product || null
            }
        },
         getCategoryById(state){
            return (id)=>{
                const category=state.category.find((p)=>p.id==id)
                return category || null
            }
        }
    },
    actions:{
        async fetchProduct(url='api/product'){
            this.loading=true
            try{
                const resp=await axiosClient.get(url);
                this.products=resp.data.data
                // this.meta=resp.data.meta
                this.links=resp.data.links
            }catch(error){
                this.error=error
            }finally{
                this.loading=false
            }
        },
        async fetchCategory(){
            try{
                const resp=await axiosClient.get("api/category");
                this.category=resp.data.data
                console.log("Category",this.category)
            }catch(error){
                this.error=error
            }
        },
        async fetchProductById(id){
            let product =this.getProductById(id)
            if (!product){
                const resp=await axiosClient.get(`api/product/${id}`)
                product=resp.data.data   
            }
            console.log(product)
            return product
        },

           async fetchCategoryById(id){
            let category =this.getCategoryById(id)
            if (!category){
                const resp=await axiosClient.get(`api/category/${id}`)
                category=resp.data.data
                
            }
            return category
        },
        
    }
})
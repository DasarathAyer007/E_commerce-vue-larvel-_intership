<template>
  <GuestLayout>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-8">
      <h2 class="text-3xl font-bold text-orange-500 text-center mb-6">Sign Up</h2>

      <form class="space-y-4" @submit.prevent="signUp">
        <div>
          <label for="name" class="block text-gray-100 mb-1">Name</label>
          <input
            v-model="formdata.name"
            type="text"
            id="name"
            name="name"
            placeholder="Enter your name"
            class="w-full px-4 py-2 rounded-md bg-gray-100 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
            <p class="text-red-500" >{{ errorMessage.name[0] }}</p>
        </div>

        <div>
          <label for="email" class="block text-gray-100 mb-1">Email</label>
          <input
           v-model="formdata.email"
            type="email"
            id="email"
            name="email"
            placeholder="Enter your email"
            class="w-full px-4 py-2 rounded-md bg-gray-100 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
            <p class="text-red-500" >{{ errorMessage.email[0] }}</p>
        </div>

        <div>
          <label for="password" class="block text-gray-100 mb-1">Password</label>
          <input
           v-model="formdata.password"
            type="password"
            id="password"
            name="password"
            placeholder="Enter your password"
            class="w-full px-4 py-2 rounded-md bg-gray-100 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
            <p class="text-red-500" >{{ errorMessage.password[0] }}</p>
        </div>

        <div>
          <label for="confirm-password" class="block text-gray-100 mb-1">Confirm Password</label>
          <input
           v-model="formdata.password_confirmation"
            type="password"
            id="confirm-password"
            name="confirm-password"
            placeholder="Confirm your password"
            class="w-full px-4 py-2 rounded-md bg-gray-100 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
        </div>

        <button
          type="submit"
          class="w-full py-2 mt-4 bg-orange-500 hover:bg-orange-600 text-black font-semibold rounded-md transition"
        >
          Sign Up
        </button>
      </form>

      <p class="text-gray-100 text-sm mt-4 text-center">
        Already have an account?
        <a href="/login" class="text-orange-500 hover:underline">Login</a>
      </p>
    </div>
  </div>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/layouts/GuestLayout.vue";
import axiosClient from '@/axios';
import { reactive, ref } from 'vue';
import router from "@/router";


const formdata = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const errorMessage = reactive({
  name:[],
  email:[],
  password:[]
})


function signUp(){
    console.log(formdata)
    axiosClient.post('api/signup',formdata.value)
        .then((resp)=>{
            console.log(resp)
            router.push({ name: "login" });
        })
        .catch((error)=>{
          errorMessage.name=error.response.data.errors.name ? error.response.data.errors.name :[]
          errorMessage.email=error.response.data.errors.email ? error.response.data.errors.email :[]
          errorMessage.password=error.response.data.errors.password ? error.response.data.errors.password :[]
          console.log(error.response.data.errors)
          // errorMessage.value=error.response.data.errors
        })

}
</script>
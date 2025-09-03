<template>
  <GuestLayout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
 
      <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-orange-500 text-center mb-6">Login</h2>

        <div
          v-if="errorMessage"
          class="bg-red-600/20 text-red-500 border border-red-500 rounded-md px-4 py-2 mb-4 text-sm font-medium text-center"
        >
          {{ errorMessage }}
        </div>

        <form class="space-y-4" @submit.prevent="submitLogin">
          <div>
            <label for="name" class="block text-gray-100 mb-1">Name</label>
            <input
              v-model="loginData.name"
              type="text"
              id="name"
              name="name"
              placeholder="Enter your name"
              class="w-full px-4 py-2 rounded-md bg-gray-100 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500"
            />
          </div>

          <div>
            <label for="password" class="block text-gray-100 mb-1">Password</label>
            <input
              v-model="loginData.password"
              type="password"
              id="password"
              name="password"
              placeholder="Enter your password"
              class="w-full px-4 py-2 rounded-md bg-gray-100 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500"
            />
          </div>

          <button
            type="submit"
            class="w-full py-2 mt-4 bg-orange-500 hover:bg-orange-600 text-black font-semibold rounded-md transition"
          >
            Login
          </button>
        </form>

        <p class="text-gray-100 text-sm mt-4 text-center">
          Don't have an account?
          <a href="/signup" class="text-orange-500 hover:underline">Sign up</a>
        </p>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import axiosClient from "@/axios";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { ref, reactive, toRaw } from "vue";
import { userStore } from "../stores/user";

const user = userStore();
const loginData = reactive({
  name: "",
  password: "",
});
const errorMessage = ref("");

async function submitLogin() {
  try {
    await user.login(toRaw(loginData));
  } catch (error) {
    console.log("Login failed", error.response.data);
    errorMessage.value = error.response.data.message;
  }
}
</script>

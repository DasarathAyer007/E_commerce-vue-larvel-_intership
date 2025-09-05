<template>
  <main class="bg-gray-100 min-h-screen p-6 space-y-8">
    <!-- Categories Section -->
    <section>
      <h2 class="text-2xl font-bold text-gray-900 mb-4">Categories</h2>
      <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
        <div
          v-for="category in productStore.category"
          :key="category.id"
          class="flex flex-col items-center bg-white rounded-lg shadow p-4 hover:shadow-lg transition"
        >
          <div @click="filterByProduct(category.id)" class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center mb-2 overflow-hidden">
            <img
              v-if="category.image"
              :src="category.image"
              alt="Category Image"
              class="object-cover w-full h-full"
            />
            <span v-else class="text-gray-600 text-sm">No Image</span>
          </div>
          <span class="text-gray-900 font-medium text-center truncate">{{ category.name }}</span>
        </div>
      </div>
    </section>

 
    <section>
      <h2 class="text-2xl font-bold text-gray-900 mb-4">New Products</h2>
      <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
        <div
          v-for="product in productStore.products"
          :key="product.id"
          class="bg-white rounded-lg shadow flex flex-col hover:shadow-lg transition"
        >
          <!-- Product Image & Name -->
          <router-link :to="`/product/${product.id}`" class="flex flex-col items-center p-4">
            <img
              :src="product.image"
              alt="Product Image"
              class="w-40 h-40 object-cover rounded-md mb-2"
            />
            <h3 class="text-lg font-semibold text-gray-900 text-center truncate">{{ product.name }}</h3>
          </router-link>

          <!-- Price & Category -->
          <div class="flex justify-between items-center p-4 border-t border-gray-200">
            <span class="text-orange-500 font-semibold">${{ product.price }}</span>
            <span class="text-gray-700 text-sm truncate">{{ product.category }}</span>
          </div>
        </div>
      </div>
    </section>

<PaginationNavigation/>

  </main>
</template>

<script setup>
import axiosClient from "@/axios";
import { useProductStore } from "@/stores/product";
import PaginationNavigation from "@/components/PaginationNavigation.vue";
import { userStore } from "@/stores/user";
import router from "@/router";
const productStore=useProductStore()

import { onMounted, ref } from "vue";
const products = ref([]);

onMounted(() => {
  productStore.fetchProduct()
  productStore.fetchCategory()
});

function filterByProduct(id){
  router.push(
    {path:'/products',
      query:{
        category:id
      }
    }
  )
}
</script>

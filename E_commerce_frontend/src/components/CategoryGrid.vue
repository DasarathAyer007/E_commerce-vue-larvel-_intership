<template>
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
</template>

<

<script setup>
import { useProductStore } from "@/stores/product";
import router from "@/router";
const productStore=useProductStore()

import { onMounted } from "vue";

onMounted(() => {
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

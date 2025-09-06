<template>
    <section>
 
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

</template>

<script setup>
import { useProductStore } from "@/stores/product";

const productStore=useProductStore()
import { onMounted, ref } from "vue";


onMounted(() => {
  productStore.fetchProduct()
});


</script>
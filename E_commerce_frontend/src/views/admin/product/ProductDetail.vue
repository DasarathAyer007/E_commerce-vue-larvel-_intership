<template>
  <div class="pt-6 bg-gray-100  flex justify-center">
    <!-- Product Card -->
    <div class="w-full max-w-4xl bg-white rounded-lg shadow p-6 flex flex-col md:flex-row gap-6">
      
      <!-- Left Column -->
      <div class="flex flex-col items-center md:items-start md:w-1/3 space-y-4">
        <img
          :src="productData.image"
          alt="Product Image"
          class="h-80 object-cover rounded-md shadow"
        />
        <span class="text-gray-500 text-sm">ID: {{ productData.id }}</span>
      </div>

      <!-- Right Column -->
      <div class="flex-1 flex flex-col justify-between space-y-4">
        <!-- Name & Description -->
        <div>
          <h1 class="text-2xl font-bold text-gray-900">{{ productData.name }}</h1>
          <p class="text-gray-700 mt-2">{{ productData.description }}</p>
          <span class="text-gray-500 mt-1 block">Added by: User Name</span>
        </div>

        <!-- Price & Quantity -->
        <div class="flex items-center gap-6 mt-4">
          <span class="text-lg font-medium text-gray-900">Price: ${{ productData.price }}</span>
          <span class="text-lg font-medium text-gray-900">Quantity: {{ productData.quantity }}</span>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 mt-4">
          <RouterLink :to="`/admin/product/edit/${productData.id}`"
            class="px-4 py-2 bg-orange-500 text-white rounded-md shadow hover:bg-orange-600 transition"
          >
            Edit Product
          </RouterLink>
          <button
            class="px-4 py-2 bg-red-500 text-white rounded-md shadow hover:bg-red-600 transition"
          >
            Delete Product
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import axiosClient from "@/axios";
import { useProductStore } from "@/stores/product";
import { onMounted, reactive, ref } from "vue";
import { useRoute } from "vue-router";
const productStore= useProductStore()
const route = useRoute();
const productId = ref(null);
const productData = ref([])

onMounted(async () => {
  productId.value = route.params.id;
  productData.value=await productStore.fetchProductById(productId.value);
});
</script>

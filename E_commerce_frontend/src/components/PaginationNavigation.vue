<template>
  <section class="pagination flex gap-2 mt-6 w-full justify-center">
    <button
      @click="productStore.fetchProduct(productStore.links.first)"
      :disabled="!productStore.links.first"
      class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed transition"
    >
      First
    </button>

    <button
      @click="productStore.fetchProduct(productStore.links.prev)"
      :disabled="!productStore.links.prev"
      class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed transition"
    >
      Previous
    </button>

    <button
      @click="productStore.fetchProduct(productStore.links.next)"
      :disabled="!productStore.links.next"
      class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed transition"
    >
      Next
    </button>

    <button
      @click="productStore.fetchProduct(productStore.links.last)"
      :disabled="!productStore.links.last"
      class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed transition"
    >
      Last
    </button>
  </section>
</template>


<script setup>
import { useProductStore } from "@/stores/product";
const productStore = useProductStore();
</script>

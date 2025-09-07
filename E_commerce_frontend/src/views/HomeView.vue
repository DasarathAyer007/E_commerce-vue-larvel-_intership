<template>
  <main class="bg-gray-100 min-h-screen p-6 space-y-8">
    <!-- Categories Section -->
    <div v-if="!isAdmin">
      <CategoryGrid/>
      <h2 class="text-2xl font-bold text-gray-900 mb-4">New Products</h2>
      <ProductGrid/>
      <PaginationNavigation/>
    </div>
    <div v-else class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
  <RouterLink 
    to="/admin" 
    class="text-3xl font-bold text-white bg-orange-500 hover:bg-orange-600 px-8 py-4 rounded-lg shadow-lg transition"
  >
    Go To Admin Dashboard
  </RouterLink>
</div>


  </main>
</template>

<script setup>
import PaginationNavigation from "@/components/PaginationNavigation.vue";
import ProductGrid from "@/components/ProductGrid.vue";
import CategoryGrid from "@/components/CategoryGrid.vue";
import { userStore } from "@/stores/user";
import { computed } from "vue";
const user= userStore();
const isAdmin=computed(()=>user.userRole=='admin')

</script>

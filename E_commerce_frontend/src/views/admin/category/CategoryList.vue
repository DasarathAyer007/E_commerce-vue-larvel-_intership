<template>
  <div class="min-h-screen bg-gray-100 p-6">
    <!-- Page Title -->
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Category List</h1>

    <!-- Table Container -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
        <!-- Table Head -->
        <thead class="bg-gray-50">
          <tr>
            <th
              class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider"
            >
              S.N
            </th>
            <th
              class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider"
            >
              Name
            </th>
            <th
              class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider"
            >
              Description
            </th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-gray-200">
          <tr
            v-for="category in productStore.category"
            :key="category.id"
            class="hover:bg-gray-100 transition-colors"
          >
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ category.id }}
            </td>
            <RouterLink :to="`/admin/category/${category.id}`">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ category.name }}
              </td>
            </RouterLink>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ category.description }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { useProductStore } from "@/stores/product";
import { onMounted, ref } from "vue";
const productStore=useProductStore()

onMounted(() => {
  productStore.fetchCategory()
});
</script>

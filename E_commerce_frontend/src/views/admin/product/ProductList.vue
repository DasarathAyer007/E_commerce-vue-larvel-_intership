<template>
  <div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Product List</h1>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full divide-y divide-gray-200">
        <!-- Table Head -->
        <thead class="bg-gray-50">
          <tr>
            <th
              scope="col"
              class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wide"
            >
              S.N
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wide"
            >
              Image
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wide"
            >
              Name
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center text-sm font-semibold text-gray-600 uppercase tracking-wide"
            >
              Price
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center text-sm font-semibold text-gray-600 uppercase tracking-wide"
            >
              Quantity
            </th>
             <th
              scope="col"
              class="px-6 py-3 text-sm text-center font-semibold text-gray-600 uppercase tracking-wide"
            >
              Category
            </th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-gray-200">
          <tr
            v-for="product in products.products"
            :key="product.id"
            class="hover:bg-gray-50 transition"
          >
            <td class="px-6 whitespace-nowrap text-base text-gray-700">
              {{ product.id }}
            </td>
            <td class="px-6 whitespace-nowrap">
              <img
                :src="product.image"
                alt="Product Image"
                class="h-14 "
              />
            </td>
            <RouterLink :to="`/admin/product/${product.id}`">
            <td class="px-6  whitespace-nowrap text-base font-medium text-gray-900">
              {{ product.name }}
            </td></RouterLink>
            <td class="px-6  whitespace-nowrap text-base text-center text-gray-700">
              ${{ product.price }}
            </td>
            <td class="px-6  whitespace-nowrap text-base text-center text-gray-700">
              {{ product.quantity }}
            </td>
              <td class="px-6  whitespace-nowrap text-base text-center text-gray-700">
              {{ product.category }}
            </td>
          </tr>
        </tbody>
      </table>
      
    </div>
    <PaginationNavigation/>
  </div>
</template>

<script setup>
import axiosClient from '@/axios';
import { useProductStore } from '@/stores/product';
import { onMounted, ref } from 'vue';
import PaginationNavigation from '@/components/PaginationNavigation.vue';


const products=useProductStore()

onMounted(()=>{
    products.fetchProduct()
})

</script>
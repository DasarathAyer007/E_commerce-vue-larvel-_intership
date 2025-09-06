<template>
  <div class="min-h-screen flex bg-gray-100">

 

    <!-- Main Content -->
    <main class="flex-1 p-6 space-y-6">

      <h1 class="text-3xl font-bold text-gray-900 mb-4">Dashboard</h1>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Users Card -->
        <div class="bg-white rounded-lg shadow p-6 space-y-2">
          <h2 class="text-lg font-semibold text-gray-900">Users</h2>
          <p class="text-gray-700">Total Users: <span class="font-bold">{{ info.totalUsers }}</span></p>
        </div>

        <!-- Products Card -->
        <div class="bg-white rounded-lg shadow p-6 space-y-2">
          <h2 class="text-lg font-semibold text-gray-900">Products</h2>
          <p class="text-gray-700">Total Products: <span class="font-bold">{{ info.totalProducts }}</span></p>
          <p class="text-gray-700">Products In Stock: <span class="font-bold">{{ info.productsInStock }}</span></p>
          <p class="text-gray-700">Stock Worth: <span class="font-bold">${{ info.stockworth }}</span></p>
        </div>

        <!-- Orders Card -->
        <div class="bg-white rounded-lg shadow p-6 space-y-2">
          <h2 class="text-lg font-semibold text-gray-900">Orders</h2>
          <p class="text-gray-700">Total Orders: <span class="font-bold">{{ info.totalOrders }}</span></p>
          <p class="text-gray-700">Total Items: <span class="font-bold">{{ info.totalOrderItem }}</span></p>
          <p class="text-gray-700">Total Sold Amount: <span class="font-bold">${{ info.totalSoldamount }}</span></p>
        </div>

      </div>

    </main>
  </div>
</template>



<script setup>
import axiosClient from '@/axios';
import SideBar from '@/components/admin/AdminSideBar.vue';
import { onMounted, ref } from 'vue';

const info=ref({})

onMounted(()=>{
    axiosClient.get('api/dashboard-info').then((resp)=>{
        console.log(resp)
        info.value=resp.data
    })
})
</script>
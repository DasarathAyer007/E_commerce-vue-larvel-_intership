<template>
  <main class="bg-gray-100 min-h-screen p-6">
    <h1 class="text-2xl font-bold mb-6">Your Orders</h1>

    <div
      v-for="order in orders"
      :key="order.id"
      class="bg-white rounded-lg shadow p-4 mb-4"
    >
      <!-- Order Summary -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="space-y-1">
          <span class="block text-gray-800 font-semibold">Order Id: {{ order.id }}</span>
          <span>
            Placed on: {{ new Date(order.created_at).toLocaleDateString() }} at
            {{
              new Date(order.created_at).toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
              })
            }}
          </span>
        </div>
        <div class="text-right space-y-1 mt-2 sm:mt-0">
          <span class="block text-lg font-bold text-orange-500"
            >${{ order.total_price }}</span
          >
    <span
            class="px-3 py-1 text-sm rounded-full font-medium"
            :class="{
              'bg-yellow-100 text-yellow-700': order.status === 'pending',
              'bg-blue-100 text-blue-700': order.status === 'processing',
              'bg-indigo-100 text-indigo-700': order.status === 'shipped',
              'bg-green-100 text-green-700': order.status === 'delivered',
              'bg-red-100 text-red-700': order.status === 'cancelled',
            }"
          >
            {{ order.status }}
          </span>
        </div>
      </div>
      <!-- Toggle Items Button -->
      <button
        @click="toggleOrder(order.id)"
        class="text-sm font-medium text-orange-500 hover:text-orange-600 transition"
      >
        {{ openOrders.includes(order.id) ? "Hide Items ▲" : "Show Items ▼" }}
      </button>

      <!-- Order Items -->
      <!-- Order Items -->
      <div v-if="openOrders.includes(order.id)" class="border-t pt-4 space-y-4">
        <div
          v-for="item in order.order_items"
          :key="item.id"
          class="flex items-center justify-between"
        >
          <!-- Left: Image + Name -->
          <div class="flex items-center space-x-4">
            <img
              :src="item.product.image"
              alt="Product Image"
              class="h-16 w-16 object-contain rounded border"
            />
            <span class="font-medium text-gray-800">{{ item.product.name }}</span>
          </div>
          <!-- Right: Price + Qty -->
          <div class="text-right">
            <span class="block text-gray-700">${{ item.product.price }}</span>
            <span class="block text-sm text-gray-500">Qty: {{ item.quantity }}</span>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axiosClient from "@/axios";

const orders = ref([]);
const openOrders = ref([]);
onMounted(() => {
  axiosClient.get("api/order").then((resp) => {
    orders.value = resp.data.data;
  });
});

function toggleOrder(orderId) {
  if (openOrders.value.includes(orderId)) {
    openOrders.value = openOrders.value.filter((id) => id !== orderId);
  } else {
    openOrders.value.push(orderId);
  }
}
</script>

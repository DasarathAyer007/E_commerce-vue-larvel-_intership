<template>
  <main class="bg-gray-100 min-h-screen p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-900">All Orders</h1>

    <div
      v-for="order in orders"
      :key="order.id"
      class="bg-white rounded-xl shadow-lg p-2 mb-3 hover:shadow-xl transition-shadow"
    >
      <!-- Order Summary -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-3">
        <div class="space-y-1">
          <RouterLink
            :to="`/admin/orders/${order.id}`"
            class="block text-gray-800 font-semibold hover:text-orange-500 transition"
          >
            <span>Order ID: {{ order.id }}</span>
            <span class="block text-sm text-gray-500">
              Placed on: {{ new Date(order.created_at).toLocaleDateString() }} at
              {{ new Date(order.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) }}
            </span>
          </RouterLink>

          <div class="text-gray-600 text-sm mt-1">
            <span class="font-medium">Order by:</span> {{ order.user.name }} |
            <span class="font-medium">Address:</span>
            {{ order.shipping_address ? order.shipping_address.address : "N/A" }}
          </div>
        </div>

        <div class="text-right mt-4 sm:mt-0 space-y-2">
          <span class="block text-xl font-bold text-orange-500">
            ${{ order.total_price }}
          </span>

          <OrderStatus :orderId="order.id" :initialStatus="order.status"/>    


        </div>
      </div>

      <!-- Toggle Items Button -->
      <button
        @click="toggleOrder(order.id)"
        class="mt-2 text-sm font-medium text-orange-500 hover:text-orange-600 transition"
      >
        {{ openOrders.includes(order.id) ? "Hide Items ▲" : "Show Items ▼" }}
      </button>

      <!-- Order Items -->
      <div
        v-if="openOrders.includes(order.id)"
        class="border-t border-gray-200 mt-4 pt-4 space-y-4"
      >
        <div
          v-for="item in order.order_items"
          :key="item.id"
          class="flex items-center justify-between bg-gray-50 p-3 rounded-lg"
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
            <span class="block text-gray-700 font-semibold">${{ item.product.price }}</span>
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
import OrderStatus from "@/components/admin/OrderStatus.vue";


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

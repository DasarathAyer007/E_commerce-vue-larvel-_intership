<template>
  <main class="min-h-screen bg-gray-100 p-6 flex justify-center">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow p-6 space-y-6">
      <!-- Order Header -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="space-y-1">
          <span class="text-sm font-medium text-gray-500"
            >Order ID: {{ orderData.id }}</span
          >
          <span class="block text-lg font-semibold text-gray-900">{{
            orderData.name || "Order"
          }}</span>
          <span class="block text-gray-600 text-sm">
            Placed on:
            {{ new Date(orderData.created_at).toLocaleDateString() }} at
            {{
              new Date(orderData.created_at).toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
              })
            }}
          </span>
        </div>

        <!-- Status & Total Price -->
        <div class="text-right mt-2 sm:mt-0 space-y-1">
          <span class="block text-xl font-bold text-orange-500">
            Total: ${{ orderData.total_price }}
          </span>
          <div>
        <OrderStatus :orderId="orderData.id" :initialStatus="orderData.status"/>            </div>
          <div>
            <label class="text-gray-700 font-medium mr-2">Payment Status:</label>
            <span
              :class="
                orderData.payment_status === 'paid' ? 'text-green-600' : 'text-red-500'
              "
            >
              {{ orderData.payment_status }}
            </span>
          </div>
        </div>
      </div>

      <!-- Shipping Info -->
      <div class="bg-gray-50 rounded-lg p-4 space-y-1">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Shipping Information</h2>
        <p><span class="font-medium">Name:</span> {{ orderData.user?.name }}</p>
        <p>
          <span class="font-medium">Phone:</span>
          {{ orderData.shipping_address?.phone || "N/A" }}
        </p>
        <p>
          <span class="font-medium">Address:</span>
          {{ orderData.shipping_address?.address || "N/A" }}
        </p>
        <p>
          <span class="font-medium">City:</span>
          {{ orderData.shipping_address?.city || "N/A" }}
        </p>
        <p>
          <span class="font-medium">Postal Code:</span>
          {{ orderData.shipping_address?.postal_code || "N/A" }}
        </p>
      </div>

      <!-- Toggle Items Button -->
      <button
        @click="toggleItems"
        class="text-sm font-medium text-orange-500 hover:text-orange-600 transition"
      >
        {{ showItems ? "Hide Items ▲" : "Show Items ▼" }}
      </button>

      <!-- Order Items -->
      <div v-if="showItems" class="border-t pt-4 space-y-4">
        <div
          v-for="item in orderData.order_items"
          :key="item.id"
          class="flex items-center justify-between bg-gray-50 rounded-lg p-3"
        >
          <div class="flex items-center space-x-4">
            <img
              :src="item.product.image"
              alt="Product Image"
              class="h-16 w-16 object-contain rounded border"
            />
            <div>
              <p class="font-medium text-gray-800">{{ item.product.name }}</p>
              <p class="text-gray-600 text-sm">Category: {{ item.product.category }}</p>
            </div>
          </div>
          <div class="text-right space-y-1">
            <span class="block text-gray-700">Price: ${{ item.product.price }}</span>
            <span class="block text-sm text-gray-500">Qty: {{ item.quantity }}</span>
            <span class="block text-gray-900 font-semibold"
              >Total: ${{ item.product.price * item.quantity }}</span
            >
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import axiosClient from "@/axios";
import OrderStatus from "@/components/admin/OrderStatus.vue";
const route = useRoute();
const orderData = ref({});
const showItems = ref(false);

const orderId = route.params.id;

onMounted(() => {
  axiosClient
    .get(`api/order/${orderId}`)
    .then((resp) => {
      orderData.value = resp.data.data;
    })
    .catch((err) => console.error(err));
});

function toggleItems() {
  showItems.value = !showItems.value;
}

// function updateStatus() {
//   axiosClient
//     .put(`api/order/${orderId}`, { status: orderData.value.status })
//     .then((resp) => console.log("Status updated:", resp.data))
//     .catch((err) => console.error(err));
// }
</script>

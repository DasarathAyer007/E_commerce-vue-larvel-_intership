<template>
  <main class="bg-gray-100 min-h-screen flex flex-col items-center py-8 px-4 space-y-8">

    <!-- Product Info Card -->
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6 p-6">
      
      <!-- Product Image and Name -->
      <div class="flex flex-col items-center md:items-start md:w-1/3 space-y-2">
        <img 
          :src="productData.image" 
          alt="Product Image" 
          class="w-32 h-32 object-contain rounded border border-gray-200"
        />
        <h1 class="text-lg md:text-xl font-semibold text-gray-900 text-center md:text-left truncate">
          {{ productData.name }}
        </h1>
      </div>

      <!-- Product Price and Quantity -->
      <div class="flex flex-col justify-center md:w-2/3 space-y-2 text-sm">
        <span class="text-orange-500 font-semibold text-lg">
          Price: $ {{ productData.price }}
        </span>
        <div class="flex items-center space-x-2">
          <span class="font-medium">Quantity :{{ productQuantity }}</span>
        </div>
        
      </div>

    </div>

    <div class="text-gray-700 font-medium text-lg">
          Total: $ {{ productData.price * productQuantity }}
        </div>

    <!-- Shipping Info -->
    <form class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl grid grid-cols-1 md:grid-cols-2 gap-4">
      <h2 class="text-xl font-bold text-gray-900 col-span-full mb-4">Shipping Details</h2>
      
      <div class="flex flex-col">
        <label class="text-gray-700 font-medium mb-1">Phone Number</label>
        <input 
          v-model="shippingInfo.phone" 
          type="text" 
          placeholder="Enter phone number"
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
        />
      </div>

      <div class="flex flex-col">
        <label class="text-gray-700 font-medium mb-1">Address</label>
        <input 
          v-model="shippingInfo.address" 
          type="text" 
          placeholder="Enter address"
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
        />
      </div>

      <div class="flex flex-col">
        <label class="text-gray-700 font-medium mb-1">City</label>
        <input 
          v-model="shippingInfo.city" 
          type="text" 
          placeholder="Enter city"
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
        />
      </div>

      <div class="flex flex-col">
        <label class="text-gray-700 font-medium mb-1">Postal Code</label>
        <input 
          v-model="shippingInfo.postal_code" 
          type="text" 
          placeholder="Enter postal code"
          class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
        />
      </div>
    </form>

    <!-- Place Order Button -->
    <div class="w-full max-w-3xl flex justify-end">
      <button
        @click="placeOrder"
        class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-md shadow hover:bg-orange-600 transition"
      >
        Place Order
      </button>
    </div>

  </main>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useProductStore } from "@/stores/product";
import axiosClient from "@/axios";

const route = useRoute();
const productStore = useProductStore();

const productId = ref(null);
const productData = ref([]);
const productQuantity = ref(0);
const shippingInfo = ref({
  phone: "",
  address: "",
  city: "",
  postal_code: ""
});

onMounted(async () => {
  productId.value = route.query.productId;
  productQuantity.value = Number(route.query.quantity) || 1;
  productData.value = await productStore.fetchProductById(productId.value);
});

function placeOrder() {
  axiosClient.post("api/order/", {
    orderItems: [
      { product_id: productId.value, quantity: productQuantity.value }
    ],
    shippingInfo: shippingInfo.value
  })
  .then(resp => console.log(resp))
  .catch(err => console.error(err));
}
</script>

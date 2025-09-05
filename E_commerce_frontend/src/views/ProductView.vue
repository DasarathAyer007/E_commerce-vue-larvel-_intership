<template>
  <main class="bg-gray-100 min-h-screen p-6 flex justify-center items-start">
    <!-- Product Card -->
    <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full flex flex-col md:flex-row overflow-hidden">
      
      <!-- Left Column: Image -->
      <div class="md:w-1/2 bg-gray-100 flex  items-center justify-center  h-full">
        <img
          :src="productData.image"
          alt="Product Image"
          class="object-contain w-full h-96 rounded-md"
        />
        
      </div>

      <!-- Right Column: Details -->
      <div class="md:w-1/2 flex flex-col p-6 space-y-6">
        <!-- Name & Description -->
        <div>
          <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ productData.name }}</h1>
          <p class="text-gray-700">{{ productData.description }}</p>
        </div>

        <!-- Price & Stock -->
        <div class="flex items-center justify-between">
          <span class="text-xl font-semibold text-orange-500">Price: Npr.{{ productData.price }}</span>
          <span class="text-gray-700">Stock: {{ productData.quantity }}</span>
        </div>

        <!-- Quantity Selector -->
        <div class="flex items-center space-x-4">
          <span class="font-medium">Quantity:</span>
          <div class="flex items-center border rounded-md overflow-hidden">
            <button
              @click="decreaseQuantity"
              class="px-3 py-1 bg-gray-200 text-gray-700 hover:bg-gray-300 transition"
            >-</button>
            <input
              type="number"
              v-model.number="selectedQuantity"
              min="1"
              :max="productData.quantity"
              class="w-12 text-center border-x outline-none"
            />
            <button
              @click="increaseQuantity"
              class="px-3 py-1 bg-gray-200 text-gray-700 hover:bg-gray-300 transition"
            >+</button>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-4">
          <button @click="buyNow()"
            class="flex-1 px-4 py-2 bg-orange-500 text-white font-semibold rounded-md shadow hover:bg-orange-600 transition"
          >
            Buy Now
          </button>
          <button
            class="flex-1 px-4 py-2 bg-gray-800 text-white font-semibold rounded-md shadow hover:bg-gray-900 transition"
          >
            Add to Cart
          </button>
          
        </div>
        <span>
          Added By: {{ productData.user }}
        </span>
      </div>
    </div>
  </main>
</template>
<script setup>
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useRouter } from "vue-router";
import { useProductStore } from "@/stores/product";
const route = useRoute();
const router=useRouter();
const productStore = useProductStore();
const productId = ref(null);
const productData = ref([]);

onMounted(async () => {
  productId.value = route.params.id;
  productData.value = await productStore.fetchProductById(productId.value);
});

const selectedQuantity=ref(1)

function increaseQuantity() {
      if (selectedQuantity.value < productData.value.quantity) selectedQuantity.value++;
}
function decreaseQuantity() {
      if (selectedQuantity.value > 1) selectedQuantity.value--;
}

function buyNow(){
  router.push({name:'checkout',
    query:{
      productId:productData.value.id,
      quantity:selectedQuantity.value
    }
  })
}
</script>

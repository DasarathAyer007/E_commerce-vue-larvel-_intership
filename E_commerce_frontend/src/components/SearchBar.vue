<template>
    <div class="flex w-full max-w-md items-center bg-white rounded-md shadow border border-gray-300 overflow-hidden">

      <input
        v-model="search"
        type="text"
        placeholder="Search products..."
        class="flex-1 px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
        @keyup.enter="searchProduct"
      />

  
      <button
        @click="searchProduct"
        class="px-4 py-2 bg-orange-500 text-white hover:bg-orange-600 transition flex items-center justify-center"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          class="w-5 h-5"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
          />
        </svg>
      </button>
    </div>

</template>
<script setup>
import { useProductStore } from "@/stores/product";
import router from "@/router";
const productStore=useProductStore()

import { ref } from "vue";


const search=ref(null)

function searchProduct(){
   if (!search.value.trim()) {
    alert("Please enter a search term.");
    return;
  }
    router.push(
    {path:'/products',
      query:{
        search:search.value.trim()
      }
    }
  )
  
}

</script>
<template>
  <div class="h-dvh bg-gray-100 flex flex-col">
    <!-- Top Header -->
    <div class="flex-shrink-0">
      <ProductHeader />
    </div>

    <!-- Bottom Content / Router View -->
    <div class="flex-1 overflow-auto">
      <RouterView />
    </div>
  </div>
</template>
<script setup>
import ProductHeader from "@/components/admin/ProductHeader.vue";
</script>

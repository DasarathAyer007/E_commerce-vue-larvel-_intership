<template>
 <div class="h-dvh bg-gray-100 flex flex-col">
    <!-- Top Header -->
    <div class="flex-shrink-0">
      <CategoryHeader />
    </div>

    <!-- Bottom Content / Router View -->
    <div class="flex-1 overflow-auto ">
      <RouterView />
    </div>
  </div>
</template>
<script setup>
import CategoryHeader from '@/components/admin/CategoryHeader.vue'
import { RouterView } from 'vue-router';

</script>
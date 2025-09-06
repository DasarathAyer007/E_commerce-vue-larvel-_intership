<template>
 <div class="h-dvh bg-gray-100 flex flex-col">
    <!-- Top Header -->
    <div class="flex-shrink-0">
      <OrderHeader />
    </div>

    <!-- Bottom Content / Router View -->
    <div class="flex-1 overflow-auto ">
      <RouterView />
    </div>
  </div>
</template>
<script setup>

import OrderHeader from '@/components/admin/OrderHeader.vue'
import { RouterView } from 'vue-router';

</script>
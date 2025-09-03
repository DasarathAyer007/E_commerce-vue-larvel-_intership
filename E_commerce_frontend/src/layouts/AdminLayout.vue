<template>
  <div class="flex h-screen">
    <AdminSideBar />

    <div class="flex-1 bg-gray-100 ">
      <router-view />
    </div>
  </div>
</template>

<script setup>
import AdminSideBar from '@/components/admin/AdminSideBar.vue';
</script>

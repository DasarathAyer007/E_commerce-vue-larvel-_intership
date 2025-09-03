<template>
  <div class="min-h-screen bg-gray-100 p-6 flex flex-col items-center space-y-6">
    <!-- Category Card -->
    <div class="w-full max-w-md bg-white rounded-lg shadow p-6 space-y-4">
      <!-- ID & Name -->
      <div class="flex items-center justify-between">
        <span class="text-sm font-medium text-gray-500">ID: {{ categoryData.id }}</span>
        <span class="text-lg font-semibold text-gray-900">{{ categoryData.name }}</span>
      </div>

      <!-- Description -->
      <div>
        <span class="text-lg font-medium text-gray-700">Description</span>
        <p class="text-gray-700 mt-1">{{ categoryData.description }}</p>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end space-x-3 mt-4">
        <RouterLink
          :to="`/admin/category/edit/${categoryData.id}`"
          class="px-4 py-2 bg-orange-500 text-white rounded-md shadow hover:bg-orange-600 transition"
        >
          Edit
        </RouterLink>
        <button
          @click="deleteCategory"
          class="px-4 py-2 bg-red-500 text-white rounded-md shadow hover:bg-red-600 transition"
        >
          Delete
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import axiosClient from "@/axios";
import { onMounted, reactive, ref } from "vue";
import { useRoute } from "vue-router";
const route = useRoute();
const categoryId = ref(null);
const categoryData = reactive({
  id: 0,
  name: "",
  description: "",
});

onMounted(() => {
  categoryId.value = route.params.id;
  axiosClient
    .get(`api/category/${categoryId.value}`)
    .then((resp) => {
      resp = resp.data.data;
      categoryData.id = resp.id;
      categoryData.name = resp.name;
      categoryData.description = resp.description;
    })
    .catch((error) => {
      console.log(error);
    });
});

function deleteCategory() {
  axiosClient.delete(`api/category/${categoryId.value}`).then((resp) => {
    console.log(resp);
  });
}
</script>

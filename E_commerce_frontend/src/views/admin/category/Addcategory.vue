<template>
  <div class="bg-gray-100 flex items-center justify-center p-6">
    <div class="w-full max-w-lg bg-white rounded-lg shadow p-8 space-y-6">
      <h2 class="text-2xl font-bold text-gray-900 text-center">Add Category</h2>

      <form @submit.prevent="addCategory" class="space-y-4">
        <!-- Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Name</label>
          <input
            v-model="categoryData.name"
            type="text"
            class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-orange-500 focus:ring-orange-500"
          />
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Description</label>
          <textarea
            v-model="categoryData.description"
            rows="3"
            class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-orange-500 focus:ring-orange-500"
          ></textarea>
        </div>

        <!-- Submit Button -->
        <div>
          <button
            type="submit"
            class="w-full py-2 px-4 bg-orange-500 text-white rounded-md shadow hover:bg-orange-600 transition cursor-pointer"
          >
            Add Category
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script setup>
import axiosClient from "@/axios";
import { onMounted, reactive, ref, toRaw } from "vue";
import { useRoute } from "vue-router";
import router from "@/router";
const route = useRoute();
const categoryId = ref(null);

const categoryData = reactive({
  id: 0,
  name: "",
  description: "",
});

async function addCategory() {
  axiosClient
    .post("api/category", toRaw(categoryData))
    .then((resp) => {
      console.log(resp);
        router.push({ name: "categoryList" });

    })
    .catch((error) => {
      console.log(error);
    });
}
</script>

<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <!-- Card -->
    <div class="w-full max-w-lg bg-white rounded-lg shadow p-8">
      <!-- Title -->
      <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Edit Product</h2>

      <!-- Form -->
      <form @submit.prevent="updateProduct" class="space-y-4">
        <!-- Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Name</label>
          <input
            v-model="productData.name"
            type="text"
            class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-orange-500 focus:ring-orange-500"
          />
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Description</label>
          <textarea
            v-model="productData.description"
            rows="3"
            class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-orange-500 focus:ring-orange-500"
          ></textarea>
        </div>

        <!-- Quantity & Price Side by Side -->
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Quantity</label>
            <input
              v-model="productData.quantity"
              type="number"
              class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-orange-500 focus:ring-orange-500"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Price</label>
            <input
              v-model="productData.price"
              type="number"
              class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-orange-500 focus:ring-orange-500"
            />
          </div>
        </div>

        <!-- Image -->
        <div class="">
          <label class="block text-sm font-medium text-gray-700">Image</label>
          <div class="flex">
            <img :src="productData.image" alt="no " class="size-10 inline" />
            <input
              @change="productData.image = $event.target.files[0]"
              type="file"
              class="mt-1 w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-orange-500 file:text-white hover:file:bg-orange-600 cursor-pointer"
            />
          </div>
        </div>

        <!-- category -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Category</label>
          <select
            v-model="productData.category"
            class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-orange-500 focus:ring-orange-500"
          >
            <option disabled value="">-- Select a category --</option>
            <option
              v-for="category in Categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>
        </div>

        <label for="">user</label>
        <input type="number" name="" id="" v-model="productData.user_id" />

        <!-- Submit Button -->
        <div class="pt-4">
          <button
            type="submit"
            class="w-full bg-orange-500 text-white py-2 px-4 rounded-md shadow hover:bg-orange-600 transition"
          >
            Add Product
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
const productId = ref(null);

const productData = reactive({
  id: 0,
  name: "",
  description: "",
  quantity: "",
  price: "",
  category: "",
  user_id: "",
  image: null,
});

onMounted(() => {
  productId.value = route.params.id;

  axiosClient
    .get(`api/product/${productId.value}`)
    .then((resp) => {
      console.log(resp.data);
      resp = resp.data.data;
      productData.id = resp.id;
      productData.name = resp.name;
      productData.description = resp.description;
      productData.quantity = resp.quantity;
      productData.price = resp.price;
      productData.category = resp.category;
      productData.image = resp.image;
    })
    .catch((error) => {
      console.log(error);
    });
});

async function updateProduct() {
  const formData = new FormData();
  formData.append("_method", "PUT");
  formData.append("name", productData.name);
  formData.append("description", productData.description);
  formData.append("quantity", productData.quantity);
  formData.append("price", productData.price);
  formData.append("category", productData.category);
  formData.append("image", productData.image);
  axiosClient
    .post(`api/product/${productData.id}`, formData)
    .then((resp) => {
      console.log(resp);
      //   router.push({ name: "productList" });
    })
    .catch((error) => {
      console.log(error);
    });
}

const Categories = ref([]);

onMounted(() => {
  axiosClient
    .get("api/category")
    .then((resp) => {
      console.log(resp.data[0]);
      Categories.value = resp.data.data;
    })
    .catch((error) => {
      console.log(error);
    });
});
</script>

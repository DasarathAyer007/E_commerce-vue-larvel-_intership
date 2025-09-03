<template>

    <div class="flex items-center justify-between  bg-white shadow rounded-lg px-6 py-4">
        <!-- Title -->
        <h1 class="text-2xl font-bold text-gray-900">Category</h1>

        <!-- Action Links -->
        <div class="flex space-x-4">
              <RouterLink to="/admin/category"
                class="px-4 py-2 bg-gray-200 text-gray-900 rounded-md shadow hover:bg-gray-300 transition">
                All Category
            </RouterLink>
            <RouterLink to="/admin/category/add"
                class="px-4 py-2 bg-orange-500 text-white rounded-md shadow hover:bg-orange-600 transition">
                Add Category
            </RouterLink>
        </div>
    </div>
</template>

<script>

</script>
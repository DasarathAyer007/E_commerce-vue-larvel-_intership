<template>
  <div :class="['h-screen flex flex-col transition-all duration-300', isCollapsed ? 'w-20' : 'w-64']">
    <!-- Sidebar -->
    <aside class="h-full bg-gray-800 text-gray-100 flex flex-col">
      <!-- Header -->
      <div class="flex items-center justify-between p-4 border-b border-gray-700">
        <span v-if="!isCollapsed" class="text-2xl font-bold text-orange-500">Admin</span>
        <button @click="toggleCollapse" class="text-orange-500 focus:outline-none">
          <svg v-if="isCollapsed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Navigation Links -->
      <nav class="flex-1 mt-4">
        <ul>
          <li>
            <router-link
              to="/admin"
              class="flex items-center gap-3 py-3 px-4 hover:bg-gray-700 rounded transition-colors"
              exact-active-class="bg-orange-500 text-black"
            >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
</svg>

              <span v-if="!isCollapsed">Home</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/product"
              class="flex items-center gap-3 py-3 px-4 hover:bg-gray-700 rounded transition-colors"
              active-class="bg-orange-500 text-black"
            >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
</svg>

              <span v-if="!isCollapsed">Product</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/category"
              class="flex items-center gap-3 py-3 px-4 hover:bg-gray-700 rounded transition-colors"
              active-class="bg-orange-500 text-black"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
</svg>

              <span v-if="!isCollapsed">Categories</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/orders"
              class="flex items-center gap-3 py-3 px-4 hover:bg-gray-700 rounded transition-colors"
              active-class="bg-orange-500 text-black"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
</svg>

              <span v-if="!isCollapsed">Orders</span>
            </router-link>
          </li>
        </ul>
      </nav>
    </aside>
  </div>
</template>

<script>
export default {
  name: "AdminSidebar",
  data() {
    return {
      isCollapsed: false,
    };
  },
  methods: {
    toggleCollapse() {
      this.isCollapsed = !this.isCollapsed;
    },
  },
};
</script>

<style scoped>
/* Optional smooth transition for router-link active */
.router-link-active {
  transition: background-color 0.3s, color 0.3s;
}
</style>

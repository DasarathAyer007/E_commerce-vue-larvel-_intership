<template>
  <Disclosure as="nav" class="bg-black relative">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <!-- Mobile menu button -->
        <div class="sm:hidden">
          <DisclosureButton
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-100 hover:bg-gray-900/50 focus:outline-none focus:ring-2 focus:ring-orange-500"
          >
            <span class="sr-only">Open main menu</span>
            <Bars3Icon v-if="!open" class="h-6 w-6" aria-hidden="true" />
            <XMarkIcon v-else class="h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>

        <!-- Logo -->
          <RouterLink to="/">
        <div class="flex items-center space-x-2">
      
          <img class="h-8 w-auto" src="../assets/batman.png" alt="BatCommerce Logo" />
          <span class="text-white font-bold text-lg">BatCommerce</span>
     \
        </div>
        </RouterLink>

        <!-- Search Bar -->
        <SearchBar/>

        <!-- Right side: Notifications / Auth -->
        <div class="flex items-center space-x-4">
          <!-- Notifications -->

          <svg
            xmlns="http://www.w3.org/2000/svg"
            height="24px"
            viewBox="0 -960 960 960"
            width="24px"
            fill="#e3e3e3"
          >
            <path
              d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"
            />
          </svg>

          <button
            class="p-1 rounded-full text-gray-100 hover:text-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500"
          >
            <span class="sr-only">View notifications</span>
            <BellIcon class="h-6 w-6" />
          </button>

          <!-- Not logged in -->
          <template v-if="!isLogin">
            <RouterLink
              to="/login"
              class="px-4 py-2 rounded-md text-sm font-medium text-gray-100 border border-gray-900 hover:bg-gray-900/50 hover:text-orange-500"
            >
              Login
            </RouterLink>
            <RouterLink
              to="/signup"
              class="px-4 py-2 rounded-md text-sm font-medium text-black bg-orange-500 hover:bg-orange-600"
            >
              Signup
            </RouterLink>
          </template>

          <!-- Logged in: Profile dropdown -->
          <Menu v-else as="div" class="relative">
            <MenuButton
              class="flex items-center rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
              <img
                class="h-8 w-8 rounded-full"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e"
                alt="User avatar"
              />
            </MenuButton>
            <transition
              enter-active-class="transition ease-out duration-100"
              enter-from-class="transform opacity-0 scale-95"
              enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75"
              leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95"
            >
              <MenuItems
                class="absolute right-0 mt-2 w-48 bg-black rounded-md py-1 shadow-lg focus:outline-none"
              >
                <MenuItem v-slot="{ active }">
                  <RouterLink
                    to="/profile"
                    :class="[
                      active ? 'bg-gray-900/50' : '',
                      'block px-4 py-2 text-sm text-gray-100',
                    ]"
                  >
                    Profile
                  </RouterLink>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <RouterLink
                    to="/settings"
                    :class="[
                      active ? 'bg-gray-900/50' : '',
                      'block px-4 py-2 text-sm text-gray-100',
                    ]"
                  >
                    Settings
                  </RouterLink>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <RouterLink
                    to="/orders"
                    :class="[
                      active ? 'bg-gray-900/50' : '',
                      'block px-4 py-2 text-sm text-gray-100',
                    ]"
                  >
                    Your Orders
                  </RouterLink>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <button
                    @click="logout"
                    :class="[
                      active ? 'bg-gray-900/50' : '',
                      'block px-4 py-2 text-sm text-gray-100 w-full text-left',
                    ]"
                  >
                    Sign out
                  </button>
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <DisclosurePanel class="sm:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <DisclosureButton
          v-for="item in navigation"
          :key="item.name"
          as="a"
          :href="item.to"
          class="block px-3 py-2 rounded-md text-base font-medium"
          :class="
            item.current
              ? 'bg-gray-900 text-gray-100'
              : 'text-gray-100 hover:bg-gray-900/50 hover:text-orange-500'
          "
        >
          {{ item.name }}
        </DisclosureButton>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<script setup>
import router from "@/router";
import { userStore } from "@/stores/user";
import SearchBar from "./SearchBar.vue";
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from "@headlessui/vue";
import { Bars3Icon, BellIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { RouterLink } from "vue-router";

const user = userStore();

function logout() {
  user.logout();
  router.push({ name: "home" });
}

defineProps(["isLogin"]);

const navigation = [
  { name: "Home", to: "/", current: true },
  { name: "Shop", to: "/shop", current: false },
  { name: "About", to: "/about", current: false },
  { name: "Contact", to: "/contact", current: false },
];
</script>

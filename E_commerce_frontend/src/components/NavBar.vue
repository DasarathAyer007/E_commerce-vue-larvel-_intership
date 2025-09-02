<template>
  <Disclosure as="nav" class="bg-black relative">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <!-- Mobile menu button -->
        <div class="sm:hidden">
          <DisclosureButton class="inline-flex items-center justify-center p-2 rounded-md text-gray-100 hover:bg-gray-900/50 focus:outline-none focus:ring-2 focus:ring-orange-500">
            <span class="sr-only">Open main menu</span>
            <Bars3Icon v-if="!open" class="h-6 w-6" aria-hidden="true" />
            <XMarkIcon v-else class="h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>

        <!-- Logo & Desktop Navigation -->
        <div class="flex items-center space-x-4 sm:space-x-6">
          <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg" alt="Logo" />

          <!-- Desktop Navigation -->
          <div class="hidden sm:flex space-x-4">
            <RouterLink
              v-for="item in navigation"
              :key="item.name"
              :to="item.to"
              class="px-3 py-2 rounded-md text-sm font-medium"
              :class="item.current
                ? 'bg-gray-900 text-gray-100'
                : 'text-gray-100 hover:bg-gray-900/50 hover:text-orange-500'"
            >
              {{ item.name }}
            </RouterLink>
          </div>
        </div>

        <!-- Search Bar -->
        <div class="flex-1 flex justify-center px-4">
          <input
            type="text"
            placeholder="Search..."
            class="w-full max-w-md px-3 py-2 rounded-md bg-gray-100 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
        </div>

        <!-- Right side: Notifications / Login / Signup / Profile -->
        <div class="flex items-center space-x-4">
          <button class="p-1 rounded-full text-gray-100 hover:text-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
            <span class="sr-only">View notifications</span>
            <BellIcon class="h-6 w-6" />
          </button>

          <!-- If not logged in -->
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

          <!-- Profile dropdown -->
          <Menu v-else as="div" class="relative">
            <MenuButton class="flex items-center rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
              <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" alt="User" />
            </MenuButton>
            <transition
              enter-active-class="transition ease-out duration-100"
              enter-from-class="transform opacity-0 scale-95"
              enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75"
              leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95"
            >
              <MenuItems class="absolute right-0 mt-2 w-48 bg-black rounded-md py-1 shadow-lg focus:outline-none">
                <MenuItem v-slot="{ active }">
                  <a :class="[active ? 'bg-gray-900/50' : '', 'block px-4 py-2 text-sm text-gray-100']" href="#">Profile</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a :class="[active ? 'bg-gray-900/50' : '', 'block px-4 py-2 text-sm text-gray-100']" href="#">Settings</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <button @click="logout()" :class="[active ? 'bg-gray-900/50' : '', 'block px-4 py-2 text-sm text-gray-100']" >Sign out</button>
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
          :class="item.current
            ? 'bg-gray-900 text-gray-100'
            : 'text-gray-100 hover:bg-gray-900/50 hover:text-orange-500'"
        >
          {{ item.name }}
        </DisclosureButton>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<script setup>
import axiosClient from '@/axios'
import router from '@/router'
import { userStore } from '@/stores/user'
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { RouterLink } from 'vue-router'

const navigation = [
  { name: 'Dashboard', to: '#', current: true },
  { name: 'Team', to: '#', current: false },
  { name: 'Projects', to: '#', current: false },
  { name: 'Calendar', to: '#', current: false },
]
const user =userStore()

function logout(){
    // axiosClient.get('api/logout')
    //   .then((response)=>{
    //     user.isLogin=false
    //       router.push({name:'home'})
    //   })
    user.logout()
}

// const isLoggedIn = true
defineProps(['isLogin'])
</script>

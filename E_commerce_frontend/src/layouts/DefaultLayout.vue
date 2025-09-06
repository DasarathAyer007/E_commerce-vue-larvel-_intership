
<script setup>
import { RouterLink, RouterView } from "vue-router";
import NavBar from "../components/NavBar.vue";
import { userStore } from "../stores/user";

const user = userStore();

if (user.isLogin) {
  user.fetchUser();
}
</script>
<template>

      <header>
    <NavBar :isLogin="user.isLogin" />
    <!-- <NavBar :isLogin="true"/> -->
  </header>


  <RouterView>
   </RouterView>
</template>

<script>
</script>


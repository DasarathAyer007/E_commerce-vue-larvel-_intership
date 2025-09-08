<template>
    <h1 class="text-xl ">Search: {{route.query.search }}</h1>
   

    <ProductGrid/>
    
</template>

<script setup>
import { onMounted,ref } from 'vue';
import { onBeforeRouteUpdate } from 'vue-router'
import { useRoute } from "vue-router";
import ProductGrid from '@/components/ProductGrid.vue';
import { useProductStore } from "@/stores/product";
const productStore=useProductStore()


const route = useRoute();
const categoryId =ref(0)
const search=ref(null)

onMounted(() => {
  productStore.fetchProduct('/api/product', {
    category: route.query.category || null,
    search: route.query.search || null,
  });
});

onBeforeRouteUpdate((to, from) => {
  productStore.fetchProduct('/api/product', {
    category: to.query.category || null,
    search: to.query.search || null,
  });

});



</script>
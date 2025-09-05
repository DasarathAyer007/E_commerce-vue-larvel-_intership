import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'
import SignupView from '@/views/SignupView.vue'
import NotFound from '@/views/NotFound.vue'
import Dashboard from '@/views/admin/Dashboard.vue'
import AdminLayout from '../layouts/AdminLayout.vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import GuestLayout from "@/layouts/GuestLayout.vue"
import Product from '@/views/admin/product/Product.vue'
import AddProduct from '@/views/admin/product/AddProduct.vue'
import ProductList from '@/views/admin/product/ProductList.vue'
import Category from '@/views/admin/category/Category.vue'
import CategoryList from '@/views/admin/category/CategoryList.vue'
import adminRouter from './adminRoutes'
import ProductView from '@/views/ProductView.vue'
import CheckoutView from '@/views/CheckoutView.vue'
import OrderView from '@/views/OrderView.vue'
import ProductFilter from '@/views/ProductFilter.vue'

const routes =[
    {
      path: '/',
      name: 'default',
      component: DefaultLayout,
      children: [
        {
          path: '/',
          name: 'home',
          component: HomeView,
        },
        {
          path:'/products',
          name:'productFilter',
          component:ProductFilter
        },
        {
          path:'/product/:id',
          name: 'productInfo',
          component:ProductView
        },{
          path:'/checkout/',
          name:"checkout",
          component:CheckoutView

        },
        {
          path:'/orders',
          name:'order',
          component:OrderView
        }

      ]
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },

    {
      path: '/signup',
      name: 'signup',
      component: SignupView
    },


    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
    },
    
    ...adminRouter,

    {
      path: '/:pathMatch(.*)*',
      name: 'notFound',
      component: NotFound
    }
  ]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})


export default router

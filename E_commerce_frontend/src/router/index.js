import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'
import SignupView from '@/views/SignupView.vue'
import NotFound from '@/views/NotFound.vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import adminRouter from './adminRoutes'
import ProductView from '@/views/ProductView.vue'
import CheckoutView from '@/views/CheckoutView.vue'
import OrderView from '@/views/OrderView.vue'
import ProductFilter from '@/views/ProductFilter.vue'
import { userStore } from '@/stores/user'
import PaymentView from '@/views/PaymentView.vue'

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
          component:CheckoutView,
          meta:{requiredAuth:true}
        },
        {
          path:'/orders',
          name:'yourOrder',
          component:OrderView,
          meta:{requiredAuth:true}
        },
          { path: "/payment/:id", component: PaymentView, props: true }
          // { path: "/thank-you/:id", component: ThankYou, props: true },

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
router.beforeEach((to,from,next)=>{

  const user=userStore()
  

  if(to.meta.requiredAuth && !user.isLogin){
    return next('/login');
  }

  if(to.meta.roles && !to.meta.roles.includes(user.userRole)){
    return next({name:'notFound'})
  }

  next()

})

export default router

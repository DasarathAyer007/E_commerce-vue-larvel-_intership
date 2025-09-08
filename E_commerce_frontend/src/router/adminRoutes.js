import Dashboard from '@/views/admin/Dashboard.vue'
import AdminLayout from '../layouts/AdminLayout.vue'
import Product from '@/views/admin/product/Product.vue'
import AddProduct from '@/views/admin/product/AddProduct.vue'
import ProductList from '@/views/admin/product/ProductList.vue'
import Category from '@/views/admin/category/Category.vue'
import CategoryList from '@/views/admin/category/CategoryList.vue'
import Addcategory from '@/views/admin/category/Addcategory.vue'
import Editcategory from '@/views/admin/category/Editcategory.vue'
import CategoryDetail from '@/views/admin/category/CategoryDetail.vue'
import ProductDetail from '@/views/admin/product/ProductDetail.vue'
import EditProduct from '@/views/admin/product/EditProduct.vue'
import Orders from '@/views/admin/order/Orders.vue'
import OrderList from '@/views/admin/order/OrderList.vue'
import OrderDetail from '@/views/admin/order/OrderDetail.vue'

const adminRoutes =[
    {
      path: '/admin',
      name: 'admin',
      component: AdminLayout,
      meta:{requiresAuth:true, roles:["admin"]},
      children: [
        {
          path: '',
          name: 'dashboard',
          component: Dashboard
        },
        {
          path: 'product',
          name: 'products',
          component: Product,
          children: [
            {path: '', name: "productList", component: ProductList },
            { path: 'add', name: "addProduct",  component: AddProduct},
            {path:':id',name:'productDetail', component:ProductDetail},
            {path:'edit/:id',name:'editProduct',component:EditProduct}

          ]

        },
        {
          path:'category',
          name:'categories',
          component:Category,
          children:[
            {path:'',  name:'categoryList', component:CategoryList },
            {path:':id',name:'categoryDetail',component:CategoryDetail},
            {path:'add', name:'addcategory', component:Addcategory},
            {path:'edit/:id',name:'editcategory',component:Editcategory}
          ]
        },{
          path:'orders',
          name:'orders',
          component:Orders,
          children:[
            {path:'',name:'orderList',component:OrderList},
            {path:':id',name:'orderDetail',component:OrderDetail}

          ]
        }
      ]
    },

  ]

export default adminRoutes
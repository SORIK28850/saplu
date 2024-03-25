import { createRouter, createWebHashHistory } from 'vue-router'
import Home from './components/home/index.vue';
import Empty from './components/index/index.vue';
import CustomersIndex from './components/customers/index.vue';
import CustomersDetail from './components/customers/customersDetail.vue';

const routes = [
  { path: '/home', component: Home },
  { path: '/', component: Empty },
  { path: '/customers', component: CustomersIndex },
  { path: '/customers-detail/:id?', name: 'customers-detail', props: true, component: CustomersDetail },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
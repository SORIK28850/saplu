import { createRouter, createWebHistory } from 'vue-router'
import Home from './components/home/index.vue';
import Empty from './components/index/index.vue';
import CustomersIndex from './components/customers/index.vue';

const routes = [
  { path: '/home', component: Home },
  { path: '/', component: Empty },
  { path: '/customers', component: CustomersIndex },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
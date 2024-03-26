import { createRouter, createWebHashHistory } from 'vue-router'
import Home from './components/home/index.vue';
import Empty from './components/index/index.vue';
import CustomersIndex from './components/customers/index.vue';
import CustomersDetail from './components/customers/customersDetail.vue';
import CustomersCreate from './components/customers/customersCreate.vue';
import CustomersUpdate from './components/customers/customersUpdate.vue';

const routes = [
  { path: '/home', component: Home },
  { path: '/', component: Empty },
  { path: '/customers', component: CustomersIndex, name: 'customers'},
  { path: '/customers-detail/:id?', name: 'customers-detail', props: true, component: CustomersDetail },
  { path: '/customers-create', component: CustomersCreate, name: 'customers-create'},
  { path: '/customers-update/:id?', component: CustomersUpdate, props: true, name: 'customers-update'},
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
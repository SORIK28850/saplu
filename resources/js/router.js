import { createRouter, createWebHashHistory } from 'vue-router'
import Home from './components/home/index.vue';
import Empty from './components/index/index.vue';
import CustomersIndex from './components/customers/index.vue';
import CustomersDetail from './components/customers/customersDetail.vue';
import CustomersCreate from './components/customers/customersCreate.vue';
import CustomersUpdate from './components/customers/customersUpdate.vue';
import UsersIndex from './components/users/index.vue';
import UsersUpdate from './components/users/usersUpdate.vue';
import UsersCreate from './components/users/createUser.vue';

const routes = [
  { path: '/home', component: Home },
  { path: '/', component: Empty },
  { path: '/customers', component: CustomersIndex, name: 'customers'},
  { path: '/customers-detail/:id?', name: 'customers-detail', props: true, component: CustomersDetail },
  { path: '/customers-create', component: CustomersCreate, name: 'customers-create'},
  { path: '/customers-update/:id?', component: CustomersUpdate, props: true, name: 'customers-update'},
  { path: '/users', component: UsersIndex, name: 'users'},
  { path: '/users-update/:id?', component: UsersUpdate, props: true, name: 'users-update'},
  { path: '/users-create', component: UsersCreate, name: 'users-create'},

]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
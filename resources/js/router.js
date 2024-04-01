import { createRouter, createWebHashHistory } from 'vue-router';
import { getAuth, onAuthStateChanged } from 'firebase/auth';
import Home from './components/home/index.vue';
import CustomersIndex from './components/customers/index.vue';
import CustomersDetail from './components/customers/customersDetail.vue';
import CustomersCreate from './components/customers/customersCreate.vue';
import CustomersUpdate from './components/customers/customersUpdate.vue';
import UsersIndex from './components/users/index.vue';
import UsersUpdate from './components/users/usersUpdate.vue';
import UsersCreate from './components/users/createUser.vue';
import Login from './components/users/login.vue';

const routes = [
  { path: '/home', component: Home, name: 'Home', meta: { requiresAuth: true } },
  { path: '/', component: Login, name: 'login' },
  { path: '/customers', component: CustomersIndex, name: 'customers', meta: { requiresAuth: true } },
  { path: '/customers-detail/:id?', name: 'customers-detail', props: true, component: CustomersDetail, meta: { requiresAuth: true } },
  { path: '/customers-create', component: CustomersCreate, name: 'customers-create', meta: { requiresAuth: true } },
  { path: '/customers-update/:id?', component: CustomersUpdate, props: true, name: 'customers-update', meta: { requiresAuth: true } },
  { path: '/users', component: UsersIndex, name: 'users', meta: { requiresAuth: true } },
  { path: '/users-update/:id?', component: UsersUpdate, props: true, name: 'users-update', meta: { requiresAuth: true } },
  { path: '/users-create', component: UsersCreate, name: 'users-create', meta: { requiresAuth: true } },
];

let isAuthenticated = false;

const auth = getAuth();
onAuthStateChanged(auth, (user) => {
  isAuthenticated = !!user;
});

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

router.beforeEach((to, from) => {
  return new Promise((resolve) => {
    const unsubscribe = onAuthStateChanged(auth, (user) => {
      if (to.matched.some(record => record.meta.requiresAuth) && !user) {
        resolve('/');
      } else {
        resolve();
      }
      unsubscribe();
    });
  });
});

export default router;
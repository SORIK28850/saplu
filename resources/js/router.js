import { createRouter, createWebHistory } from 'vue-router'
import Home from './components/home/index.vue';
import Empty from './components/index/index.vue';

const routes = [
  { path: '/home', component: Home },
  { path: '/', component: Empty },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
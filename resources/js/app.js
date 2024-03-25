import './bootstrap';

import { createApp } from 'vue';
import App from './components/App.vue';

import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';
import store from './store'

import Vuetify from './vuetify';
import router from './router';

createApp(App)
  .use(Vuetify)
  .use(router)
  .use(store)
  .mount('#app');
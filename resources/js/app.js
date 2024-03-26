import './bootstrap';

import { createApp } from 'vue';
import App from './components/App.vue';

import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';
import store from './store'

import Vuetify from './vuetify';
import router from './router';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

createApp(App)
  .use(Vuetify)
  .use(router)
  .use(store)
  .use(VueSweetalert2)
  .mount('#app');
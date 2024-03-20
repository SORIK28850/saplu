import './bootstrap';

import { createApp } from 'vue';
import App from './components/App.vue';

import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';

import Vuetify from './vuetify';
import router from './router';

createApp(App)
  .use(Vuetify)
  .use(router)
  .mount('#app');
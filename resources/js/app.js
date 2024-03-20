import './bootstrap';

import { createApp } from 'vue';
import App from './components/App.vue';

import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';

import Vuetify from './vuetify';

createApp(App).use(Vuetify).mount('#app');
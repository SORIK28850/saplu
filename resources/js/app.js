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

// Importa Firebase
import { initializeApp } from 'firebase/app';
import { getAuth } from 'firebase/auth';
import { getFirestore } from 'firebase/firestore';

// Configuración de Firebase
const firebaseConfig = {
  apiKey: "AIzaSyBWP5xHrtkzb3UIMBHRI4O1uuhL1GqDNpA",
  authDomain: "saplu-d767d.firebaseapp.com",
  projectId: "saplu-d767d",
  storageBucket: "saplu-d767d.appspot.com",
  messagingSenderId: "471409530815",
  appId: "1:471409530815:web:5073b99a2146f1e69af30a"
};

// Inicializa Firebase
const firebaseApp = initializeApp(firebaseConfig);
const firebaseAuth = getAuth(firebaseApp);
const firestore = getFirestore(firebaseApp);

const app = createApp(App)
  .use(Vuetify)
  .use(router)
  .use(store)
  .use(VueSweetalert2);

// Añade Firebase y firebaseAuth a las propiedades globales
app.config.globalProperties.$firebaseApp = firebaseApp;
app.config.globalProperties.$firebaseAuth = firebaseAuth;
app.config.globalProperties.$firestore = firestore;

app.mount('#app');
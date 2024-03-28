// store.js
import { createStore } from 'vuex'
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, signOut } from 'firebase/auth';
import { initializeApp } from 'firebase/app';

const firebaseConfig = {
  apiKey: "AIzaSyBWP5xHrtkzb3UIMBHRI4O1uuhL1GqDNpA",
  authDomain: "saplu-d767d.firebaseapp.com",
  projectId: "saplu-d767d",
  storageBucket: "saplu-d767d.appspot.com",
  messagingSenderId: "471409530815",
  appId: "1:471409530815:web:5073b99a2146f1e69af30a"
};

const firebaseApp = initializeApp(firebaseConfig);
const auth = getAuth(firebaseApp);

export default createStore({
  state: {
    selectedItem: null,
    user: {
      loggedIn: false,
      data: null
    },
  },
  mutations: {
    SET_LOGGED_IN(state, value) {
      state.user.loggedIn = value;
    },
    SET_USER(state, data) {
      state.user.data = data;
    },
    setSelectedItem(state, item) {
      state.selectedItem = item;
    },
  },
  actions: {
    async register(context, { email, password, name }){
      const response = await createUserWithEmailAndPassword(auth, email, password);
      if (response) {
        context.commit('SET_USER', response.user);
        response.user.updateProfile({displayName: name});
      } else {
        throw new Error('Unable to register user');
      }
    },

    async updateUser(context, { email, password, name }) {
      const user = auth.currentUser;
  
      if (user) {
        // Actualiza el correo electrónico y la contraseña del usuario
        await user.updateEmail(email);
        await user.updatePassword(password);
  
        // Actualiza el nombre del usuario
        await user.updateProfile({ displayName: name });
  
        // Actualiza el usuario en el estado de Vuex
        context.commit('SET_USER', user);
      } else {
        throw new Error('No user is currently logged in');
      }
    },

    async logIn(context, { email, password }){
      const response = await signInWithEmailAndPassword(auth, email, password);
      if (response) {
        context.commit('SET_USER', response.user);
      } else {
        throw new Error('login failed');
      }
    },

    async logOut(context){
      await signOut(auth);
      context.commit('SET_USER', null);
    },

    async fetchUser(context ,user) {
      context.commit("SET_LOGGED_IN", user !== null);
      if (user) {
        context.commit("SET_USER", {
          displayName: user.displayName,
          email: user.email
        });
      } else {
        context.commit("SET_USER", null);
      }
    }
  }
})
<template>
  <v-app class="backgroundLateral">
    <v-app-bar app color="purple darken-2" dark>
      <v-btn icon @click="drawer = !drawer" v-if="isAuthenticated">
        <v-icon>mdi-menu</v-icon>
      </v-btn>
      <v-app-bar-title> Sap Lu control de usuarios</v-app-bar-title>
      <v-spacer></v-spacer>
      <v-btn color="white" style="font-weight: bold;" @click="logout" v-if="isAuthenticated">Cerrar sesión</v-btn> <!-- Botón de cierre de sesión -->
    </v-app-bar>
    <v-navigation-drawer v-model="drawer" app temporary width="300">
      <v-col cols="12" style="display: flex; flex-direction: column;" v-if="isAuthenticated">
        <router-link to="/home" @click="drawer = false">
          <v-btn block color="primary">Home</v-btn>
        </router-link>
        <v-card outlined class="backgroundView mt-2">
            <v-card-title style="color: white;">Usuarios</v-card-title>
            <v-card-text>
              <router-link to="/customers" @click="drawer = false">
                <v-btn block color="secondary" class="">Listado de usuarios</v-btn>
              </router-link>  
            </v-card-text>
            <v-card-text>
              <router-link to="/customers-create" @click="drawer = false">
                <v-btn block color="secondary" class="">Crear usuario</v-btn>
              </router-link>
            </v-card-text>
        </v-card>
        <v-card outlined class="backgroundView mt-2">
            <v-card-title style="color: white;">Trabajadores</v-card-title>
            <v-card-text>
              <router-link to="/users" @click="drawer = false">
                <v-btn block color="secondary" class="">Listado de trabajadores</v-btn>
              </router-link>  
            </v-card-text>
            <v-card-text>
              <router-link to="/users-create" @click="drawer = false">
                <v-btn block color="secondary" class="">Registrar trabajador</v-btn>
              </router-link>
            </v-card-text>
        </v-card>
      </v-col>
    </v-navigation-drawer>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import { getAuth, onAuthStateChanged, signOut } from 'firebase/auth'; // Asegúrate de que estás importando getAuth de firebase/auth
import { useRouter } from 'vue-router';

export default {
  data: () => ({
    isAuthenticated: false,
    drawer: false,
  }),
  created() {
    const auth = getAuth();
    onAuthStateChanged(auth, (user) => {
      this.isAuthenticated = !!user; // Actualiza isAuthenticated cuando el estado de autenticación cambia
    });
  },
  methods: {
    logout() {
      const auth = getAuth();
      signOut(auth)
        .then(() => {
          this.$router.push('/'); // Redirige al usuario a la página de inicio de sesión después de cerrar la sesión
        })
        .catch((error) => {
          console.error('Error al cerrar la sesión:', error);
        });
    },
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
  color: inherit;
}
a:hover {
  text-decoration: none;
  color: inherit;
}

.backgroundView {
  background-color: rgba(128, 0, 128, 0.4) !important;
}

.backgroundLateral{
  background-color: rgba(135,206,235, 0.4) !important;
}
</style>
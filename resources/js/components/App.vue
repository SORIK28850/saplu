<template>
  <v-app class="backgroundLateral">
    <v-app-bar app color="purple darken-2" dark>
      <v-app-bar-title> Sap Lu control de usuarios</v-app-bar-title>
      <v-spacer></v-spacer>
      <v-btn color="white" style="font-weight: bold;" @click="logout" v-if="isAuthenticated">Cerrar sesión</v-btn> <!-- Botón de cierre de sesión -->
    </v-app-bar>
    <v-row class="mt-15">
      <v-col cols="3" v-if="!isAuthenticated"></v-col>
      <v-col cols="3" style="display: flex; flex-direction: column;" v-if="isAuthenticated">
        <router-link to="/home">
          <v-btn block color="primary">Home</v-btn>
        </router-link>
        <v-card outlined class="backgroundView mt-2">
            <v-card-title style="color: white;">Usuarios</v-card-title>
            <v-card-text>
              <router-link to="/customers">
                <v-btn block color="secondary" class="">Listado de usuarios</v-btn>
              </router-link>  
            </v-card-text>
            <v-card-text>
              <router-link to="/customers-create">
                <v-btn block color="secondary" class="">Crear usuario</v-btn>
              </router-link>
            </v-card-text>
        </v-card>
        <v-card outlined class="backgroundView mt-2">
            <v-card-title style="color: white;">Trabajadores</v-card-title>
            <v-card-text>
              <router-link to="/users">
                <v-btn block color="secondary" class="">Listado de trabajadores</v-btn>
              </router-link>  
            </v-card-text>
            <v-card-text>
              <router-link to="/users-create">
                <v-btn block color="secondary" class="">Registrar trabajador</v-btn>
              </router-link>
            </v-card-text>
        </v-card>
      </v-col>

      <v-divider vertical></v-divider>

      <v-col cols="8" style="justify-content: center;" class="backgroundView">
        <router-view />
      </v-col>
    </v-row>
  </v-app>
</template>

<script>
import { getAuth, onAuthStateChanged, signOut } from 'firebase/auth'; // Asegúrate de que estás importando getAuth de firebase/auth
import { useRouter } from 'vue-router';

export default {
  data: () => ({
    isAuthenticated: false,
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
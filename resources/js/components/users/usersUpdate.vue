<template>
    <v-form ref="form" @submit.prevent="submitForm">
      <v-text-field v-model="user.name" label="Nombre" required></v-text-field>
      <v-text-field v-model="user.email" label="Email" required></v-text-field>
      <v-text-field v-model="user.phone" label="Teléfono" type="number" required></v-text-field>
      <v-text-field v-model="user.password" label="Contraseña" type="password"></v-text-field>
      <v-text-field v-model="confirmPassword" label="Confirmar Contraseña" type="password" :rules="[passwordMatch]"></v-text-field>
      <v-row>
        <v-col cols="6">
          <v-btn :disabled="isSubmitting" type="submit" color="success" block>Actualizar</v-btn>
        </v-col>
        <v-col cols="6">
          <v-btn color="warning" block @click="resetForm">Limpiar</v-btn>
        </v-col>
      </v-row>
    </v-form>
  </template>
  
  <script>
  import axios from 'axios';
 
  const dev = 'http://127.0.0.1:8000';
  const prod = 'https://www.sap-lu.com';

  export default {
    name: 'usersUpdate',
    data: () => ({
      isSubmitting: false,
      user: {
        name: '',
        email: '',
        phone: '',
        password: '',
      },
      confirmPassword: '',
    }),
    created() {
      this.loadUser();
    },
    computed: {
        passwordMatch() {
            return (v) => {
                if (!this.user.password && !v) return true;
                return v === this.user.password || 'Las contraseñas deben coincidir';
            };
        },
    },
    methods: {
      loadUser() {
        axios.get(dev + '/api/users-detail', {
          params: {
            id: this.$route.params.id
          }
        })
        .then(response => {
          this.user = response.data;
        })
        .catch(error => {
          console.error(error);
        });
      },
      async submitForm() {
        if (this.$refs.form.validate()) {
          this.isSubmitting = true;
          try {
            const response = await axios.post(dev + '/api/users-update', this.user);
            this.$swal({
              title: 'Usuario modificado',
              text: 'El usuario ha sido modificado con éxito.',
              icon: 'success',
            });
            this.$router.push({ name: 'users' });
          } catch (error) {
            console.error(error);
          } finally {
            this.isSubmitting = false;
          }
        }
      },
      resetForm() {
        this.user.name = '';
        this.user.email = '';
        this.user.phone = '';
        this.user.password = '';
        this.confirmPassword = '';
      },
    },
  };
  </script>
  
  <style scoped>
  
  </style>
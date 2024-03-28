<template>
    <v-form @submit.prevent="submitForm" ref="form">
      <v-text-field v-model="user.name" label="Nombre" required></v-text-field>
      <v-text-field v-model="user.email" label="Email" required></v-text-field>
      <v-text-field v-model="user.phone" label="Teléfono" type="number" required></v-text-field>
      <v-text-field v-model="user.password" label="Contraseña" type="password" required></v-text-field>
      <v-text-field v-model="confirmPassword" label="Confirmar Contraseña" type="password" :rules="[passwordMatch]" required></v-text-field>
      <v-btn type="submit" color="primary">Crear Usuario</v-btn>
    </v-form>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'createUser',
    data: () => ({
      user: {
        name: '',
        email: '',
        phone: '',
        password: '',
      },
      confirmPassword: '',
    }),
    computed: {
      passwordMatch() {
        return (v) => v === this.user.password || 'Las contraseñas deben coincidir';
      },
    },
    methods: {
      async submitForm() {
        if (this.$refs.form.validate()) {
          try {
            const response = await axios.post('http://127.0.0.1:8000/api/users-create', this.user);
            this.$swal({
              title: 'Usuario creado',
              text: 'El usuario ha sido creado con éxito.',
              icon: 'success',
            });
            this.$router.push({ name: 'users' });
          } catch (error) {
            console.error(error);
          }
        }
      },
    },
  };
  </script>
  
  <style scoped>
  
  </style>
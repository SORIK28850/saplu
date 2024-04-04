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
  import { ref } from 'vue';
  import { useStore } from 'vuex';
  import { useRouter } from 'vue-router';

  const dev = 'http://127.0.0.1:8000';
  const prod = 'https://www.sap-lu.com';
  
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
    setup() {
      const name = ref('')
      const email = ref('')
      const password = ref('')
      const error = ref(null)
      const store = useStore()
      const router = useRouter()

      const Register = async (user) => {
        try {
          await store.dispatch('register', {
            email: user.email,
            password: user.password,
            name: user.name
          })
        }
        catch (err) {
          error.value = err.message
        }
      }

      return { Register, name,email, password, error }
    },
    computed: {
      passwordMatch() {
        return (v) => v === this.user.password || 'Las contraseñas deben coincidir';
      },
    },
    methods: {
      async submitForm() {
        if (this.$refs.form.validate()) {
          try {
            const response = await axios.post(dev + '/api/users-create', this.user);
            this.$swal({
              title: 'Usuario creado',
              text: 'El usuario ha sido creado con éxito.',
              icon: 'success',
            });
            await this.Register(this.user);

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
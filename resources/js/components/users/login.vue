<template>
    <v-form ref="form" @submit.prevent="submitForm">
      <v-text-field v-model="user.email" label="Email" required></v-text-field>
      <v-text-field v-model="user.password" label="Contraseña" type="password" required></v-text-field>
      <v-btn :disabled="isSubmitting" type="submit" color="success" block>Iniciar sesión</v-btn>
    </v-form>
  </template>
  
  <script>
  export default {
    name: 'Login',
    data: () => ({
      isSubmitting: false,
      user: {
        email: '',
        password: '',
      },
    }),
    methods: {
      async submitForm() {
        if (this.$refs.form.validate()) {
          this.isSubmitting = true;
          try {
            const response = await axios.post('http://127.0.0.1:8000/api/login', this.user);
            const token = response;
            localStorage.setItem('token', token);
            console.log('Token guardado:', token);
            this.$router.push({ name: 'Home' });
          } catch (error) {
            console.error(error);
          } finally {
            this.isSubmitting = false;
          }
        }
      },
    },
  };
  </script>
  
  <style scoped>
  
  </style>
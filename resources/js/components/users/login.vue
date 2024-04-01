<template>
	<v-row style="justify-content: center;" class="mt-5">
		<v-col cols="9">
			<v-form ref="form" @submit.prevent="Login">
			<v-text-field v-model="email" label="Email" required></v-text-field>
			<v-text-field v-model="password" label="Contraseña" type="password" required></v-text-field>
			<v-btn :disabled="isSubmitting" type="submit" color="success" block>Iniciar sesión</v-btn>
			<v-alert v-if="success" type="success" dismissible>Usuario logueado</v-alert>
			<span v-if="error" style="color: red;">Contraseña o nombre de usuario erróneos</span>
		  </v-form>
		</v-col>
	</v-row>
</template>

<script>
import { ref } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { getAuth, signInWithEmailAndPassword } from 'firebase/auth';

export default {
  name: "LoginComponent",
  data() {
    return {
      isSubmitting: false,
      email: '',
      password: '',
      error: null,
      success: false,
    };
  },
  methods: {
    async Login() {
      if (this.$refs.form.validate()) {
        this.isSubmitting = true;
        const auth = getAuth();
        try {
          const response = await signInWithEmailAndPassword(auth, this.email, this.password);
          const token = await response.user.getIdToken();
          localStorage.setItem('token', token);
          this.success = true;
          this.$router.push('home');
        } catch (err) {
          this.error = true;
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
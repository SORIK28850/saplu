<template>
    <v-form ref="form" v-model="valid" @submit.prevent="submitForm">
        <v-text-field v-model="item.name" label="Nombre" required variant="solo"></v-text-field>
        <v-text-field v-model="item.phone" label="Teléfono" type="number" required variant="solo"></v-text-field>
        <v-text-field v-model="item.address" label="Dirección" required variant="solo"></v-text-field>
        <v-textarea v-model="item.care" label="Cuidado" required variant="solo"></v-textarea>
        <v-text-field v-model="item.schedule" label="Horario" required variant="solo"></v-text-field>
        <v-text-field v-model="item.pills" label="Pastillas" variant="solo"></v-text-field>
        <v-text-field v-model="item.dietType" label="Tipo de dieta" variant="solo"></v-text-field>
        <v-text-field v-model="item.familyPhone" label="Teléfono de la familia" type="number" variant="solo"></v-text-field>
        <v-row>
      <v-col cols="6">
        <v-btn :disabled="submitting" type="submit" color="success" block>Crear</v-btn>
      </v-col>
      <v-col cols="6">
        <v-btn color="warning" block @click="resetForm">Limpiar</v-btn>
      </v-col>
      <v-snackbar v-model="snackbar" color="success" :timeout="3000">
        Usuario creado
        <v-btn color="white" text @click="snackbar = false">
            Cerrar
        </v-btn>
    </v-snackbar>
    </v-row>
    </v-form>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'CustomersCreate',
    data: () => ({
        snackbar: false,
        submitting: false,
        valid: true,
        item: {
            name: '',
            phone: '',
            address: '',
            care: '',
            schedule: '',
            pills: '',
            dietType: '',
            familyPhone: '',
        },
    }),
    methods: {
      submitForm() {
        if (this.$refs.form.validate()) {
            this.submitting = true;
            axios.post('http://127.0.0.1:8000/api/customers-create', this.item)
                .then(response => {
                    this.snackbar = true;
                    this.$router.push({ name: 'customers' });
                })
                .catch(error => {
                    console.error(error);
                 })
                .finally(() => {
                    this.submitting = false;
            });
        }
      },
      resetForm() {
        this.item = {
            name: '',
            phone: '',
            address: '',
            care: '',
            schedule: '',
            pills: '',
            dietType: '',
            familyPhone: '',
        };
    },
    },
  };
  </script>

<style scoped>

</style>
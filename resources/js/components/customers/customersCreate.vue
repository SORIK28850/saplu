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
        <v-btn type="submit" color="success" block>Crear</v-btn>
      </v-col>
      <v-col cols="6">
        <v-btn color="warning" block @click="resetForm">Limpiar</v-btn>
      </v-col>
    </v-row>
    </v-form>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'CustomersCreate',
    data: () => ({
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
          axios.post('http://127.0.0.1:8000/api/customers-create', this.item)
            .then(response => {
              console.log(response);
            })
            .catch(error => {
              console.error(error);
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
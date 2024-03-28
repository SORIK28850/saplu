<template>
    <v-form ref="form" v-model="valid" @submit.prevent="submitForm">
      <v-file-input v-model="item.photo" label="Foto de perfil" variant="solo"></v-file-input>
      <v-text-field v-model="item.name" label="Nombre" required variant="solo"></v-text-field>
      <v-text-field v-model="item.userInformation" label="Información del usuario" required variant="solo"></v-text-field>
      <v-text-field v-model="item.phone" label="Teléfono" required variant="solo"></v-text-field>
      <v-text-field v-model="item.caregiverPhone" label="Teléfono  del cuidador habitual" variant="solo"></v-text-field>
      <v-text-field v-model="item.address" label="Dirección" required variant="solo"></v-text-field>
      <v-textarea v-model="item.care" label="Cuidado" required variant="solo"></v-textarea>
      <v-text-field v-model="item.schedule" label="Horario" required variant="solo"></v-text-field>
      <v-text-field v-model="item.pills" label="Medicación" variant="solo"></v-text-field>
      <v-text-field v-model="item.observations" label="Observaciones" variant="solo"></v-text-field>
      <v-row>
        <v-col cols="6">
          <v-btn :disabled="submitting" type="submit" color="success" block>Crear</v-btn>
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
        submitting: false,
        valid: true,
        item: {
            name: '',
            userInformation: '',
            phone: '',
            address: '',
            care: '',
            schedule: '',
            pills: '',
            observations: '',
            caregiverPhone: '',
            photo: null,
        },
    }),
    methods: {
      async submitForm() {
        if (this.$refs.form.validate()) {
          this.submitting = true;
          const formData = new FormData();
          for (const key in this.item) {
            if (key === 'photo' && this.item[key]) {
              formData.append(key, this.item[key][0]);
            } else if (typeof this.item[key] === 'number') {
              formData.append(key, parseInt(this.item[key]));
            } else {
              formData.append(key, this.item[key]);
            }
          }
        
          try {
            const response = await axios.post('http://127.0.0.1:8000/api/customers-create', formData, {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            });

            this.$swal({
              title: 'Usuario creado',
              text: 'El usuario ha sido creado con éxito.',
              icon: 'success',
            });

            this.$router.push({ name: 'customers' });
          } catch (error) {
            console.error(error);
          } finally {
            this.submitting = false;
          }
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
            observations: '',
            caregiverPhone: '',
            photo: null,
        };
    },
    },
  };
  </script>

<style scoped>

</style>
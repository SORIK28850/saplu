<template>
  <v-form ref="form" @submit.prevent="submitForm">
    <v-file-input v-model="item.photo" label="Foto de perfil" variant="solo"></v-file-input>
    <v-text-field v-model="item.name" label="Nombre" required variant="solo"></v-text-field>
    <v-text-field v-model="item.userInformation" label="información del usuario" required variant="solo"></v-text-field>
    <v-text-field v-model="item.phone" label="Teléfono" type="number" required variant="solo"></v-text-field>
    <v-text-field v-model="item.familyPhone" label="Teléfono del cuidador habitual" type="number" variant="solo"></v-text-field>
    <v-text-field v-model="item.address" label="Dirección" required variant="solo"></v-text-field>
    <v-textarea v-model="item.care" label="Cuidado" required variant="solo"></v-textarea>
    <v-text-field v-model="item.schedule" label="Horario" required variant="solo"></v-text-field>
    <v-text-field v-model="item.pills" label="Medicación" variant="solo"></v-text-field>
    <v-textarea v-model="item.observations" label="Observaciones" variant="solo"></v-textarea>
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

export default {
  name: 'CustomersUpdate',
  data: () => ({
    isSubmitting: false,
    item: {
      name: '',
      phone: '',
      userInformation: '',
      address: '',
      care: '',
      schedule: '',
      pills: '',
      observations: '',
      familyPhone: '',
      photo: null,
    },
  }),
  created() {
    this.loadItem();
  },
  methods: {
    loadItem() {
      axios.get('http://127.0.0.1:8000/api/customers-detail', {
        params: {
          id: this.$route.params.id
        }
      })
      .then(response => {
        this.item = response.data;
      })
      .catch(error => {
        console.error(error);
      });
    },
    async submitForm() {
      this.isSubmitting = true;
      try {
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
      
        const response = await axios.post('http://127.0.0.1:8000/api/customers-update', formData);
        this.$swal({
          title: 'Usuario modificado',
          text: 'El usuario ha sido modificado con éxito.',
          icon: 'success',
        });

        this.$router.push('/customers');

      } catch (error) {
        console.error(error);
      } finally {
        this.isSubmitting = false;
      }
    },
    resetForm() {
      this.item.name = '';
      this.item.phone = '';
      this.item.address = '';
      this.item.care = '';
      this.item.schedule = '';
      this.item.pills = '';
      this.item.observations = '';
      this.item.familyPhone = '';
      this.item.photo = null;
    },
  },
};
</script>

<style scoped>

</style>

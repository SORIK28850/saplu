<template>
    <v-container class="fill-height" fluid v-if="item">
      <v-row align="center" justify="center">
        <v-col cols="10">
          <v-card>
            <img
              src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg">
            
            <v-card class="mb-4" outlined>
                <v-card-title>Nombre</v-card-title>
                <v-card-text>{{ item.name }}</v-card-text>
            </v-card>

            <v-card class="mb-4" outlined>
                <v-card-title>Información del usuario</v-card-title>
                <v-card-text>{{ item.userInformation }}</v-card-text>
            </v-card>

            <v-card class="mb-4" outlined>
                <v-card-title>Teléfono</v-card-title>
                <v-card-text>{{ item.phone }}</v-card-text>
            </v-card>

            <v-card class="mb-4" outlined>
                <v-card-title>Dirección</v-card-title>
                <v-card-text><a :href="`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(item.address)}`" target="_blank">{{ item.address }}</a></v-card-text>
            </v-card>
            <v-card class="mb-4" outlined>
                <v-card-title>Cuidados</v-card-title>
                <v-card-text>{{ item.care }}</v-card-text>
            </v-card>
            <v-card class="mb-4" outlined>
                <v-card-title>Horario</v-card-title>
                <v-card-text>{{ item.schedule }}</v-card-text>
            </v-card>
            <v-card class="mb-4" outlined>
                <v-card-title>Medicamentos</v-card-title>
                <v-card-text>{{ item.pills }}</v-card-text>
            </v-card>
            <v-card class="mb-4" outlined>
                <v-card-title>Observaciones</v-card-title>
                <v-card-text>{{ item.observations }}</v-card-text>
            </v-card>
            <v-card class="mb-4" outlined>
                <v-card-title>Teléfono familiar</v-card-title>
                <v-card-text>{{ item.familyPhone }}</v-card-text>
            </v-card>

            <v-card-actions>
              <v-spacer></v-spacer>
  
              <v-btn
                text="Volver"
                @click="goBack"
              ></v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script>
import axios from 'axios';

export default {
  name: 'customerDetail',
  data() {
    return {
      item: null,
    };
  },
  methods: {
    goBack() {
      this.$router.go(-1);
    },
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
  },
  created() {
    this.loadItem();
  },
}
</script>
  
<style scoped>
</style>
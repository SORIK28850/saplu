<template>
    <v-container class="fill-height" fluid v-if="item">
      <v-row align="center" justify="center">
        <v-col cols="10">
          <v-card>
            <img
              src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg">
            <v-card-text>
                Nombre: {{ item.name }}<br>
                Teléfono: {{ item.phone }}<br>
                Dirección: {{ item.address }}<br>
                Cuidados: {{ item.care }}<br>
                Horario: {{ item.schedule }}<br>
                Medicamentos: {{ item.pills }}<br> 
                Tipo de dieta: {{ item.dietType }}<br>
                Teléfono familiar: {{ item.familyPhone }}
            </v-card-text>
  
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
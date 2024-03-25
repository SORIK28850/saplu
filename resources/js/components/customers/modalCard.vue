<template>
    <div>
      <v-card
        v-for="(customer, index) in customers"
        :key="index"
        class="mb-4"
      >
        <v-card-title>
          {{ customer.name }}
        </v-card-title>
        <v-card-subtitle>
          ID: {{ customer.id }}
        </v-card-subtitle>
        <v-card-text>
          Phone: {{ customer.phone }} <br>
          Address: {{ customer.address }} <br>
          Care: {{ customer.care }} <br>
          Schedule: {{ customer.schedule }} <br>
          Pills: {{ customer.pills }} <br>
          Diet Type: {{ customer.dietType }} <br>
          Family Phone: {{ customer.familyPhone }} <br>
          Created At: {{ customer.created_at }} <br>
          Updated At: {{ customer.updated_at }}
        </v-card-text>
      </v-card>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'modalCard',
    data() {
      return {
        customers: [],
      };
    },
    mounted() {
      axios.get('http://127.0.0.1:8000/api/customers')
        .then(response => {
          this.customers = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
  </script>
  
  <style scoped>
  </style>
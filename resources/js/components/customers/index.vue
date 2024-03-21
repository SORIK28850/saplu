<template>
  <div>
    Hola
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'CustomersIndex',
  mounted() {
    axios.get('http://127.0.0.1:8000/api/customers')
      .then(response => {
        console.log(response.data);
      })
      .catch(error => {
        console.error(error);
      });
  }
}
</script>

<style scoped>
</style>
<template>
  <div>
    <router-link to="/home">
      <v-btn color="primary">Home</v-btn>
    </router-link>
    <router-link to="/customers">
      <v-btn color="secondary">Customers</v-btn>
    </router-link>
    <router-view />
  </div>
</template>

<script>
export default {
  data: () => ({

  }),
};
</script>
<template>
  <div>
    <router-link to="/home">
      <v-btn color="primary">Home</v-btn>
    </router-link>
    <router-link to="/customers">
      <v-btn color="secondary">Customers</v-btn>
    </router-link>
    <v-row style="justify-content: center;">
      <v-col cols="8">
        <router-view />
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data: () => ({

  }),
};
</script>
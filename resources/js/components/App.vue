<template>
  <div>
    <router-link to="/home">
      <v-btn color="primary">Primary</v-btn>
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
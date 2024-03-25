<template>
  <v-row style="justify-content: center;">
    <v-col cols="6">
      <v-data-table-server
        v-model:items-per-page="itemsPerPage"
        :headers="headers"
        :items="serverItems"
        :items-length="totalItems"
        :loading="loading"
        item-value="name"
        @update:options="loadItems"
      >
      <template v-slot:item.actions="{ item }">
        <router-link :to="{ name: 'customers-detail', params: { id: item.id } }">
          <v-btn color="primary">Ver</v-btn>
        </router-link>
      </template>
    
      </v-data-table-server>
    </v-col>
  </v-row>
</template>

<script>
import axios from 'axios';

export default {
  data: () => ({
    selectedItem: null,
    itemsPerPage: 5,
    headers: [
        { title: 'Nombre', key: 'name', align: 'end' },
        { title: '', key: 'actions', align: 'end' },
      ],
    serverItems: [],
    loading: true,
    totalItems: 0,
    currentPage: 1,
    totalPages: 0,
  }),
  methods: {
    loadItems ({ page, itemsPerPage, sortBy }) {
      this.loading = true
      axios.get(`http://127.0.0.1:8000/api/customers`)
        .then(response => {
          this.totalItems = response.data.length;
          this.totalPages = Math.ceil(this.totalItems / this.itemsPerPage);
          this.currentPage = page;
          this.serverItems = response.data.slice((page - 1) * itemsPerPage, page * itemsPerPage);
          this.loading = false;
        })
        .catch(error => {
          console.error(error);
          this.loading = false;
        });
    },
  },
}
</script>

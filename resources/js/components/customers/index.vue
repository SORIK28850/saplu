<template>
  <v-data-table-server
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="serverItems"
    :items-length="totalItems"
    :loading="loading"
    item-value="name"
    @update:options="loadItems"
  ></v-data-table-server>
</template>

<script>
import axios from 'axios';

export default {
  data: () => ({
    itemsPerPage: 5,
    headers: [
        {
          title: 'ID',
          align: 'start',
          sortable: false,
          key: 'id',
        },
        { title: 'Actions', key: 'actions', align: 'end' },
        { title: 'Name', key: 'name', align: 'end' },
        { title: 'Phone', key: 'phone', align: 'end' },
        { title: 'Address', key: 'address', align: 'end' },
        { title: 'Care', key: 'care', align: 'end' },
        { title: 'Schedule', key: 'schedule', align: 'end' },
        { title: 'Pills', key: 'pills', align: 'end' },
        { title: 'Diet Type', key: 'dietType', align: 'end' },
        { title: 'Family Phone', key: 'familyPhone', align: 'end' },
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
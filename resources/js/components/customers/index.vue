<template>
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
      <v-btn color="primary" @click="openDialog(item)">Ver</v-btn>
    </template>
    
  </v-data-table-server>
  <ModalCard v-model="dialog" @close="dialog = false" :item="selectedItem"/>
</template>

<script>
import axios from 'axios';
import ModalCard from './modalCard.vue';

export default {
  components: {
    ModalCard,
  },
  data: () => ({
    selectedItem: null,
    dialog: false,
    itemsPerPage: 5,
    headers: [
        { title: '', key: 'actions', align: 'end' },
        { title: 'Nombre', key: 'name', align: 'end' },
        
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
    openDialog(item) {
      this.selectedItem = item;
      this.dialog = true;
    },
  },
}
</script>

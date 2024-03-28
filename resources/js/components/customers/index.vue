<template>
  <v-row class="mt-5" style="justify-content: center;">
    <v-col cols="8">
      <v-row style="justify-content: center;">
        <v-col cols="6">
          <v-text-field v-model="search" label="Buscar" outlined dense ></v-text-field>
        </v-col>
      </v-row>

      <v-data-table-server
        style="color: white;"
        class="custom-table"
        v-model:items-per-page="itemsPerPage"
        :headers="headers"
        :items="paginatedItems"
        :items-length="totalItems"
        :loading="loading"
        item-value="name"
        @update:options="loadItems"
      >
        <template v-slot:item.actions="{ item }">
          <router-link :to="{ name: 'customers-detail', params: { id: item.id } }">
            <v-btn color="primary">Ver</v-btn>
          </router-link>
          <router-link :to="{ name: 'customers-update', params: { id: item.id } }">
            <v-btn color="warning" class="ml-1 mr-1">Editar</v-btn>
          </router-link>
          <v-btn color="red" @click="deleteItem(item.id)">Eliminar</v-btn>
        </template>
      </v-data-table-server>
    </v-col>
  </v-row>
</template>

<script>
import axios from 'axios';
import $ from 'jquery';

export default {
  data: () => ({
    selectedItem: null,
    itemsPerPage: 5,
    headers: [
        { title: 'Nombre', key: 'name', align: 'start', sortable: false},
        { title: '', key: 'actions', align: 'end', sortable: false },
      ],
    serverItems: [],
    loading: true,
    totalItems: 0,
    currentPage: 1,
    totalPages: 0,
    search: '',
  }),
  mounted() {
      this.$nextTick(function () {
        $('.custom-table span').css('font-weight', 'bold');
      })
    },
  computed: {
    paginatedItems() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.filteredItems.slice(startIndex, endIndex);
    },
    filteredItems() {
      return this.serverItems.filter(item =>
        item.name.toLowerCase().includes(this.search.toLowerCase())
      );
    }
  },
  methods: {
    loadItems({ page, itemsPerPage, sortBy }) {
      this.loading = true;
      axios.get(`http://127.0.0.1:8000/api/customers`)
        .then(response => {
          this.totalItems = response.data.length;
          this.totalPages = Math.ceil(this.totalItems / this.itemsPerPage);
          this.currentPage = page;
          this.serverItems = response.data;
          this.loading = false;
        })
        .catch(error => {
          console.error(error);
          this.loading = false;
        });
    },
    async deleteItem(id) {
      const confirmed = await this.$swal({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
      });

      if (confirmed.isConfirmed) {
        try {
          const response = await axios.delete('http://127.0.0.1:8000/api/customers-delete', { data: { id: id } });
          this.$swal('Eliminado!', 'El usuario ha sido eliminado.', 'success');
          this.loadItems({ page: this.currentPage, itemsPerPage: this.itemsPerPage });
        } catch (error) {
          console.error(error);
        }
      }
    },
  },
}
</script>

<style scoped>
.custom-table {
  background-color: rgba(128, 0, 128) !important;
  border-radius: 5% !important;
}

.custom-table th {
  font-weight: bold;
}
</style>

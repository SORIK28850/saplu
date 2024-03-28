<template>
    <v-container class="fill-height" fluid v-if="item">
      <div id="pdf-content">
        <v-row align="center" justify="center">
          <v-col cols="10">
            <v-card>
              <img
                class="customer-photo"
                :src="item.photo ? `http://127.0.0.1:8000/uploads/${item.photo}` : 'https://source.unsplash.com/random'">
              
              <v-card class="mb-4" outlined>
                  <v-card-title>Nombre</v-card-title>
                  <v-card-text>{{ item.name }}</v-card-text>
              </v-card>

              <v-card class="mb-4" outlined>
                  <v-card-title>Información del usuario</v-card-title>
                  <v-card-text>{{ item.userInformation }}</v-card-text>
              </v-card>

              <v-card class="mb-4" outlined>
                  <v-card-title>Teléfono</v-card-title>
                  <v-card-text>{{ item.phone }}</v-card-text>
              </v-card>

              <v-card class="mb-4" outlined>
                  <v-card-title>Teléfono del cuidador habitual</v-card-title>
                  <v-card-text>{{ item.caregiverPhone }}</v-card-text>
              </v-card>

              <v-card class="mb-4" outlined>
                  <v-card-title>Dirección</v-card-title>
                  <v-card-text><a :href="`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(item.address)}`" target="_blank">{{ item.address }}</a></v-card-text>
              </v-card>
              <v-card class="mb-4" outlined>
                  <v-card-title>Cuidados</v-card-title>
                  <v-card-text>{{ item.care }}</v-card-text>
              </v-card>
              <v-card class="mb-4" outlined>
                  <v-card-title>Horario</v-card-title>
                  <v-card-text>{{ item.schedule }}</v-card-text>
              </v-card>
              <v-card class="mb-4" outlined>
                  <v-card-title>Medicación</v-card-title>
                  <v-card-text>{{ item.pills }}</v-card-text>
              </v-card>
              <v-card class="mb-4" outlined>
                  <v-card-title>Observaciones</v-card-title>
                  <v-card-text>{{ item.observations }}</v-card-text>
              </v-card>

              <v-card-actions>
                <v-btn color="success" variant="outlined" @click="exportToPdf">Exportar a PDF</v-btn>

                <v-spacer></v-spacer>
    
                <v-btn
                  variant="outlined"
                  text="Volver"
                  @click="goBack"
                ></v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </div>
    </v-container>
  </template>
  
<script>
import axios from 'axios';
import { jsPDF } from 'jspdf';
import html2canvas from 'html2canvas';

export default {
  name: 'customerDetail',
  data() {
    return {
      item: null,
    };
  },
  methods: {
    exportToPdf() {
     html2canvas(document.querySelector("#pdf-content")).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'mm', 'a4');
        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();
        const imageWidth = canvas.width;
        const imageHeight = canvas.height;
        const ratio = imageWidth/imageHeight >= pageWidth/pageHeight ? pageWidth / imageWidth : pageHeight / imageHeight;
        const width = imageWidth * ratio;
        const height = imageHeight * ratio;
        pdf.addImage(imgData, 'PNG', 0, 0, width, height);
        pdf.save("ficha" + this.item.name + ".pdf"); 
      });
    },
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
.customer-photo {
  width: 100%;
  max-height: 600px;
  object-fit: cover;
}
</style>
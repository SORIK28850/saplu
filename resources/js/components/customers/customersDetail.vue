<template>
    <v-container class="fill-height" fluid v-if="item">
      <v-row align="center" justify="center" id="pdf-content">
        <v-col cols="10">
          <v-card>
            <img
              class="customer-photo"
              :src="item.photo ? `https://www.sap-lu.com/public/uploads/${item.photo}` : 'https://source.unsplash.com/random'">
            
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
              <v-btn @click="generatePDF" success>Descargar PDF</v-btn>

              <v-spacer></v-spacer>
  
              <v-btn
                text="Volver"
                @click="goBack"
              ></v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
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
    goBack() {
      this.$router.go(-1);
    },
    async generatePDF() {
      this.$nextTick(() => {
        setTimeout(async () => {
          const element = document.querySelector('#pdf-content');
          const imgElement = element.querySelector('.customer-photo');
          const response = await fetch(imgElement.src);
          const blob = await response.blob();
          imgElement.src = URL.createObjectURL(blob);
          html2canvas(element).then((canvas) => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');
            const imgProps= pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save(`${this.item.name}.pdf`);
          });
        }, 1000);
      });
    },
    loadItem() {
      axios.get('https://www.sap-lu.com/api/customers-detail', {
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
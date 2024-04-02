<template>
  <v-container class="fill-height" fluid v-if="item">
    <div id="pdf-content" style="width: 100%;">
      <v-row align="center" justify="center">
        <v-col cols="10">
          <v-card>
            <div style="display: flex; justify-content: center; align-items: center;">
              <img
              class="customer-photo"
              :src="item.photo ? `http://127.0.0.1:8000/uploads/${item.photo}` : 'https://source.unsplash.com/random'">
            </div>            
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
              <v-btn
                color="success"
                variant = "outlined"
                text="Descargar en PDF"
                @click="downloadPDF"
              ></v-btn>

              <v-spacer></v-spacer>

              <v-btn
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
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';


export default {
name: 'customerDetail',
data() {
  return {
    item: null,
    photo: null,
  };
},
methods: {
  downloadPDF() {
    html2canvas(document.querySelector("#pdf-content"), { useCORS: true }).then(canvas => {
      const imgData = canvas.toDataURL('image/png');
      const pdf = new jsPDF('p', 'mm', 'a4');
      const pageWidth = pdf.internal.pageSize.getWidth();
      const pageHeight = pdf.internal.pageSize.getHeight();
      const imageWidth = canvas.width * 0.5;
      const imageHeight = canvas.height * 0.5;
      const ratio = imageWidth/imageHeight >= pageWidth/pageHeight ? pageWidth / imageWidth : pageHeight / imageHeight;
      const width = imageWidth * ratio;
      const height = imageHeight * ratio;
      pdf.addImage(imgData, 'PNG', 0, 0, width, height);

      // Calcular la posición del enlace
      const linkX = 60; // Ajustar según sea necesario
      const linkY = pageHeight - 50; // Ajustar según sea necesario

      // Cambiar el color del texto a verde
      pdf.setTextColor(0, 255, 0);

      // Añadir el enlace
      const link = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(this.item.address)}`;
      pdf.textWithLink('Ver dirección en Google Maps', linkX, linkY, { url: link });

      // Cambiar el color del texto de nuevo a negro
      pdf.setTextColor(0, 0, 0);

      pdf.save(this.item.name + ".pdf"); 
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
      this.photo = this.item.photo;
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
max-width: 100%;
max-height: 100%;
object-fit: cover;
}
</style>
<template>
  <v-dialog max-width="500">
      <template v-slot:default="{ isActive }">
        <v-card title="Dialog">
          <img
            height="200px"
            src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg">
          <v-card-text>
            Nombre: {{ item.name }}<br>
            Teléfono: {{ item.phone }}<br>
            Dirección: {{ item.address }}<br>
            Cuidados: {{ item.care }}<br>
            Horario: {{ item.schedule }}<br>
            Medicamentos: {{ item.pills }}<br> 
            Tipo de dieta: {{ item.dietType }}<br>
            Teléfono familiar: {{ item.familyPhone }}
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
              text="Close Dialog"
              @click="$emit('close')"
            ></v-btn>
          </v-card-actions>
        </v-card>
      </template>
  </v-dialog>
</template>

<script>
export default {
  name: 'ModalCard',
  props: {
    item: Object,
  },
}
</script>

<style scoped>
</style>
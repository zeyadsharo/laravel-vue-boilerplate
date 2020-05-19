<template>
  <v-card>
    <v-card-title>
      Requsets
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table :headers="headers" :items="desserts" :search="search"></v-data-table>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      headers: [
        {
          text: "Request To",
          align: "start",
          sortable: false,
          value: "name"
        },
        { text: "id", value: "calories" },
        { text: "Requset Number", value: "fat" },
        { text: "data time", value: "carbs" },
        { text: "description", value: "protein" },
        { text: "process", value: "iron" }
      ],
      desserts: [
        {
          name: "ICT Science",
          calories: 231,
          fat: 24322,
          carbs: "12:30 AM",
          protein: "cable internet crashed",
          iron: "completed "
        },
        {
          name: "ICT Science",
          calories: 231,
          fat: 12453,
          carbs: "9:15 AM",
          protein: "Change PC",
          iron: "denied"
        }
      ]
    };
  }
};
</script>
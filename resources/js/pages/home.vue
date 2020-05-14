<template>
  <div id="app">
    <v-app id="inspire" light>
      <v-card>
        <v-toolbar color="cyan" dark flat>
          <v-spacer></v-spacer>
          <v-toolbar-title>Maintenace System Home</v-toolbar-title>

          <v-spacer></v-spacer>

          <!-- <v-btn icon>
            <v-icon>mdi-magnify</v-icon>
          </v-btn>-->

          <v-btn icon>
            <v-icon color="red" @click="logout">mdi-logout</v-icon>
          </v-btn>

          <template v-slot:extension>
            <v-tabs v-model="model" centered slider-color="yellow">
              <v-tab :href="`#tab-${i}`">Requsets</v-tab>
              <v-tab :href="`#tab-${i}`">History</v-tab>
              <v-tab :href="`#tab-${i}`">In process</v-tab>
            </v-tabs>
          </template>
        </v-toolbar>

        <v-tabs-items v-model="model">
          <v-tab-item v-for="i in 3" :key="i" :value="`tab-${i}`">
            <v-card flat>
              <v-card-text v-text="text"></v-card-text>
            </v-card>
          </v-tab-item>
        </v-tabs-items>
      </v-card>

      <v-content>
        <v-container class="fill-height" fluid></v-container>
      </v-content>
      <v-footer color="primary lighten-1" padless>
        <v-row justify="center" no-gutters>
          <v-col class="primary lighten-2 py-4 text-center white--text" cols="12">
            {{ new Date().getFullYear() }} —
            <strong>University Of Zakho</strong>
          </v-col>
        </v-row>
      </v-footer>
    </v-app>
  </div>
</template>

<script>
export default {
  props: {
    source: String
  },
  data: () => ({
    drawer: null,
    links: ["Home", "About Us", "Team", "Services", "Blog", "Contact Us"],
    model: "tab-2",
    text: "tabs ,"
  }),
 methods: {
    logout() {
      axios.post("/logout").then(response => window.location.reload());
    },
  }
};
</script>
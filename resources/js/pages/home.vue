<template>
  <div id="app">
    <v-app id="inspire" light>
      <v-card>
        <v-toolbar color="cyan" dark flat>
          <div class="mx-3"></div>

          <v-badge bordered bottom color="deep-purple accent-4" dot offset-x="10" offset-y="10">
            <v-avatar    size="40">
              <v-img src="https://cdn.vuetifyjs.com/images/lists/2.jpg"></v-img>
            </v-avatar>
     
          </v-badge>       
          Zeyad Sharo
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
            <v-tabs v-model="activeTab" centered slider-color="yellow">
              <v-tab v-for="tab in tabs" :key="tab.id" :to="tab.route" exact>{{ tab.name }}</v-tab>
            </v-tabs>
          </template>
        </v-toolbar>
      </v-card>

      <v-content>
        <v-container class="fill-height" fluid>
          <v-layout justify-center>
            <v-flex shrink>
              <router-view></router-view>
            </v-flex>
          </v-layout>
        </v-container>
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
    activeTab: `/home/requests`,
    tabs: [
      { id: 1, name: "Requests", route: `/home/requests` },
      { id: 2, name: "History", route: `/home/history` },
      { id: 3, name: "in Process", route: `/home/inprogress` }
    ]
  }),
  methods: {
    logout() {
      axios.post("/logout").then(response => window.location.reload());
    }
  }
};
</script>
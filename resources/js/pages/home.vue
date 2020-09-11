<template>
  <div id="app">
    <v-app id="inspire" light>
      <v-card>
        <v-toolbar color="primary lighten-1" dark flat>
          <div class="mx-3"></div>

          <v-badge bordered bottom color="deep-purple accent-4" dot offset-x="10" offset-y="10">
            <v-avatar size="40">
              <v-img src="https://cdn.vuetifyjs.com/images/lists/2.jpg"></v-img>
            </v-avatar>
          </v-badge>
          {{user.name}}
          <v-spacer></v-spacer>
          <v-toolbar-title>{{ $t('system') }}</v-toolbar-title>
          <v-spacer></v-spacer>
         <languageswitcher/>
          <v-btn icon>
            <v-icon color="red" @click="logout">mdi-logout</v-icon>
          </v-btn>
          <template v-slot:extension>
            <v-tabs v-model="activeTab" centered slider-color="yellow">
              <router-link :to="{name:'Request', params: { lang: `${$i18n.locale}` }}"
              ><v-tab>{{ $t('tabs.request') }} </v-tab></router-link>
             <router-link :to="{name:'History', params: { lang: `${$i18n.locale}` }}"
              ><v-tab>{{ $t('tabs.history') }}</v-tab></router-link>
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
          <v-col class="primary lighten-1 py-4 text-center white--text" cols="12">
            {{ new Date().getFullYear() }} —
            <strong>{{ $t('foo.name') }}</strong>
          </v-col>
        </v-row>
      </v-footer>
    </v-app>
  </div>
</template>

<script>
 import languageswitcher from '../components/LanguageSwitcher'
export default {

  components: {languageswitcher},
  props: {
    source: String,
  },
  data: () => ({
    drawer: null,
    activeTab: 2,
    tabs: [
      { id: 1, name: "Requests", route: "`/${i18n.locale}/home/requests`" },
      { id: 2, name: "History", route: `/home/history` },
      { id: 3, name: "in Process", route: `/home/inprogress` },
    ],
  }),
  methods: {
    logout() {
      axios.post("/logout").then((Response) => (window.location.href = "/"));
    },
  },
  props: ["user"],
};
</script>



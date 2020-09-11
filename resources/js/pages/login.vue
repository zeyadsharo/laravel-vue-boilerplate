<template>
  <div id="app">
    <v-app id="inspire" light>
      <v-app-bar app color="primary lighten-1" rounded dark>
        <v-spacer></v-spacer>
        <v-toolbar-title>Maintenace Sytem</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-app-bar>

      <v-content>
        <v-container class="fill-height" fluid>
          <v-row justify="center" no-gutters>
            <v-col cols="12" sm="12">
              <v-hover v-slot:default="{ hover }" open-delay="200">
                <v-card :elevation="hover ? 16 : 2" class="mx-auto" height="500" max-width="900">
                  <v-card-text
                    class="font-weight-medium mt-12 text-center subtitle-1"
                  >How System Work</v-card-text>
                  <v-spacer />
                  <v-card align-center class="mx-auto" height="400" max-width="850">
                    <iframe
                      width="850"
                      height="400"
                      src="https://www.youtube.com/embed/mpKd7BzNtZg"
                      frameborder="0"
                      allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                      allowfullscreen
                    ></iframe>
                  </v-card>
                </v-card>
              </v-hover>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12" sm="12">
              <v-card align-center class="mx-auto" width="850">
                <v-btn rounded align-center block color="success" dark href="/googlelogin">
                  <v-icon color="blue darken-2">mdi-google</v-icon>Login
                </v-btn>
              </v-card>
            </v-col>
          </v-row>
          <v-btn  rounded align-center block color="success" dark >
            <v-icon color="blue darken-2">mdi-google</v-icon>{{count}}
          </v-btn>
        </v-container>
      </v-content>
      <v-footer color="primary lighten-1" padless>
        <v-row justify="center" no-gutters>
          <v-btn
            v-for="link in links"
            :key="link"
            color="white"
            text
            rounded
            class="my-2"
          >{{ link }}</v-btn>
          <v-col class="primary lighten-2 py-4 text-center white--text" cols="12">
            {{ new Date().getFullYear() }} —
            <strong>University Of Zakho</strong>
            <strong>{{ $t('message') }}</strong>
          </v-col>
        </v-row>
      </v-footer>
    </v-app>
  </div>
</template>

<script>
export default {
  props: {
    source: String,
  },

  data: () => ({
    drawer: null,
    links: ["Home", "About Us", "Team", "Services", "Blog", "Contact Us"],
  }),

  methods: {
    login() {
      axios.get("/login").then((Response) => (window.location.href = "home"));
    },
    increment() {
      console.log(this.$store.state.count);
    },
  },
   computed: {
        count () {
            return this.$store.state.count
        }
    }
};
</script>

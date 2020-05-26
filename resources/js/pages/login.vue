<template>
  <div id="app">
    <v-app id="inspire" light>
      <!-- <v-navigation-drawer v-model="drawer" app>
      <v-list dense>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-contact-mail</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Contact</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      </v-navigation-drawer>-->

      <v-app-bar app color="primary lighten-1" rounded dark>
        <v-spacer></v-spacer>
        <v-toolbar-title>Maintenace Sytem</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-app-bar>

      <v-content>
        <v-container class="fill-height" fluid>
          <!-- <v-card width="1000px" align-center>
          <v-timeline :dense="$vuetify.breakpoint.smAndDown">
            <v-timeline-item color="purple lighten-2" fill-dot right>
              <v-card>
                <v-card-title class="purple lighten-2">
                  <v-icon dark size="42" class="mr-4">mdi-magnify</v-icon>
                  <h2 class="display-1 white--text font-weight-light">Title 1</h2>
                </v-card-title>
                <v-container>
                  <v-row>
                    <v-col
                      cols="12"
                      md="10"
                    >Lorem ipsum dolor sit amet, no nam oblique veritus. Commune scaevola imperdiet nec ut, sed euismod convenire principes at. Est et nobis iisque percipit.</v-col>
                    <v-col class="hidden-sm-and-down text-right" md="2">
                      <v-icon size="64">mdi-calendar-text</v-icon>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card>
            </v-timeline-item>

            <v-timeline-item color="amber lighten-1" fill-dot left small>
              <v-card>
                <v-card-title class="amber lighten-1 justify-end">
                  <h2 class="display-1 mr-4 white--text font-weight-light">Title 2</h2>
                  <v-icon dark size="42">mdi-home-outline</v-icon>
                </v-card-title>
                <v-container>
                  <v-row>
                    <v-col
                      cols="12"
                      md="8"
                    >Lorem ipsum dolor sit amet, no nam oblique veritus. Commune scaevola imperdiet nec ut, sed euismod convenire principes at. Est et nobis iisque percipit.</v-col>
                    <v-col cols="12" md="4">Lorem ipsum dolor sit amet, no nam oblique veritus.</v-col>
                  </v-row>
                </v-container>
              </v-card>
            </v-timeline-item>

            <v-timeline-item color="cyan lighten-1" fill-dot right>
              <v-card>
                <v-card-title class="cyan lighten-1">
                  <v-icon class="mr-4" dark size="42">mdi-email-outline</v-icon>
                  <h2 class="display-1 white--text font-weight-light">Title 3</h2>
                </v-card-title>
                <v-container>
                  <v-row>
                    <v-col
                      v-for="n in 3"
                      :key="n"
                      cols="12"
                      md="4"
                    >Lorem ipsum dolor sit amet, no nam oblique veritus no nam oblique.</v-col>
                  </v-row>
                </v-container>
              </v-card>
            </v-timeline-item>

            <v-timeline-item color="red lighten-1" fill-dot left small>
              <v-card>
                <v-card-title class="red lighten-1 justify-end">
                  <h2 class="display-1 mr-4 white--text font-weight-light">Title 4</h2>
                  <v-icon dark size="42">mdi-account-multiple-outline</v-icon>
                </v-card-title>
                <v-container>
                  <v-row>
                    <v-col class="hidden-sm-and-down" md="2">
                      <v-icon size="64">mdi-server-network</v-icon>
                    </v-col>
                    <v-col
                      cols="12"
                      md="10"
                    >Lorem ipsum dolor sit amet, no nam oblique veritus. Commune scaevola imperdiet nec ut, sed euismod convenire principes at. Est et nobis iisque percipit, an vim zril disputando voluptatibus.</v-col>
                  </v-row>
                </v-container>
              </v-card>
            </v-timeline-item>

            <v-timeline-item color="green lighten-1" fill-dot right>
              <v-card>
                <v-card-title class="green lighten-1">
                  <v-icon class="mr-4" dark size="42">mdi-phone-in-talk</v-icon>
                  <h2 class="display-1 white--text font-weight-light">Title 5</h2>
                </v-card-title>
                <v-container>
                  <v-row>
                    <v-col>Lorem ipsum dolor sit amet, no nam oblique veritus. Commune scaevola imperdiet nec ut, sed euismod convenire principes at. Est et nobis iisque percipit, an vim zril disputando voluptatibus, vix an salutandi sententiae.</v-col>
                  </v-row>
                </v-container>
              </v-card>
            </v-timeline-item>
          </v-timeline>
          </v-card>-->
          <v-row>
            <v-col cols="12" sm="12">
              <v-hover v-slot:default="{ hover }" open-delay="200">
                <v-card :elevation="hover ? 16 : 2" class="mx-auto" height="500" max-width="900">
                  <v-card-text
                    class="font-weight-medium mt-12 text-center subtitle-1"
                  >How System Work</v-card-text>
                  <v-spacer />
                  <v-card align-center class="mx-auto" height="400" max-width="850">
                    <iframe
                      align-center
                      width="850"
                      height="400"
                      src="https://www.youtube.com/embed/mpKd7BzNtZg"
                      frameborder="0"
                      allow="autoplay; encrypted-media"
                      allowfullscreen
                      rounded
                    ></iframe>
                  </v-card>
                </v-card>
              </v-hover>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12" sm="12">
              <v-card align-center class="mx-auto" width="850">
                <v-btn rounded align-center block color="success" dark @click="login">
                  <v-icon color="blue darken-2">mdi-google</v-icon>Login
                </v-btn>
              </v-card>
            </v-col>
          </v-row>
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
    links: ["Home", "About Us", "Team", "Services", "Blog", "Contact Us"]
  }),

  methods: {
    login() {
      axios.get("/login").then(Response => (window.location.href = "home"));
    }
  }
};
</script>
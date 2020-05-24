<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer"  absolute :clipped="$vuetify.breakpoint.lgAndUp" app>
      <v-list dense>
          <sidebar></sidebar>
      </v-list>
    </v-navigation-drawer>
    <navbar :user="user"></navbar>
    <v-content>
      <v-container class="fill-height" fluid>
         <v-layout justify-center>
            <v-flex shrink>
              <router-view></router-view>
            </v-flex>
          </v-layout>
      </v-container>
    </v-content>
 

    
  </v-app>
</template>

<script>
import Sidebar from "./_sidebar";
import Navbar from "./_navbar";
export default {
  components: { Sidebar, Navbar },
  props: {
    source: String
  },
  data: () => ({
    dialog: false,
    drawer: null,
   
  }),
  props: ["user"]
};
</script>
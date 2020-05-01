<template v-slot:activator="{ on }">
  <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" app color="blue darken-3" dark>
    <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
    <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
      <span class="hidden-sm-and-down">Maintenance Admin</span>
    </v-toolbar-title>
    <!-- <v-text-field
      flat
      solo-inverted
      hide-details
      prepend-inner-icon="mdi-magnify"
      label="Search"
      class="hidden-sm-and-down"
    /> -->
    <v-spacer />

    <v-menu left bottom>
      <template v-slot:activator="{ on }">
        <v-btn icon v-on="on" @click="markAsRead" text>
          <!-- <v-badge color="red" overlap>
          <span slot="badge">{{unreadNotifications.length}}</span>
          <v-icon medium>far fa-bell</v-icon>
          </v-badge>-->
          <v-badge
            :content="unreadNotifications.length"
            :value="unreadNotifications.length"
            color="red"
            overlap
          >
            <v-icon>mdi-bell</v-icon>
          </v-badge>
        </v-btn>
      </template>

      <v-list>
        <v-list-item
          :class="{'green': notification.read_at==null}"
          @click="markAsRead"
          v-for="notification in allNotifications"
          :key="notification.id"
        >
          <v-list-item-title>{{notification.data.createdUser.name}} has just registered on {{notification.created_at}}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
    <v-menu left bottom>
      <template v-slot:activator="{ on }">
        <v-btn icon v-on="on" @click="markAsRead" text>
            <v-icon>far fa-user</v-icon>
        </v-btn>
      </template>

      <v-list>
        <v-list-item>
          <v-list-item-title>{{user.name}}</v-list-item-title>
        </v-list-item>
        <v-list-item>
          <v-list-item-title @click="logout" ripple="ripple" rel="noopener">
            <v-list-item-action>
              <v-icon color="red">fas fa-power-off </v-icon> 
            </v-list-item-action>
           Logout
          </v-list-item-title>

        </v-list-item>
      </v-list>
    </v-menu>

    <!-- <v-btn icon large>
      <v-avatar size="32px" item>
        <v-img src="https://cdn.vuetifyjs.com/images/logos/logo.svg" alt="Vuetify" />
      </v-avatar>
    </v-btn>-->
  </v-app-bar>
</template>


<script>
export default {
  props: ["user"],
  data: () => ({
    drawer: true,
    allNotifications: [],
    unreadNotifications: []
  }),
  props: ["user"],
  watch: {
    allNotifications(val) {
      this.unreadNotifications = this.allNotifications.filter(notification => {
        return notification.read_at == null;
      });
    }
  },

  methods: {
    logout() {
      axios.post("/logout").then(response => window.location.reload());
    },
    markAsRead() {
      axios.get("/mark-all-read/" + this.user.id).then(response => {
        this.unreadNotifications = [];
      });
    }
  },

  created() {
    this.allNotifications = this.user.notifications;

    this.unreadNotifications = this.allNotifications.filter(notification => {
      return notification.read_at == null;
    });

    // Echo.private("App.User." + this.user.id).notification(notification => {
    //   this.allNotifications.unshift(notification.notification);
    // });
  }
};
</script>

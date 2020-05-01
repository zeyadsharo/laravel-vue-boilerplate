<template v-slot:activator="{ on }">
  <v-app-bar  color="primary darken-1" dart app fixed clipped-left>
    <v-app-bar-nav-icon  color="red" @click="drawer = true"></v-app-bar-nav-icon>
     <v-toolbar-title>Maintenance Admin</v-toolbar-title>
    <v-spacer></v-spacer>

    <v-menu
      offset-y
      origin="center center"
      class="elelvation-1"
      :nudge-bottom="14"
      transition="scale-transition"
    >
      <v-btn color="red" @click="markAsRead" icon text >
        <v-badge color="red" overlap>
          <span slot="badge">{{unreadNotifications.length}}</span>
          <v-icon medium>far fa-bell</v-icon>
        </v-badge>
        
      </v-btn>

      <v-list>
        <v-list-tile :class="{'green': notification.read_at==null}" @click="markAsRead" v-for="notification in allNotifications" :key="notification.id">
          <v-list-tile-content>
            <v-list-tile-title>{{notification.data.createdUser.name}} has just registered on {{notification.created_at}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-menu>
    <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
      <v-btn icon large text >
        <v-avatar size="30px">
          <img  src="https://via.placeholder.com/150" alt="Michael Wang">
        </v-avatar>
      </v-btn>
      <v-list class="pa-0">
        <v-list-tile ripple="ripple" rel="noopener">
          <v-list-tile-content>
            <v-list-tile-title>{{user.name}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>

      <v-list class="pa-0">
        <v-list-tile @click="logout" ripple="ripple" rel="noopener">
          <v-list-tile-action>
            <v-icon color="red">fas fa-power-off</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Logout</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>


<script>
export default {
  props: ["user"],
  data: () => ({
    drawer: false,
    allNotifications: [],
    unreadNotifications: [],
  }),
  props: ["user"],
  watch:{
      allNotifications(val){
          this.unreadNotifications =  this.allNotifications.filter(notification => {
            return notification.read_at == null;
        });
      }
  },

  methods: {
    logout() {
      axios.post("/logout").then(response => window.location.reload());
    },
    markAsRead() {
      axios.get("/mark-all-read/" + this.user.id).then(response=>{
          this.unreadNotifications = [];
      });
    }
  },
 
  created() {
    this.allNotifications = this.user.notifications;

    this.unreadNotifications =  this.allNotifications.filter(notification => {
        return notification.read_at == null;
      });

    // Echo.private("App.User." + this.user.id).notification(notification => {
    //   this.allNotifications.unshift(notification.notification);
    // });
  }
};
</script>

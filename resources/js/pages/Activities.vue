<template v-slot:activator="{ on }">
  <v-layout row fill-height justify-space-around>
    <div v-if="!activities.length">
      <h3>No Activities to show</h3>
    </div>


    <v-timeline :dense="$vuetify.breakpoint.smAndDown">
      <v-timeline-item
        color="purple lighten-2"
        fill-dot
        this.left
        v-for="(activity, i) in activities"
        :key="i"
      >
        <v-card>
          <v-card-title class="purple lighten-2">
            <v-icon dark size="42" class="mr-4">mdi-magnify</v-icon>
            <h1 class="display-1 white--text">{{activity.description}}</h1>
          </v-card-title>
          <v-container>
            <div class="py-1">
              <div
                class="display-1 green--text"
                style="min-width: 700px;"
              >{{activity.created_at | updateDate}}</div>
              <div style="min-width: 700px;">{{activity.name}}</div>
            </div>

            <!-- <v-icon size="64">mdi-calendar-text</v-icon> -->
          </v-container>
        </v-card>
      </v-timeline-item>
    </v-timeline>
  </v-layout>
</template>

<script>
export default {
  data: () => ({
    activities: [],
    left: "left"
  }),

  created() {
    axios.get("/api/activities/" + window.user.user.id).then(response => {
      this.activities = response.data;
    });
  }
};
</script>

<template v-slot:activator="{ on }">
  <v-list dense>
    <v-list-item exact to="/admin">
      <v-list-item-action>
        <v-icon color="blue">fas fa-tachometer-alt</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>Dashboard</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-list-group no-action>
      <v-list-item slot="activator">
        <v-list-item-action>
          <v-icon color="blue">fas fa-users</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>User Management</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item to="/admin/users">
        <v-list-item-action>
          <v-icon color="#fd7e14">far fa-user</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>user</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item to="/admin/roles">
        <v-list-item-action>
          <v-icon color="primary">fas fa-toolbox</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Roles</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item to="/admin/permissions">
        <v-list-item-action>
          <v-icon color="#f783ac">fas fa-key</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Permissions</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-group>

    <v-list-item to="/admin/activities">
      <v-list-item-action>
        <v-icon color="blue">fa fa-user-cog</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>Activities</v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-list-item to="/admin/settings">
      <v-list-item-action>
        <v-icon color="blue">settings</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>Settings</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
  </v-list>
</template>


<script>
export default {};
</script>



<template>
  <div>
    <v-toolbar dark flat color="#fd7e14 darken-1">
      <v-toolbar-title>Users</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" rounded color="primary" dark class="mb-2">New User</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout color="primary" wrap>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="editedItem.password" label="password"></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="editedItem.confirm_password" label="Confirm Password"></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <h3>Roles</h3>
                  <v-select
                    v-model="editedItem.role"
                    :items="allRoles"
                    label="Roles"
                    item-text="name"
                    return-object
                    chips
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-select
                    v-model="editedItem.permissions"
                    :items="allPermissions"
                    label="Permissions"
                    item-text="name"
                    return-object
                    multiple
                    chips
                  ></v-select>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
            <v-btn color="blue" flat @click="save">{{editdilaog}}</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
<v-card>

  <v-card-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table :headers="headers" :search="search" :items="tableData" class="elevation-1">
      <v-spacer></v-spacer>
      <template slot="items" slot-scope="props">
        <td>{{ props.item.name }}</td>
        <td class="text-xs-right">{{ props.item.email }}</td>
        <td class="text-xs-right" v-if="props.item.role">{{ props.item.role.name |upText }}</td>
        <td class="text-xs-right" v-else>n/a</td>
        <td class="text-xs-right">{{ props.item.created_at | myDate }}</td>
        <td class="text-xs-right">{{ props.item.updated_at | myDate }}</td>
        <td class="justify-center layout px-0">
          <v-icon color="green" small class="mr-2" @click="editItem(props.item)">edit</v-icon>
          <v-icon
            v-if="props.item.email!='zeyadsharo85@gmail.com'"
            small
            @click="deleteItem(props.item)"
            color="red"
          >delete</v-icon>
        </td>
      </template>
      <template slot="no-data">
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>

</v-card>
  </div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
     search: '',
    editdilaog: "save",
    headers: [
      { text: "Username", value: "name" },
      { text: "Email", value: "email" },
      { text: "Role", value: "role" },
      { text: "Created", value: "created_at" },
       { text: "Updated", value: "updated_at" },
      { text: "Actions", value: "name", sortable: false }
    ],
    tableData: [],
    editedIndex: -1,
    allRoles: [],
    allPermissions: [],
    editedItem: {
      name: "",
      email: "",
      role: {},
      permissions: [],
      created_at: ""
    },
    defaultItem: {
      name: "",
      email: "",
      role: {},
      permissions: [],
      created_at: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New User" : "Edit User";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios.get("/api/users").then(response => {
        this.tableData = response.data.data;
      });

      axios
        .get("/api/roles")
        .then(response => (this.allRoles = response.data.data));
      axios
        .get("/api/permissions")
        .then(response => (this.allPermissions = response.data.data));
    },

    editItem(item) {
      this.editedIndex = this.tableData.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.tableData.indexOf(item);
      // confirm("Are you sure you want to delete this item?") &&
      // this.tableData.splice(index, 1);

      // axios
      //   .delete("/api/users/" + item.id)
      //   .then(response => console.log(response.data));
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to delete this User",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          Swal.fire(" User Deleted!", "Your file has been deleted.", "success");
          axios
            .delete("/api/users/" + item.id)
            .then(response => this.tableData.splice(index, 1));
        }
      });
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.tableData[this.editedIndex], this.editedItem);
        axios
          .put("/api/users/" + this.editedItem.id, this.editedItem)
          .then(response => this.alert("User Updated"));
      } else {
        this.tableData.push(this.editedItem);
        axios
          .post("/api/users/", this.editedItem)
          .then(response => this.alert("New User Created"));
      }
      this.close();
    },
    alert(item) {
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: item,
        showConfirmButton: false,
        timer: 1500
      });
    }
  }
};
</script>
<style lang="scss" scoped>
.table-header {
  thead {
    background-color: black;
  }
}
</style>
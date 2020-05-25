<template >
  <div>
    <v-app-bar dark text color="#fd7e14 darken-1">
      <v-toolbar>Users</v-toolbar>
      <v-divider class="mx-2" inset vertical></v-divider>
      <!-- <v-spacer></v-spacer> -->
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn
            v-on="on"
            v-if="$auth.can('create user')"
            rounded
            color="primary"
            dark
            class="mb-2"
          >
            <v-icon color="#fd7e14">fas fa-user-plus</v-icon>&nbsp; New User
          </v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout color="primary" wrap>
                <v-flex xs12>
                  <v-text-field
                    label="Name"
                    placeholder="Enter User name"
                    filled
                    rounded
                    dense
                    prepend-icon="fas fa-toolbox"
                    :rules="nameRules"
                    v-model="editedItem.name"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field
                    v-model="editedItem.email"
                    :rules="emailRules"
                    label="Enter vaild Email"
                    prepend-icon="mdi-email"
                    required
                    filled
                    rounded
                    dense
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field
                    v-model="editedItem.password"
                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                    :rules="[rules.required, rules.min]"
                    :type="show1 ? 'text' : 'password'"
                    name="input-10-1"
                    label="Enter the Password"
                    hint="At least 8 characters"
                    counter
                    @click:append="show1 = !show1"
                    filled
                    rounded
                    dense
                    prepend-icon="mdi-key"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field
                    v-model="editedItem.confirm_password"
                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                    :rules="[rules.required, rules.min]"
                    :type="show1 ? 'text' : 'password'"
                    name="input-10-1"
                    label="Confirm the Password"
                    hint="At least 8 characters"
                    counter
                    @click:append="show1 = !show1"
                    filled
                    rounded
                    dense
                    prepend-icon="mdi-key"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <h3>Roles</h3>
                  <v-select
                    filled
                    rounded
                    dense
                    prepend-icon="fas fa-toolbox"
                    v-model="editedItem.role"
                    :items="allRoles"
                    label="Roles"
                    item-text="name"
                    return-object
                    chips
                  ></v-select>
                </v-flex>

                <!-- <v-flex xs12 v-if="false">
                  <v-select
                    v-model="editedItem.permissions"
                    :items="allPermissions"
                    label="Permissions"
                    item-text="name"
                    return-object
                    multiple
                    chips
                  ></v-select>
                </v-flex>-->
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" text @click="close">Cancel</v-btn>
            <v-btn color="blue" text @click="save">{{editdilaog}}</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-app-bar>
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
      <v-data-table
        v-if="$auth.can('view users')"
        :headers="headers"
        :items="tableData"
        class="elevation-1"
      >
        <template v-slot:item.name="{ item }">
          <!-- <v-chip color="red" outlined dark>{{ item.name }}</v-chip> -->
          <v-chip pill>
            <v-avatar left>
              <!-- <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img> -->
              <v-icon color="green" small>fas fa-user</v-icon>
            </v-avatar>
            {{ item.name }}
          </v-chip>
        </template>
        <template v-slot:item.role="{ item }">
          <v-chip :color="getColor(item.role.name)" dark>{{ item.role.name }}</v-chip>
        </template>
        <template v-slot:item.role="{ item }">
          <v-chip :color="getColor(item.role.name)" dark>{{ item.role.name }}</v-chip>
        </template>
        <template v-slot:item.role="{ item }">
          <v-chip :color="getColor(item.role.name)" dark>{{ item.role.name }}</v-chip>
        </template>
        <template v-slot:item.created_at="{ item }">
          <v-chip :color="getColorblue(item.created_at)" dark>{{ item.created_at | updateDate}}</v-chip>
        </template>
        <template v-slot:item.updated_at="{ item }">
          <v-chip :color="getColorblue(item.updated_at)" dark>{{ item.updated_at | createDate}}</v-chip>
        </template>
        <template v-slot:item.action="{ item }">
          <td class="justify-center layout px-0">
            <v-icon
              color="green"
              small
              class="mr-2"
              v-if="$auth.can('edit user')"
              @click="editItem(item)"
            >fas fa-edit</v-icon>
            <v-icon
              v-if="$auth.can('delete user')"
              small
              @click="deleteItem(item)"
              color="red"
            >fas fa-trash</v-icon>
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
class Errors {
  constructor() {
    this.errors = {};
  }
}
export default {
  data: () => ({
    // for password
    show1: false,
    show2: true,
    show3: false,
    show4: false,
    dialog: false,
    search: "",
    error: "",
    rules: {
      required: value => !!value || "Required.",
      min: v => v.length >= 8 || "Min 8 characters"
    },
    nameRules: [
      v => !!v || "Name is required",
      v => v.length <= 14 || "Name must be less than 10 characters"
    ],
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+/.test(v) || "E-mail must be valid"
    ],
    editdilaog: "save",
    headers: [
      { text: "Username", value: "name" },
      { text: "Email", value: "email" },
      { text: "Role", value: "role" },
      { text: "Created", value: "created_at" },
      { text: "Updated", value: "updated_at" },
      { text: "Actions", value: "action", sortable: false }
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
      axios.get("/api/request").then(response => {
        this.tableData = response.data.data;
      });

      axios
        .get("/api/roles")
        .then(response => (this.allRoles = response.data.data));
      axios
        .get("/api/permissions")
        .then(response => (this.allPermissions = response.data.data));
    },
    getColor(calories) {
      // if (calories > 400) return 'red'
      // else if (calories > 200) return 'orange'
      return "green";
    },
    getColorblue(calories) {
      // if (calories > 400) return 'red'
      // else if (calories > 200) return 'orange'
      return "blue";
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
          .then(response => this.alertandpush("User  Was Updated"));
      } else {
        // this.tableData.push(this.editedItem),
        axios
          .post("/api/users/", this.editedItem)
          .then(response =>
            this.alertandpush("User Was Created", this.editedItem)
          )
          .catch(function(error) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!",
              footer:
                "Try to insert field correctly <br/> and make sure the email is not Duplicate"
            });
          });
      }
    },
    alertandpush(item, editedItem) {
      if (editedItem != null) {
        this.tableData.push(editedItem);
      }

      Swal.fire({
        position: "top-end",
        icon: "success",
        title: item,
        showConfirmButton: false,
        timer: 1500
      });
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
      this.close();
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
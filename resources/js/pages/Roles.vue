<template>
  <div>
    <v-toolbar dark text color="grey-lighten">
      <v-toolbar-title>Roles</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="700px">
        <template v-slot:activator="{ on }">
          <v-btn v-on="on" v-if="$auth.can('create role')" color="primary" dark class="mb-2">
            <v-icon color="#fd7e14">fas fa-plus-circle</v-icon>&nbsp;New Role
          </v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12>
                  <v-text-field
                    label="Name"
                    placeholder="Enter User name"
                    filled
                    rounded
                    dense
                    prepend-icon="mdi-text"
                    :rules="nameRules"
                    v-model="editedItem.name"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  
                    <v-select
                  
                 
                    v-model="editedItem.permissions"
                    :items="allPermissions"
                    label="Permissions"
                    item-text="name"
                    return-object
                    multiple
                    :rules="[v => !!v || 'Item is required']"
                    required
                    chips
                      filled
                    rounded
                    dense
                    prepend-icon="fas fa-toolbox"
                  ></v-select>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" text @click="close">Cancel</v-btn>
            <v-btn color="blue darken-1" text v-if="editcon" @click="save">Edit</v-btn>
            <v-btn color="blue darken-1" text v-else @click="save">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table
      v-if="$auth.can('view roles')"
      :headers="headers"
      :items="tableData"
      class="elevation-1"
    >
      <template v-slot:item.name="{ item }">
        <v-chip :color="getColor(item.name)" dark>{{ item.name }}</v-chip>
      </template>

      <template v-slot:item.permissions="{ item }">
        <td class="text-xs-right" v-if="item.permissions">
          <v-chip
            small
            v-for="(permission,index) in item.permissions"
            color="primary"
            text-color="white"
            :key="index"
            dark
          >
            <tr>{{permission.name}}</tr>
          </v-chip>
        </td>
        <td v-else>n/a</td>
      </template>
      <template v-slot:item.action="{ item }">
        <td class="justify-center layout px-0">
          <v-icon
            color="green"
            small
            class="mr-2"
            v-if="$auth.can('edit role')"
            @click="editItem(item)"
          >fas fa-edit</v-icon>
          <v-icon
            v-if="$auth.can('delete role')"
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
  </div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    editcon: false,
    nameRules: [
      v => !!v || "Name is required",
      v =>
        (v.length <= 14 && v.length >= 4) ||
        "Name must be less than 14 and more than 4 characters"
    ],
    headers: [
      { text: "Name", value: "name" },
      { text: "Permissions", value: "permissions" },
      { text: "Actions", value: "action", sortable: false }
    ],
    tableData: [],
    editedIndex: -1,
    allPermissions: [],
    editedItem: {
      name: "",
      created_at: ""
    },
    defaultItem: {
      name: "",
      created_at: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
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
    getColor(calories) {
      // if (calories > 400) return 'red'
      // else if (calories > 200) return 'orange'
      return "green";
    },
    initialize() {
      axios.get("/api/roles").then(response => {
        this.tableData = response.data.data;
      });

      axios
        .get("/api/permissions")
        .then(response => (this.allPermissions = response.data.data));
    },

    editItem(item) {
      this.editedIndex = this.tableData.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.editcon = true;
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.tableData.indexOf(item);
      // confirm("Are you sure you want to delete this item?") &&

      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to delete this Role",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          Swal.fire("Deleted!", "Your Role has been deleted.", "success");
          axios
            .delete("/api/roles/" + item.id)
            .then(response => this.tableData.splice(index, 1));
        }
      });
    },

    close() {
      this.dialog = false;
      this.editcon = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.tableData[this.editedIndex], this.editedItem);

        axios
          .put("/api/roles/" + this.editedItem.id, this.editedItem)
          .then(response => this.alert(" Role was Updated"))
          .catch(function() {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!"
            });
          });
      } else {
        // this.tableData.push(this.editedItem);

        axios
          .post("/api/roles", this.editedItem)
          .then(response =>
            this.alert(" New Role Was Created", this.editedItem)
          )
          .catch(function() {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!",
              footer:
                "Try to insert field correctly <br/> and make sure the Role is not Duplicate"
            });
          });
      }
      // this.close();
    },
    alert(item, editedItem) {
      this.tableData.push(editedItem);
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
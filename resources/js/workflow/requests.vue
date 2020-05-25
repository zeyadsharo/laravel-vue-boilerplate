<template>
  <v-card>
    <v-card-title>
      Requsets
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table :headers="headers" :items="tableData" class="elevation-1">
      <template v-slot:item.priority="{ item }">
        <v-chip :color="getColor(item.priority)" dark>{{ item.priority }}</v-chip>
      </template>
      <template v-slot:item.problem_description="{ item }">
        <v-btn text small color="primary" @click="ShowText(item.problem_description)">show des...</v-btn>
      </template>
      <template slot="no-data">
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
    <v-btn bottom color="pink" dark fab fixed right @click="dialog = !dialog">
      <v-icon @click="myFunction()">mdi-plus</v-icon>
    </v-btn>
    <v-dialog v-model="dialog" width="800px">
      <v-card>
        <v-card-title class="green darken-2">Create Requset</v-card-title>
        <v-container>
          <v-row class="mx-2">
            <v-col cols="6">
              <v-text-field
                prepend-icon="mdi-numeric"
                :readonly="true"
                v-model="randomNumber"
                placeholder="no"
              ></v-text-field>
            </v-col>

            <v-col cols="6">
              <v-row>
                <v-dialog
                  ref="dialog"
                  v-model="modal"
                  :return-value.sync="date"
                  persistent
                  width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      prepend-icon="mdi-calendar"
                      placeholder="no"
                      v-model="date"
                      readonly
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-row>
            </v-col>

            <v-col cols="6">
              <v-text-field
                prepend-icon="mdi-account-card-details-outline"
                placeholder="Requested By"
              ></v-text-field>
            </v-col>
            <v-col class="d-flex" cols="12" sm="6">
              <v-select :items="items" prepend-icon="mdi-school" label="select Department" solo></v-select>
            </v-col>
            <v-col cols="6">
              <v-text-field prepend-icon="mdi-map-marker" placeholder="Room#/Location"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-textarea
                label="Problem Description"
                auto-grow
                outlined
                rows="3"
                row-height="25"
                shaped
              ></v-textarea>
            </v-col>
            <!-- TODO:Priority -->
            <v-col cols="12">
              <v-col cols="6">Priority</v-col>
              <v-radio-group v-model="row" row>
                <v-radio color="red" label="High" value="high"></v-radio>
                <v-radio color="green" label="Medium" value="medium"></v-radio>
                <v-radio color="yellow" label="Low" value="low"></v-radio>
              </v-radio-group>
            </v-col>
            <!-- <v-col cols="6">
              <v-text-field
                prepend-icon="mdi-numeric"
                placeholder="no"
              ></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field
                prepend-icon="mdi-numeric"
                placeholder="no"
              ></v-text-field>
            </v-col>-->
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="dialog = false">Cancel</v-btn>
          <v-btn text @click="dialog = false">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      items: ["Foo", "Bar", "Fizz", "Buzz"],
      date: new Date().toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      row: null,
      randomNumber: "324",

      search: "",
      dialog: false,
      headers: [
        { text: "Request number", value: "requestnumber" },
        { text: "Department", value: "department" },
        { text: "Location", value: "location" },
        { text: "Problem_Description", value: "problem_description" },
        { text: "Priority", value: "priority" },
        { text: "Created_at", value: "created_at" }
      ],
      SaveRequest: {
        name: "",
        email: "",
      },
      tableData: [],
    
    };
  },
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      axios
        .get("/api/request")
        .then(({ data }) => (this.tableData = data.data));
    },
    ShowText(text) {
      Swal.fire(text);
    },
    getColor(priority) {
      if (priority === "High") return "red";
      if (priority == "Medium") return "green";
      if (priority == "Low") return "orange";
    },
    myFunction: function() {
      var idStrLen = 8;
      // always start with a letter -- base 36 makes for a nice shortcut
      var idStr = Math.floor(Math.random() * 25) + 10;
      // add a timestamp in milliseconds (base 36 again) as the base
      idStr += new Date().getTime();
      // similar to above, complete the Id using random, alphanumeric characters
      do {
        idStr += Math.floor(Math.random() * 35).toString(36);
      } while (idStr.length < idStrLen);
      this.randomNumber = idStr;
    }
  }
};
</script>
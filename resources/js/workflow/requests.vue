<template>
  <v-card>
    <v-card-title>
      {{ $t('Requset.name') }}
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
        <template slot="Faclity">
          <p> {{Faclity}}</p>
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
                  <v-date-picker readonly v-model="date" scrollable>
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
                v-model="ff"
              ></v-text-field>
            </v-col>
            <v-col class="d-flex" cols="12" sm="6">
              <!-- TODO: Faculty-->
              <v-select
                :items="Faculty"
                prepend-icon="mdi-school"
                label="select Faculty or Collage"
                v-model="Faclity"
                solo
              ></v-select>
            </v-col>
            <v-col class="d-flex" cols="12" sm="6">
              <v-select
                :items="items"
                v-model="SaveRequest.department"
                prepend-icon="mdi-school"
                label="select Department"
                solo
              ></v-select>
            </v-col>

            <v-col cols="6">
              <v-text-field
                prepend-icon="mdi-map-marker"
                v-model="SaveRequest.location"
                placeholder="Room#/Location"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-textarea
                label="Problem Description"
                auto-grow
                outlined
                v-model="SaveRequest.problem_description"
                rows="3"
                row-height="25"
                shaped
              ></v-textarea>
            </v-col>
            <!-- TODO:Priority -->
            <v-col cols="12">
              <v-col cols="6">Priority</v-col>
              <v-radio-group v-model="SaveRequest.priority" row>
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
          <v-btn text @click="save">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
import i18n from '/E disk/Maintenance System/resources/plugins/i18n'
export default {
  data() {
    return {
      items: ["Computer Science", "Math", "Physics", "Biology"],
      date: new Date().toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      row: null,
      randomNumber: "324",
      ff: "zeyad sharo",
      search: "",
      dialog: false,
      Faculty: [
        { text: "Faculty of Science", id: 1 },
        { text: "Faculty of Humanities", id: 2 },
        { text: "Faculty of Education", id: 3 },
        { text: "College of Medicine", id: 4 },
        { text: "College of Engineering", id: 5 },
        { text: "College of Basic Education", id: 6 },
        { text: "College of Administration & Economics", id: 7 }
      ],
      headers: [
        { text: this.$t('Requset.RN') , value: "requestnumber" },
        { text: "Department", value: "department" },
        { text: "Location", value: "location" },
        { text: "Problem_Description", value: "problem_description" },
        { text: "Priority", value: "priority" },
        { text: "Created_at", value: "created_at" },
      ],
      SaveRequest: {
        requestnumber: "",
        department: "",
        location: "",
        Problem_Description: "",
        priority: "",
        Faclity: "",
        created_at: ""
      },
      tableData: []
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
      if (priority === "Medium") return "green";
      if (priority === "Low") return "orange";
    },

    save() {
      axios
        .post("/api/request", this.SaveRequest)
        .then(response =>
          this.alertandpush("Request Was Created", this.SaveRequest)
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
      this.dialog = false;
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
      this.randomNumber = idStr.toString().slice(0, 8);
      this.SaveRequest.requestnumber = idStr.toString().slice(0, 8);
    }
  }
};
</script>

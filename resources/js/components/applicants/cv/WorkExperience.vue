<template>
  <div>
    <div class="card-header mb-6 d-flex align-center">
      <h3 class="headline">Work Experience</h3>
      <v-spacer></v-spacer>
      <v-btn v-if="formview == false" text small fab color="primary" @click="newWorkExperience()">
        <v-icon>mdi-plus</v-icon>
      </v-btn>
    </div>
    <div class="card-body mb-5" v-for="item in experience" :key="item.id">
      <template v-if="formview == false">
        <h4 class="title d-flex align-center">
          {{ JSON.parse(item.value).jobtitle }}
          <v-spacer></v-spacer>
          <v-btn v-if="formview == false" text small fab color="primary" @click="edit(item)">
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
        </h4>
        <div
          class="subtitle-2"
        >{{ JSON.parse(item.value).company }} - {{ JSON.parse(item.value).city }}</div>
        <div
          class="subtitle-2"
        >{{ formatDate(item.startdate)}} to {{ item.topresent ? 'Present' : formatDate(item.todate) }}</div>
        <v-textarea
          color="primary"
          hide-details
          readonly
          auto-grow
          :value="JSON.parse(item.value).description"
          style="width:100%;"
          class="no-border"
        ></v-textarea>
        <v-divider></v-divider>
      </template>
    </div>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">Edit Work Experience</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field dense label="Job Title" required v-model="dialogItem.jobtitle"></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field dense label="Company" v-model="dialogItem.company"></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field dense label="City" v-model="dialogItem.city"></v-text-field>
              </v-col>
              <v-col cols="12" class="py-0">
                <div class="row">
                  <div class="col-8">
                    <v-menu
                      ref="startmenu"
                      v-model="startmenu"
                      :close-on-content-click="false"
                      :return-value.sync="dialogItem.startdate"
                      transition="scale-transition"
                      offset-y
                      width="290px"
                      max-width="290px"
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on }">
                        <v-text-field
                          dense
                          v-model="dialogItem.startdate"
                          label="Start Date"
                          prepend-icon="mdi-calendar"
                          readonly
                          v-on="on"
                          class="mb-3"
                        ></v-text-field>
                      </template>
                      <v-date-picker
                        v-model="dialogItem.startdate"
                        color="primary"
                        type="month"
                        no-title
                        scrollable
                      >
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="startmenu = false">Cancel</v-btn>
                        <v-btn
                          text
                          color="primary"
                          @click="$refs.startmenu.save(dialogItem.startdate)"
                        >OK</v-btn>
                      </v-date-picker>
                    </v-menu>
                    <template v-if="toPresentCheckbox == false">
                      <v-menu
                        ref="tomenu"
                        v-model="tomenu"
                        :close-on-content-click="false"
                        :return-value.sync="dialogItem.todate"
                        transition="scale-transition"
                        offset-y
                        width="290px"
                        max-width="290px"
                        min-width="290px"
                      >
                        <template v-slot:activator="{ on }">
                          <v-text-field
                            dense
                            v-model="dialogItem.todate"
                            label="To"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker
                          hide-details
                          v-model="dialogItem.todate"
                          color="primary"
                          type="month"
                          no-title
                          scrollable
                        >
                          <v-spacer></v-spacer>
                          <v-btn text color="primary" @click="tomenu = false">Cancel</v-btn>
                          <v-btn
                            text
                            color="primary"
                            @click="$refs.tomenu.save(dialogItem.todate)"
                          >OK</v-btn>
                        </v-date-picker>
                      </v-menu>
                    </template>
                  </div>
                  <div class="col-4">
                    <v-checkbox
                      dense
                      v-model="toPresentCheckbox"
                      label="I still work here."
                      class="ma-0"
                    ></v-checkbox>
                  </div>
                </div>
              </v-col>
              <v-col cols="12">
                <v-textarea
                  color="primary"
                  auto-grow
                  label="Description"
                  v-model="dialogItem.description"
                ></v-textarea>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="primary" text @click="saveData(dialogItem)">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      theUserID: 0,

      date: new Date().toISOString().substr(0, 7),
      startmenu: false,
      tomenu: false,
      modal: false,
      dialog: false,
      toPresentCheckbox: false,

      action: "store",
      formview: false,
      valid: true,
      experience: [],
      dialogItem: {
        id: "",
        startdate: "",
        todate: "",
        topresent: "",
        jobtitle: "",
        company: "",
        description: ""
      },
      dataItem: {
        jobtitle: "",
        company: "",
        date: "",
        description: ""
      },
      value:
        '{"fullname":"Romel Indemne","jobtitle":Web Developer,"company":"GAG","city":"Dubai","description":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."}',
      jobTitle: "Web Developer",
      company: "Test Company",
      city: "Cebu",
      description:
        "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
    };
  },
  methods: {
    newWorkExperience() {
      this.dialogItem = [];
      this.dialog = true;
    },
    edit(i) {
      this.toPresentCheckbox = false;
      this.dialogItem = Object.assign({}, JSON.parse(i.value));
      this.dialogItem.id = i.id;
      this.dialogItem.startdate = moment(i.startdate).format("YYYY-MM");
      this.dialogItem.todate =
        i.todate == null
          ? new Date().toISOString().substr(0, 7)
          : moment(i.todate).format("YYYY-MM");
      if (i.topresent) {
        this.dialogItem.topresent = i.topresent;
        this.toPresentCheckbox = true;
      }
      this.dialog = true;
    },
    formatDate(d) {
      return moment(d).format("MMMM YYYY");
    },
    getExperience() {
      axios
        .get("/applicant/experience/" + this.theUserID)
        .then(response => {
          this.experience = response.data.exp;
        })
        .catch(error => {
          console.log(error.response);
          console.log("error");
        });
    },
    saveData(i) {
      let postData = [];
      let valueData = {
        jobtitle: i.jobtitle,
        company: i.company,
        city: i.city,
        description: i.description
      };
      postData = {
        id: i.id,
        user: this.theUserID,
        type: "work_experience",
        startdate: i.startdate,
        todate: this.toPresentCheckbox == false ? i.todate : null,
        topresent: this.toPresentCheckbox,
        value: JSON.stringify(valueData)
      };
      if(!i.id){
        delete postData.id;
      }
      console.log(postData)
      axios
        .post("/applicant/experience/save", postData)
        .then(response => {
          this.getExperience();
          this.dialog = false;
        })
        .catch(error => {
          this.dialog = false;
          console.log(error.response);
          console.log("error");
        });
    }
  },
  mounted() {
    this.theUserID = document
      .getElementById("app")
      .getAttribute("data-template");
    if (this.theUserID > 0) {
      this.getExperience();
    }
  }
};
</script>

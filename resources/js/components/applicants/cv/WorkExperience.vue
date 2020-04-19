<template>
  <div>
    <div class="card-header mb-6 d-flex align-center">
      <h3 class="headline">Work Experience</h3>
      <v-spacer></v-spacer>
      <v-btn v-if="formview == false" text small fab color="primary" @click="edit()">
        <v-icon>mdi-plus</v-icon>
      </v-btn>
    </div>

    <div class="card-body mb-5" v-for="item in experience" :key="item.id">
      <template v-if="formview == false">
        <h4 class="title d-flex align-center">
          {{ JSON.parse(item.value).jobtitle }}
          <v-spacer></v-spacer>
          <!-- @click="formview = true" -->
          <v-btn v-if="formview == false" text small fab color="primary" @click="edit(item)">
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
        </h4>
        <div
          class="subtitle-2"
        >{{ JSON.parse(item.value).company }} - {{ JSON.parse(item.value).city }}</div>
        <div class="subtitle-2">January 2025 - Present</div>
        <p class="body-1 my-3">{{ JSON.parse(item.value).description }}</p>
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
              <v-col cols="12">
                <v-menu
                  ref="menu"
                  v-model="menu"
                  :close-on-click="false"
                  :close-on-content-click="false"
                  :return-value.sync="date"
                  transition="scale-transition"
                  offset-y
                  max-width="290px"
                  min-width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      v-model="date"
                      label="Picker in menu"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" color="primary" type="month" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.menu[item.id -1].save(date)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-col>
              <v-col cols="12">
                <v-textarea label="Description" v-model="dialogItem.description"></v-textarea>
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
export default {
  data() {
    return {
      date: new Date().toISOString().substr(0, 7),
      menu: false,
      modal: false,
      dialog: false,

      action: "store",
      formview: false,
      valid: true,
      experience: [],
      dialogItem: {
        id: "",
        jobtitle: "",
        company: "",
        date: "",
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
    edit(i) {
      this.dialogItem = Object.assign({}, JSON.parse(i.value));
      this.dialogItem.id = i.id;
      this.dialog = true;
    },
    getExperience() {
      axios
        .get("/applicant/experience/2")
        .then(response => {
          this.experience = response.data.ex;
          // console.log(this.experience[0].value);
          //   this.dataItem = Object.assign({}, this.experience);
        })
        .catch(error => {
          console.log(error.response);
          console.log("error");
        });
    },
    saveData(i) {
      // console.log(i);
      let postData = [];
      let valueData = {
        jobtitle : i.jobtitle,
        company : i.company,
        city : i.city,
        description : i.description,
      };
      postData = {
          id : i.id,
          user: 2,
          type : 'work_experience',
          value: JSON.stringify(valueData),
      }
      console.log(postData)
      axios
        .post("/applicant/experience/save", postData)
        .then(response => {
          console.log(response.data);
        })
        .catch(error => {
          console.log(error.response);
          console.log("error");
        });
    }
    // saveDate(d) {
    //   this.date = new Date().toISOString().substr(0, 7);
    //   this.menu = false;
    //   console.log(d);
    // }
    // save(i) {
    //   console.log(i);
    // }
    // save(i, action) {
    //   console.log(i);
    //   console.log(action);
    //   console.log(this.$refs["title_" + i.id].value);

    //   // this.dialogItem = Object.assign({}, i);
    //   //   let data = {
    //   //     id: "1",
    //   //     user: 2,
    //   //     type: "work_experience",
    //   //     value: "asdas"
    //   //   };
    //   // axios
    //   // .get("/applicant/experience/storeExperience", data )
    //   // .then(response => {
    //   //     this.experience = response.data.ex;
    //   //     console.log(this.experience);
    //   // })
    //   // .catch(error => {
    //   //   console.log(error.response);
    //   //   console.log("error");
    //   // });
    // }
  },
  mounted() {
    this.getExperience();
    console.log(this.dialogItem);
  }
};
</script>

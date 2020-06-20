<template>
  <div class="col-md-8 mx-auto">
    <v-btn to="/e/jobs" icon color="primary" class="mb-3">
      <v-icon>mdi-undo</v-icon>
    </v-btn>

      <h3 class="mb-3">Create a Job Post</h3>
      <v-stepper v-model="e1">
        <v-stepper-header class="elevation-0 rounded-0">
          <v-stepper-step editable :complete="e1 > 1" step="1"></v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step editable :complete="e1 > 2" step="2"></v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step editable :complete="e1 > 3" color="success" step="3"></v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step editable step="4"></v-stepper-step>
        </v-stepper-header>
        <v-stepper-items>
          <v-stepper-content step="1">
            <JobDetails @complete="stepOneComplete" />
          </v-stepper-content>
          <v-stepper-content step="2">
            <v-card class="mb-12" color="grey lighten-1" height="200px"></v-card>

            <v-btn color="primary" @click="e1 = 3">Continue</v-btn>

            <v-btn text>Cancel</v-btn>
          </v-stepper-content>

          <v-stepper-content step="3">
            <v-card class="mb-12" color="grey lighten-1" height="200px"></v-card>

            <v-btn color="primary" @click="e1 = 1">Continue</v-btn>

            <v-btn text>Cancel</v-btn>
          </v-stepper-content>
          <v-stepper-content step="4">
            <div class="d-flex pa-4">
              <v-spacer></v-spacer>
              <!-- <v-btn
                text
                class="primary--text"
                :disabled="!valid"
                @click="save('draft')"
              >Save as Draft</v-btn>
              <v-btn :disabled="!valid" @click="save('publish')" color="primary">Publish</v-btn> -->
            </div>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>

  </div>
</template>

<script>
import JobDetails from "./jobform/JobDetails";
export default {
  components: {
    JobDetails
  },
  created() {
    let meh = "no param";
    if (this.$route.params.id) {
      console.log(this.$route.params.id);
      meh = "with param";
    }
    console.log(meh);
  },
  data() {
    return {
      /**
       * job title
       * job role - dropdown
       * company industry
       * job location
       * employment type - dropdown
       *  - Unspecified
       *  - commission
       *  - contractor
       *  - Freelancer
       *  - Full Time Employee
       *  - Internship
       *  - Part Time Employee
       *  - Temporary Employee
       *  - Volunteer
       * Remote job - boolean
       * Monthly Salary - Dropdown
       * Number of vacancy
       * Job Description - rich editor: B I ul ol
       * Desired Skils - rich editor: B I ul ol
       *
       */
      /**
        Candidate requirements
        Experience
         - Career level - dropdown
            - student/internship
            - Fresh Graduate
            - Entry Level
            - Mid Career
            - Management
            - Director/Head
            - Senior Executive
         - Years of experience
            - min
            - max
        Education
         - Accounting - autofill
         - Degree - Dropdown
            - Highschool or the same
            - Certification / Diploma
            - Bachelor's Degree / Higher Diploma
            - Master's Degree
            - Doctorate
        Personal Information
         - Resident location
         - Nationality
         - Gender
         - Age
        Specialitites
            - Javascript
            - PHP
        Add questions to learn about candidates
      */
      // ui
      e1: 1,
    //   valid: true
    };
  },
  methods: {
      stepOneComplete(data){
          this.e1 = data.el;
          console.log(data.jobdetails)
      }
  }
};
</script>

<style lang="css">
.v-stepper__step__step .v-icon.v-icon {
  font-size: 14px !important;
}
</style>

<template>
  <div class="col-md-8 mx-auto">
    <v-btn to="/e/jobs" icon color="primary" class="mb-3">
      <v-icon>mdi-undo</v-icon>
    </v-btn>
    <v-form v-model="valid">
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
            <h3 class="mb-5">Job Details</h3>
            <label for>Job Title</label>
            <v-text-field
              single-line
              outlined
              dense
              v-model="job.title"
              label="Ex. Head of Human Resources"
              required
              :rules="textRules"
              :error="textError"
              :error-messages="textErrMsg"
              @change="clearAlert"
            ></v-text-field>
            <label for>Job Role</label>
            <v-autocomplete
              v-model="job.role"
              :items="roles"
              single-line
              outlined
              required
              dense
              label="Select Job Role"
            ></v-autocomplete>
            <label for>Company Industry</label>
            <v-autocomplete
              v-model="job.industry"
              :items="industries"
              single-line
              outlined
              required
              dense
              chips
              small-chips
              label="Select your Company Industry"
              multiple
            >
              <template v-slot:selection="data">
                <v-chip
                  v-bind="data.attrs"
                  :input-value="data.selected"
                  close
                  @click="data.select"
                  @click:close="remove(data.item)"
                >{{ data.item }}</v-chip>
              </template>
              <template v-slot:item="data">
                <v-list-item-content v-text="data.item"></v-list-item-content>
              </template>
            </v-autocomplete>
            <label for>Job Location</label>
            <v-autocomplete
              v-model="job.location"
              :items="roles"
              single-line
              outlined
              required
              dense
              label="Select your Job Location"
            ></v-autocomplete>
            <label for>Employment Type</label>
            <v-autocomplete
              v-model="job.location"
              :items="roles"
              single-line
              outlined
              required
              dense
              label="Select Employment Type"
            ></v-autocomplete>
            <label for>Remote Job?</label>
             <v-switch v-model="job.remote" :label="`${job.remote.toString()}`"></v-switch>
            <label for>Monthly Salary</label>
            <v-autocomplete
              v-model="job.location"
              :items="roles"
              single-line
              outlined
              required
              dense
              label="Monthly Salary"
            ></v-autocomplete>
            <label for>Number of Vacancy</label>
            <v-autocomplete
              v-model="job.location"
              :items="roles"
              single-line
              outlined
              required
              dense
              label="Select"
            ></v-autocomplete>
            <label for>Job Description</label>
            <v-textarea
              dense
              v-model="job.description"
              label="content"
              outlined
              name="input-7-4"
              @change="clearAlert"
            ></v-textarea>
            <label for>Desired Skills</label>
            <v-textarea
              dense
              v-model="job.content"
              label="content"
              outlined
              name="input-7-4"
              @change="clearAlert"
            ></v-textarea>
            <div class="d-flex">
              <v-spacer></v-spacer>
              <v-btn text>Back</v-btn>
              <v-btn color="primary" @click="e1 = 2">Continue</v-btn>
            </div>
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
              <v-btn
                text
                class="primary--text"
                :disabled="!valid"
                @click="save('draft')"
              >Save as Draft</v-btn>
              <v-btn :disabled="!valid" @click="save('publish')" color="primary">Publish</v-btn>
            </div>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </v-form>
  </div>
</template>

<script>
export default {
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
      e1: 1,
      job: {
        position: "",
        slug: "",
        content: "",
        status: "",
        role: "",
        industry: [],
        remote: 0
      },
      roles: ["foo", "bar", "fizz", "buzz"],
      industries: ["foo", "bar", "fizz", "buzz"],
      // ui
      valid: true,

      // Rules
      textRules: [
        value => !!value || "Required",
        value => (value && value.length < 50) || "Max 50 characters",
        value => (value && value.length > 1) || "Min 1 characters"
      ],

      // Error Handling
      textError: false,
      textErrMsg: ""
    };
  },
  methods: {
    remove(item) {
      const index = this.job.industry.indexOf(item);
      if (index >= 0) this.job.industry.splice(index, 1);
    },
    generateSlug() {
      this.job.slug = this.job.position && slugify(this.job.position);
    },
    clearAlert() {},
    save(a) {
      console.log(a);
    }
  }
};
</script>

<style lang="css">
.v-stepper__step__step .v-icon.v-icon {
  font-size: 14px !important;
}
</style>

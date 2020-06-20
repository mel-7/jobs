<template>
  <div>
    <v-form ref="form" v-model="validInput" lazy-validInputation>
      <h3 class="mb-5">Job Details</h3>
      <label for>Job Title</label>
      <v-text-field
        single-line
        outlined
        dense
        v-model="title"
        label="Ex. Head of Human Resources"
        required
        :rules="inputRules"
        :error="inputError"
        :error-messages="inputErrMsg"
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
        v-model="job.employment_type"
        :items="empTypes"
        single-line
        outlined
        return-object
        :item-text="empTypes.name"
        dense
        label="unspecified"
      >
        <template slot="selection" slot-scope="data">{{ data.item.name }}</template>
        <template v-slot:item="data">
          <template v-if="typeof data.item !== 'object'">
            <v-list-item-content v-text="data.item"></v-list-item-content>
          </template>
          <template v-else>
            <v-list-item-content>
              <v-list-item-title v-html="data.item.name"></v-list-item-title>
            </v-list-item-content>
          </template>
        </template>
      </v-autocomplete>
      <label for>Remote Job?</label>
      <v-switch class="ml-3" v-model="job.remote" :label="`${job.remote.toString()}`"></v-switch>
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
        <v-btn color="primary" :disabled="!validInput" @click="complete">Continue</v-btn>
      </div>
    </v-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "",
      job: {
        title: "",
        slug: "",
        employment_type: "unspecified",
        position: "",
        content: "",
        status: "",
        role: "",
        industry: [],
        remote: 0
      },
      roles: ["foo", "bar", "fizz", "buzz"],
      industries: ["foo", "bar", "fizz", "buzz"],
      empTypes: [
        {
          name: "Unspecified",
          value: "unspecified"
        },
        {
          name: "Commission",
          value: "commission"
        },
        {
          name: "Contractor",
          value: "contractor"
        },
        {
          name: "Freelancer",
          value: "freelancer"
        },
        {
          name: "Full Time Employee",
          value: "full-time-employee"
        },
        {
          name: "Internship",
          value: "internship"
        },
        {
          name: "Part Time Employee",
          value: "part-time-employee"
        },
        {
          name: "Volunteer",
          value: "volunteer"
        }
      ],
      // ui
      validInput: false,

      // Rules
      inputRules: [value => !!value || "Required"],

      // Error Handling
      inputError: false,
      inputErrMsg: ""
    };
  },
  methods: {
    remove(item) {
      const index = this.job.industry.indexOf(item);
      if (index >= 0) this.job.industry.splice(index, 1);
    },
    clearAlert() {},
    save(a) {
      console.log(a);
    },
    complete() {
      console.log(this.validInput);
      this.$refs.form.validate();
      if (this.validInput == true) {
        let d = {
          el: 2,
          jobdetails: this.job
        };
        this.$emit("complete", d);
      }
    }
  },
  mounted() {
    setTimeout(() => console.log(this.validInput), 2000);
  }
};
</script>

<style>
</style>

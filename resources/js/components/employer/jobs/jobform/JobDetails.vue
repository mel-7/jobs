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
      validInput: false,

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
    clearAlert() {},
    save(a) {
      console.log(a);
    },
    complete() {
      console.log(this.validInput);
    //   this.$refs.form.validInputate();
      //   if (this.validInput == true) {
      //     let d = {
      //       el: 2,
      //       jobdetails: this.job
      //     };
      //     this.$emit("complete", d);
      //   }
    }
  },
  mounted(){
      console.log(this.validInput)
  }
};
</script>

<style>
</style>

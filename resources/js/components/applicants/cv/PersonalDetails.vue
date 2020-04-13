<template>
  <div>
    <div class="card-header mb-6 d-flex align-center">
      <h3 class="headline">Personal Information</h3>
      <v-spacer></v-spacer>
      <v-btn v-if="formview == false" text small fab color="primary" @click="edit()">
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
    </div>
    <div class="card-body">
      <template v-if="formview == false">
        <h1 class="title">{{fullname}}</h1>
        <div class="subtitle-2">{{jobtitle}}</div>
        <div class="body-2">{{email}}</div>
        <div class="body-2">{{phone}}</div>
      </template>
      <template v-else>
        <form :formview="false" lazy-validation>
          <v-text-field type="text" v-model="fullname" label="Full Name" dense outlined></v-text-field>
          <v-text-field type="email" v-model="email" label="Full Name" dense outlined></v-text-field>
          <v-text-field type="tel" v-model="phone" label="Phone" dense outlined></v-text-field>
          <!-- :disabled="!valid" -->
          <v-btn type="submit" class="mr-2" @click="formview = false">Cancel</v-btn>
          <v-btn type="submit" color="primary" @click="save()">Save</v-btn>
        </form>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formview: false,
      valid: true,
      fullname: "Romel Indemne",
      jobtitle: "Web Developer",
      email: "test@test.com",
      phone: "050000000",
      password: "123456789"
    };
  },
  methods: {
    edit() {
      this.formview = true;
    }
  }
};
</script>

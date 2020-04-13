<template>
  <div class="col-md-8">
    <v-card class="mx-auto pa-5" width="100%">
      <div class="card-header mb-6">
        <div class="d-flex align-center">
          <span>Account Settings</span>
          <v-spacer></v-spacer>
          <v-btn v-if="formview == false" small outlined fab color="primary" @click="edit()">
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
        </div>
      </div>
      <div class="card-body">
        <template v-if="formview == false">
          <div class="row">
            <div class="col-4">Full Name</div>
            <div class="col-8">{{fullname}}</div>
            <div class="col-4">Email</div>
            <div class="col-8">{{email}}</div>
            <div class="col-4">Phone</div>
            <div class="col-8">{{phone}}</div>
            <div class="col-4">Password</div>
            <div class="col-8">
              <a href="#" @click="formview = true">change password</a>
            </div>
          </div>
        </template>
        <template v-else>
          <form :formview="false" lazy-validation>
            <v-text-field type="text" v-model="fullname" label="Full Name" dense outlined></v-text-field>
            <v-text-field type="email" v-model="email" label="Full Name" dense outlined></v-text-field>
            <v-text-field type="tel" v-model="phone" label="Phone" dense outlined></v-text-field>
            <v-text-field type="password" v-model="password" label="Password" dense outlined></v-text-field>
            <!-- :disabled="!valid" -->
            <v-btn type="submit" class="mr-2" @click="formview = false">Cancel</v-btn>
            <v-btn type="submit" color="primary" @click="save()">Save</v-btn>
          </form>
        </template>
      </div>
    </v-card>
  </div>
</template>

<script>
export default {
  name: "Account",
  data() {
    return {
      formview: false,
      valid: true,
      fullname: "Romel",
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

<style>
</style>

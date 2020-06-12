<template>
  <div>
    <v-card class="mx-auto pa-5" width="100%">
      <div class="card-header mb-6">
        <div class="d-flex align-center">
          <span>Account Settings</span>
          <v-spacer></v-spacer>
          <v-btn v-if="formview == false" small text fab color="primary" @click="edit()">
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
        </div>
      </div>
      <div class="card-body">
        <template v-if="formview == false">
          <div class="row">
            <div class="col-4">Full Name</div>
            <div class="col-8">{{postData.name}}</div>
            <div class="col-4">Email</div>
            <div class="col-8">{{postData.email}}</div>
            <div class="col-4">Phone</div>
            <div class="col-8">{{postData.phone}}</div>
            <div class="col-4">Password</div>
            <div class="col-8">
              <a href="#" @click="formview = true">change password</a>
            </div>
          </div>
        </template>
        <template v-else>
          <v-form ref="form" v-model="valid" :formview="false" lazy-validation>
            <template v-if="changePassword == true">
              <v-text-field
                type="password"
                v-model="postData.password"
                ref="password"
                :rules="passwordRules"
                label="Password"
                dense
                outlined
              ></v-text-field>
            </template>
            <template v-else>
              <v-text-field
                type="text"
                v-model="postData.name"
                ref="name"
                :rules="nameRules"
                label="Full Name"
                dense
                outlined
              ></v-text-field>
              <v-text-field
                type="email"
                v-model="postData.email"
                ref="email"
                :rules="emailRules"
                label="Full Name"
                dense
                outlined
              ></v-text-field>
              <v-text-field
                type="tel"
                v-model="postData.phone"
                ref="phone"
                :rules="phoneRules"
                label="Phone"
                dense
                outlined
              ></v-text-field>
            </template>

            <v-btn class="mr-2" @click="formview = false">Cancel</v-btn>
            <v-btn color="primary" :disabled="!valid" @click="save()">Save</v-btn>
            <v-overlay absolute="absolute" color="white" opacity=".75" :value="loading">
              <v-progress-circular :value="20" color="primary"></v-progress-circular>
            </v-overlay>
          </v-form>
        </template>
      </div>
    </v-card>
  </div>
</template>

<script>
export default {
  name: "AccountSettingsForm",
  props: {
    user: Object,
    default: null
  },
  data() {
    return {
      loading: false,
      valid: false,
      formview: false,
      changePassword: false,
      valid: true,
      postData: {
        name: "",
        email: "",
        phone: ""
      },
      defaultEmail: "",
      // rules
      nameRules: [
        v => !!v || "Name is required",
        v => (v && v.length >= 5) || "Name must be 5 characters or more"
      ],
      emailRules: [
        v => !!v || "E-mail is required",
        v => /.+@.+\..+/.test(v) || "E-mail must be valid"
      ],
      phoneRules: [
        v => !!v || "Phone number is required",
        v => /^[0-9]+$/.test(v) || "Phone number must be integer (0-9)",
        v => (v && v.length >= 9) || "Phone number must be 9 characters or more"
      ]
    };
  },
  methods: {
    edit() {
      this.formview = true;
      this.getAccountInfo();
    },
    validate() {
      this.$refs.form.validate();
    },
    getAccountInfo() {
      axios
        .get("/u/get-account-info/" + this.user.id)
        .then(response => {
          this.postData = Object.assign({}, response.data.user[0]);
          this.defaultEmail = response.data.user[0].email;
        })
        .catch(error => {
          console.log(error.response.data.errors);
        });
    },
    save() {
      this.loading = true;
      this.validate();
      let data = {
        id: this.user.id,
        name: this.$refs.name.value,
        phone: this.$refs.phone.value
      };
      if (this.$refs.email.value != this.defaultEmail) {
        data.email = this.$refs.email.value;
      }
      axios
        .post("/u/update-account-info", data)
        .then(response => {
          data = [];
          //   this.successUI(response.data.message);
          console.log(response.data.message);
          this.getAccountInfo();
          this.loading = false;
          this.formview = false;
        })
        .catch(error => {
          console.log(error.response.data.errors);
          //   this.errors.setErrors(error.response.data.errors);
          //   this.errorUI("Error on User creation");
          //   let errorFields = Object.keys(this.errors.errors);
          //   console.log(this.errors.firstKey());
          //   // console.log(this.errors.errors.email[0]);
          //   console.log(errorFields);
          //   Object.keys(this.form).forEach(f => {
          //     console.log(f);
          //     if (errorFields.includes(f)) {
          //       this.formHasErrors = true;
          //     }
          //     // if (!this.form[f]) this.formHasErrors = true
          //     this.$refs[f].validate(true);
          //   });
          //   // Object.keys(this.form).forEach(f => {
          //   //     if (!this.form[f]) this.formHasErrors = true
          //   //     this.$refs[f].validate(true)
          //   // })
        });
    }
  },
  mounted() {
    this.postData = {
      name: this.user.name,
      email: this.user.email,
      phone: this.user.phone
    };
  }
};
</script>

<style>
</style>

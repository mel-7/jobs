<template>
    <div style="width:100%;">
        <v-overlay :value="loading" color="#FFF">
            <v-progress-circular indeterminate color="primary" width="3" size="32"></v-progress-circular>
        </v-overlay>
        <v-form v-model="valid">
            <div class="secondary-header" style="width:100%;border-bottom:1px solid #ddd;">
                <v-toolbar dense flat class="grey lighten-4">
                    <v-toolbar-title>{{pageTitle}}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <!-- <v-btn small text class="primary--text" :disabled="!valid" @click="save('draft')">Save as Draft</v-btn> -->
                    <!-- <v-btn v-if="pageAction === 'update'" small color="error" class="ml-2" @click="trash()">Trash</v-btn> -->
                    <v-btn small color="primary" class="ml-2" :disabled="!valid" @click="submit(pageAction)">{{pageAction}}</v-btn>
                </v-toolbar>
            </div>     
            <div class="col page-content" style="width:100%;overflow-y:scroll;">
                <div class="d-flex">
                    <div class="col-md-8 col-12">
                        <v-card class="py-1">
                            <v-card-text>
                                <v-text-field
                                    outlined
                                    dense
                                    ref="name"
                                    v-model="name"
                                    label="name"
                                    required
                                    :rules="[
                                        value => !!value || 'Required',
                                        value => (value && value.length < 50)  || 'Max 50 characters',
                                        value => (value && value.length > 1)  || 'Min 1 characters',
                                    ]"
                                    :error-messages="errorMessages"
                                    @change="clearAlert"
                                ></v-text-field>
                                <v-text-field
                                    outlined
                                    dense
                                    ref="email"
                                    v-model="email"
                                    label="email"
                                    required
                                    :rules="[
                                        value => !!value || 'Required',
                                        value => /.+@.+\..+/.test(value) || 'E-mail must be valid',
                                        value => (value && value.length < 50)  || 'Max 50 characters',
                                        value => (value && value.length > 1)  || 'Min 1 characters',
                                    ]"
                                    :error-messages="errorMessages"
                                    @change="clearAlert"
                                ></v-text-field>
                                <v-text-field
                                    :append-icon="showpass ? 'mdi-eye' : 'mdi-eye-off'"
                                    :type="showpass ? 'text' : 'password'"
                                    outlined
                                    dense
                                    ref="password"
                                    v-model="password"
                                    label="password"
                                    required
                                    :rules="[
                                        value => !!value || 'Required',
                                        value => (value && value.length < 50)  || 'Max 50 characters',
                                        value => (value && value.length > 1)  || 'Min 1 characters',
                                    ]"
                                    :error-messages="errorMessages"
                                    @change="clearAlert"
                                    @click:append="showpass = !showpass"
                                ></v-text-field>
                                <v-text-field
                                    type="tel"
                                    outlined
                                    dense
                                    ref="phone"
                                    v-model="phone"
                                    label="phone"
                                    required
                                    :error-messages="errorMessages"
                                    @change="clearAlert"
                                ></v-text-field>
                            </v-card-text>
                        </v-card>
                    </div>
                </div>
            </div><!-- .page-content -->
        </v-form>
        <snack-bar :snackbar-type="sbType" :snackbar-text="sbText" :snackbar-status="sbStatus"></snack-bar>
    </div>
</template>

<script>
import SnackBar from '../../SnackBar.vue';
import ErrorBag from "../../../helpers/errorBag.js";
export default {
    data() {
        return {
            loading: false,
            valid: false,

            pageAction: 'publish',
            pageTitle: 'Create a User',

            errors : new ErrorBag,
            // SnackBar
            sbType : '',
            sbText : '',
            sbStatus : false,

            emailError: false,
            emailErrMsg: '',
            nameError: false,
            nameErrMsg: '',
            passwordError: false,
            passwordErrMsg: '',

            errorMessages: '',
            email: null,
            name: null,
            password: null,
            phone: null,
            showpass: false,
            formHasErrors: false,

            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),

        }
    },
    computed: {
        form () {
            return {
                name: this.name,
                email: this.email,
                password: this.password,
                phone: this.phone,
                // address_1: this.address_1,
                // address_2: this.address_2,
                // state: this.state,
                // zip: this.zip,
                // country: this.country,
            }
        },
    },
    methods: {
        clearAlert(){
            this.sbStatus = false; // SnackBar
            this.positionError = false;
            this.positionErrMsg = '';
            this.slugError = false;
            this.slugErrMsg = '';
            this.errors.clearAll();
        },
        successUI(msg){
            this.loading = false;
            setTimeout(() => {
                this.sbStatus = true;
                this.sbType = 'success';
                this.sbText = msg;
            }, 100);
        },
        errorUI(msg){
            this.loading = false;
            setTimeout(() => {
                this.sbStatus = true;
                this.sbType = 'error';
                this.sbText = msg;
            }, 100);
        },
        postRequest(controller, data){
            if(controller === 'store'){
                axios.post('/admin/user/'+controller, data)
                .then(response => {
                    this.successUI(response.data.message);
                    console.log(response);
                })
                .catch(error => {
                    this.errors.setErrors( error.response.data.errors );
                    this.errorUI('Error on User creation');
                    let errorFields = Object.keys(this.errors.errors);
                    console.log(this.errors.firstKey());
                    // console.log(this.errors.errors.email[0]);
                    console.log(errorFields);
                    Object.keys(this.form).forEach(f => {
                        console.log(f);
                        if(errorFields.includes(f) ){
                            this.formHasErrors = true
                        }
                        // if (!this.form[f]) this.formHasErrors = true
                        this.$refs[f].validate(true)
                    })
                    // Object.keys(this.form).forEach(f => {
                    //     if (!this.form[f]) this.formHasErrors = true
                    //     this.$refs[f].validate(true)
                    // })
                });
            }
        },
        submit (action) {
            let postData = {
                email : this.email,
                name : this.name,
                password : this.password,
                phone : this.phone,
            }
            if(action === 'publish'){
                this.postRequest('store', postData);
            }
        },
    },
    mounted(){
        const height = document.querySelector('header.v-app-bar').offsetHeight + document.querySelector('.secondary-header').offsetHeight;
        document.querySelector('.page-content').style.height = "calc(100vh - "+height+"px - 24px)";
    }
}
</script>
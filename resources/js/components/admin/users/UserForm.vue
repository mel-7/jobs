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
                    <v-btn small color="primary" class="ml-2" :disabled="!valid" @click="save(pageAction)">{{pageAction}}</v-btn>
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
                                    v-model="email"
                                    label="email"
                                    required
                                    :rules="emailRules"
                                    :error="emailError"
                                    :error-messages="emailErrMsg"
                                    @change="clearAlert"
                                ></v-text-field>                          
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="name"
                                    label="name"
                                    required
                                    :rules="nameRules"
                                    :error="nameError"
                                    :error-messages="nameErrMsg"
                                    @change="clearAlert"
                                ></v-text-field>
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="password"
                                    label="name"
                                    required
                                    type="password"
                                    :rules="passwordRules"
                                    :error="passwordError"
                                    :error-messages="passwordErrMsg"
                                    @change="clearAlert"
                                ></v-text-field>
                            </v-card-text>
                        </v-card>
                    </div>
                </div>
            </div><!-- .page-content -->
        </v-form>
        <!-- <snack-bar :snackbar-type="sbType" :snackbar-text="sbText" :snackbar-status="sbStatus"></snack-bar> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            valid: false,

            pageAction: 'publish',
            pageTitle: 'Create a User',

            // errors : new ErrorBag,
            emailError: false,
            emailErrMsg: '',
            nameError: false,
            nameErrMsg: '',
            passwordError: false,
            passwordErrMsg: '',

            email: '',
            name: '',
            password: '',

            // Rules
            passwordRules : [
                value => !!value || 'Required',
                value => (value && value.length < 50)  || 'Max 50 characters',
                value => (value && value.length > 1)  || 'Min 1 characters',
            ],
            emailRules : [
                value => !!value || 'Required',
                value => (value && value.length < 50)  || 'Max 50 characters',
                value => (value && value.length > 1)  || 'Min 1 characters',
            ],
            nameRules : [
                value => !!value || 'Required',
                value => (value && value.length < 50)  || 'Max 50 characters',
                value => (value && value.length > 1)  || 'Min 1 characters',
            ],

            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),

        }
    },
    methods: {
        clearAlert(){

        },
        save(action){
            let postData = {
                email : this.email,
                name : this.name,
                password : this.password,
            }
            console.log('postData: '+postData);
            if(action === 'publish'){
                axios.post('/admin/user/store', postData)
                .then(response => {
                    // this.successUI(response.data.message);
                    // this.originalSlug = this.slug;
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }
    },
    mounted(){
        const height = document.querySelector('header.v-app-bar').offsetHeight + document.querySelector('.secondary-header').offsetHeight;
        document.querySelector('.page-content').style.height = "calc(100vh - "+height+"px - 24px)";
    }
}
</script>
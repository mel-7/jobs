<template>
    <div style="width:100%;">
        <v-overlay :value="loading" color="#FFF">
            <v-progress-circular indeterminate color="primary" width="3" size="32"></v-progress-circular>
        </v-overlay>
        <v-form v-model="valid">
            <div class="secondary-header" style="width:100%;border-bottom:1px solid #ddd;">
                <v-toolbar dense flat class="grey lighten-4">
                    <v-toolbar-title>{{pageTitle}}</v-toolbar-title>
                    <v-btn v-if="pageAction === 'update'" small class="ml-2" :href="postURL" target="_blank">Preview</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn small text class="primary--text" :disabled="!valid" @click="save('draft')">Save as Draft</v-btn>
                    <v-btn v-if="pageAction === 'update'" small color="error" class="ml-2" @click="trash()">Trash</v-btn>
                    <v-btn small color="primary" class="ml-2" :disabled="!valid" @click="save(pageAction)">{{pageAction}}</v-btn>
                </v-toolbar>
            </div>
            <div class="col page-content" style="width:100%;overflow-y:scroll;">
                <div class="d-flex">
                    <div class="col-md-8 col-12">
                        <v-card class="py-1">
                            <v-card-text>
                                <v-text-field
                                    single-line
                                    outlined
                                    dense
                                    v-model="position"
                                    label="position"
                                    required
                                    :rules="positionRules"
                                    :error="positionError"
                                    :error-messages="positionErrMsg"
                                    @change="clearAlert"
                                ></v-text-field>
                                <v-text-field
                                    single-line
                                    outlined
                                    dense
                                    v-model="slug"
                                    label="slug"
                                    required
                                    @mousedown="generateSlug"
                                    @focus="generateSlug"
                                    :rules="slugRules"
                                    :error="slugError"
                                    :error-messages="slugErrMsg"
                                    @change="clearAlert"
                                ></v-text-field>
                                <v-textarea
                                    dense
                                    v-model="content"
                                    label="content"
                                    outlined
                                    name="input-7-4"
                                    @change="clearAlert"
                                ></v-textarea>
                            </v-card-text>
                        </v-card>
                    </div>
                    <div class="col-md-4 col-12">
                        <v-card>
                            <v-card-text>
                                <v-text-field
                                    label="First name"
                                    required
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
    // props: ['postObject'],
    components: {
      SnackBar
    },
    created(){
        if(this.$route.params.id){
            this.getPostToEdit();
            this.pageAction = 'update';
        }
    },
    data() {
        return {
            id: '',
            pageAction: 'publish',
            pageTitle: 'Create Job a Post',

            baseURL : window.location.origin,
            p:[],
            // v-models
            postURL: '',
            position: '',
            slug: '',
            originalSlug: '',
            content: '',

            // Error Handling
            errors : new ErrorBag,
            positionError: false,
            positionErrMsg: '',
            slugError: false,
            slugErrMsg: '',

            // ui
            loading: false,
            valid: true,

            // SnackBar
            sbType : '',
            sbText : '',
            sbStatus : false,

            // Rules
            positionRules : [
                value => !!value || 'Required',
                value => (value && value.length < 50)  || 'Max 50 characters',
                value => (value && value.length > 1)  || 'Min 1 characters',
            ],
            slugRules : [
                value => !!value || 'Required',
                value => (value && value.length < 50)  || 'Max 50 characters',
                value => (value && value.length > 1)  || 'Min 1 characters',
            ],

            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        }
    },
    mounted(){
        const height = document.querySelector('header.v-app-bar').offsetHeight + document.querySelector('.secondary-header').offsetHeight;
        document.querySelector('.page-content').style.height = "calc(100vh - "+height+"px - 24px)";

        // Check if has postObject
        // if(this.getEditData) {
        //     this.loading = true;
        //     this.pageAction = 'update';
        // }
        // console.log(this.$route.params.id);

    },
    methods:{
        getPostToEdit() {
            axios.get("/api/admin/post/edit/" + this.$route.params.id).then(response => {
                // this.post = JSON.stringify(response.data);
                this.p = response.data;
                //     this.p = JSON.parse(this.postObject);
                this.pageTitle = 'Edit '+this.p.position;
                this.id = this.p.id;
                this.position = this.p.position;
                this.slug = this.p.slug;
                this.originalSlug = this.p.slug;
                this.content = this.p.content;
                this.postURL = '';
                this.loading = false;
                console.log(this.p);
            });
        },
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
        generateSlug(){
            this.slug = this.position && slugify(this.position);
        },
        postRequest(controller, data){
            console.log(controller);
            console.log(data);
            axios.post('/admin/post/store', data)
            .then(response => {
                this.successUI(response.data.message);
                this.originalSlug = this.slug;
                console.log(response);
                // console.log(response.data.message);
            })
            .catch(error => {
                console.log(error);
                if(error.response.status == 403){
                    this.errorUI(error);
                }
                if (error.response && error.response.status == 422) {
                    this.errors.setErrors( error.response.data.errors );
                    this.errorUI('Unprocessable Entity');
                    // Input error messages
                    if(this.errors.hasError('slug') ){
                        this.slugError = true;
                        this.slugErrMsg = this.errors.first('slug');
                    }
                    if(this.errors.hasError('position') ){
                        this.positionError = true;
                        this.positionErrMsg = this.errors.first('position');
                    }
                }
            });
        },
        save(action){
            this.clearAlert();
            this.loading = true;
            let postData = [];
            postData = {
                status : action,
                slug : this.slug,
                position : this.position && this.position.trim(),
                content : this.content
            }
            // if(controller === 'update'){
            //     data['id'] = this.id;
            //     if(this.originalSlug === this.slug){ // check the slug
            //         delete data['slug'];
            //     }
            // }
            if(action === 'publish'){ // Create
                this.postRequest('store', postData);
            }else if(action === 'update'){ // update
                postData.id = this.id;
                if(this.originalSlug === this.slug){ // check the slug
                    delete postData.slug;
                }
                console.log(postData)
                this.postRequest('update', postData);
            }else if(action === 'draft'){ // draft
                postData.status = 'draft';
                let routeController = (this.pageAction === 'publish') ? 'store' : 'update';
                this.postRequest(routeController, postData);
            }

        },
    }
};
</script>

<template>
    <div style="width:100%;">
        <v-form v-model="valid">
            <div class="secondary-header" style="width:100%;border-bottom:1px solid #ddd;">
                <v-toolbar dense flat class="grey lighten-4">
                    <v-toolbar-title>Create Job a Post</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn small text class="info--text" @click="draft()">Save as Draft</v-btn>
                    <v-btn small class="ml-2" :href="postURL" target="_blank">Preview</v-btn>
                    <v-btn small color="primary" class="ml-2" :disabled="!valid" @click="update()">Publish</v-btn>
                </v-toolbar>
            </div>     
            <div class="col page-content" style="width:100%;overflow-y:scroll;">
                <div class="d-flex">
                    <div class="col-md-8 col-12">
                        <v-card>
                            <v-card-text>
                                <v-text-field
                                    dense
                                    v-model="position"
                                    :rules="positionRules"
                                    label="Position"
                                    required
                                ></v-text-field>                          
                                <v-text-field
                                    dense
                                    v-model="slug"
                                    :rules="slugRules"
                                    label="Slug"
                                    required
                                ></v-text-field>
                            </v-card-text>
                        </v-card>
                    </div>
                    <div class="col-md-4 col-12">
                        <v-card>
                            <v-card-text>
                                <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="position"
                                    :rules="positionRules"
                                    :counter="10"
                                    label="First name"
                                    required
                                ></v-text-field>
                                </v-col>
                            </v-card-text>
                        </v-card>
                    </div>
                </div>
            </div><!-- .page-content -->
        </v-form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // ui
            loading: false,
            valid: true,
            postURL: '',
            name: '',
            postURL: '',
        }
    },
    mounted(){
        const height = document.querySelector('header.v-app-bar').offsetHeight + document.querySelector('.secondary-header').offsetHeight;
        document.querySelector('.page-content').style.height = "calc(100vh - "+height+"px - 24px)";
    }
};
</script>

<style>
</style>
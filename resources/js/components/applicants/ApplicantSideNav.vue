<template>
    <div class="col-md-4">
        <v-card class="mx-auto" width="100%">
            <v-list>
                <v-subheader>Settings</v-subheader>
                <v-list-item-group color="primary">
                <v-list-item to="/u/account">
                    <v-list-item-icon>
                        <v-icon>mdi-account</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Account</v-list-item-title>
                    </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
                <v-list-item-group color="primary">
                <v-list-item to="/u/cv">
                    <v-list-item-icon>
                        <v-icon>mdi-file-document</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>CV</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                </v-list-item-group>
                <v-list-item-group color="primary">
                    <v-list-item to="/u/my-applications">
                        <v-list-item-icon>
                            <v-icon>mdi-send</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                        <v-list-item-title>My Applications</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-card>
    </div>
</template>

<script>
export default {
    daya(){

    },
    methods: {
        getUser(){

        }
    }
}
</script>

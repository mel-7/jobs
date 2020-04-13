<template>
    <div>
        <v-app-bar app clipped-left dense dark>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <span class="ml-3 mr-5">AZJOBS</span>
            <v-spacer></v-spacer>
            <v-menu
                v-model="menu"
                :close-on-content-click="false"
                :nudge-width="150"
                transition="slide-y-transition"
                offset-y
                :nudge-bottom="3"
            >
                <template v-slot:activator="{ on }">
                    <v-btn text icon v-on="on">
                        <v-avatar size="36">
                        <img src="https://mel-7.com/wp-content/uploads/2019/04/romel-indemne-v1.jpg" alt="Romel Indemne">
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card>
                    <v-list>
                        <v-list-item>
                        <v-list-item-avatar>
                            <img src="https://mel-7.com/wp-content/uploads/2019/04/romel-indemne-v1.jpg" alt="Romel Indemne">
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title> {{ authUser.name }} </v-list-item-title>
                            <v-list-item-subtitle>{{ authUser.email }}</v-list-item-subtitle>
                        </v-list-item-content>
                        </v-list-item>
                    </v-list>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-btn depressed v-on:click="logout" width="100%">Logout</v-btn>
                    </v-card-actions>
                </v-card>
            </v-menu>
        </v-app-bar>
        <v-navigation-drawer
            v-model="drawer"
            app
            clipped
            color="grey lighten-4"
        >
            <v-list>
                <router-link tabindex="0" to="/admin/dashboard" class="router px-0 v-list-item v-list-item--link theme--light">
                    <v-list-item :ripple="{ center: true }">
                        <v-list-item-icon>
                            <v-icon>mdi-view-dashboard-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Dashboard</v-list-item-title>
                    </v-list-item>
                </router-link>

                <v-list-group prepend-icon="mdi-format-list-text">
                    <template v-slot:activator>
                        <v-list-item-title>Job Posts</v-list-item-title>
                    </template>
                    <v-list class="grey lighten-3">
                        <v-list-item to="/admin/post/create">
                            <v-list-item-icon class="pl-5">
                                <v-icon small>mdi-file-document-box-plus-outline</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>Create Post</v-list-item-title>
                        </v-list-item>
                        <v-list-item to="/admin/posts">
                            <v-list-item-icon class="pl-5">
                                <v-icon small>mdi-format-list-bulleted</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>All Posts</v-list-item-title>
                        </v-list-item>
                        <v-list-item to="/admin/post/categories">
                            <v-list-item-icon class="pl-5">
                                <v-icon small>mdi-file-tree</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>Categories</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-list-group>

                <v-list-group prepend-icon="mdi-account-group">
                    <template v-slot:activator>
                        <v-list-item-title>Users</v-list-item-title>
                    </template>
                    <v-list class="grey lighten-3">
                        <v-list-item  to="/admin/users">
                            <v-list-item-icon class="pl-5">
                                <v-icon small>mdi-account</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>All Users</v-list-item-title>
                        </v-list-item>
                        <v-list-item @click="0">
                            <v-list-item-icon class="pl-5">
                                <v-icon small>mdi-account-check</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>Roles</v-list-item-title>
                        </v-list-item>
                        <v-list-item @click="0">
                            <v-list-item-icon class="pl-5">
                                <v-icon small>mdi-account-details</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>User Fields</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-list-group>

                <v-list-item @click="0">
                     <v-list-item-icon>
                        <v-icon>mdi-email-receive</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Applications</v-list-item-title>
                    <v-list-item-action>
                    <v-badge color="success" small content="6"></v-badge>
                    </v-list-item-action>
                </v-list-item>

                <v-list-item to="/admin/post/customfields">
                    <v-list-item-icon>
                        <v-icon >mdi-checkbox-multiple-blank-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Custom Fields</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
export default {
    props: ['authUser'],
    data: () => ({
        drawer: null,
        menu: false,
    }),
    methods: {
        logout: function (event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        },
    }
}
</script>

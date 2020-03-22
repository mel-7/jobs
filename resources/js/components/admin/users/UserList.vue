<template>
   <div class="col">
      <div class="col-12 col-md-8">
         <v-data-table
            :headers="headers"
            :items="users"
            :page.sync="page"
            :items-per-page="itemsPerPage"
            hide-default-footer
            class="elevation-1">
            <template v-slot:top>
               <v-toolbar flat color="transparent">
                  <v-toolbar-title>Users</v-toolbar-title>
                  <v-spacer></v-spacer>
                  <v-btn class="primary" to="/admin/user/create">New</v-btn>
               </v-toolbar>
            </template>
            <template v-slot:item.position="{ item }">
               <a @click="editItem(item)">{{ item.position }}</a>
            </template>
            <template v-slot:item.action="{ item }">
               <v-icon small @click="editItem(item)">mdi-pencil</v-icon>
               <v-icon small @click="deleteItem(item)">mdi-trash-can</v-icon>
            </template>
         </v-data-table>
         <v-pagination
            v-if="pageCount > 1"
            class="mt-3"
            v-model="page"
            :length="pageCount"
            @input="onPageChange"
         ></v-pagination>
      </div>
      <!-- <v-dialog v-model="dialog" max-width="500px">
         <v-card :loading="loading">
            <v-form
               ref="form"
               @submit.prevent="confirmDelete(dialogId)">
               <v-card-title>
                  <span class="headline">Delete {{ deleteTitle }}</span>
               </v-card-title>
               <v-card-text>
                  Are you sure you want to delete <strong>{{deleteTitle}}</strong>?
               </v-card-text>
               <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="dialog = false">Cancel</v-btn>
                  <v-btn
                     color="primary"
                     text
                     type="submit"
                  >Delete</v-btn>
               </v-card-actions>
            </v-form>
         </v-card>
      </v-dialog> -->
      <!-- <snack-bar :snackbar-type="sbType" :snackbar-text="sbText" :snackbar-status="sbStatus"></snack-bar> -->
   </div>
</template>

<script>
export default {
    data() {
        return {
            baseURL : window.location.origin,
            users: [],
            page: 1,
            pageCount: 0,
            itemsPerPage: 10,
            headers: [
                {
                    text: "ID",
                    value: "id",
                    width: "1%",
                    align: "left",
                    sortable: false,
                },
                {
                    text: "Name",
                    value: "name",
                    width: "10%",
                    align: "left"
                },
                {
                    text: "Email",
                    value: "email",
                    width: "10%",
                    align: "left"
                },
                {
                    text: "Actions",
                    value: "action",
                    sortable: false,
                    width: "10%",
                    align: "right"
                }
            ],
        }
    },
    methods: {
        onPageChange(){
            this.getUsers(this.page);
        },
        getUsers(p) {
            axios.get("/api/admin/users/?page=" + p)
            .then(response => {
                console.log(response.data.data)
                this.users = response.data.data;
                this.page = response.data.current_page;
                this.pageCount = response.data.last_page;
            })
            .catch(error => {
                console.log("Error: " + error);
            });
        },
    },
    mounted(){
        this.getUsers(1);
    }
}
</script>
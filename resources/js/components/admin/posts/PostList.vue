<template>
   <div class="col">
      <div class="col-12">
         <v-data-table
            :headers="headers"
            :items="posts"
            :page.sync="page"
            :items-per-page="itemsPerPage"
            hide-default-footer
            class="elevation-1"
            >
            <template v-slot:top>
               <v-toolbar flat color="transparent">
                  <v-toolbar-title>Job Posts</v-toolbar-title>
                  <v-spacer></v-spacer>
                   
                  <!-- <v-btn class="primary" ><router-link to="/admin/post/create" class="white--text router">New</router-link></v-btn> -->
                  <v-btn class="primary" to="/admin/post/create">New</v-btn>
               </v-toolbar>
            </template>
            <template v-slot:item.title="{ item }">
               <a v-bind:href="'/admin/post/'+item.id">{{ item.title }}</a>
            </template>
            <template v-slot:item.action="{ item }">
               <v-icon small @click="editItem(item)">mdi-pencil</v-icon>
               <v-icon small @click="toDeleteItem(item)">mdi-trash-can</v-icon>
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
   </div>
   <!-- <snack-bar :snackbar-type="sbType" :snackbar-text="sbText" :snackbar-status="sbStatus"></snack-bar> -->
</template>
<style scoped>
   table td a:hover{
      border-bottom: 1px dotted;
      transition: .1s ease-out;
   }
</style>
<script>
export default {
   name: 'PostList',
   data() {
      return {
         // Base URL to be changed in vuex
         baseURL : window.location.origin,

         posts : [],
         page: 1,
         pageCount: 1,

         // Data Table
         itemsPerPage: 10,
         page: 1,
         pageCount: 0,
         headers: [
            {
               text: "ID",
               value: "id",
               width: "1%",
               align: "left"
            },
            {
               text: "Position",
               value: "position",
               width: "10%",
               align: "left"
            },
            {
               text: "Slug",
               value: "slug",
               width: "10%",
               align: "left"
            },
            {
               text: "Actions",
               value: "action",
               sortable: false,
               width: "20%",
               align: "right"
            }
         ]
      }
   },
   methods: {
      onPageChange(){
         this.getProducts(this.page);
      },
      getProducts(p) {
         // Get the data
        axios
        .get("/api/posts/?page=" + p)
        .then(response => {
            this.posts = response.data.data;
            this.page = response.data.current_page;
            this.pageCount = response.data.last_page;
        })
        .catch(error => {
            console.log("Error: " + error);
        });
      },
      newItem(){

      }
   },
   mounted(){
      this.getProducts(this.page);
   }
}
</script>
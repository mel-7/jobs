<template>
  <div class="col-12">
    <v-card v-for="post in posts" v-bind:key="post.id" class="mx-auto mb-5">
      <v-list-item three-line>
        <v-list-item-avatar class="align-self-center">
          <v-avatar color="teal" size="48">
            <span class="white--text overline">48</span>
          </v-avatar>
        </v-list-item-avatar>
        <v-list-item-content class="align-self-center">
          <v-list-item-title class="mb-1">{{post.position}}</v-list-item-title>
          <v-list-item-subtitle>{{post.content}}</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action class="align-self-center">
          <div class="overline mb-4">ACTIONS</div>
          <div class="d-flex">
            <v-icon small color="primary">mdi-pencil</v-icon>
            <v-icon small color="primary" class="ml-3">mdi-trash-can-outline</v-icon>
          </div>
        </v-list-item-action>
      </v-list-item>
    </v-card>
    <v-pagination v-if="pageCount > 1" class="mt-3" v-model="page" :length="pageCount"></v-pagination>
    <!-- @input="onPageChange" -->
  </div>
</template>

<script>
export default {
  name: "Account",
  props: {
    user: Object,
    default: null
  },
  data() {
    return {
      // Posts
      posts: [],
      page: 1,
      pageCount: 1,
      itemsPerPage: 10
    };
  },
  methods: {
    getProducts(p) {
      axios
        .get("/api/posts/?page=" + p)
        .then(response => {
          this.posts = response.data.data;
          this.page = response.data.current_page;
          this.pageCount = response.data.last_page;
          console.log(this.posts);
        })
        .catch(error => {
          console.log("Error: " + error);
        });
    },
    editItem() {}
  },
  mounted() {
    // console.log(this.user);
    this.getProducts(1);
  }
};
</script>

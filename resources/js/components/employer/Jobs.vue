<template>
  <div class="col-12 col-md-8 mx-auto">
    <div class="my-5">
      <v-btn to="/e/job/create" class="primary">New Job Post</v-btn>
    </div>
    <v-card v-for="post in posts" v-bind:key="post.id" class="mx-auto mb-5">
      <v-list-item three-line>
        <v-list-item-avatar tile size="62" class="align-self-center">
          <v-img src="https://picsum.photos/510/300?random" aspect-ratio="1"></v-img>
        </v-list-item-avatar>
        <v-list-item-content class="align-self-center">
          <v-list-item-title class="mb-1 font-weight-bold">{{post.position}}</v-list-item-title>
          <v-list-item-subtitle v-html="post.content ? post.content : 'N/A'"></v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action class="align-self-center">
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

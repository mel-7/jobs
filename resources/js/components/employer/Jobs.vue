<template>
  <div class="col-12">
    <v-card v-for="post in posts" v-bind:key="post.id" class="mx-auto mb-5">
      <v-list-item three-line>
        <v-list-item-content>
          <div class="overline mb-4">OVERLINE</div>
          <v-list-item-title class="headline mb-1">Headline 5</v-list-item-title>
          <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
      <v-card-actions>
        <v-btn text>Button</v-btn>
        <v-btn text>Button</v-btn>
      </v-card-actions>
    </v-card>
    <!-- <v-pagination v-if="pageCount > 1" class="mt-3" v-model="page" :length="pageCount"></v-pagination> -->
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

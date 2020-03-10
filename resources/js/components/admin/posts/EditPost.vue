<template>
  <div class="col">
      <div class="col-12">
          edit post {{singlePost}}
      </div>
  </div>
</template>

<script>
export default {
    name: 'EditPost',
    props: ['post'],
    data() {
      return {
          postID: this.id,
          singlePost: this.post,
      }
    },
    mounted(){
        console.log(this.singlePost);
    },
    created(){
        // axios.get('/admin/post/edit/'+this.$route.params.id)
        // .then((response) => {
        //     this.post = response.data;
        //     // console.log(response.data);
        // });
    },
    methods: {

    }
}
</script>

<style>

</style>
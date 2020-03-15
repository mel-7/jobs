<template>
    <post-form :post-object="post"></post-form>
</template>

<script>
import postForm from './PostForm';
export default {
    components:{
        postForm
    },
    props: ['id'],
    data() {
        return {
            postID: this.id,
            post: [],
        }
    },
    created(){
        axios.get('/api/admin/post/edit/'+this.postID)
        .then((response) => {
            // this.post = response.data;
            this.post = JSON.stringify(response.data);
            // console.log(this.post);
        });
    },
    methods: {

    }
}
</script>
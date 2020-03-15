<template>
    <post-form :post-object="post"></post-form>
</template>
<script>
import postForm from './PostForm';
export default {
    components:{ postForm },
    props: ['id'],
    data() {
        return {
            post: [],
        }
    },
    created(){
        axios.get('/api/admin/post/edit/'+this.id)
        .then((response) => {
            this.post = JSON.stringify(response.data);
        });
    },
}
</script>
<template>
    <div class="col-8">
        <search-job></search-job>
        <v-card v-for="item in posts" :key="item.id" class="mx-auto mb-6">
            <v-card-text>
                <h2 class="text--primary mb-3">{{ item.position }}</h2>
                <p><span>IT</span></p>
                <div class="text--primary" v-if="item.content != null">
                    {{item.content}}
                </div>
                <div v-else>no content</div>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions class="pa-3">
                <v-btn small color="primary">Read More</v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
        }
    },
    methods:{
        getPosts(p) {
            axios.get("/api/posts/?page=" + p)
            .then(response => {
                this.posts = response.data.data;
            })
            .catch(error => {
                console.log("Error: " + error);
            });
        },
    },
    mounted(){
        this.getPosts(1);
    },
}
</script>
<style lang="css" scoped>
    h1, h2, h3, h4, h5, h6, p{
        margin-bottom: 15px;
    }
</style>

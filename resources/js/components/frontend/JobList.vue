<template>
    <div class="col-9">
        <v-card v-for="item in posts" :key="item.id" class="mx-auto mb-6">
            <v-card-text>
            <h2 class="text--primary mb-3">{{ item.position }}</h2>
            <p><span>IT</span></p>
            <div class="text--primary">
                {{ printContent(item.content) }}
            </div>
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
            content: [],
        }
    },
    methods:{
        printContent(c){
            console.log(JSON.parse(c));
            if(c){
                if(c.blocks){
                    return c.blocks;
                }else{
                    return 'meh';
                }
            }else{
                return 'No Details';
            }
        },
        getPosts(p) {
            axios.get("/api/posts/?page=" + p)
            .then(response => {
                this.posts = response.data.data;
                // console.log(this.posts);
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
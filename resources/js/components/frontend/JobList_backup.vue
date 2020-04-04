<template>
    <div class="col-9">
        <v-card v-for="item in posts" :key="item.id" class="mx-auto mb-6">
            <v-card-text>
                <h2 class="text--primary mb-3">{{ item.position }}</h2>
                <p><span>IT</span></p>
                <div class="text--primary" v-if="item.content != null">
                    <!-- {{ JSON.parse(item.content).blocks }} -->
                    <div v-for="block in JSON.parse(item.content).blocks" :key="block.id">
                        <template v-if="block.type == 'header'">
                            <template v-if="block.data.level == 1">
                                <h1>{{ block.data.text }}</h1>
                            </template>
                            <template v-else-if="block.data.level == 2">
                                <h2>{{ block.data.text }}</h2>
                            </template>
                        </template>
                        <template v-else-if="block.type == 'paragraph'">
                            <p v-html="block.data.text"></p>
                        </template>
                        <template v-else-if="block.type == 'list'">
                            <template v-if="block.data.style == 'ordered'">
                                <ol>
                                    <li v-for="list in block.data.items" :key="list.id" v-html="list"></li>
                                </ol>
                            </template>
                            <template v-if="block.data.style == 'unordered'">
                                <ul>
                                    <li v-for="list in block.data.items" :key="list.id"  v-html="list"></li>
                                </ul>
                            </template>
                        </template>
                    </div>
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

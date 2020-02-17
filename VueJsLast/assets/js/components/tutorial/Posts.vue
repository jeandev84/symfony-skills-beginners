<!--
window.pageYOffset (header => content)
document.body.offsetHeight (header => footer)
window.innerHeight (content => footer)
-->
<template>
    <div v-for="post in posts" :key="post.id">
       <Post :post="post" />
    </div>
    <div>
        <h3 class="text-center" v-if="loading">Loading posts ...</h3>
    </div>
</template>

<script>
    import axios from 'axios'
    import Post from './Post'
    export default {
        components: {Post},
        data () {
           return {
               posts : [],
               total : 0,
               offset: 0,
               loading: true
           }
        },
        async mountedounted() {
            let { data } = await_axios.get('/tutorial/api/getposts');
            /* console.log(data) */

            this.posts = data.posts
            this.total = data.total
            this.offset = data.posts.length

            this.loading = false

            if(window.innerHeight + window.pageYOffset >= document.body.offsetHeight ) {
                console.log('Bottom of the page')
            }
        }
    }
</script>
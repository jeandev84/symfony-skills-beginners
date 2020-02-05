<template>
    <div>
        <h2 class="text-center">Create a new post</h2>
        <div id="post-form-holder" ref="form" v-on:submit.prevent="onSubmit">

        </div>
    </div>
</template>

<script type="application/javascript">
    import axios from 'axios'
    export default {
        methods: {
            onSubmit: function (e) {

                let formData = new FormData(e.target);

                /* alert('submitted') */
                axios.post('/tutorial/storePost', formData)
                     .then((response) => {
                         console.log(response)
                     })
            }
        },
        async mounted () {
           /*
            let {data} = await_axios.get('/tutorial/postform');
            console.log(data);
            this.$refs.form.innerHTML = data.form
           */
           let {data} = await_axios.get('/tutorial/postform')
                                   .then((response) => {
                                       console.log(response)
                                   })
        }
    }

/*
 document.getElementById('test').click(function (e) {
     e.preventDefault();
 });
*/
</script>
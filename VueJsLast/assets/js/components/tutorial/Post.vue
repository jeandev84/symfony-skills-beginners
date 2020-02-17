<template>
   <div>
       {{ post }}
   </div>
</template>

<script>
    export default {
        props: {
           post: {
               require: true,
               type: Object
           }
        },
        async mounted () {
            console.log(this.post)
        }
    }
</script>

<template>
    <div>
        <a @click="like" >
        <span><i class="fas fa-thumbs-up"></i></span>
        <span>Like</span>
    </a>
    </div>
</template>

<script>
    export default {
        name: "LikeButton",
        props: {
            tweetId: "",
        },
        methods: {
            like(){
                axios.post('/like/{id}',{
                    tweetId: this.tweetId,
                })
                .then(response => {
                    this.$root.$emit('tweetLiked', this.tweetId);
                    console.log("liked");
                });
            },
        },
    }
</script>

<style scoped>

</style>

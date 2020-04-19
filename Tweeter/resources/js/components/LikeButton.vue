
<template>
    <a class="level-item button is-small is-info" @click="like" >
        <span class="icon is-small"><i class="fas fa-thumbs-up"></i></span>
        <span>Like</span>
    </a>
</template>

<script>
export default {
    name: "TweetLikeButton",
    props: {
        tweetId: "",
    },
    methods: {
        like(){
            axios.post('/tweet/like',{
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

<style>
</style>

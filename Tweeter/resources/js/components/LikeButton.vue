
<template>
    @if (checkLike($tweet->id, Auth::user()->like))
        <form action="/unlike/{{$tweet->id}}" method="post">
            @csrf
            <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">
            <input class="btn btn-warning rounded-pill float-right" type="submit" value="Unlike" style="margin-right:10px;">
        </form>
        <br><br>
    @else
        <form action="/like/{{$tweet->id}}" method="post">
            @csrf
            <input class="btn btn-success rounded-pill float-right"type="submit" value="Like" style="margin-right:10px;">
            <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">
        </form>
    <br><br>
    @endif
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

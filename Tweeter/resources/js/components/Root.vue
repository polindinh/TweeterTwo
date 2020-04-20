<template>
    <div class="container marketing">
        <div id="banner">
            <h1 >Tweeter</h1>
            <h4>Feel The Social Experience</h4>
            <img src="/storage/images/banner.jpg" alt="">
        </div>
        <div class="bullet one">
            <div class="item">
                <img class= "photo" src="/storage/images/networking.jpg" alt="Image">
            </div>
            <div class="item">
                <h4>Connect with your friends and loved ones </h4>
            </div>

        </div>
        <div class="bullet two">
            <div>
                <h4 >The World At Your Fingertips</h4>
                <p>Amazing you can talk to someone halfway across the world.</p>
            </div>
            <div>
                <img class= "photo" src="https://media.giphy.com/media/2UqY3qzXIR6DwM31Aq/giphy.gif" alt="GIF">
            </div>
        </div>
        <div class="bullet three">
            <div>
                <img class= "photo" src="https://media.giphy.com/media/3o6ZtfKwnx8bWjDAgo/giphy.gif" alt="GIF">
            </div>
            <div>
                <h4>Share Your Stories</h4>
                <p>We are here every step of the way with your stories.</p>
            </div>
        </div>
        <div class="bullet four" >
            <div>
                <h4>Multi platform</h4>
                <p>We are available on all platfomr: pc, mobile. give you that seemless transition</p>
            </div>
            <div>
                <img class= "photo"  src="/storage/images/mobile.jpg" alt="Image">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Root',
}
$(document).ready(function(){
 // init controller
var controller = new ScrollMagic.Controller();

// create a scene
new ScrollMagic.Scene({
	duration: 100, // the scene should last for a scroll distance of 100px
	offset: 50 // start this scene after scrolling for 50px
})
	.setPin('#my-sticky-element') // pins the element for the the scene's duration
	.addTo(controller); // assign the scene to the controlle
})
</script>

<style scoped>
    .marketing {
        background-color:whitesmoke;
        /* background: linear-gradient(to top, #99ccff 0%, #3366ff 100%); */
        display:grid;
        grid-template-rows: 1fr 1fr 1fr 1fr 1fr;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: auto;
        width :100%;
        height: auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.40);

        
    }
    .bullet {
        display:grid;
        grid-template-columns: 1fr 1fr;
        /* justify-items: center; */
        align-self: center;
        padding: 50px 0 50px 0;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 20px;
    }

    .one{
        /* background-color:#E0DFD5; */
        background-color:#F4EBE8;

        
    }
    .two{
        background-color:#EFCFE3;
    }
    .three{
        background-color:#B3DEE2;
    }
    .four{
        background-color:#E0DFD5;
    }

    h1 ,h4 {
        text-align: center;
        font-size: 3rem;
        color:#F06543;
    }

    img {
        width:100%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.40);

    }

    .photo {
        display:block;
        width: 65%;
        height: auto;
        border-radius:50px;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);


    }
</style>



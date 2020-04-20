<template>
    <div class="container marketing">
        <div id="banner">
            <h1>Tweeter</h1>
            <img id="main-banner" src="/storage/images/banner.jpg" alt="Image">
            <h4>Feel The Social Experience</h4>
        </div>
        <div id="tile2" class="bullet two animate">
            <div>
                <a href="/register">The World At Your Fingertips</a>
                <p>Our goal is to innovate. Our technology can help you connect to someone halfway across the world.</p>
            </div>
            <div>
                <img class= "photo" src="https://media.giphy.com/media/2UqY3qzXIR6DwM31Aq/giphy.gif" alt="GIF">
            </div>
        </div>
        <div id="tile1" class="bullet one animate">
            <div>
                <img class= "photo" src="/storage/images/networking.jpg" alt="Image">
            </div>
            <div>
                <a href="/register">Connecting Everyone</a>
                <p>Our platform are being used by millions of satisfied Users. What are you waiting for. Be in the know</p>
            </div>
        </div>
        <div id="tile3" class="bullet three animate">
            <div>
                <img class= "photo" src="https://media.giphy.com/media/3o6ZtfKwnx8bWjDAgo/giphy.gif" alt="GIF">
            </div>
            <div>
                <a href="/register">Share Your Stories</a>
                <p>We are here every step of the way with your stories. We bring you closer to the people and things you love</p>
            </div>
        </div>
        <div id="tile4" class="bullet four animate">
            <div>
                <a href="/register">Multi Platform</a>
                <p>Conveniently available on all devices of your choice whether its a laptop or a mobile phone. As long as you have internet connect. We got you covered.</p>
            </div>
            <div>
                <img  class= "photo"  src="/storage/images/mobile.jpg" alt="Image">
            </div>
        </div>
        <div>
            <p class="cp-text">
                © Copyright 2020 Tweeter. All rights reserved.
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Root',
}
$(document).ready(function(){
  var controller = new ScrollMagic.Controller();
  var sceneOne = new ScrollMagic.Scene({
    triggerElement: '#tile1',
    triggerHook: 1,
		duration: "100%"
  })
  .setClassToggle('#tile1', 'fade')
  .addTo(controller);

    var sceneOne = new ScrollMagic.Scene({
    triggerElement: '#tile2',
    triggerHook: 1,
		duration: "100%"
  })
  .setClassToggle('#tile2', 'fade')
  .addTo(controller);

    var sceneOne = new ScrollMagic.Scene({
    triggerElement: '#tile3',
    triggerHook: 0.8,
		duration: "100%"
  })
  .setClassToggle('#tile3', 'fade')
  .addTo(controller);

    var sceneOne = new ScrollMagic.Scene({
    triggerElement: '#tile4',
    triggerHook: 1,
		duration: "100%"
  })
  .setClassToggle('#tile4', 'fade')
  .addTo(controller);
})
</script>

<style scoped>
    .marketing {
        background-color:#DDEFFD;
        /* display:grid;
        grid-template-rows: 1fr 1fr 1fr 1fr 1fr; */
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: auto;
        width :100%;
        height: auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.40);
        padding-bottom: 10px;
    }
    .bullet {
        display:grid;
        grid-template-columns: 1fr 1fr;
        align-self: center;
        padding: 30px 0 30px 0;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 20px;
        margin:40px 0 40px 0;
    }
    .one{
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
    h1, h4 {
        text-align: center;
        font-size: 2rem;
        color:#F06543;
        padding:30px 0 30px 0;
        font-weight: bolder;

    }

    p {
        /* text-align: center; */
        padding:20px;
        font-size: 1rem;

    }

    img {
        width:100%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.40);
    }
    .photo {
        display:block;
        width: 65%;
        height: auto;
        border-radius:15px;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .animate{
        transform: translate(10px,75px);
        transition: all 1.3s ease-in;
        opacity: 0;
    }
    .fade{
        transform: translate(0,0);
        opacity: 1;
    }

    #main-banner:hover {
        animation: shake 1.5s;
        animation-iteration-count: infinite;
    }

    @keyframes shake {
        0% { transform: translate(1px, 1px) rotate(0deg); }
        10% { transform: translate(-1px, -2px) rotate(-1deg); }
        20% { transform: translate(-3px, 0px) rotate(1deg); }
        30% { transform: translate(3px, 2px) rotate(0deg); }
        40% { transform: translate(1px, -1px) rotate(1deg); }
        50% { transform: translate(-1px, 2px) rotate(-1deg); }
        60% { transform: translate(-3px, 1px) rotate(0deg); }
        70% { transform: translate(3px, 1px) rotate(-1deg); }
        80% { transform: translate(-1px, -1px) rotate(1deg); }
        90% { transform: translate(1px, 2px) rotate(0deg); }
        100% { transform: translate(1px, -2px) rotate(-1deg); }
    }
    .cp-text{ 
        color: rgba(0,0,0,.7); 
        text-shadow: 0 1px rgba(255, 255, 255, 0.1);
        text-align: center;

    }
a {
  color: #F06543;
  text-decoration: none;
  display: inline-block;
  position: relative;
  text-align: center;
  font-size: 2rem;
  padding:0 20px 0 20px;
}
a:after {    
  background: none repeat scroll 0 0 transparent;
  bottom: 0;
  content: "";
  display: block;
  height: 2px;
  left: 50%;
  position: absolute;
  background: #F06543;
  transition: width 0.3s ease 0s, left 0.3s ease 0s;
  width: 0;
}
a:hover:after { 
  width: 100%; 
  left: 0; 
}
</style>



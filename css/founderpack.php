<style>
@font-face {
    font-family: 'Montserrat Font';
    src: url(../fonts/Montserrat-Medium.ttf);
}

body {
    margin: 0;
    font-family: sans-serif;
    overflow-x: hidden;
}

@keyframes shrink {
  0% {
    background-size: 100% 100%;
  }
  100% {
    background-size: 125% 125%;
  }
}

/* Hero Image START */
.hero {
    /* Sizing */
    width: 100vw;
    height: 90vh;
    
    /* Flexbox stuff */
    display: flex;
    justify-content: center;
    align-items: center;
    
    /* Text styles */
    text-align: center;
    color: white;
    
    /* Background styles 
    background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('../img/gallery/1.jpg');
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: relative;
    animation: shrink 20s infinite alternate; */

}


.hero h1 {
    /* Text styles */
    font-size: 5em;
    font-family: 'Montserrat Font';
    
    /* Margins */
    margin-top: 0;
    margin-bottom: 0.5em;
    border-bottom: 2px solid gold;
    width: 30%;
    margin-left: 35%;
}

.hero h2 {
    /* Text styles */
    font-size: 1.5em;
    font-family: 'Montserrat Font';
    
    /* Margins */
    margin-top: 0;
    margin-bottom: 0.5em;
}

.hero .btn {
    /* Positioning and sizing */
    display: block;
    width: 200px;
    
    /* Padding and margins */
    padding: 1em;
    margin-top: 50px;
    margin-left: auto;
    margin-right: auto;
    
    /* Text styles */
    color: white;
    text-decoration: none;
    font-size: 1.5em;
    
    /* Border styles */
    border: 3px solid white;
    border-radius: 20px;
    
    /* Background styles */
    background-color: rgba(147, 112, 219, 0.8);
}

.hero{
animation: bgfade 30s infinite alternate;
background-size:cover;
background-position:center;
background-color:#000;
position:relative;
}

@keyframes bgfade {
0% {
background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('../img/gallery/1.jpg');
background-size: 100% 100%;
opacity: 0;
}
25% {
background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('../img/gallery/1.jpg');
opacity: 1;
}
50% {
background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('../img/gallery/1.jpg');

}
75% {
background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('../img/gallery/8.jpg');

}
100% {
background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('../img/gallery/3.jpg');
background-size: 150% 150%;
}
}

/* Hero V2 Image START */
.hero {
    /* Sizing */
    width: 100vw;
    height: 90vh;
    
    /* Flexbox stuff */
    display: flex;
    justify-content: center;
    align-items: center;
    
    /* Text styles */
    text-align: center;
    color: white;
}


.herov2 h1 {
    /* Text styles */
    font-size: 2.5em;
    font-family: 'Montserrat Font';
    
    /* Margins */
    margin-top: 0;
    margin-bottom: 0.5em;
    border-bottom: 2px solid gold;
    width: 30%;
    margin-left: 35%;
    
    text-shadow: 0px 0px 5px #FFDF00;
}

.herov2 h2 {
    /* Text styles */
    font-size: 1.5em;
    font-family: 'Montserrat Font';
    
    /* Margins */
    margin-top: 0;
    margin-bottom: 0.5em;
    text-shadow: 0px 0px 5px #FFDF00;
}

.herov2 .btn {
    /* Positioning and sizing */
    display: block;
    width: 200px;
    
    /* Padding and margins */
    padding: 1em;
    margin-top: 0px;
    margin-left: auto;
    margin-right: auto;
    
    /* Text styles */
    color: white;
    text-decoration: none;
    font-size: 1.5em;
    
    /* Border styles */
    border: 3px solid white;
    border-radius: 20px;
    
    /* Background styles */
    background-color: green;
}

.herov2{
animation: bgfadev2 10s infinite alternate;
background-size:cover;
background-position:center;
background-color:#000;
position:relative;
width: 100%;
height: 100%;
display:flex;
justify-content: center;
-webkit-transform: scale(1.2);  /* Fixes the shake in firefox */
-moz-transform: scale(1.2) rotate(0.02deg); /* Small rotation that fixes the shake in firefox */

}

@keyframes bgfadev2 {
0% {
background-image: linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.7)), url('../img/a.jpg');
background-size: 100% 100%;

}

100% {
background-image: linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.7)), url('../img/a.jpg');
background-size: 105% 105%;

}
}

/* Hero Image END */

/****** add a background overlay *******/
#animated-background:before {
content:"";
position:absolute;
top:0;
bottom:0;
left:0;
right:0;
background-color:black;
opacity:0.3;
}

/* width */
::-webkit-scrollbar {
  width: 15px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}

/* Fade in Stuff */
.fade-in {
  animation: fadeIn ease 1s;
  -webkit-animation: fadeIn ease 1s;
  -moz-animation: fadeIn ease 1s;
  -o-animation: fadeIn ease 1s;
  -ms-animation: fadeIn ease 1s;
}

@keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}

@-moz-keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}

@-webkit-keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}

@-o-keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}

@-ms-keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
}
}

/* Fade in stuff END */

/* Style the buttons that are used to open and close the accordion panel */
button.accordion {
    background-color: #2c2f30;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 50%;
    text-align: center;
    border: none;
    outline: none;
    transition: 0.4s;
    color: white;
    height: 7%;
    opacity: 0.9;
    /* Text styles */
    font-size: 1em;
    font-family: 'Montserrat Font';
    margin-top: 20px;
    font-weight:bold;
    color: gold;
    height: 10%;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */

button.accordion.active, button.accordion:hover {
    background-color: #232324;
    /* Text styles */
    font-size: 1em;
    font-family: 'Montserrat Font';
    opacity: 1;
}

div.panelaccordian {
    padding: 0 18px;
    /* background-color: #2c2f30; */
    max-height: 0;
    overflow: hidden;
    transition: 0.6s ease-in-out;
    opacity: 0;
    width: 50%;
    
    font-size:1.2em;
}

div.panelaccordian.show {
    opacity: 1;
    max-height: 100%; /* Whatever you like, as long as its more than the height of the content (on all screen sizes) */
    /* Text styles */
    width: 100%;
}

button.accordion:after {
    content: '\02795'; /* Unicode character for "plus" sign (+) */
    font-size: 13px;
    color: #777;
    float: right;
    margin-left: 5px;
}

button.accordion.active:after {
    content: "\2796"; /* Unicode character for "minus" sign (-) */
}

#container
{
    height:2000px;    
}

#container DIV
{ 
    margin:50px; 
    padding:50px; 
    background-color:pink; 
}

.hideme
{
    opacity:0;
}

td {
  font-size:20px;
  font-family: 'Montserrat Font';
}

p {
  font-size: 17px;
  font-family: 'calibri';
  text-shadow: 0px 0px 0px #FFDF00;
  font-weight: normal;
}

.col-lg-4 ul {
  list-style: none;
  margin-left: 0;
  padding-left: 0;
}

.col-lg-4 li {
  padding-left: 1.5em;
  text-indent: -1.5em;
}

.col-lg-4 li:before {
  content: "✓";
  padding-right: 5px;
  color: gold;
  font-size: 1.5em;
}





</style>
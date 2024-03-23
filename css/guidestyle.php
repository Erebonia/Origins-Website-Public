<?php  if(session_status()==PHP_SESSION_NONE) session_start(); ?>

<?php header('Content-type: text/css; charset:UTF-8');?>

<style>
@font-face 
{
font-family: myFirstFont;
src: url(../pvpimg/Montserrat-Bold.ttf);
}

@font-face 
{
font-family: myFirstFont;
src: url(../pvpimg/Montserrat-Medium.ttf);
}

body, html 
{
    height: 100%;
}

.main-banner-text 
{
  text-align: center;
  font-family: Montserrat-Medium;
  display: flex;
  justify-content: center;
  align-items: center;
}

.bgcustom {
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("../img/a.jpg");
    background-position-x: center;
    background-position-y: bottom;
    /*background-size: auto;*/
    background-size: cover;
    min-height: 900px;
    position: relative;
    animation: fadeIn ease 20s;
    -webkit-animation: fadeIn ease 5s;
    -moz-animation: fadeIn ease 5s;
    -o-animation: fadeIn ease 5s;
    -ms-animation: fadeIn ease 5s;
}

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}

body 
{
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
background-color: #181a1b;
}

.featurette-divider 
{
border: 1px solid #ffb320 !important;
margin-bottom: 25px;
}

h1 
{
font-size: 70px;
font-weight:700;
transition: 0.6s;
color: #c5912b;
text-transform:uppercase;
text-shadow: 0px 0px 2px #ffb320;
font-family: Montserrat-Bold.ttf;
}

h2 
{
font-size: 40px;
font-weight:700;
transition: 0.6s;
color: #c5912b;
text-transform:uppercase;
text-shadow: 0px 0px 2px #ffb320;
font-family: Montserrat-Bold.ttf;
padding-left: 15%;
}

p
{
font-size:20px;
color: #ffffff;
text-align:center;
padding-left: 15%;
padding-right: 15%;
font-family: Montserrat-Medium;
}

ul
{
font-size:20px;
color: #ffffff;
padding-left: 20%;
padding-right: 20%;
font-family: Montserrat-Medium;
}

img
{
  margin-top: 10px;
  margin-bottom: 25px;
}

/* Scroll Bar */
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

a {
  font-size: 50px;
  font-family: Montserrat-Medium;
  color:#c5912b;
  border: 1px solid #ffb320 !important;
  text-align: center;
}

a:hover {
  background: rgba(0, 0, 0, 0.9);
  opacity: 0.7;
}

</style>




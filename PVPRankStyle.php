<?php
header('Content-type: text/css; charset:UTF-8');
?>
<head>
<style>



@font-face 
{
font-family: myFirstFont;
src: url(pvpimg/Montserrat-Bold.ttf);
}

@font-face 
{
font-family: myFirstFont;
src: url(pvpimg/Montserrat-Medium.ttf);
}

body, html 
{
    height: 100%;
}

.main-banner
{
  /* background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("pvpimg/slider2.jpg"); */
  background-position: center;
  background-repeat: no-repeat;
  width: cover;
  position: relative;
  border-style: solid;
  border-color: #ffb320;
  border-width: 1px;
  animation: fadeIn ease 20s;
  -webkit-animation: fadeIn ease 1s;
  -moz-animation: fadeIn ease 1s;
  -o-animation: fadeIn ease 1s;
  -ms-animation: fadeIn ease 1s
}

.main-banner-text 
{
  text-align: center;
  font-family: cambria;
  display: flex;
  justify-content: center;
  align-items: center;
  -webkit-animation: fadeIn ease 5s;
  -moz-animation: fadeIn ease 5s;
  -o-animation: fadeIn ease 5s;
  -ms-animation: fadeIn ease 5s
}

.bgcustom {
  background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url("../img/a.jpg");
    background-position-x: center;
    background-position-y: bottom;
    /*background-size: auto;*/
    background-size: cover;
    min-height: 900px;
    position: relative;
    overflow: hidden;
}


body 
{


background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
}

.pvp-icon1 
{
text-align: center;
top: 0.1%;
right: -75%;
width: 100px;
position: relative;
} 	

.warrior
{
  opacity: 25%;
	position: absolute;
  z-index: 1;
  justify-content: center;
  margin-left: 70%;
}

.featurette-divider 
{
border: 1px solid #ffb320 !important;
}

h1 
{
font-size: 60px;
font-weight:700;
letter-spacing:0.5em;
transition: 0.6s;
color: #ffffff;
text-transform:uppercase;
text-shadow: 0px 0px 9px #ffb320;
animation: fadeIn ease 20s;
-webkit-animation: fadeIn ease 5s;
-moz-animation: fadeIn ease 5s;
-o-animation: fadeIn ease 5s;
-ms-animation: fadeIn ease 5s;
font-family: Montserrat-Bold.ttf;
}

p
{
font-size:25px;
color: #ffb320;
}

th
{
font-size: 50px;
text-shadow: 0px 0px 6px #ffb320;
color: #ffffff;
text-align: left;
font-family: Montserrat-Bold.ttf;
animation: fadeIn ease 20s;
-webkit-animation: fadeIn ease 5s;
-moz-animation: fadeIn ease 5s;
-o-animation: fadeIn ease 5s;
-ms-animation: fadeIn ease 5s;

}

tr 
{
color: #588c7e;
font-size: 50px;
text-align: left;
transform: scale(0.65);

}
	
td
{
text-align: left;
color: #ffffff;
font-size: 25px;
font-family: Montserrat-Medium;
animation: fadeIn ease 5s;
-webkit-animation: fadeIn ease 5s;
-moz-animation: fadeIn ease 5s;
-o-animation: fadeIn ease 5s;
-ms-animation: fadeIn ease 5s;
width: 1%;
text-shadow: 0px 0px 2px #ffb320;
}

tr:hover {
  background: rgba(0, 0, 0, 0.3);
}

tr:hover td {
    background-color: transparent; /* or #000 */
}
  
td::after {
  content: "";
  position: absolute;
  height: 1px;
  border-bottom: 2px solid black;
  top: 100%;
  width: 100%;
  left: 50%;
  transform: translateX(-50%);
}



table tr td:nth-child(8)
{
display: none;
}
	
</style>
</head>




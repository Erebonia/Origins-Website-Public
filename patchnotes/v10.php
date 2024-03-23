<?php  if(session_status()==PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="patchnotestyle.php"/>
    <link rel="stylesheet" href='../css/animate.css'  type='text/css' media="screen and (min-width:1200px)">
<style>
</style>
</head>
<body>

<div class="container-fluid bgcustom"> 
<div class="main-banner-text" >
<h1 style = "margin-top:25px" >Patch: January 12th, 2021</h1>
</div>

<hr class="featurette-divider" style="width: 70%;"> <!--  DIVIDER -->

<h2>Announcements</h2>
<p class="custom-paragraph">Hello everyone,</p>
<p class="custom-paragraph">This patch contains a few new features and some bug fixes.</p>
<hr class="featurette-divider" style="width: 70%;"> <!--  DIVIDER -->

<h2>Misc Changes</h2>
<ul>
<li>Right clicking an already equipped heraldry will now send it to your inventory instead of destroying it.
</li>
<li>Right clicking a plate in your inventory will open the plate crafting interface, no need to go to the NPC anymore.
</li>
<li>A few network improvements were made on server side.
</li>
<li>Shadow resolution was hugely increased on high graphics (Thanks Vahr!).
</li>
<li>Critical % stat cap has been increased to 100%, keep trying to max out your characters!
</li>
<li>Critical % and Final Damage % will now display 2 extra digits when you hover them:
<img src="../img/fd_percentage.png" id="test2" style=" display: block; margin-left: auto; margin-right: auto; width: 500px; heigth;500px">
<br>
<img src="../img/crit_percentage.png" id="test2" style=" display: block; margin-left: auto; margin-right: auto; width: 500px; heigth;500px">
</li>
<li>Buffed Fris.
</li>
</ul>

<hr class="featurette-divider" style="width: 70%;"> <!--  DIVIDER -->


<h2>Bug Fixes</h2>
<ul>
<li>Fixed an issue wherein Golem Moltan boss at Sea Dragon Nest Spores would target randomly any player instead of the one who has the aggro.</li>
<li>Gold gain on clear has been slightly increased, that's the final value it will stay at.</li>
</ul>




<hr class="featurette-divider" style="width: 70%;"> <!--  DIVIDER -->
<a class ="center" href = "https://dnorigins.com/">RETURN HOME</a>

</div>
</body>
</html>

<style>

.custom-paragraph {
    text-align:left;
}

</style>
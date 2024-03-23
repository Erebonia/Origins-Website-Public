<link rel = "stylesheet" type="text/css" href = "css/accountguide.php">
<?php include 'header.php';?>

<?php error_reporting(0);ini_set('display_errors', 0); if(session_status()==PHP_SESSION_NONE) session_start();
$AccountName = $_SESSION['AccountName'];
?>

<div class="container-fluid info">
	<main role="main" style="padding-top: 100px;">


    <div class="container marketing text-center">
     <h1 style="padding-bottom: 25px; font-size: 2em;">Welcome <?PHP echo $AccountName; ?></h1>



    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider" style="width: 100%;">

    <div class="row featurette">
      
        <h2 class="text-center" class="featurette-heading">Let's get started  <span class="">         </span></h2>

		<p> Your adventure will start in Prairie Town or Mana Ridge, depending on which character you chose.</li>
    <center><img class="img-responsive" data-src="holder.js/500x500/auto" alt="500x500" style="width: 55%;" src="img/sainthavenold.jpg" data-holder-rendered="true"></center><br>
    <ul>
    <li> Create your character go straight to the grind!</li>
		<li> In order to level up you should follow the main storyline or team up with parties.</li>
		<li> Don't feel like fighting monsters and still want to progress? Take a break from your adventure and try out our life skills(<b>COMING SOON</b>)!</li>
    </ul>
		<p><b>Good luck exploring, we'll see you around. - The Origin Team </b> </p>
      

    </div>

    <hr class="featurette-divider" style="width: 100%;margin-top: 25px;">

<div class="row featurette hideme">
  <div class="col-md-7">
    <h2 class="text-center"  class="featurette-heading">The Battlegrounds (PVP) <span class=""> </span></h2>
  <p class="text-center" ><b>A new paradise for fighters.</b></p>
  <p class="text-center">
    A completely unique and new map dedicated to the those who seeking to prove their worth in an colosseum setting. 
    Unlike other places you may have visited, it comes with a fully flushed out ranking system that factors much more than a player's experience. 
    To reach the pinnacle then you must aim to win as many matches possible and defeat all adversaries along the way.
    You will also notice there are completely different areas to compete in battle as well as familar ones. Good luck. </p>
  </div>
  <div class="col-md-5">
    <img class="img-responsive" data-src="holder.js/500x500/auto" alt="500x500" style="width: 300px; height: 300px;" src="img/wipeout.png" data-holder-rendered="true">
  </div>
</div>



    <hr class="featurette-divider" style="width: 100%;">

    <div class="row featurette hideme">
     <div class="col-md-5">
      <img class="img-responsive" data-src="holder.js/500x500/auto" alt="500x500" style="width:100%;" src="img/apoc.png" data-holder-rendered="true">
    </div>
    <div class="col-md-7">
	  <h2 class="featurette-heading">Road to Apocalypse (PvE) <span class="">Are you ready?</span></h2>
	  <p><b> Tips for new players! </b></p>
    <ul>
    <li>Follow the main quest for a smooth leveling process or join a party for an even faster grind.</li>
    <li>Save all your dimensional keys for farming abyss dungeons in the future.</li>
    <li>Collect all the equipment dungeons drop, they will be useful for you or your friends!</li>
    </ul>
    </div>
    
  </div>

  <hr class="featurette-divider" style="width: 100%; margin-top: 25px; margin-bottom: 25px;">



  <!-- /END THE FEATURETTES -->



	
	</div><!-- /.container -->
<!-- FOOTER -->
<footer class="container">
  
</footer>

</main>

</div>


<script src="js/scrollandfade.js" type="text/javascript"></script>

<?php include 'footer.php';?>


<?php error_reporting(0);ini_set('display_errors', 0); ?>

<style type="text/css">

	.w3-red {border-radius: 10px;}

	.w3-container img {text-align: center;}

	.w3-button {background: transparent;border:2px solid transparent;margin:5px;text-align: center; }

	.w3-button:focus {
    outline: 0;
    opacity: 1;
	}

	.w3-button:hover {
    outline: 0;
	}

	.w3-container h3{margin-bottom: 80px;font-family: Arial;text-shadow: none;border-bottom: 2px solid yellow; display: block !important;}

	.w3-container li {
		display: inline-grid;
		text-decoration: none;

	}

	.w3-container img {
		opacity: 0.5;
		transition-duration: 0.3s;
	}

	.w3-container img:hover {
		opacity: 1;
		transition-duration: 0.3s;
	}

	.w3-container img:active {
		opacity: 1;

	}

	.class-showcase {
		position: absolute; 
		z-index: -999; 
		opacity: 0.5; 
		filter: alpha(opacity=50);
		max-width: 600px;
		max-height: 700px;
		padding-top: 100px;
		padding-left: 50px;
	}

	.classContent {
    position: absolute;
    bottom: 0;
    right: 0;
}


</style>



<div class="container" style="margin-top: 25px;">

	<center><h2 style="padding-top:40px;">Select your class</h2></center>

	<hr style="border: 2px solid yellow;margin-bottom: 50px;">

	<div class="w3-container">

		
		<div class="col-md-5" style="min-height: 600px;">

			<h3>Classes</h3>

			<p>Select the class by clicking on the icons below to know more about the class and what they are capable of! Each and every class is unique and achieved through their 2nd job specialization. If you are new to Dragon Nest, you can find basic information corresponding the class here.</p>

			<br>

			<div class="w3-bar w3-black" >
			<ul>
				<li><button class="w3-bar-item w3-button tablink w3-red" onclick="openskil(event,'swordsman','sk1p')"><img src="img/class/icons/swordsman.png"></button></li>
				<li><button class="w3-bar-item w3-button tablink" onclick="openskil(event,'mercenary')"><img src="img/class/icons/mercenary.png"></button></li>
				<li><button class="w3-bar-item w3-button tablink" onclick="openskil(event,'sharpshooter')"><img src="img/class/icons/sharpshooter.png"></button></li>
				<li><button class="w3-bar-item w3-button tablink" onclick="openskil(event,'acrobat')"><img src="img/class/icons/acrobat.png"></button></li>
				<li><button class="w3-bar-item w3-button tablink" onclick="openskil(event,'elementalist')"><img src="img/class/icons/elementalist.png"></button></li>
			</ul>

			<ul>
				<li><button class="w3-bar-item w3-button tablink" onclick="openskil(event,'mystic')"><img src="img/class/icons/mystic.png"></button></li>
				<li><button class="w3-bar-item w3-button tablink" onclick="openskil(event,'paladin')"><img src="img/class/icons/paladin.png"></button></li>
				<li><button class="w3-bar-item w3-button tablink" onclick="openskil(event,'priest')"><img src="img/class/icons/priest.png"></button></li>
				<li><button class="w3-bar-item w3-button tablink" onclick="openskil(event,'engineer')"><img src="img/class/icons/engineer.png"></button></li>
				<li><button class="w3-bar-item w3-button tablink" onclick="openskil(event,'alchemist')"><img src="img/class/icons/alchemist.png"></button></li>
			</ul>
			</div>

		</div>

<!-- 		<div class="col-md-3" style="min-height: 600px;">
			<h3>Preview</h3>
			<img class="class-showcase" src="img/class/guardian.png" />
		</div> -->

		<div class="col-md-4" style="min-height: 400px;">

			<h3>Class Information</h3>
			<div id="allClasses" style="line-height: 30px;">
				<div class="classContent">
					<script src="js/classes.js"></script>
				</div>
			</div>

		</div>

	</div>

</div>

<!-- <div><iframe style="width: 100%;min-height: 200px;" class="img-responsive center-block" src="https://www.youtube.com/embed/Ha3v3E7gpJ0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div> -->





<div class="clearfix"></div>




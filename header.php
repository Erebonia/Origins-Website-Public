<?php session_start();


// set timeout period in seconds
$session_timeout = 3600;

if (!isset($_SESSION['last_visit'])) { $_SESSION['last_visit'] = time(); } 

if((time() - $_SESSION['last_visit']) > $session_timeout) { 
  session_destroy(); 
  header("Location: login/logout"); // think about user feedback, "your session timed out" ... index.php?action=session_timeout
  exit(); // <= IMPORTANT !!!
}


$_SESSION['last_visit'] = time();



?>
<!DOCTYPE html>

<html>

<head>

	<title>Dragon Nest Origins</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name=keywords content="Dragon Nest Origins,DNOrigins,DNO,Dragon Nest,DragonNest,Dragon Nest Private Server,Dragon Nest gaming,Private Server,Dragon Nest 60cap,OldSchool Dragon Nest, OldSchool, Vanilla DN">
        <meta name=description content="Dragon Nest Origins is an OldSchool Dragon Nest Server focused on bringing back the good times and improving them with our quality of life improvements.">
        <meta name=type content=website>
        <meta name=resource-type content=games>
        <meta name=Rating content=General>
        <meta property=og:site_name content="DN Origins">
        <meta property=og:title content="Dragon Nest Origins">
        <meta property=og:description content="Dragon Nest Origins is an OldSchool Dragon Nest Server focused on bringing back the good times and improving them with our quality of life improvements.">

	<!-- Latest compiled and minified CSS -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">





	<link rel='stylesheet' type='text/css' href="css/prettyPhoto.css" media='all' />

	<link rel="stylesheet" href="css/custom.min.css" type="text/css" media="screen" title="" charset="utf-8" />

	<link rel="stylesheet" href="css/duck.css" type="text/css" media="screen" title="" charset="utf-8" />

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

	<!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-TXfwrfuHVznxCssTxWoPZjhcss/hp38gEOH8UPZG/JcXonvBQ6SlsIF49wUzsGno" crossorigin="anonymous" async /> -->

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<!-- Latest compiled and minified JavaScript -->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script type="text/javascript" src="js/e.js"></script>

	<link rel="stylesheet" href='css/animate.css'  type='text/css' media="screen and (min-width:1200px)">

	<script type="text/javascript" src="js/wow.min.js"></script>


	<script type="text/javascript">

		$(document).on("scroll", function(){

			if

				($(document).scrollTop() > 86){

					$("#banner").addClass("shrink");

				}

				else

				{

					$("#banner").removeClass("shrink");

				}

			});

		</script>



	</head>

	<body style="background: black;">


		<div class="floating-navigation show">

			<ul class="float-nav-ul">


				<li class="nost-nav-mobile" id="floating-nav-first"><a id="nost-nav-home" href="home" marked="1"><i class="fas fa-home"></i><span>Home</span></a><div class="nav-text"><a href="home" marked="1">Home</a></div></li>

				<li class="nost-nav-mobile"><a id="nost-nav-account" href="https://docs.google.com/document/d/1kWxYfmL_JuiyZdyQG4ErbCz3KjVgoFhmznYldQua4sg/edit?usp=sharing" target=”_blank” marked="1"><i class="fas fa-street-view "></i><span>My Account</span></a><div class="nav-text"><a href="guide" marked="1">Guide</a></div></li>

				<li class="nost-nav-mobile"><a id="nost-nav-info" href="info" marked="1"><i class="fas fa-info "></i><span>Info</span></a><div class="nav-text"><a href="info" marked="1">Info</a></div></li>

				<li class="nost-nav-mobile"><a id="nost-nav-woe" href="pvprankingboard" marked="1"><i class="fas fa-chess-king "></i><span>Ranking</span></a><div class="nav-text"><a href="pvprankingboard" marked="1">Ranking</a></div></li>

				<!--<li class="nost-nav-mobile"><a id="nost-nav-review" href="https://discord.gg/XFcyMqE" target="_blank" rel="noreferrer" marked="1"><i class="fas fa-users-cog"></i><span>Team</span></a><div class="nav-text"><a href="#" marked="1">Team</a></div></li>-->

				<li class="nost-nav-mobile"><a id="nost-nav-shop" href="donation" marked="1"><i class="fas fa-donate "></i><span>nost Points</span></a><div class="nav-text"><a href="donation" marked="1">Donate</a></div></li>

				<li class="nost-nav-mobile"><a id="nost-nav-review" href="https://discord.gg/bmRdXRh" target="_blank" rel="noreferrer" marked="1"><i class="fab fa-discord"></i><span>Chat with Us</span></a><div class="nav-text"><a href="https://discord.gg/bmRdXRh" marked="1">Discord</a></div></li>

			</ul>

			<a href="javascript:return false;" class="float-nav-toggle show" marked="1"></a>

			

		</div>

		<nav class="navbar navbar-default navbar-fixed-top" id="banner">

			<div class="container-fluid">

				<!-- Brand and toggle get grouped for better mobile display -->

				<div class="navbar-header">

					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

						<span class="sr-only">Toggle navigation</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

					</button>

<!-- Real time Clock -->
<div><span style="font-family: 'Bebas';color: rgba(0,0,0,0.9);font-size: 25px;-webkit-text-stroke-width: 0.2px;-webkit-text-stroke-color: black; ">
<span id='ct' style="color:#FFFFFF" class="wow fadeIn" data-wow-delay="0.3s" ></span>
<div>
<script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date();
var x1=x.toString();// changing the display to UTC string
document.getElementById('ct').innerHTML = x1;
tt=display_c();
 }
</script>
</head>
</div>

<body onload=display_ct();>


<label id="timer"></label>

				</span> </div>

<!-- Real Time Clock END -->

 					<!-- Login Session Check -->
					 <span class="wow fadeIn" data-wow-delay="1s" style="font-family: 'Bebas';color:#AFA;font-size: 25px;-webkit-text-stroke-width: 0.5px;-webkit-text-stroke-color: black;">
					<?php if (isset($_SESSION['AccountID'] )) {
					echo "<b>Account: ";
					echo $_SESSION["AccountName"];
					}
					?></span>
					<span class="wow fadeIn" data-wow-delay="1s" style="font-family: 'Bebas';color: red;font-size: 25px;-webkit-text-stroke-width: 0.5px;-webkit-text-stroke-color: black;">
					<?php 
					if (!isset($_SESSION['AccountID'] )) {
						echo "<b>Logged off. </b>";
					}
					?></span>
					<!-- Login Session Check End -->


				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

					<ul class="nav navbar-nav hidenav" style="">

						<li class="active"><a href="#">Menu <span class="sr-only">(current)</span></a></li>

						<li><a href="#">Menu</a></li>

						<li class="dropdown">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu<span class="caret"></span></a>

							<ul class="dropdown-menu">

								<li><a href="#">Dropdown Menu 1</a></li>

								<li><a href="#">Dropdown Menu 2</a></li>

								<li><a href="#">Dropdown Menu 3</a></li>

							</ul>

						</li>

						<li><a href="#">Menu</a></li>

						<li><a href="#">Menu</a></li>

						<li><a href="#">Menu</a></li>

					</ul>

					<ul class="nav navbar-nav navbar-right">

						<li><a class="login-trigger"> Server Status: <span style="color: lightgreen;"><span class="glyphicon glyphicon-circle-arrow-up"></span></span></a></li>
		
						<?php 
						// Logged in
						if (isset($_SESSION["AccountID"])) {
							echo '<li class="nost-nav-mobile"><a id="nost-nav-market" href="login/logout" marked="1"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>';
						}
						// Activate "admin" button for account level 99s ONLY.
						if (isset($_SESSION["AccountLevelAdmin"])) {
							echo '<li class="nost-nav-mobile"><a id="nost-nav-market" href="admin/admincp" marked="1"><i class="fas fa-diagnoses"></i><span>Admin</span></a></li>';
						}
						// Activate "admin" button for account level 99s ONLY.
						if (isset($_SESSION["AccountID"])) {
							echo '<li class="nost-nav-mobile"><a id="nost-nav-market" href="accountadmin" marked="1"><i class="fas fa-user-cog"></i><span>Account Management</span></a></li>';
						}
							// Logged Out
						if (!isset($_SESSION["AccountID"])) {
							echo '<li><a class="login-trigger" href="#" data-target="#login" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
						}
						?>
						

						<li><a class="login-trigger" href="#" data-target="#create" data-toggle="modal"><span class="glyphicon glyphicon-user"></span> Register</a></li>
						
						<li class="nost-nav-mobile"><a id="nost-nav-market" href="download" marked="1"><i class="fas fa-download "></i><span>Download</span></a></li>
						</span>

					</ul> 

				</div><!-- /.navbar-collapse -->

			</div><!-- /.container-fluid -->

		</nav>
<?php  if(session_status()==PHP_SESSION_NONE) session_start();
?>
<?php if (isset($_SESSION["AccountLevelAdmin"])) {}else{
	header("Location: ../home");
exit();
} ?>
<!DOCTYPE html>
<html>
<head>
	<title>DN Origins</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel='stylesheet' type='text/css' href="/css/prettyPhoto.css" media='all' />
	<link rel="stylesheet" href="/css/custom.min.css" type="text/css" media="screen" title="" charset="utf-8" />
	<link rel="stylesheet" href="/css/duck.css" type="text/css" media="screen" title="" charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<script src="/js/slim.min.js"></script> 
	<!-- Latest compiled and minified JavaScript -->
	<script src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/e.js"></script>
	<link rel="stylesheet" href='/css/animate.css'  type='text/css' media="screen and (min-width:1200px)">
	<script type="text/javascript" src="/js/wow.min.js"></script> 

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




	<div class="floating-navigation show">

<ul class="float-nav-ul">


	<li class="nost-nav-mobile" id="floating-nav-first"><a id="nost-nav-home" href="../home" marked="1"><i class="fas fa-home active"></i><span>Home</span></a><div class="nav-text"><a href="../home" marked="1">Home</a></div></li>

	<li class="nost-nav-mobile"><a id="nost-nav-account" href="../account" marked="1"><i class="fas fa-street-view "></i><span>My Account</span></a><div class="nav-text"><a href="../account" marked="1">New Player</a></div></li>

	<li class="nost-nav-mobile"><a id="nost-nav-info" href="../info" marked="1"><i class="fas fa-info "></i><span>Info</span></a><div class="nav-text"><a href="../info" marked="1">Info</a></div></li>

	<li class="nost-nav-mobile"><a id="nost-nav-woe" href="../pvprankingboard" marked="1"><i class="fas fa-chess-king "></i><span>Ranking</span></a><div class="nav-text"><a href="../ranking" marked="1">Ranking</a></div></li>

	<li class="nost-nav-mobile"><a id="nost-nav-shop" href="../donateorigins" marked="1"><i class="fas fa-donate "></i><span>nost Points</span></a><div class="nav-text"><a href="../donateorigins" marked="1">Donate</a></div></li>

	<li class="nost-nav-mobile"><a id="nost-nav-review" href="https://discord.gg/uTWtmee" target="_blank" rel="noreferrer" marked="1"><i class="fab fa-discord"></i><span>Chat with Us</span></a><div class="nav-text"><a href="https://discord.gg/XFcyMqE" marked="1">Discord</a></div></li>

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

		<a class="navbar-brand text-center" href="#" style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><span style="font-family: 'Bebas'; font-size: 40px; color: white;-webkit-text-stroke-width: 0.5px;-webkit-text-stroke-color: black;">DN Origins</span><br><span style="font-family: 'Bebas';color: yellow;font-size: 25px;-webkit-text-stroke-width: 0.5px;-webkit-text-stroke-color: black;"><br>The Golden Experience</span><span style="color: orange;font-size: 25px;"></span></a>
		<span style="font-family: 'Bebas';color: green;font-size: 25px;-webkit-text-stroke-width: 0.5px;-webkit-text-stroke-color: black;">
		<?php if (isset($_SESSION['AccountID'] )) {
		echo "<b>Logged on as </b>";
		echo $_SESSION["AccountName"];
		echo ".";
		}
		?></span>
		<span style="font-family: 'Bebas';color: red;font-size: 25px;-webkit-text-stroke-width: 0.5px;-webkit-text-stroke-color: black;">
		<?php 
		if (!isset($_SESSION['AccountID'] )) {
			echo "<b>Logged off. </b>";
		}
		?></span>

<div><span style="font-family: 'Bebas';color: rgba(0,0,0,0.9);font-size: 25px;-webkit-text-stroke-width: 0.5px;-webkit-text-stroke-color: black; ">
<div>
<br>
<br>
<script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()
var x1=x.toUTCString();// changing the display to UTC string
document.getElementById('ct').innerHTML = x1;
tt=display_c();
 }
</script>
</head>
</div>

<body onload=display_ct();>
<span id='ct' style="color:#FFFFFF"  class = "wow fadeIn" data-wow-delay="1.5s"></span>

<label id="timer"></label>
	</span> </div>

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
				echo '<li class="nost-nav-mobile"><a id="nost-nav-market" href="../login/logout" marked="1"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>';
			}
			// Activate "admin" button for account level 99s ONLY.
			if (isset($_SESSION["AccountLevelAdmin"])) {
				echo '<li class="nost-nav-mobile"><a id="nost-nav-market" href="../admin/admincp" marked="1"><i class="fas fa-diagnoses"></i><span>Admin</span></a></li>';
			}
			// Activate "admin" button for account level 99s ONLY.
			if (isset($_SESSION["AccountID"])) {
				echo '<li class="nost-nav-mobile"><a id="nost-nav-market" href="../accountadmin" marked="1"><i class="fas fa-user-cog"></i><span>Account Management</span></a></li>';
			}
				// Logged Out
			if (!isset($_SESSION["AccountID"])) {
				echo '<li><a class="login-trigger" href="#" data-target="#login" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
			}
			?>
			
			<li class="nost-nav-mobile"><a id="nost-nav-market" href="../download" marked="1"><i class="fas fa-download "></i><span>Download</span></a></li>
			</span>

		</ul> 

	</div><!-- /.navbar-collapse -->

</div><!-- /.container-fluid -->

</nav>


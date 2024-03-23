<?php include 'header.php';?>
<?php if (isset($_SESSION["AccountLevelStandard"]) || isset($_SESSION["AccountLevelAdmin"])) {
}else{
echo "<script>location.href='home.php'</script>";
exit();
} ?>
	<div class = "container-fluid bg1" >
	<center>
	<h1 style = "margin-top:5%;">Origins Account Panel</h1>
	<div class="footer-divider"></div>

			<h2 style = 'font-size:20px;margin-bottom: 3%;'>Account Management Tools</h2>
		
			<div class="btt" style="width:30%;">
			<a href="accountpanel/passwordchange">Change Password</a><br>
			</div>
					
			<div class="btt" style="width:30%;">
			<a href="accountpanel/emailchange">Change Email</a><br>
			</div>
					
			<div class="btt" style="width:30%;">
			<a href="accountpanel/regionchange">Change In-Game Default Region</a><br>
			</div>
			
			<div class="btt" style="width:30%;">
			<a href="accountpanel/purchasehistory">Purchase History</a><br>
			</div>
			
			<div class="btt" style="width:30%;">
			<a href="accountpanel/discordlink">Link Discord Account</a><br>
			</div>


		</center>
	</div>


<style type="text/css">

.box12{
	min-height: 950px;
	background: url(../img/b.jpg) fixed no-repeat;
    background-size: cover;
    z-index: 1;
    position: relative;
    left: 0px;
    top: 0px;
}
.box12 h1{
	color: white;
	text-transform: uppercase;
	font-weight: 750;
	font-size: 25px;
	text-align: center;
	text-transform:uppercase; 
	text-shadow: 0px 0px 9px white;
	margin-top:15%;
}
.box12 h2{
	color: white;
	text-transform: uppercase;
	font-weight: 500;
	font-size: 15px;
	text-align: center;
}
	.box12 h3{
	color: white;
	text-transform: uppercase;
	font-weight: 500;
	font-size: 15px;
	text-align: center;
}
.box12 label {margin:0px;padding: 0px;color: white;text-align: left !important;text-transform: uppercase; font-size: 13px;}
</style>



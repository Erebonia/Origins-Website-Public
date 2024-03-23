<?php
if(session_status()==PHP_SESSION_NONE) session_start();
?>
<?php
	if (isset($_SESSION["AccountID"]))
	{
		if (isset($_POST["Change"]))
		{
			include('../configlogin.php');
			$conn = sqlsrv_connect($serverName, $conn_array);

			// SET POST Variables to custom params
			$myparams['discordID'] = (!empty($_POST['discordID']))?$_POST['discordID']:null;
			$myparams['username'] = $_SESSION['AccountName'];

			// The following functions are based on bootstrap classes for error and success message. If you are not using bootstrap you can stylize your own.

			$sql = "
			SET ANSI_NULLS ON
			SET QUOTED_IDENTIFIER ON
			SET CONCAT_NULL_YIELDS_NULL ON
			SET ANSI_WARNINGS ON
			SET ANSI_PADDING ON
			EXEC __MON__DiscordLink @AccountName=?,@DiscordID=?
			  
			";


			//Array for prep
			$procedure_params = array(
				array(&$myparams['username'], SQLSRV_PARAM_IN),
				array(&$myparams['discordID'], SQLSRV_PARAM_IN)

			);
				/* Prepare the statement. */
			if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
			{
				 //echo "Statement was successfully prepared.\n";
			} 
			else
			{
				 //echo "Statement could not be prepared.\n";
				 //( print_r( sqlsrv_errors(), true));
			}

			/* Execute the statement. */
			if( sqlsrv_execute($stmt))
			{
				// echo "Statement successfully executed.";
			}
			else
			{
				 // echo " Unable to execute prepared statement!\n";
				// ( print_r( sqlsrv_errors(), true));
			}

		}
	}
	else
	{
		header("Location: ../home");
		exit();
	}
?>

			<div class = "pagebg1" class="wow fadeIn" data-wow-delay="1s" style="display: flex;justify-content: center;align-items: center;" >
				<form class="box" action="" method="post" enctype="multipart/form-data" autocomplete = "off">
					
					<h1>Discord Link</h1>
				<div class="footer-divider" style="margin-top:1%"></div>
				<div class="container">

				<!-- Respond to user when they change password successfully or not -->
				<?php
				if(isset($_POST['Change']))
				{ 
					//if(!preg_match('^(.*)#[0-9]{4}$',$myparams['discordID']))
					//{ 
					//	echo ("<b><p align=center>DiscordID format is yourname#1234 ! <p></b>");
					//} 

				}
				?>
  				<?php
				error_reporting(0);
				ini_set('display_errors', 0);
				if (isset($_POST['Change']))
				{
					//if( sqlsrv_execute($stmt) && preg_match('^(.*)#[0-9]{4}$',$myparams['discordID']))
					if( sqlsrv_execute($stmt))
					{ 
						echo "<b><p align=center>Discord ID successfully updated.<p></b>";
						header("refresh:10;url=../accountadmin");
					}
				}
				?>

					<h3>Discord Username</h3>
					<input type="text" name="discordID" placeholder="Discord ID (Format name#1234)" required>
					<input type="submit" value="Change" name = "Change">
					<button data-dismiss="modal" type ="CANCEL" class="cncl">Cancel</button>
				</form>
			</div>
			</div>
			


<style type="text/css">

	.modal-content {background: transparent;}
	.box{


 min-height: 1000px;
    
	
	}
	.box h1{
		color: white;
		text-transform: uppercase;
		font-weight: 750;
		font-size: 25px;
		margin-top: 15%;
		text-align: center;
		text-transform:uppercase; 
		text-shadow: 0px 0px 9px white;
	}
	.box h2{
		color: white;
		text-transform: uppercase;
		font-weight: 500;
		font-size: 15px;
		margin-top: 1%;
		text-align: center;
	}
		.box h3{
		color: white;
		text-transform: uppercase;
		font-weight: 500;
		font-size: 15px;
		margin-top: 0%;
		text-align: center;
	}
	.box input[type = "text"],.box input[type = "password"],.box input[type = "email"]{
		border:0;
		background: rgba(0, 0, 0, 0.3);
		display: block;
		margin: 2px auto 20px;
		text-align: center;
		border: 1px solid gold;
		padding: 8px 0px;
		width: 50%;
		outline: none;
		color: white;
		transition: 0.25s;
	}
	.box input[type = "text"]:focus,.box input[type = "password"]:focus,.box input[type = "email"]:focus{

		border-color: orange;
	}
	.box input[type = "submit"]{
		border:0;
		background: rgba(0, 0, 0, 0.3);
		display: block;
		margin: 20px auto;
		text-align: center;
		border: 1px solid cyan;
		padding: 8px 10px;
		width: 50%;
		outline: none;
		color: white;
		transition: 0.25s;
		display: block;
		text-transform: uppercase;
	}
	.box input[type = "submit"]:hover{
		background: rgba(0, 0, 0, 0.7);
		color: black;
	}
	
	.cncl {
		border:0;
		background: rgba(0, 0, 0, 0.1);
		display: block;
		margin: 20px auto 0;
		text-align: center;
		text-transform: uppercase;
		padding: 10px 10px;
		width: 50%;
		outline: none;
		color: grey;
		transition: 0.25s;
		display: block;
		border: 1px solid grey;
	}
	.cncl:hover {
		background: rgba(0, 0, 0, 0.7);
		color: black;}
	.box label {margin:0px;padding: 0px;color: white;text-align: left !important;text-transform: uppercase; font-size: 13px;}
</style>


</body>
</html>

<?php include('headersub.php'); ?>
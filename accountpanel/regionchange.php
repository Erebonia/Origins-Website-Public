<?php  if(session_status()==PHP_SESSION_NONE) session_start();
$Region = $_SESSION['AccountRegionID'];
?>
<?php include('headersub.php'); ?>

<?php 
if (isset($_SESSION["AccountID"])) {
if (isset($_POST["Change"])) {

include('../configlogin.php');
$conn = sqlsrv_connect($serverName, $conn_array);

// SET POST Variables to custom params
$myparams['AccountRegion'] = (!empty($_POST['region']))?$_POST['region']:null;
$myparams['username'] = $_SESSION['AccountName'];

//Used for updating the Session Variable

$RegionUpdated = $_POST['region'];


// The following functions are based on bootstrap classes for error and success message. If you are not using bootstrap you can stylize your own.

  $sql = "USE DNMembership
  UPDATE Accounts
  SET AccountRegionID = ?
  Where AccountName = ?;
  ";


//Array for prep
$procedure_params = array(
    array(&$myparams['AccountRegion'], SQLSRV_PARAM_IN),
    array(&$myparams['username'], SQLSRV_PARAM_IN)

);
	/* Prepare the statement. */
if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
{
   //  echo "Statement was successfully prepared.\n";
} 
else
{
    // echo "Statement could not be prepared.\n";
    // ( print_r( sqlsrv_errors(), true));
}

/* Execute the statement. */
if( sqlsrv_execute($stmt))
{
	// echo "Statement successfully executed.";
}
else
{
    //  echo " Unable to execute prepared statement!\n";
    // ( print_r( sqlsrv_errors(), true));
}

}

}else{
	header("Location: ../home");
exit();
}

?>

			<div class = "pagebg1" class="wow fadeIn" data-wow-delay="1s" style="display: flex;justify-content: center;align-items: center;" >
				<form class="box" action="" method="post" enctype="multipart/form-data" autocomplete = "off">
					
					<h1>Region Selector</h1>
                    <center><b><p>This is only utilized when you are playing solo and the default value when creating a party.</p></b><center>
				<div class="footer-divider" style="margin-top:1%"></div>
				<div class="container">

				<!-- Respond to user when they change password successfully or not -->
                  <?php error_reporting(0);ini_set('display_errors', 0); 
                  if( sqlsrv_execute($stmt)) { echo "<b><p align=center>Region successfully updated for all game solo instances. Website will fully reflect information on next login. <p></b>";
                  header("refresh:10;url=../accountadmin"); } ?>

					<h2>Current Region</h2>
                    <input readonly = "readonly" style="background: rgba(0,0,0,0.3); color:green; font-weight:bold;" value="<?PHP 
                    //After Update
                    if( sqlsrv_execute($stmt)&& $RegionUpdated == 1){echo 'Europe | ID: '.$RegionUpdated.'';}
                    if( sqlsrv_execute($stmt) && $RegionUpdated == 2){echo 'North America West | ID: '.$RegionUpdated.'';}
					if( sqlsrv_execute($stmt) && $RegionUpdated == 3){echo 'North America East | ID: '.$RegionUpdated.'';}
                    if( sqlsrv_execute($stmt) && $RegionUpdated == 4){echo 'South East Asia | ID: '.$RegionUpdated.'';}
					if( sqlsrv_execute($stmt) && $RegionUpdated == 5){echo 'South America | ID: '.$RegionUpdated.'';}
					if( sqlsrv_execute($stmt) && $RegionUpdated == 6){echo 'Hong Kong | ID: '.$RegionUpdated.'';}
                    //Before Update
                    if( !sqlsrv_execute($stmt)&& $Region == 1){echo 'Europe | ID: '.$Region.'';}
                    if( !sqlsrv_execute($stmt) && $Region == 2){echo 'North America West | ID: '.$Region.'';}
					if( !sqlsrv_execute($stmt) && $Region == 3){echo 'North America East | ID: '.$Region.'';}
                    if( !sqlsrv_execute($stmt) && $Region == 4){echo 'South East Asia | ID: '.$Region.'';}
					if( !sqlsrv_execute($stmt) && $Region == 5){echo 'South America | ID: '.$Region.'';}
					if( !sqlsrv_execute($stmt) && $Region == 6){echo 'Hong Kong | ID: '.$Region.'';}
                    ?>" 

                    type="text" maxlength="20" name="username" placeholder="Account Name (20 characters maximum)" required> 

					<h3>Update Region</h3>
					<Select type = "region" name = "region" required>
					<option value = "1">Europe (EU)</option>
					<option value = "2">North America West (NA-West)</option>
					<option value = "3">North America East (NA-East)</option>
					<option value = "4">South East Asia (SEA)</option>
					<option value = "5">South America (SA)</option>
					<option value = "6">Hong Kong (HK)</option>
					</select> 
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
	.box input[type = "text"],.box input[type = "password"],.box input[type = "email"],.box select[type = "region"]{
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
	.box input[type = "text"]:focus,.box input[type = "password"]:focus,.box input[type = "email"]:focus,.box select[type = "region"]:focus{

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


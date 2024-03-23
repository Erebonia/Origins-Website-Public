<?php  if(session_status()==PHP_SESSION_NONE) session_start();
?>

<?php ?>

<?php 
if (isset($_SESSION["AccountLevelAdmin"])) {

if (isset($_POST["ban"])) {

include('../configlogin.php');
$conn = sqlsrv_connect($serverName, $conn_array);

// SET POST Variables to custom params
$myparams['accountname'] = $_POST['accountname'];
$myparams['bantitle'] = $_POST['bantitle'];
$myparams['banreason'] = $_POST['banreason'];
$myparams['banExpirationDate'] = $_POST['banExpirationDate'];
$myparams['titleExpirationDate'] = $_POST['titleExpirationDate'];
$AccountBanned = $_POST['accountname'];

// The following functions are based on bootstrap classes for error and success message. If you are not using bootstrap you can stylize your own.

  $sql = "USE DNMembership
  SET IDENTITY_INSERT Restraints ON
  Insert into dbo.Restraints (RestraintID, RestraintTargetCode, RestraintTypeCode, AccountID, CharacterID, AdminID, RestraintReasonID, Memo, RestraintMessage, StartDate, EndDate, RegisterDate, CancelFlag)
  Values ((Select ISNULL(max(RestraintID)+1, 1) from dbo.Restraints), 
                 1,
                 3,
                 ?, 
                 NULL,
                 0,
                 5,
                 ?, 
                 ?, 
                 GetDate(), 
                 ?, 
                 GetDate(), 
                 0 
                 );
  SET IDENTITY_INSERT Restraints OFF
  ";


//Array for prep
$procedure_params = array(
    array(&$myparams['accountname'], SQLSRV_PARAM_IN),
    array(&$myparams['bantitle'], SQLSRV_PARAM_IN),
    array(&$myparams['banreason'], SQLSRV_PARAM_IN),
	array(&$myparams['banExpirationDate'], SQLSRV_PARAM_IN)

);
	/* Prepare the statement. */
if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
{
    // echo "Statement was successfully prepared.\n";
} 
else
{
   //  echo "Statement could not be prepared.\n";
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
					
					<h1>Ban An Account</h1>
				<div class="footer-divider" style="margin-top:1%"></div>
				<div class="container">

				<!-- Ban Response -->
  				<?php error_reporting(0);ini_set('display_errors', 0); if( sqlsrv_execute($stmt)) { echo '<span style="color:#AFA;"><center>Account ID: '.$AccountBanned.' has been banned.</span>';header("refresh:30;url=../admin/admincp"); } ?>

					<h3 style="margin-top:2%;">Account ID</h3>
					<input type="number" name="accountname" placeholder="Enter a valid account ID" required>

					<h3>Ban Topic</h3>
					<input type="text"  name="bantitle" placeholder="Enter the category for the offense." required>

                    <h3>Ban Description</h3>
					<input type="text"  name="banreason" placeholder="Full description of ban details." required>
					
					<h3>Expiration Date</h3>
                    <input type="datetime-local" name="banExpirationDate" placeholder="When the ban ends" required>

					<h3>Abuser Title Duration</h3>
                    <input type="number" name="titleExpirationDate" placeholder="Duration in days" list="titleExpirationDateCombo" required>
                    <datalist id="titleExpirationDateCombo">
                        <option>1</option>
                        <option>7</option>
                        <option>14</option>
                        <option>30</option>
                    </datalist>

					<input type="submit" value="ban" name = "ban">
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
	.box input[type = "text"],.box input[type = "password"],.box input[type = "text"],.box input[type = "number"]{
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
    .box input[type = "datetime-local"]{
		border:0;
		background: rgba(255, 255, 255, 1);
		display: block;
		margin: 2px auto 20px;
		text-align: center;
		border: 1px solid gold;
		padding: 8px 0px;
		width: 50%;
		outline: none;
		color: black;
		transition: 0.25s;
	}
	.box input[type = "text"]:focus,.box input[type = "password"]:focus,.box input[type = "text"]:focus,.box input[type = "number"]:focus,.box input[type = "datetime-local"]:focus{

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
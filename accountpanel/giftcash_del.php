<?php  if(session_status()==PHP_SESSION_NONE) session_start();
$AccountNameDisplay = $_SESSION['AccountName'];
?>

<?php ?>

<?php 
if (isset($_SESSION["AccountID"])) {

if (isset($_POST["Send"])) {

include('../configlogin.php');
$conn = sqlsrv_connect($serverName, $conn_array);

// SET POST Variables to custom params
$myparams['accountnameuser'] =  $_POST['accountnameuser'];
$myparams['origincash'] = $_POST['origincash'];
$myparams['ReceiverAccountName'] = $_POST['ReceiverAccountName'];
$CashAmount = $myparams['origincash'];
$ReceiverAccountName = $myparams['ReceiverAccountName'];


// The following functions are based on bootstrap classes for error and success message. If you are not using bootstrap you can stylize your own.

$sql = "
SET ANSI_NULLS ON
SET QUOTED_IDENTIFIER ON
SET CONCAT_NULL_YIELDS_NULL ON
SET ANSI_WARNINGS ON
SET ANSI_PADDING ON
USE DNMembership

DECLARE 
@intCashBalance int , 
@inbCashIncomeAmount bigint = 0, 
@inbCashOutgoAmount bigint = 0,
@intAccountID int = 0, 
@nvcAccountName nvarchar(50) = ?, 
@ReceiverAccountName nvarchar(50) = ?, 
@Success VARCHAR ( 300 ) = 'Successfully Executed', 
@Failure VARCHAR ( 300 ) = 'Not enough cash on the account or invalid username!', 
@intCashAmount1 INT = ?,
@inyOldPublisher tinyint = 0 ,
@bitExist bit = 1
 
-- Verify account name! (Case sensitive)
SET @ReceiverAccountName = @ReceiverAccountName + CASE WHEN @inyOldPublisher = 1 THEN N'@nx' ELSE N'' END

IF EXISTS (
   SELECT *
   FROM dbo.Accounts WITH (NOLOCK, INDEX(IX_UN_Accounts_AccountName), FORCESEEK)
   WHERE AccountName = @ReceiverAccountName
)
   SET @bitExist = 1

ELSE
   SET @bitExist = 0

-- Combine all cash amounts for final balance.
IF @intAccountID <= 0 OR @intAccountID IS NULL
SELECT @intAccountID = AccountID
FROM dbo.Accounts WITH (NOLOCK, INDEX(IX_UN_Accounts_AccountName), FORCESEEK)
WHERE AccountName = @nvcAccountName
OPTION (KEEPFIXED PLAN)

SELECT @inbCashIncomeAmount = CashAmount
FROM dbo.VIX_CashIncomeTotals WITH (NOLOCK)
WHERE AccountID = @intAccountID

SELECT @inbCashOutgoAmount = CashAmount
FROM dbo.VIX_CashOutgoTotals WITH (NOLOCK)
WHERE AccountID = @intAccountID

-- Player's Total balance
SET @intCashBalance = @inbCashIncomeAmount - @inbCashOutgoAmount

-- The Check and execute
	IF (@intCashBalance > @intCashAmount1 and @bitExist = 1 and @intCashAmount1 >= 1000)
	BEGIN
	EXEC ALT_ReduceCash @nvcAccountName = ?,@intCashAmount = ? --HERE
	EXEC __DRD_CASH_ADD_ @AccountName = ?,@intCashAmount = ? --HERE
	PRINT @Success 
	END ELSE PRINT @Failure
";


//Array for prep
$procedure_params = array(
	array(&$myparams['accountnameuser'], SQLSRV_PARAM_IN),
	array(&$myparams['ReceiverAccountName'], SQLSRV_PARAM_IN),
	array(&$myparams['origincash'], SQLSRV_PARAM_IN),
	array(&$myparams['accountnameuser'], SQLSRV_PARAM_IN),
	array(&$myparams['origincash'], SQLSRV_PARAM_IN),
	array(&$myparams['ReceiverAccountName'], SQLSRV_PARAM_IN),
	array(&$myparams['origincash'], SQLSRV_PARAM_IN)

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
    // echo " Unable to execute prepared statement!\n";
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
					
					<h1>Gift Origin Cash</h1>
					<h3>Gift another player origin cash through this panel.</h3>
				<div class="footer-divider" style="margin-top:1%"></div>
				<div class="container">
				<!-- Panel Response -->
				<?php echo '<span style="color:yellow;"><center>Note: You must have at least 1000 origin cash to use this panel.</span>'; ?>
				  <?php error_reporting(0);ini_set('display_errors', 0); if( $_POST["Send"]) { echo '<span style="color:#AFA;"><center>Gift action initiated: '.$ReceiverAccountName.' for '.$CashAmount.' origin cash.</span>'; 
											 echo '<span style="color:yellow;"><center>Note: If you do not have enough balance or invalid username the transaction will automatically be declined!</span>'; }?>

					<h3 style="margin-top:2%;">Sender Account Name</h3>
					<input readonly = "readonly" type="text" name="accountnameuser" style="background: rgba(0,0,0,0.3); color:#AFA; font-weight:bold;" value="<?PHP echo $AccountNameDisplay; ?>" required>

					<h3 style="margin-top:2%;">Receiver Account Name</h3>
					<input type="text" name="ReceiverAccountName" placeholder="Use the exact account name!" required>

					<h3>Cash Amount</h3>
					<input type="number" name="origincash" placeholder="Enter desired amount to send" required>

					<input type="submit" value="Send" name = "Send">
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
	.box input[type = "text"]:focus,.box input[type = "password"]:focus,.box input[type = "text"]:focus,.box input[type = "number"]:focus{

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
<?php if(session_status()==PHP_SESSION_NONE) session_start();?>
<?php
//Intiialize DB Connection
include('../configlogin.php');

$conn = sqlsrv_connect($serverName, $conn_array);

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`!!!!!
$enableSandbox = true;

//$OriginEmail = "seller@paypalsandbox.com";
$OriginEmail = "";
	
/* This should redirect the person if they made a GET request instead of a POST request. 
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
header('Location: wEdIDNoTSLePT.php'); 
exit();
} */
	
/* Behold Paypal's magic API, also DO NOT USE THE WWW. VERSION! */
$ch = curl_init($enableSandbox ? 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr' : 'https://ipnpb.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_STDERR, fopen("curl_debug.txt", "w+")); // debugging
curl_setopt($ch, CURLOPT_VERBOSE, 1); // debugging
curl_setopt($ch, CURLOPT_CAINFO, 'cacert.pem'); //C:\xampp\htdocs\donate\cacert.pem
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // COMMENT/CHANGE NUMBER IF YOU WANT TO EDIT A CONNECTION TIMEOUT (default set to 30s).
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
curl_setopt($ch, CURLOPT_POSTFIELDS, "cmd=_notify-validate&" . http_build_query($_POST));
$response = curl_exec($ch);
curl_close($ch);

if (strcmp ($response, "VERIFIED") == 0) {

	/* Information Currently Utilized in Database */
	$txn_id = $_POST['txn_id']; 
	$receiver_email = $_POST['receiver_email']; 
	$payer_email = $_POST['payer_email']; 
	$memo = $_POST['memo'];

	/* Other Post Variables */
	$item_name = $_POST['item_name']; 
	$item_number = $_POST['item_number']; 
	$payment_status = $_POST['payment_status']; 
	if ($_POST['mc_gross'] != NULL)
		$payment_amount = $_POST['mc_gross']; // Important
	else
		$payment_amount = $_POST['mc_gross1']; 
	$payment_currency = $_POST['mc_currency']; 
	$AccountName = $_POST['custom'];


		
// Set $ to Game Currency ratio. In this case $1 = 10,000!
$payment_amount *= 10000;

if($payment_status == 'Completed') {

$handle = fopen("LegitTransactionCheck.txt", "w");
$txt = "Valid Credentials & Payment Status Completed...";
fwrite($handle, $txt);
fclose($handle);	

if (!$conn) {
	$handle = fopen("DatabaseCheck.txt", "w");
	$txt = "Failed to open db...";
	fwrite($handle, $txt);
	fclose($handle); } else {
		$handle = fopen("DatabaseCheck.txt", "w");
		$txt = "Database Connection was a success.";
		fwrite($handle, $txt);
		fclose($handle); }
				
/* Add in game currency query. */
$sql = "SET ANSI_NULLS ON
SET QUOTED_IDENTIFIER ON
SET CONCAT_NULL_YIELDS_NULL ON
SET ANSI_WARNINGS ON
SET ANSI_PADDING ON
EXEC __MON__FounderApply_ @AccountName = ?, @FounderPackID = ?
";
					
$myparams['username'] = $AccountName;
$myparams['founderpackid'] = $_POST['name'];
echo $myparams['founderpackid'];

//Array for prep
$procedure_params = array(
array(&$myparams['username'], SQLSRV_PARAM_IN),
array(&$myparams['founderpackid'], SQLSRV_PARAM_IN)
); 

/* Prepare the statement. */
if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
{
     // echo "Statement was successfully prepared.\n";
} 
else
{
     // echo "Statement could not be prepared.\n";
}

/* Execute the statement. */
if( sqlsrv_execute($stmt))
{
	// echo " Statement executed.\n";
}
else
{
      //echo " Unable to execute prepared statement!\n";
     // echo ( print_r( sqlsrv_errors(), true));
}
				
/* Transaction Check Query */
$sql2 = "SELECT * FROM [dbo].[Transactions] WHERE TransactionID = ?
";

// Set Params
$myparams['TransactionID'] = $txn_id;
$myparams['paymentamount'] = $payment_amount;

//Array for prep
$procedure_params2 = array(
array(&$myparams['TransactionID'], SQLSRV_PARAM_IN),
array(&$myparams['TransactionID'], SQLSRV_PARAM_IN)
);

$stmt2 = sqlsrv_prepare( $conn, $sql2, $procedure_params2);
sqlsrv_execute($stmt2);
$transactioncheck = sqlsrv_fetch_array($stmt2);

if (!$transactioncheck) {
	$handle = fopen("Records.txt", "w");
	$txt = "No Record found, Success!";
	fwrite($handle, $txt);
	fclose($handle); 
} else {
	$handle = fopen("Records.txt", "w");
	$txt = "This transaction ID already exists within the database.";
	fwrite($handle, $txt);
	fclose($handle);
}


}
}

if (strcmp ($response, "INVALID") == 0) {
// HACKER? BAN ACCOUNT! EZ GG NO RE!!!!!!
file_put_contents("VERIFIEDCHECK.txt", $response);
} else {
file_put_contents("VERIFIEDCHECK.txt", $response);
}

?>

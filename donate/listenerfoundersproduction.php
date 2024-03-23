<?php if(session_status()==PHP_SESSION_NONE) session_start();?>
<?php
//Intiialize DB Connection
include('../configlogin.php');
$conn = sqlsrv_connect($serverName, $conn_array);

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`!!!!!
$enableSandbox = false;

//$OriginEmail = "seller@paypalsandbox.com";
$OriginEmail = "";
	
/* This should redirect the person if they made a GET request instead of a POST request. */
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
header('Location: wEdIDNoTSLePT.php'); 
exit();
} 
	
/* Behold Paypal's magic API, also DO NOT USE THE WWW. VERSION! */
$ch = curl_init($enableSandbox ? 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr' : 'https://ipnpb.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_STDERR, fopen("curl_debug.txt", "w+")); // debugging
curl_setopt($ch, CURLOPT_VERBOSE, 1); // debugging
curl_setopt($ch, CURLOPT_CAINFO, 'cacert.pem');
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

$founders_ID = 4;

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

if ($payment_amount >= 10 and $payment_amount < 30)
	{
		$founders_ID = 1;
	}else if ($payment_amount >= 30 and $payment_amount < 50) {
		$founders_ID = 2;
	}else if ($payment_amount >= 50) {
		$founders_ID = 3;
	}
		
// Set $ to Game Currency ratio. In this case $1 = 10,000!
$payment_amount *= 2000; // 2000

if($payment_status == 'Completed') {

$handle = fopen("LegitTransactionCheck.txt", "w");
$txt = "Valid Credentials & Payment Status Completed...";
fwrite($handle, $txt);
fclose($handle);	

if (!$conn) {
	$handle = fopen("DatabaseCheck.txt", "w");
	$txt = "Failed to open db...";
	fwrite($handle, $txt);
	fclose($handle); 
	} else {
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
EXEC __DRD_CASH_ADD_ @AccountName = ?, @intCashAmount = ?
";
					
$myparams['username'] = $AccountName;
$myparams['paymentamount'] = $payment_amount;
$myparams['TransactionID'] = $txn_id;
$myparams['foundersid'] = $founders_ID;
$myparams['payeremail'] = $payer_email;

$procedure_params = array(
array(&$myparams['username'], SQLSRV_PARAM_IN),
array(&$myparams['paymentamount'], SQLSRV_PARAM_IN)
); 

$stmt = sqlsrv_prepare( $conn, $sql, $procedure_params);
sqlsrv_execute($stmt);

/* Transaction CHECKER */
$sql4 = "SET ANSI_NULLS ON
SET QUOTED_IDENTIFIER ON
SET CONCAT_NULL_YIELDS_NULL ON
SET ANSI_WARNINGS ON
SET ANSI_PADDING ON
select TransactionID  from dbo.Transactions where transactionid = ?
";

$procedure_params4 = array(
array(&$myparams['TransactionID'], SQLSRV_PARAM_IN)
);

$stmt3 = sqlsrv_prepare($conn, $sql4, $procedure_params4);
sqlsrv_execute($stmt4);
$transactioncheck = sqlsrv_fetch_array($stmt4); 
				
/* Add transaction to database */ 
$sql2 = "SET ANSI_NULLS ON
SET QUOTED_IDENTIFIER ON
SET CONCAT_NULL_YIELDS_NULL ON
SET ANSI_WARNINGS ON
SET ANSI_PADDING ON
EXEC ALT_TRANSACTION_ADD @AccountName = ?, @PaymentAmount = ?, @TransactionID = ?, @PayerEmail = ?
";

$procedure_params2 = array(
array(&$myparams['username'], SQLSRV_PARAM_IN),
array(&$myparams['paymentamount'], SQLSRV_PARAM_IN),
array(&$myparams['TransactionID'], SQLSRV_PARAM_IN),
array(&$myparams['payeremail'], SQLSRV_PARAM_IN)
);

$stmt2 = sqlsrv_prepare( $conn, $sql2, $procedure_params2);
sqlsrv_execute($stmt2);

/* Add Founder Packs */
$sql3 = "SET ANSI_NULLS ON
SET QUOTED_IDENTIFIER ON
SET CONCAT_NULL_YIELDS_NULL ON
SET ANSI_WARNINGS ON
SET ANSI_PADDING ON
EXEC ALT_FOUNDERPACK_ADD @AccountName = ?, @FounderID = ?, @TransactionID = ?
";

$procedure_params3 = array(
array(&$myparams['username'], SQLSRV_PARAM_IN),
array(&$myparams['foundersid'], SQLSRV_PARAM_IN),
array(&$myparams['TransactionID'], SQLSRV_PARAM_IN)
);

$stmt3 = sqlsrv_prepare($conn, $sql3, $procedure_params3);
sqlsrv_execute($stmt3);

//Document transaction in local files.
if (!$transactioncheck) {
	$handle = fopen("Records.txt", "w");
	$txt = "No Record found, Success! YAY ";
	fwrite($handle, $txt);
	fclose($handle); 
} else {
	$handle = fopen("TransactionChecker.txt", "w");
	$txt = "This transaction ID already exists within the database. Account Name: " + $AccountName + "Transaction ID: " + $txn_id;
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
<?php error_reporting(0);ini_set('display_errors', 0); ?>
<?php if(session_status()==PHP_SESSION_NONE) session_start(); ?>
<?php

if (isset($_POST["Login"])) {
include('../configlogin.php');
$conn = sqlsrv_connect($serverName, $conn_array);
if (!$conn)
{
	//echo "failed w";
	//( print_r( sqlsrv_errors(), true));
}

  $myparams['username'] = $_POST['username'];
  $myparams['password'] = $_POST['password'];

$hashDB = "test";
	  // All checks done already (including password check). Begin building prepare statement.
    $sql = "SET ANSI_NULLS ON
    SET QUOTED_IDENTIFIER ON
    SET CONCAT_NULL_YIELDS_NULL ON
    SET ANSI_WARNINGS ON
    SET ANSI_PADDING ON
    exec __MON__newLogin @username=?,@passwordHash=?
    
    ";

//Array for prep
$procedure_params = array(
	array(&$myparams['username'], SQLSRV_PARAM_IN),
	array(&$hashDB, SQLSRV_PARAM_OUT)

);

/* Prepare the statement. */
if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
{
     // echo "Statement was successfully prepared.\n";
} 
else
{
     // echo "Statement could not be prepared.\n";
     // ( print_r( sqlsrv_errors(), true)); ACTIVATE ONLY FOR DEBUGGING TO PREVENT HELPING SQL INJECTORS
}

/* Execute the statement. */
if( sqlsrv_execute($stmt))
{
	 // echo " Statement executed.\n";
}
else
{
      echo " Unable to execute prepared statement!\n";
     // ( print_r( sqlsrv_errors(), true));
}

//checkuser
$result = sqlsrv_fetch_array($stmt);

if (password_verify($myparams['password'], $hashDB)) {
    $LoginResult = 1;
} else {
    $LoginResult = 2;
}

//Login Success
if ($LoginResult == 1)
{
	echo "Login Successful.";
	echo "</br>";  
	echo " Login Result: ".$result[0]."\n";
	echo "</br>"; 

$procedure_params2 = array(
	array(&$myparams['username'], SQLSRV_PARAM_IN),
	array(&$myparams['accountname'], SQLSRV_PARAM_IN) //irrelevant
);

$sql2 = "SELECT AccountID, AccountName, AccountLevelCode, Email, AccountRegionID FROM Accounts WHERE AccountName=?

";

$stmt2 = sqlsrv_prepare( $conn, $sql2, $procedure_params2);
sqlsrv_execute($stmt2);


	// Set Account ID and Name
	$info=sqlsrv_fetch_array($stmt2);
	$AccountID=$info[0];
	$AccountName=$info[1];
	$AccountLevelCode=$info[2];
	$Email=$info[3];
	$AccountRegionID=$info[4];

	//Setting Session
	$_SESSION['AccountID']=$AccountID;
	echo "Account ID: $AccountID";
	echo "</br>"; 

	$_SESSION['AccountName']=$AccountName;
	echo " Account Name: $AccountName";
	echo "</br>"; 
	
	$_SESSION['AccountLevelCode']=$AccountLevelCode;

	$_SESSION['Email']=$Email;

	$_SESSION['AccountRegionID']=$AccountRegionID;

	if ($AccountLevelCode == 99){
		$_SESSION["AccountLevelAdmin"] = true; 
		//echo " Account Level Code: $AccountLevelCode";
		//echo "</br>"; 
		header("Location: ../home");
	}else{
		$_SESSION["AccountLevelStandard"] = true; 
		//echo " Account Standard Level Code: $AccountLevelCode";
		//echo "</br>";
		header("Location: ../home"); 
	}

	
}

if ($LoginResult == 2) 
{
	echo "Login unsuccessful, please try your credentials again.";
	echo "</br>";  
	echo " Login Result: ".$result[0]."\n";
	header("Location: ../failed");
}

}

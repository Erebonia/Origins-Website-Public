<?php  if(session_status()==PHP_SESSION_NONE) session_start();?>
<?php include 'headersub.php';?>
<?php if (isset($_SESSION["AccountLevelAdmin"])) {}else{
	header("Location: ../home");
exit();
} ?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="accountidentifyresultstyle.php"/>
    <link rel="stylesheet" href='../css/animate.css'  type='text/css' media="screen and (min-width:1200px)">
<style>
</style>
</head>
<body>

<div class="container-fluid bgcustom"> 
<div class="main-banner-text" >
<h1  style = "margin-top:5%" >Account Identification Results</h1>
</div>
<hr class="featurette-divider" style="width: 70%;">

<table>
<?php
if (isset($_SESSION["AccountLevelAdmin"])) {
/* Link DB */
include_once '../configlogin.php';

/* Initialize Connection */
$conn=sqlsrv_connect($serverName, $conn_array);
if ($conn){
}else{
    die; 
}

/* Prepare Statement Preparation */
$sql = "
Select A.AccountID, A.AccountName, CharacterID, C.CharacterName, Email, LastLoginIP, convert(varchar(25), RegisterDate, 120) as RegisterDate
From Accounts as A
INNER JOIN Characters AS C
ON A.AccountID = C.AccountID and CharacterName is NOT NULL
Where AccountName = ?
";

/* Assign Parameter values. */
$myparams['accountname'] = $_POST['accountname'];

// Array requirement for prepare statement.
$procedure_params = array(
    array(&$myparams['accountname'], SQLSRV_PARAM_IN)
);

$stmt = sqlsrv_prepare( $conn, $sql, $procedure_params);

sqlsrv_execute( $stmt);


echo

'
<tr>
<th>Account ID</th>
<th>Account Name</th>
<th>Character ID</th>
<th>Character</th>
<th>Email</th>
<th>IP Address</th>
<th>Registration Date</th> 
</tr>';

/* ID # to increment itself. I.E 1,2,3,4,5,6 etc.. */
while ($rows=sqlsrv_fetch_array($stmt))
{
echo 
'
<tr id=io>
<td> '.$rows[0].' </td> 
<b> <td> <a style = "color:#AFA;" href="accountprofile"> '.$rows[1].' </a> </td> </b> 
<td> '.$rows[2].' </td>
<b> <td> <a style = "color:#AFA;" href="accountprofile"> '.$rows[3].' </a> </td> </b> 
<td> '.$rows[4].' </td>
<td> '.$rows[5].' </td>
<td> '.$rows[6].' </td>
</tr>
';  
}

}
 ?>
</div>



</table>
</body>
</html>
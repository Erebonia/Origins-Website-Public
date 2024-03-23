<?php session_start(); ?>
<?php
$myServer = "10.6.11.11,1433";
$myUser = "DragonNest";
$myPass = "skQmsgozj!*sha";
$DBDNMembership = "DNMembership";

$name = $_POST['username'];
$pass = $_POST['password'];

$str_len1 = strlen($name);
$str_len2 = strlen($pass);

if ($str_len1 <= 0){
echo "<div style='color:#f00;font-family:黑体;'> User name is empty </div>";
exit();}

if ($str_len2 <= 0){
echo "<div style='color:#f00;font-family:黑体;'> Password is empty </div>";
exit();}

if (!preg_match("#^[a-z0-9]+$#i", $name)){
echo "<div style='color:#f00;font-family:黑体;'> User names are letters and numbers </div>";
exit();}

if ($str_len1 > 20){
echo "<div style='color:#f00;font-family:黑体;'> Too long </div>";
exit();}

$s = @mssql_connect( $myServer, $myUser, $myPass ) or die ("<div style='color:#f00;font-family:黑体;'>Unable to connect to database</div>");
@mssql_select_db($DBDNMembership, $s) or die ("<div style='color:#f00;font-family:黑体;'>Unable to open database</div>");

//checkuser
$result = mssql_query("exec DN_Login2 N'$name',N'$pass'");
$info=mssql_fetch_array($result);
$LoginResult=$info[LoginResult];/////////LoginResult

if ($LoginResult==1){

	$result = mssql_query("SELECT AccountID FROM Accounts WHERE AccountName='$name'");
	
	$exist = mssql_num_rows($result);
	if($exist <= 0){
	echo "<div  style='color:#f00;font-family:黑体;'> Please create a role first </div>"; 
	exit();}
	
	$info=mssql_fetch_array($result);
	$AccountID=$info[AccountID];/////////AccountID
	mssql_close();
	
	$_SESSION['AccountID']=$AccountID;
	echo "$AccountID";
exit();}

if ($LoginResult==5){
echo "<div style='color:#f00;font-family:黑体;'> wrong user name or password </div>";
exit();}

echo "<div style='color:#f00;font-family:黑体;'> Unknown error </div>";
?>
<?php  if(session_status()==PHP_SESSION_NONE) session_start();
?>
<?php if (isset($_SESSION["AccountLevelAdmin"])) {}else{
	header("Location: ../home");
exit();
} ?>
<?php include 'headersub.php';?>
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
<h1  style = "margin-top:5%" >Character Identification Results</h1>
</div>
<hr class="featurette-divider" style="width: 70%;">

<table>
<?php
/* Link DB */
include_once '../config.php';

/* Initialize Connection */
$conn=sqlsrv_connect($serverName, $conn_array);
if ($conn){
}else{
    die; 
}

/* Prepare Statement Preparation */
$sql = "
Select C.AccountID, C.AccountName, C.CharacterID, C.CharacterName, Case Jobcode
     WHEN '1' THEN  'WARRIOR'
     WHEN '2' THEN  'ARCHER'
     WHEN '3' THEN  'SOCERESS'
     WHEN '4' THEN  'CLERIC'
     WHEN '5' THEN  'ACADEMIC'
     WHEN '6' THEN  'KALI'
     WHEN '7' THEN  'ASSASSIN'
     WHEN '8' THEN  'PLACEHOLDER'
     WHEN '9' THEN  'PLACEHOLDER'
     WHEN '10' THEN  'ANCESTOR'
     WHEN '11' THEN  'SWORDMASTER'
     WHEN '12' THEN  'MERCENARY'
     WHEN '14' THEN  'SHARPSHOOTER'
     WHEN '15' THEN  'ACROBAT'
     WHEN '17' THEN  'ELEMENTALIST'
     WHEN '18' THEN  'MYSTIC'
     WHEN '19' THEN  'WARLOCK'
     WHEN '20' THEN  'PALADIN'
     WHEN '21' THEN  'MONK'
     WHEN '22' THEN  'PRIEST'
     WHEN '23' THEN  'GLADIATOR'
     WHEN '24' THEN  'MOONLORD'
     WHEN '25' THEN  'BARBARIAN'
     WHEN '26' THEN  'DESTROYER'
     WHEN '29' THEN  'SNIPER'
     WHEN '30' THEN  'ARTILLERY'
     WHEN '31' THEN  'TEMPEST'
     WHEN '32' THEN  'WINDWALKER'
     WHEN '35' THEN  'SALEANA'
     WHEN '36' THEN  'ELESTRA'
     WHEN '37' THEN  'SMASHER'
     WHEN '38' THEN  'MAJESTY'
     WHEN '41' THEN  'GUARDIAN'
     WHEN '42' THEN  'CRUSADER'
     WHEN '43' THEN  'SAINT'
     WHEN '44' THEN  'INQUISITOR'
     WHEN '45' THEN  'EXORCIST'
     WHEN '46' THEN  'ENGINEER'
     WHEN '47' THEN  'SHOOTING STAR'
     WHEN '48' THEN  'GEAR MASTER'
     WHEN '49' THEN  'ALCHEMIST'
     WHEN '50' THEN  'ADEPT'
     WHEN '51' THEN  'PHYSICIAN'
     WHEN '54' THEN  'SCREAMER'
     WHEN '55' THEN  'DARK SUMMONER'
     WHEN '56' THEN  'SOUL EATER'
     WHEN '57' THEN  'DANCER'
     WHEN '58' THEN  'BLADE DANCER'
     WHEN '59' THEN  'SPIRIT DANCER'
     WHEN '62' THEN  'CHASER'
     WHEN '63' THEN  'REAPER'
     WHEN '64' THEN  'RAVEN'
     WHEN '65' THEN  'PLACEHOLDER'
     WHEN '66' THEN  'PLACEHOLDER'
     WHEN '67' THEN  'BRINGER'
     WHEN '68' THEN  'LIGHT FURY'
     WHEN '69' THEN  'ABYSS WALKER'
     WHEN '72' THEN  'PIERCER'
     WHEN '73' THEN  'FLURRY'
     WHEN '74' THEN  'STINGBREEZER'
     WHEN '75' THEN  'AVENGER'
     WHEN '76' THEN  'DARK AVENGER'
     WHEN '77' THEN  'PATRONA'
     WHEN '78' THEN  'DEFENSIO'
     WHEN '79' THEN  'RUINA'
     WHEN '80' THEN  'HUNTER'
     WHEN '81' THEN  'SILVER HUNTER'
     WHEN '82' THEN  'HERETIC'
     WHEN '83' THEN  'ARCH HERETIC'
     WHEN '84' THEN  'MARA'
     WHEN '85' THEN  'BLACK MARA'
     WHEN '86' THEN  'MECHANIC'
     WHEN '87' THEN  'RAY MECHANIC'
     WHEN '88' THEN  'ORACLE'
     WHEN '89' THEN  'ORACLE ELDER'
     WHEN '90' THEN  'PHANTOM'
     WHEN '91' THEN  'BLEED PHANTOM'
     WHEN '92' THEN  'KNIGHTESS'
     WHEN '93' THEN  'AVALANCHE'
     WHEN '94' THEN  'RANDGRID'
     WHEN '95' THEN  'LAUNCHER'
     WHEN '96' THEN  'IMPACTOR'
     WHEN '97' THEN  'LUSTRE'
     WHEN '98' THEN  'PLAGA'
     WHEN '99' THEN  'VENA PLAGA'
END AS Specialization, convert(varchar(25), LastLoginDate, 120) as LastLoginDate, Format(Coin/10000,'##,##0') as Coin, Format(WarehouseCoin/10000,'##,##0') as WarehouseCoin
From Characters as C
INNER JOIN CharacterStatus AS CS
ON C.CharacterID = CS.CharacterID and C.CharacterName is NOT NULL
Where CharacterName = ?
AND DeleteFlag <> 1
";

/* Assign Parameter values. */
$myparams['accountname'] = $_POST['accountname'];

// Array requirement for prepare statement.
$procedure_params = array(
    array(&$myparams['accountname'], SQLSRV_PARAM_IN)
);

/* Prepare the statement. */
if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
{
    //  echo "Statement prepared.\n";
} 
else
{
    //  echo "Statement could not be prepared.\n";
    //  ( print_r( sqlsrv_errors(), true)); 
}

/* Execute the statement. */
if( sqlsrv_execute( $stmt))
{
    // echo "Statement executed.\n";
    // ( print_r( sqlsrv_errors(), true)); 
}
else
{
     // echo "Statement could not be executed.\n";
     // ( print_r( sqlsrv_errors(), true)); 
}

echo

'
<tr>
<th>Account ID</th>
<th>Account</th>
<th>Character ID</th>
<th>Character</th>
<th>Specialization</th>
<th>Last Login</th>
<th>Gold</th>
<th>Storaged Gold</th>
</tr>';

/* ID # to increment itself. I.E 1,2,3,4,5,6 etc.. */
while ($rows=sqlsrv_fetch_array($stmt))
{

echo 
'
<tr>
<td> '.$rows[0].' </td> 
<b> <td> <a style = "color:#AFA;" href="accountprofile"> '.$rows[1].' </a> </td> </b> 
<td> '.$rows[2].' </td>
<b> <td> <a style = "color:#AFA;" href="accountprofile"> '.$rows[3].' </a> </td> </b> 
<td> '.$rows[4].' </td>
<td> '.$rows[5].' </td>
<td style = "color:gold;"> '.$rows[6].' </td>
<td style = "color:gold;"> '.$rows[7].' </td>
<td style = "color:gold;"> '.$rows[7].' </td>
</tr>
';  

}
 ?>




</table>
</body>
</html>
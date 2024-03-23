<!DOCTYPE html>

<?php include 'header.php';?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="PVPRankStyle.php"/>
    <link rel="stylesheet" href='css/animate.css'  type='text/css' media="screen and (min-width:1200px)">
	<title>PVP Hall of Fame</title>
<style>
</style>
</head>
<body>

<meta name="viewport" content="width=device-width, initial-scale=0.5">

<div class = "main-banner"> 
    </div>
    
    <div class="pagebg2"> <!-- Div is closed at end of doc -->

<div class="main-banner-text">
<img src = 'pvpimg/gwumpus-right.png'/> 
<h1 class="text-center wow slideInLeft" data-wow-delay="0.1s"> TOP 25 PVP Rankings</h1>
<img src = 'pvpimg/gwumpus-left.png'/> 
</div>

<hr class="featurette-divider" style="width: 100%;">

<div class ="warrior">
<img src = 'pvpimg/warrior.png'/>
</div>

<!-- <div class="salad">
<img src = 'salad.png'/>
</div> --> 

<table>

<?php
error_reporting(0); // Hide undefined "errors" due to footer versatility.
ini_set('display_errors', 0); // Hide undefined "errors" due to footer versatility.

include_once 'config.php';

// Initialize Connection
$conn=sqlsrv_connect($serverName, $conn_array);
if ($conn){
// echo "Connection Successful.";
}else{
    die; // (print_r(sqlsrv_errors(), true)); ACTIVATE ONLY FOR DEBUGGING TO PROTECT AGAINST SQL INJECTION.
}

// Query
$sql = "
SELECT TOP 25 G.CharacterName, G.JobCode, G.PvPExp, D.PVPWin, D.PVPLose, D.PVPGiveUp
FROM PvPRanking as G
INNER JOIN PVPScores as D
ON G.CharacterID = D.CharacterID
ORDER BY  RANK() OVER (ORDER BY TotalRank ASC ) 
";

/* Assign Parameter values. */
$param1 = 1;
$param2 = 2;

// Array requirement for prepare statement.
$procedure_params = array(
    array(&$param1, SQLSRV_PARAM_OUT),
    array(&$param2, SQLSRV_PARAM_OUT)
);

/* Prepare the statement. */
if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
{
      // echo "Statement prepared.\n";
} 
else
{
      /* echo "Statement could not be prepared.\n";
      ( print_r( sqlsrv_errors(), true)); ACTIVATE ONLY FOR DEBUGGING TO PREVENT HELPING SQL INJECTORS */
}

/* Execute the statement. */
if( sqlsrv_execute( $stmt))
{
	 // echo "Statement executed.\n";
}
else
{
      /* echo "Statement could not be executed.\n";
      ( print_r( sqlsrv_errors(), true)); ACTIVATE ONLY FOR DEBUGGING TO PREVENT HELPING SQL INJECTORS */
}


//Table Headers ETC

$g=0;


echo

'
<tr>
<th>Rank</th>
<th>Name</th>
<th>Class</th>
<th>Experience</th>
<th>Wins</th>
<th>Losses</th>
<th>Rage Quit</th>
</tr>';

// Rank # to increment itself. I.E 1,2,3,4,5,6 etc..

while ($rows=sqlsrv_fetch_array($stmt))
{
	$g++;
{



}
// Echo will spit out the rows and the data.
echo 

'
<tr id=io>
<td> '.$g.' </td>
<td> '.$rows[0].' </td>
<td> '.$rows[1].' </td>
<td> '.$rows[2].' </td>
<td> '.$rows[3].' </td>
<td> '.$rows[4].' </td>
<td> '.$rows[5].' </td>
'; 
}



    ?>
    </div>
</table>
</body>
</html>


<?php include 'footer.php';?>
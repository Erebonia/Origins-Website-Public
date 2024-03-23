<!DOCTYPE html>
<?php include 'header.php';?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="PVPRankStyle.php"/>
    <link rel="stylesheet" href='css/animate.css'  type='text/css' media="screen and (min-width:1200px)">
<style>
</style>
</head>
<body>
<div>
<img style = "width:30%" class = "warrior" src = 'img/logov2.png'/> </div>
<div class="container-fluid bgcustom"> 
<div class="main-banner-text" >
<h1  style = "margin-top:5%" >TOP 25 PVP Rankings</h1>
</div>
<hr class="featurette-divider" style="width: 70%;">
</hr>

<table>


<?php

/* Link DB */
include_once 'configpvp.php';

/* Initialize Connection */
$conn=sqlsrv_connect($serverName, $conn_array);
if ($conn){
}else{
    die; 
}

/* Prepare Statement Preparation */
$sql = "
SELECT TOP 25 G.CharacterName,
Case G.Jobcode
WHEN '1' THEN  'Warrior'
WHEN '2' THEN  'Archer'
WHEN '3' THEN  'Sorceress'
WHEN '4' THEN  'Cleric'
WHEN '5' THEN  'Academic'
WHEN '6' THEN  'Kali'
WHEN '7' THEN  'Assassin'
WHEN '8' THEN  'Placeholder'
WHEN '9' THEN  'Placeholder'
WHEN '10' THEN  'Ancestor'
WHEN '11' THEN  'Swordmaster'
WHEN '12' THEN  'Mercenary'
WHEN '14' THEN  'Sharpshooter'
WHEN '15' THEN  'Acrobat'
WHEN '17' THEN  'Elementalist'
WHEN '18' THEN  'Mystic'
WHEN '19' THEN  'Warlock'
WHEN '20' THEN  'Paladin'
WHEN '21' THEN  'Monk'
WHEN '22' THEN  'Priest'
WHEN '23' THEN  'Gladiator'
WHEN '24' THEN  'Moonlord'
WHEN '25' THEN  'Barbarian'
WHEN '26' THEN  'Destroyer'
WHEN '29' THEN  'Sniper'
WHEN '30' THEN  'Artillery'
WHEN '31' THEN  'Tempest'
WHEN '32' THEN  'Windwalker'
WHEN '35' THEN  'Pyromancer'
WHEN '36' THEN  'Ice Witch'
WHEN '37' THEN  'Smasher'
WHEN '38' THEN  'Majesty'
WHEN '41' THEN  'Guardian'
WHEN '42' THEN  'Crusader'
WHEN '43' THEN  'Saint'
WHEN '44' THEN  'Inquisitor'
WHEN '45' THEN  'Exorcist'
WHEN '46' THEN  'Engineer'
WHEN '47' THEN  'Shooting Star'
WHEN '48' THEN  'Gear Master'
WHEN '49' THEN  'Alchemist'
WHEN '50' THEN  'Adept'
WHEN '51' THEN  'Physician'
WHEN '54' THEN  'Screamer'
WHEN '55' THEN  'Dark Summoner'
WHEN '56' THEN  'Soul Eater'
WHEN '57' THEN  'Dancer'
WHEN '58' THEN  'Blade Dancer'
WHEN '59' THEN  'Spirit Dancer'
WHEN '62' THEN  'Chaser'
WHEN '63' THEN  'Reaper'
WHEN '64' THEN  'Raven'
WHEN '65' THEN  'Placeholder'
WHEN '66' THEN  'Placeholder'
WHEN '67' THEN  'Bringer'
WHEN '68' THEN  'Light Fury'
WHEN '69' THEN  'Abyss Walker'
WHEN '72' THEN  'Piercer'
WHEN '73' THEN  'Flurry'
WHEN '74' THEN  'Valkyrie'
WHEN '75' THEN  'Avenger'
WHEN '76' THEN  'Dark Avenger'
WHEN '77' THEN  'Patrona'
WHEN '78' THEN  'Defensio'
WHEN '79' THEN  'Ruina'
WHEN '80' THEN  'Hunter'
WHEN '81' THEN  'Silver Hunter'
WHEN '82' THEN  'Heretic'
WHEN '83' THEN  'Arch Heretic'
WHEN '84' THEN  'Mara'
WHEN '85' THEN  'Black Mara'
WHEN '86' THEN  'Mechanic'
WHEN '87' THEN  'Ray Mechanic'
WHEN '88' THEN  'Oracle'
WHEN '89' THEN  'Oracle Elder'
WHEN '90' THEN  'Phantom'
WHEN '91' THEN  'Bleed Phantom'
WHEN '92' THEN  'Knightess'
WHEN '93' THEN  'Avalanche'
WHEN '94' THEN  'Randgrid'
WHEN '95' THEN  'Launcher'
WHEN '96' THEN  'Impactor'
WHEN '97' THEN  'Lustre'
WHEN '98' THEN  'Plaga'
WHEN '99' THEN  'Vena Plaga'
END,
D.PVPWin, D.PVPLose, G.PvPExp, D.PVPGiveUp
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

/* The ACTUAL Prepare Statement */
$stmt = sqlsrv_prepare( $conn, $sql, $procedure_params);

/*Execute*/
sqlsrv_execute($stmt);


/* Variables */
$autoincrement = 0;

echo

'
<tr>
<th>Rank</th>
<th>Name</th>
<th>Class</th>
<th>Wins</th>
<!-- <th>Losses</th>
<th>Experience</th>
<th>Quit</th> -->
</tr>';



// Rank # to increment itself. I.E 1,2,3,4,5,6 etc..
while ($rows=sqlsrv_fetch_array($stmt))
{
    $autoincrement++; // For IDs only.

    include('classesdirty.php');
    
echo 
'
<tr id=io>
<td> '.$autoincrement.' </td>
<b> <td> <a style = "color:#AFA;" href="pvpprofile"> '.$rows[0].'</a> </td> </b> 
<td> '.$rows[1].'</td>
<td> '.$rows[2].' </td>
<!--  <td> '.$rows[3].' </td>
<td> '.$rows[4].' </td>
<td> '.$rows[5].' </td> -->
</tr>
';  

}
 ?>


</table>
<?php include 'footer.php';?>
</div>
</body>
</html>


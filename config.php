<?php 

error_reporting(0);ini_set('display_errors', 0);

//MSSQL settings 
$serverName = "";

$conn_array = array (
    "UID" => "",
    "PWD" => "",
    "Database" => "DNWORLD",
);

/* This should redirect the person if they made a GET request instead of a POST request. */
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: home'); 
    exit();
    } 



?>


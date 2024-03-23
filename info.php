
<link rel = "stylesheet" type="text/css" href = "css/info.php">
<?php error_reporting(0);ini_set('display_errors', 0); if(session_status()==PHP_SESSION_NONE) session_start();
$AccountName = $_SESSION['AccountName'];
?>
<?php include 'header.php';?>

<div class="container-fluid info">
  <div class="container marketing text-center">

  	<!-- Class and Media Center insert -->
	<?php include 'class.php';?> 
  </div>
</div>
<!-- FOOTER -->
<footer class="container" style = "margin-top: 500px;">
<?php include 'footer.php';?>


<script src="js/scrollandfade.js" type="text/javascript"></script>









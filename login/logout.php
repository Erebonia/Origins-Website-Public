<?php
session_start();
echo $_SESSION['AccountID'];
session_unset();
session_destroy();
header("Location: ../home");

?>
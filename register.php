
<?php 
if (isset($_POST["Register"])) {
error_reporting(0); // Hide undefined "errors" due to footer versatility.
ini_set('display_errors', 0); // Hide undefined "errors" due to footer versatility.

include('../config.php');
$conn = sqlsrv_connect($serverName, $conn_array);

// For error or success messages place the following functions in your functions.php file and include the file here.
// The following functions are based on bootstrap classes for error and success message. If you are not using bootstrap you can stylize your own.

function alertSuccess($msg){
	$alert = "<div class='alert alert-success'>".$msg."</div>";
	return $alert;
  }
  
  function alertError($msg){
	$alert = "<div class='alert alert-danger'>".$msg."</div>";
	return $alert;
  }
  
  function alertInfo($msg){
	$alert = "<div class='alert alert-info'>".$msg."</div>";
	return $alert;
  }

// Storing Form Inputs
$myparams['username'] = ($_POST['username']);
$myparams['email'] = ($_POST['email']);
$myparams['region'] =($_POST['region']);
$myparams['password'] = (!empty($_POST['password']))?$_POST['password']:null;
$password2 = (!empty($_POST['confirmpassword']))?$_POST['confirmpassword']:null;

// Initiate Checks

if(isset($_POST['Register'])) {
	// Set "Creating Account" message. 
	echo alertInfo("Attempting to initiate Account Creation...");
  
	// If username is null then rest of the code will not be executed
	if($myparams['username'] == null){
	  echo alertError("Invalid username!");
	  header("Location: ../failed");
	  exit();
	}
  
	// If password is not equal then rest of the code will not be executed
	if($myparams['password'] != $password2){
	  echo alertError("Password mismatch");
	  header("Location: ../failed");
	  exit();
	}
  
	if(strlen($myparams['password']) < 4){
	  echo alertError("Password must contain at least 4 characters.");
	  header("Location: ../failed");
	  exit();
	}
  
	// If username is less than 4 characters long, or higher than 15, then rest of the code will not be executed
	if(strlen($myparams['username']) < 4){
	  echo alertError("Username must contain at least 4 characters.");
	  header("Location: ../failed");
	  exit();
	}
  
	if($myparams['region'] > 6){
	  echo alertError("Invalid Region.");
	  header("Location: ../failed");
	  exit();
	}

	$options = [
		'cost' => 10
	];
	$passhash = password_hash($myparams['password'], PASSWORD_BCRYPT, $options);

  // All checks done already (including password check). Now process the query.
  $sql = "SET ANSI_NULLS ON
          SET QUOTED_IDENTIFIER ON
          SET CONCAT_NULL_YIELDS_NULL ON
          SET ANSI_WARNINGS ON
          SET ANSI_PADDING ON
          exec dnmembership.dbo.__MON__CreateAccount @AccountName=?,@NxLoginPwd=?,@Email=?,@accountregionid=?
		  ";
		  


//Array for prep
$procedure_params = array(
	array(&$myparams['username'], SQLSRV_PARAM_IN),
	array(&$passhash, SQLSRV_PARAM_IN),
	array(&$myparams['email'], SQLSRV_PARAM_IN),
	array(&$myparams['region'], SQLSRV_PARAM_IN)
	
	);

/* Prepare the statement. */
if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
{
      echo "Statement prepared.\n";
} 
else
{
      echo "Statement could not be prepared.\n";
     // ( print_r( sqlsrv_errors(), true)); ACTIVATE ONLY FOR DEBUGGING TO PREVENT HELPING SQL INJECTORS
}

/* Execute the statement. */
if( sqlsrv_execute( $stmt))
{
	  echo "Statement executed.\n";
	  header("Location: ../account");
}
else
{
      echo "Statement could not be executed.\n";
     // ( print_r( sqlsrv_errors(), true)); ACTIVATE ONLY FOR DEBUGGING TO PREVENT HELPING SQL INJECTORS
}

/* Free the statement and connection resources. */
sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);
}
}
?>

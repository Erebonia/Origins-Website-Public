<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '/home/webserver/vendor/autoload.php';

	include('configlogin.php');
	$conn = sqlsrv_connect($serverName, $conn_array);

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	function randomText() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 16; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	$token = randomText();
	$accountName = $_POST["username"];
	$accountEmail = "test";
	$sql2 = "
			SELECT Email
			FROM Accounts
			WHERE AccountName = ?
			";


	//Array for prep
	$procedure_params2 = array(
		array(&$accountName, SQLSRV_PARAM_IN)
	);

	if( $stmt2 = sqlsrv_prepare( $conn, $sql2, $procedure_params2))
	{
		//echo "Statement was successfully prepared.\n";
	} 
	else
	{
		//echo "Statement could not be prepared.\n";
		//( print_r( sqlsrv_errors(), true));
	}

	/* Execute the statement. */
	if( sqlsrv_execute($stmt2))
	{
		//echo "Statement successfully executed.";
	}
	else
	{
		//echo " Unable to execute prepared statement!\n";
		// ( print_r( sqlsrv_errors(), true));
	}
	$info=sqlsrv_fetch_array($stmt2);
	$accountEmail=$info[0];
	
	$URL = 'https://dnorigins.com/confirmpassrequest?accountName=' . $accountName . '&token=' . $token;
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('','');
    $mail->addAddress($accountEmail);               // Name is optional

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
	$body = 
	'<p>Hello ' . $accountName . ',</p>
	<br/>
	<p>A request to reset your account password has been made.</p>	
	<br/>
	<p>If you wish to confirm the request, click this URL or paste it on your browser : </p>' . $URL . '
	<p>If you are not the author of this request, please contact our staff on Discord !</p>
	<br/>
	Sincerly, your Origins automatic support !
	'
	;
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Dragon Nest Origins Support - Reset password request';
    $mail->Body    = $body;
    $mail->AltBody = $body;

    if($mail->send())
	{
		
		$sql = "
			SET ANSI_NULLS ON
			SET QUOTED_IDENTIFIER ON
			SET CONCAT_NULL_YIELDS_NULL ON
			SET ANSI_WARNINGS ON
			SET ANSI_PADDING ON
			EXEC __MON__ResetPasswordRequest @AccountName=?,@Token=?
			  
			";


		//Array for prep
		$procedure_params = array(
			array(&$accountName, SQLSRV_PARAM_IN),
			array(&$token, SQLSRV_PARAM_IN)

		);

		if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
		{
			//echo "Statement was successfully prepared.\n";
		} 
		else
		{
			//echo "Statement could not be prepared.\n";
			 //( print_r( sqlsrv_errors(), true));
		}

		/* Execute the statement. */
		if( sqlsrv_execute($stmt))
		{
			//header("Location: home");
			echo "<SCRIPT>
			alert('Your password reset request has been made. Check your mails !');
			window.location.replace('home');
    		</SCRIPT>";
			exit();
			// echo "Statement successfully executed.";
		}
		else
		{
			// echo " Unable to execute prepared statement!\n";
			// ( print_r( sqlsrv_errors(), true));
		}
	}
	?>

	

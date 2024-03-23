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

    $token = $_POST["token"];
    $accountName = $_POST["accountName"];
    $accountEmail = "test";
    $newPassword = $_POST["NewPassword"];

    $sql3 = "
			SET ANSI_NULLS ON
			SET QUOTED_IDENTIFIER ON
			SET CONCAT_NULL_YIELDS_NULL ON
			SET ANSI_WARNINGS ON
			SET ANSI_PADDING ON
			EXEC __MON__ValidatePassToken @AccountName=?,@Token=?
			  
			";


		//Array for prep
		$procedure_params3 = array(
			array(&$accountName, SQLSRV_PARAM_IN),
            array(&$token, SQLSRV_PARAM_IN)

		);

		if( $stmt3 = sqlsrv_prepare( $conn, $sql3, $procedure_params3))
		{
			//echo "Statement was successfully prepared.\n";
		} 
		else
		{
			//echo "Statement could not be prepared.\n";
			 //( print_r( sqlsrv_errors(), true));
		}

		/* Execute the statement. */
		if( sqlsrv_execute($stmt3))
		{
			// echo "Statement successfully executed.";
		}
		else
		{
			// echo " Unable to execute prepared statement!\n";
			// ( print_r( sqlsrv_errors(), true));
        }
    $returnValue = sqlsrv_fetch_array($stmt3);
    $validToken = $returnValue[0];

    if ($validToken == 1)
    {
        $options = [
            'cost' => 10
          ];
        $passhash = password_hash($newPassword, PASSWORD_BCRYPT, $options);
          
        $sql4 = "SET ANSI_NULLS ON
            SET QUOTED_IDENTIFIER ON
            SET CONCAT_NULL_YIELDS_NULL ON
            SET ANSI_WARNINGS ON
            SET ANSI_PADDING ON
            EXEC __MON__ModPassword @AccountName=?,@NxLoginPwd=?
            
            ";
          
          
          //Array for prep
        $procedure_params4 = array(
              array(&$accountName, SQLSRV_PARAM_IN),
              array(&$passhash, SQLSRV_PARAM_IN)
          
          );
              /* Prepare the statement. */
          if( $stmt4 = sqlsrv_prepare( $conn, $sql4, $procedure_params4))
          {
               // echo "Statement was successfully prepared.\n";
          } 
          else
          {
               //  echo "Statement could not be prepared.\n";
               // ( print_r( sqlsrv_errors(), true));
          }
          
          /* Execute the statement. */
          if( sqlsrv_execute($stmt4))
          {
              // echo "Statement successfully executed.";
          }
          else
          {
               //  echo " Unable to execute prepared statement!\n";
               // ( print_r( sqlsrv_errors(), true));
          }



    
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
        '<p>' . $accountName . ',</p>
        <br/>
        <p>Your password has been reset successfully.</p>	
        <br/>
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
                echo "<SCRIPT>
                alert('Password has been reset. You will be redirected to the home page.');
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

    }
    else
    {
        echo "<SCRIPT>
        alert('Invalid or Expired Token ! Make a new request.');
        window.location.replace('home');
        </SCRIPT>";
        exit();
        //echo "Invalid Token";
        //header("Location: failed");
        exit();
    }
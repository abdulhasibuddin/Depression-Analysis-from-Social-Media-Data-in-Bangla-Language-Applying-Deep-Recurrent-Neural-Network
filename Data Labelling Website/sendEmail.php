<?php
	//This file sends email to the assigned address of the user::
	//This file is required in 'registrationDatabase.php' & 'forgotUsernamePassword2.php'
	//Note: In this file, PHP's default mail() function is used to send mail. It might not work while working on localhost [on pc]

	$to = $eMail; //Email address to send the email
	$header = ''; //Header of the email
	mail($to, $subject, $message, $header); //Sending email using PHP's mail() function
?>

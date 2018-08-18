<?php
	//After submitting the form of 'resetAccount.php', submitted 'name' properies are processed in this file::
	session_start(); //Start session
	require 'secureInput.php'; //This file checks for cross-site scripting(XSS) vulnerability
//-----------------------------------------------------------------


	$eMail = $activationCode = "";
	$err = $captchaErr =  "";
	$errFlag = 0; //If any error occures, this flag would be valued 1
//-----------------------------------------------------------------


	if($_SERVER["REQUEST_METHOD"]=="POST") { //Checking if the form was submitted as POST

		$eMail = secureInput($_POST["eMail"]); //XSS vulnerability checking of input username
		if(!filter_var($eMail, FILTER_VALIDATE_EMAIL)) { //Validating email using PHP's own function
			//If input email format is not valid::
			$eMailErr = "Incorrect username or activation code!"; 
			$errFlag = 1;
		}
//-----------------------------------------------------------------


		$activationCode = secureInput($_POST["activationCode"]); //XSS vulnerability checking of input account activation code
		if(!preg_match("/^[a-zA-Z0-9]*$/", $activationCode)) { //Regular expression comparison
			//If input account activation code is invalid::
			$err = "Incorrect username or activation code!"; 
			$errFlag = 1;
		}
		//---------------------------------------------------------

		require 'checkActivationCode.php'; //This file gets the stored activation code for the corresponding username from database::
		$actCode = "";
		foreach($chkResult as $value){ //Traversing columns of the selected row
			if(count(array_filter($value)) > 0){ //If the activation code is found...
				$actCode = $value["activationCode"]; //Assign the encrypted activation code stored in the database to a variable
			}
			else{ //If the activation code is not found[i.e. username does not exist]::
				$err = "Incorrect username or activation code!"; 
				$errFlag = 1;
			}
		}

		//password_verify('Unencrypted code needs to be verified', 'Encrypted code to be verified with')::
		if (!password_verify($activationCode, $actCode)) { //Verify the input activation code with the actual stored code
			//If there is no match::
			$err = "Incorrect username or activation code!"; 
			$errFlag = 1;
		}
//-----------------------------------------------------------------


		if(isset($_SESSION["vercode"])){ //Check if session 'vercode' is set
			if($_POST["vercode1"] != $_SESSION["vercode"] OR $_SESSION["vercode"] == ""){
				//If the captcha input is not correct or if the session 'vercode' does not contain any captcha::
				$captchaErr =  "Incorrect captcha!";
				$errFlag = 1;
			}
			else{
				session_unset($_SESSION["vercode"]); //Unsetting session 'vercode' when captcha is confirmed
			}
		}		
	}
//-----------------------------------------------------------------
	

	if ($eMail != "" AND $activationCode != "" AND $errFlag == 0) { //If the username and activation code fields are not empty and if there is no other error...
		$_SESSION['user'] = $eMail; //assign the username to the session 'user'...
		require 'activateAccount.php'; //This page gets the username and activates the corresponding account::
		//header('Location: authenticatedUser.php'); //take the user to his/her own authenticated page
		$redirect = '<script>';
		$redirect .= 'window.location.href = "authenticatedUser.php";';
		$redirect .= '</script>';
		echo $redirect;
		//Note: The 'header()' function will function properly if this file is required at the first/top of the corresponding HTML file (verificationPage.php).
	}
?>

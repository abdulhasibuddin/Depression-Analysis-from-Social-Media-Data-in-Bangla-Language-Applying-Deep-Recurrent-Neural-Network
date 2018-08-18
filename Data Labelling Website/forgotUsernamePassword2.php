<?php
	//After submitting the form of 'forgotUsernamePassword.php', submitted 'name' properies are processed in this file::
	session_start(); //Start session
	require 'secureInput.php'; //This file checks for cross-site scripting(XSS) vulnerability

	$eMail = "";
	$err = $captchaErr =  "";
	$errFlag = 0; //If any error occures, this flag would be valued 1
	//-----------------------------------------------------------------


	if($_SERVER["REQUEST_METHOD"]=="POST"){ //Checking if the form was submitted as POST

		$eMail = secureInput($_POST["email"]); //XSS vulnerability checking of input email
		if(!filter_var($eMail, FILTER_VALIDATE_EMAIL)) { //Validating email using PHP's own function
			//If email format is not valid::
			$err = "Invalid email format!"; 
			$errFlag = 1;
		}
		//---------------------------------------------------------

		require 'checkExistingAccount.php'; //This file checks if the account [corresponding to the email] extsts or not...
		if($result->num_rows<=0 AND $errFlag==0){ //If account exists
			$err = "Account does not exist!"; 
			$errFlag = 1;
		}
			/*elseif($err == ""){ //If account does not exist & there is no previous error
				$err = "Account does not exist!"; 
				$errFlag = 1;
			}*/
	//-----------------------------------------------------------------


		//$_POST["vercode"]-> captcha code input by the user [here, 'vercode' is the name of the captcha input field; don't be 	confused with the session 'vercode'!]
		//$_SESSION["vercode"]-> session 'vercode' holding the actual captcha code

		if (isset($_SESSION["vercode"])) { //Check if session 'vercode' is set
			if($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"] == ""){
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


	//Generating random code username/password reset operation::
	$verLetter = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890'; //String containing characters to be used to generate the reset code
	$verLength = strlen($verLetter); //Getting the length (i.e. total number of characters) of the string to be used
	$verCode = ''; //Declaring an empty variable to hold the randomly generated characters

	for ($i=0; $i<8 ; $i++) { //Looping 8 times to generate 8 characters long reset code
		$verCode .= $verLetter[rand(0, $verLength-1)]; //Appending every randomly generated character to the variable $verCode
	}
	//After the end of the looping, $verCode holds the randomly generated reset code
	//-----------------------------------------------------------------


	if ($eMail != "" AND $errFlag == 0) { //If valid existing email is available from the user and if there is no other errors
		$subject = 'Reset your account'; //Subject of the email
		$message = 'Your account reset code is: '.$verCode; //Message including the username/password reset code
		require 'sendEmail.php'; //This file mails the account reset code to the user

		require 'config.php'; //Opening database connection
		$eMail = mysqli_real_escape_string($conn, $eMail); //Checking for SQL-Injection type vulnerability
		$verCode = password_hash($verCode, PASSWORD_DEFAULT); //Hashing password with PHP's default password hashing algorithm [bcrypt]

		//Prepared statement to prevent SQL-Injection::
		$query = "UPDATE registrationTable SET activationCode = ? WHERE eMail = ?"; //Update query to store the hashed reset code in the 'activationCode' column corresponding to the email column
		$stmt = $conn->prepare($query); //Processing prepared statement
		$stmt->bind_param("ss", $verCode, $eMail); //Binding parameters
		$stmt->execute(); //Executing prepared statement

		$stmt->close(); //Closing prepared statement
		$conn->close(); //Closing the database connection
		
		$_SESSION['email'] = $eMail; //Assign the current user's email in the session 'email'
		echo "eMail=".$eMail.'<br>';
		echo "errFlag=".$errFlag;
		//header("location: resetAccount.php"); //Loads 'resetAccount.php' file [the Reset Account page]
		$redirect = '<script>';
		$redirect .= 'window.location.href = "resetAccount.php";';
		$redirect .= '</script>';
		echo $redirect;
		//Note: The 'header()' function will function properly if this file is required at the first/top of the corresponding HTML file (forgotUsernamePassword.php).
	}

?>

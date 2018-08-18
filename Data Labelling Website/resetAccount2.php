<?php
	//After submitting the form of 'resetAccount.php', submitted 'name' properies are processed in this file::
	session_start(); //Start session
	
	$eMail = "";
	if (isset($_SESSION['email'])) {
		$eMail = $_SESSION['email']; //Assigning the value of session 'email' into a variable
	}
	require 'secureInput.php'; //This file checks for cross-site scripting(XSS) vulnerability	
//---------------------------------------------------------------------------


	$stdId = $password = $conPasswrd = $resetCode = "";
	$err = $eMailErr = $stdIdErr = $passwordErr = $conPasswordErr = $resetCodeErr =  $captchaErr = "";
	$errFlag = 0; //If any error occures, this flag would be valued 1
//---------------------------------------------------------------------------


	if($_SERVER["REQUEST_METHOD"]=="POST") { //Checking if the form was submitted as POST

		$stdId = secureInput($_POST["userName"]); //XSS vulnerability checking of input username
		if(!preg_match("/^[a-zA-Z0-9_]*$/", $stdId)) { //Regular expression comparison
			//If input username is invalid::
			$stdIdErr = "* Invalid username!";
			$errFlag = 1;
		}
        //-------------------------------------------------------------------

		require 'checkUniqueUserName.php'; //This file checks if the username input by the user already exists or not
		foreach($result as $value){ //Traversing columns of the selected row
			if(count(array_filter($value)) > 0){ //If username already exists...[i.e. if the selected row has columns]

				if ($value['eMail'] != $eMail) { //and if the username is not the previous username of the current user...		
					$stdIdErr = "* This username is already taken!"; //notify the user...
					$errFlag = 1; //and set error flag high
				}
			
			}
		}
//---------------------------------------------------------------------------


		$password = secureInput($_POST["password"]); //XSS vulnerability checking of input password
		require 'passwordValidation.php'; //This file validates the input password format
		//-------------------------------------------------------------------

		$conPasswrd = secureInput($_POST["conPassword"]); //XSS vulnerability checking of input confirm password
		if(!preg_match("/^[a-zA-Z0-9_]*$/", $conPasswrd)) { //Regular expression comparison
			//If input confirmation password doesn't match with input password::
			$conPasswordErr = "* Password doesn't match!";
			$errFlag = 1;
		}
		//Password hashing/encryption::
		if($password == $conPasswrd){ //If password & confirmation password are same...
			$password = password_hash($password, PASSWORD_DEFAULT); //hash the input password [default bcrypt]
		}
		else{ $errFlag = 1; } //If password & confirmation password do not match, set error flag high
//---------------------------------------------------------------------------


		if (isset($_SESSION["vercode"])) {
			if($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"] == ""){
				//If the captcha input is not correct or if the session 'vercode' does not contain any captcha::
				$captchaErr =  "* Incorrect captcha!";
				$errFlag = 1;
			}
		}
//---------------------------------------------------------------------------


		$resetCode = secureInput($_POST["resetCode"]); //XSS vulnerability checking of input reset code
		if(!preg_match("/^[a-zA-Z0-9]*$/", $resetCode)) { //Regular expression comparison
			//If input reset code is invalid::
			$resetCodeErr = "* Wrong input!";
			$errFlag = 1;
		}
		//-------------------------------------------------------------------

		require 'config.php'; //Opening database connection
		$eMail = mysqli_real_escape_string($conn, $eMail); //Checking for SQL-Injection type vulnerability::(Escaping special characters in a string having special meaning in SQL statement)
		
		//Prepared statement to prevent SQL-Injection::
		$query = "SELECT * FROM registrationTable WHERE eMail = ?"; //Select the row of the corresponding email/account
		$stmt = $conn->prepare($query); //Processing prepared statement
		$stmt->bind_param("s", $eMail); //Binding parameters
		$stmt->execute(); //Executing prepared statement
		$queryResult = $stmt->get_result(); //Get the result
		$queryResult->fetch_all(); //Fetch all the column values of the selected row

		foreach($queryResult as $value){ //Traversing columns of the selected row
			if(count(array_filter($value)) > 0){ //If account exists...

				//Verify the stored encrypted account reset code with input reset code [password_verify(Un-encrypted code, Encrypted code)]::
				if(!password_verify($resetCode, $value['activationCode'])) { //If there is no match...
					$resetCodeErr = "* Wrong input!"; //notify user...
					$errFlag = 1; //and set error flag high
				
				}
			}
		}

		$stmt->close(); //Closing prepared statement
		$conn->close(); //Closing database connection

	}
//---------------------------------------------------------------------------


	if (($eMail == "" || $stdId == "" || $password == "" || $conPasswrd == "" || $resetCode == "") || $errFlag == 1) { }
	else { //If no field is empty or there is no other error...

		require 'config.php'; //Opening database connection
		//Checking for SQL-Injection type vulnerability::(Escaping special characters in a string having special meaning in SQL statement)::
		$stdId = mysqli_real_escape_string($conn, $stdId);
		$password = mysqli_real_escape_string($conn, $password);
		$eMail = mysqli_real_escape_string($conn, $eMail);

		$activationCode = "";
		//Prepared statement to prevent SQL-Injection::
		$query = "UPDATE registrationTable SET userName = ?, password = ?, activationCode = ? WHERE eMail = ?"; //Update query to assign the newly given username and password in the database and set the activation code empty to the corresponding email row
		$stmt = $conn->prepare($query); //Processing prepared statement
		$stmt->bind_param("ssss", $stdId, $password, $activationCode, $eMail); //Binding parameters
		$stmt->execute(); //Executing prepared statement

		$stmt->close(); //Closing prepared statement
		$conn->close(); //Closing the database connection
		
		$_SESSION['user'] = $stdId; //Assign newly updated username to the session 'user'
		//header("location: authenticatedUser.php"); //Take user to his/her authenticated page
		$redirect = '<script>';
		$redirect .= 'window.location.href = "authenticatedUser.php";';
		$redirect .= '</script>';
		echo $redirect;
		//Note: The 'header()' function will function properly if this file is required at the first/top of the corresponding HTML file (resetAccount.php).
	}
?>

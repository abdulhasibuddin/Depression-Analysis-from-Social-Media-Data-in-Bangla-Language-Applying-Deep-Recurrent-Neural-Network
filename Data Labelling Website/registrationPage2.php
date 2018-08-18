<?php
	//After submitting the form of 'registrationPage.php', submitted 'name' properies are processed in this file::
	session_start(); //Start session
	require 'secureInput.php'; //This file checks for cross-site scripting(XSS) vulnerability
//---------------------------------------------------------------------------


	$fName = $lName = $eMail = $instName = $subject = $batchNo = $stdId = $socialMedia = $gender = $password = $conPasswrd = "";
	$fNameErr = $lNameErr = $eMailErr = $instNameErr = $subjectErr = $batchNoErr = $stdIdErr = $conPasswordErr = $captchaErr = "";
	$errFlag = 0; //If any error occures, this flag would be valued 1
//---------------------------------------------------------------------------


	if($_SERVER["REQUEST_METHOD"]=="POST"){ //Checking if the form was submitted as POST

		$fName = secureInput($_POST["firstName"]); //XSS vulnerability checking of input first name
		if(!preg_match("/^[a-zA-Z ]*$/", $fName)) { //Regular expression comparison
			//If input first name is invalid::
			$fNameErr = "Only letters and white space allowed!"; 
			$errFlag = 1;
		}
		

	//-----------------------------------------------------------------------
		$lName = secureInput($_POST["lastName"]); //XSS vulnerability checking of input last name
		if(!preg_match("/^[a-zA-Z ]*$/", $lName)) { //Regular expression comparison
			//If input last name is invalid::
			$lNameErr = "Only letters and white space allowed!";
			$errFlag = 1;
		}
		

	//-----------------------------------------------------------------------
		$eMail = secureInput($_POST["email"]); //XSS vulnerability checking of input email
		if(!filter_var($eMail, FILTER_VALIDATE_EMAIL)) { //Validating email using PHP's own function
			//If input email format is not valid::
			$eMailErr = "Invalid email format!"; 
			$errFlag = 1;
		}	

		//-------------------------------------------------------------------
		require 'checkExistingAccount.php'; //This file checks if the account [corresponding to the email] extsts or not
		foreach($result as $value){ //Traverse columns of the selected row
			if(count(array_filter($value)) > 0){ //If account exists...[count(array_filter($value)) gives the column numbers of the selected row. The row is empty if there is no column i.e. the account does not exist]
				$eMailErr = "Account already exists!"; //notify the user...
				$errFlag = 1; //set error flag high
			}
		}
		

		//-------------------------------------------------------------------
		$instName = secureInput($_POST["instName"]); //XSS vulnerability checking of input username
		if(!preg_match("/^[a-zA-Z0-9 ]*$/", $instName)) { //Regular expression comparison
			//If input username is invalid::
			$instNameErr = "Only letters, numbers and space allowed!";
			$errFlag = 1;
		}

		//-------------------------------------------------------------------
		$subject = secureInput($_POST["subject"]); //XSS vulnerability checking of input username
		if(!preg_match("/^[a-zA-Z0-9 ]*$/", $subject)) { //Regular expression comparison
			//If input username is invalid::
			$subjectErr = "Only letters, numbers and space allowed!";
			$errFlag = 1;
		}

		//-------------------------------------------------------------------
		$batchNo = secureInput($_POST["batchNo"]); //XSS vulnerability checking of input username
		if(!preg_match("/^[a-zA-Z0-9 ]*$/", $batchNo)) { //Regular expression comparison
			//If input username is invalid::
			$batchNoErr = "Only letters, numbers and space allowed!";
			$errFlag = 1;
		}

		//-------------------------------------------------------------------
		$stdId = secureInput($_POST["stdId"]); //XSS vulnerability checking of input username
		if(!preg_match("/^[a-zA-Z0-9_\- ]*$/", $stdId)) { //Regular expression comparison
			//If input username is invalid::
			$stdIdErr = "Only letters, numbers and (_, - and space) allowed!";
			$errFlag = 1;
		}
		
	//-----------------------------------------------------------------------
		$socialMedia = $_POST['socialMedia']; //Assigning socialMedia value to the variable '$socialMedia'

        //-------------------------------------------------------------------
		require 'checkUniqueUserName.php'; //This file checks if the username input by the user already exists or not
		foreach($result as $value){ //Traverse columns of the selected row
			if(count(array_filter($value)) > 0){ //If username already exists...
				$stdIdErr = "Student id already taken!"; //notify user...
				$errFlag = 1; //set error flag high
			}
		}
		

	//-----------------------------------------------------------------------
		$password = secureInput($_POST["password"]); //XSS vulnerability checking of input password
		require 'passwordValidation.php'; //This file validates the input password format
		

	//-----------------------------------------------------------------------
		$conPasswrd = secureInput($_POST["conPassword"]); //XSS vulnerability checking of input confirm password
		if(!preg_match("/^[a-zA-Z0-9_]*$/", $conPasswrd)) { //Regular expression comparison
			//If input confirmation password doesn't match with input password::
			$conPasswordErr = "Password doesn't match! Invalid input.";
			$errFlag = 1;
		}
		//-------------------------------------------------------------------

		//Password hashing/encryption::
		if($password == $conPasswrd){ //If password & confirmation password are same...
			$password = password_hash($password, PASSWORD_DEFAULT); //hash the input password[default bcrypt]
		}
		else{ 
			$conPasswordErr = "Password doesn't match!";
			$errFlag = 1; 
		} //If password & confirmation password don't match, set error flag high
		
	
	//-----------------------------------------------------------------------
		$gender = $_POST['gender']; //Assigning gender value to the variable '$gender'


	//-----------------------------------------------------------------------
		if (isset($_SESSION["vercode"])) {
			if($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"] == ""){
				//If the captcha input is not correct or if the session 'vercode' does not contain any captcha::
				$captchaErr =  "Incorrect captcha code!";
				$errFlag = 1;
			}
		}
		
	}
//---------------------------------------------------------------------------


	if (($fName == "" || $lName == "" || $eMail == "" || $instName == "" || $subject == "" || $batchNo == "" || $stdId == "" || $gender == "" || $password == "" || $conPasswrd == "") || $errFlag == 1) { } //Check for if any required field is empty or there is any error...
	else{ //If everything is ok...
		
		$conPasswrd = ""; //Setting the unencrypted value of '$conPasswrd' to empty for security reason
		require 'registrationDatabase.php'; //If everything is ok, take the input values to registration database
	}
?>

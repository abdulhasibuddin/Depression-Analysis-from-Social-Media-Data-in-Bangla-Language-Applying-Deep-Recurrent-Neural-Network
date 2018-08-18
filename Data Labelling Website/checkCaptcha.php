<?php
	//This file checks if the captcha code input by the user is correct or not::
	session_start(); //Start session

	//$_POST["vercode"]-> captcha code input by the user [here, 'vercode' is the name of the captcha input field; don't be confused with the session 'vercode'!]
	//$_SESSION["vercode"]-> session 'vercode' holding the actual captcha code

	if (isset($_SESSION["vercode"])) {
		if($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"] == ""){ //If the captcha input is not correct or if 	the session 'vercode' does not contain any captcha, then show the message below...
			echo "<strong>Incorrect verification code.</Strong>";
		}else{ //If the input captcha is correct...
			echo "<strong>Verification successful.</Strong>";
		}
	}
?>

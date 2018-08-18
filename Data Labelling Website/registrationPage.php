<?php //require 'registrationPage2.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="registrationPage.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="bodyId">
	<div id="headerId"><h2>Registration Here</h2></div>
	<!--The following part needs to be loaded before the form section to use the variables declared and assigned in the file-->
	<?php 
		//Declaring necessary variables with certain messages to show the user about the different characteristics that the input password should have::[default color of the messages is blue]
	    $pass_size = "*Password should be atleast 8 characters!";
	    $pass_char_lower = "*Password should contain atleast one lowercase character!";
	    $pass_char_upper = "*Password should contain atleast one uppercase character!";
	    $pass_char_num = "*Password should contain atleast one number!";
	    $pass_char_spe = "*No special character is permitted except (_)!";
	    require 'registrationPage2.php';
	?>
	<!--'POST' method prevents data from exposing on the url bar-->
	<!--Don't use $_SERVER['PHP_SELF'] as it is vulnerable to Cross-Site Scripting(XSS)-->
	<!--If you have to use $_SERVER['PHP_SELF'], then use it as htmlspecialchars($_SERVER['PHP_SELF'])-->
	<form id="form" method="POST" action="" ><!--action="" refers to the self submission of this form-->
		<div id="tableId">
			<div id="td1">First Name: 
				<div id="td2">
					<input id="inputId" type="text" name="firstName" value="<?php echo $fName; ?>" required autofocus><!--First name input area-->
				</div>
				<div id="error">* <?php echo $fNameErr; ?></div><!--Error messages related to first name-->
			</div><br>

			<div id="td1">Last Name: 
				<div id="td2">
					<input id="inputId" type="text" name="lastName" value="<?php echo $lName; ?>" required><!--Last name input area-->
				</div>
				<span id="error">* <?php echo $lNameErr; ?></span><!--Error messages related to last name-->
			</div><br>

			<div id="td1">E-mail:
				<div id="td2">
					<input id="inputId" type="E-mail" name="email" value="<?php echo $eMail; ?>" required><!--Email input area-->
				</div>
				<div id="error">* <?php echo $eMailErr; ?></div><!--Error messages related to email-->
			</div><br>

			<div id="td1">Institute Name:
				<div id="td2">
					<input id="inputId" type="text" name="instName" value="<?php echo $instName; ?>" required><!--Username input area-->
				</div>
				<div id="error">* <?php echo $instNameErr; ?></div><!--Error messages related to username-->
			</div><br>

			<div id="td1">Subject:
				<div id="td2">
					<input id="inputId" type="text" name="subject" value="<?php echo $subject; ?>" required><!--Username input area-->
				</div>
				<div id="error">* <?php echo $subjectErr; ?></div><!--Error messages related to username-->
			</div><br>

			<div id="td1">Batch No:
				<div id="td2">
					<input id="inputId" type="text" name="batchNo" value="<?php echo $batchNo; ?>" required><!--Username input area-->
				</div>
				<div id="error">* <?php echo $batchNoErr; ?></div><!--Error messages related to username-->
			</div><br>

			<div id="td1">Student ID:
				<div id="td2">
					<input id="inputId" type="text" name="stdId" value="<?php echo $stdId; ?>" required><!--Username input area-->
				</div>
				<div id="error">* <?php echo $stdIdErr; ?></div>
			</div><br>

			<div id="td1">Social Media:
				<span id="error">* </span>
			</div><br>
			<div id="td1" style="padding-left: 15%;">
				<input type="radio" name="socialMedia" value="facebook" required>Facebook
				<br>
				<input type="radio" name="socialMedia" value="twitter">Twitter
				<br>
				<input type="radio" name="socialMedia" value="other">Other
			</div><br>

			<div id="td1">Password:
				<div id="td2">
					<input id="inputId" type="password" name="password" required><!--Password input area-->
				</div>
			</div>

			<div id="td1">
				<div id="td2">
					<span id="pass_message"><?php echo $pass_size; ?></span><br>
	                <span id="pass_message"><?php echo $pass_char_lower; ?></span><br>
	                <span id="pass_message"><?php echo $pass_char_upper; ?></span><br>
	                <span id="pass_message"><?php echo $pass_char_num; ?></span><br>
	                <span id="pass_message"><?php echo $pass_char_spe; ?></span><br>
				</div>
			</div><br>

			<div id="td1">Confirm Password:
				<div id="td2">
					<input id="inputId" type="password" name="conPassword" required><!--Confirmation password input area-->
				</div>
				<div id="error">* <?php echo $conPasswordErr; ?></div><!--Error messages related to confirmation password-->
			</div><br>

			<div id="td1">Gender:
				<span id="error">* </span>
			</div><br>
			<div id="td1" style="padding-left: 15%;">
				<input type="radio" name="gender" value="male" required>Male
				<br>
				<input type="radio" name="gender" value="female">Female
			</div><br>

			<div id="td1"><img src="captcha.php"><!--Captcha image area-->
			</div><br>
			<div id="td1">Enter captcha:
				<div id="td2"><input id="inputId" type="text" name="vercode" required/><!--Captcha code input area-->
				</div>
				<div id="td2"> <span id="error"><?php echo $captchaErr; ?></span></div><!--Error messages related to captcha code-->
			</div><br>

			<div id="td1">	
				<input id="submitId" type="submit" value="Submit"/><!--Submit button-->					
				<br>
				<div id="td2">
					<h6 style="color: red; font-style: italic;">*Required field</h6>
				</div>
			</div>
		</div>
		<footer id="footerId">Already have an account? Login <a href="loginPage.php"><strong>here</strong></a></footer><!--Link to the login page-->	
	</form>
</body>
</html>
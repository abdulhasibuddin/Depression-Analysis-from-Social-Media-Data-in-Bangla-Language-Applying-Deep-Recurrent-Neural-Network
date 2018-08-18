<?php require 'forgotUsernamePassword2.php'; ?><!--This line must be the first line of this file to be redirected to the next page by 'header()' function.-->

<!--This file produces the front-end 'Reset account' page where user has to provide email address to get username/password reset code via email::-->
<!DOCTYPE html>
<html>
<head>
	<title>Reset account</title>
	<link rel="stylesheet" type="text/css" href="forgotUsernamePassword.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
</head>
<body id="bodyId">
	<!--'POST' method prevents data from exposing on the url bar-->
	<!--Don't use $_SERVER['PHP_SELF'] as it is vulnerable to Cross-Site Scripting(XSS)-->
	<!--If you have to use $_SERVER['PHP_SELF'], then use it as htmlspecialchars($_SERVER['PHP_SELF'])-->
	<form method="POST" action="">		
		<div style="padding-left: 15vh; padding-right: 10vh; color: blue; text-align: center;"><h3>Forgot username or password?</h3><br>To reset your username or password, please enter the email associated with your account.
		</div>
		<div id="tableId">
			<div id="error" style="margin-left: 8%;"><?php echo $err; ?></div>
			<br>
			<div id="td1">E-mail:
				<div id="td2"><!--Email input area-->
					<input id="inputId" type="text" name="email" value="<?php echo $eMail; ?>" required autofocus/>
				</div>
			</div>
			<br>
			<div id="td1"><img src="captcha.php">
			</div>
			<div id="td1">Enter captcha: 
				<div id="td2">
					<input id="inputId" type="text" name="vercode" required/>
				</div>
				<div id="td2">
					<span id="error"><?php echo $captchaErr; ?></span>
				</div>
			</div>

			<div>
				<div style="margin-left: 7.8%; margin-top: 5%;"><a style="color: #ffffff;" href="loginPage.php"><strong><- BACK</strong></a>
				</div><!--Go back login page-->
			</div>
			<div>
				<input id="submitId" type="submit" value="Submit"/><!--Submit information-->
			</div>
		</div>
	</form>
</body>
</html>

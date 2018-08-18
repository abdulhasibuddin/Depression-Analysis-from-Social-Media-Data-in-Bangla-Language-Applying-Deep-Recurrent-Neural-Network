<?php require 'loginPage2.php'; ?><!--This line must be the first line of this file to be redirected to the next page by 'header()' function.-->
<?//----------------------------------------------------------------------------------------------------------------------------?>

<!--This file generates the login page front-end design::-->
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="loginPage.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="bodyId">
	<h1 id="headerId">Login to Your Account</h1>

	<!--'POST' method prevents data from exposing on the url bar-->
	<!--Don't use $_SERVER['PHP_SELF'] as it is vulnerable to Cross-Site Scripting(XSS)-->
	<!--If you have to use $_SERVER['PHP_SELF'], then use it as htmlspecialchars($_SERVER['PHP_SELF'])-->
	<form method="POST" action=""><!--action="" refers to the self submission of this form-->

		<div id="tableId">
			<div></div>
			<div id="error" style="margin-left: 8%"><?php echo $err; ?></div><!--Error messages related to username & password are shown in this section-->
			<br>

			<div id="td1">Email:
				<div id="td2">
					<input id="inputId" type="text" name="eMail" value="<?php echo $eMail; ?>" required autofocus/><!--eMail input area-->
				</div>
			</div><br>
		
			<div id="td1">Password:
				<div id="td2">
					<input id="inputId" type="password" name="password" required/><!--Password input area-->
				</div>
			</div><br>
		
			<div id="td1">
				<img src="captcha.php"><!--Captcha image area-->
			</div><br>
			<div id="td1">Enter captcha:
				<div id="td2">
					<input id="inputId" type="text" name="vercode" required/>
				</div><!--Captcha input area-->
				<div id="td2">
					<span id="error"><?php echo $captchaErr; ?></span><!--Captcha code related error message is shown here-->
				</div>
			</div><br>

			<div id="td1">
				<input id="submitId" type="submit" value="Login"/><!--Login button-->
			</div><br>

			<div style="margin-left: 7.8%;"><a id="error" href="forgotUsernamePassword.php">Forgot username or password?</a></div><!--Link to username/password reset page-->
		</div>

		<footer id="footerId">Don't have an account? Register <a href="registrationPage.php"><strong>here</strong></a></footer><!--Link to the registration page-->
	</form>
</body>
</html>

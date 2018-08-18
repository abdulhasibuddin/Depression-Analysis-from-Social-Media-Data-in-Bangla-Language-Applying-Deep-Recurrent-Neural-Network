<?php require 'resetAccount2.php';?><!--This line must be the first line of this file to be redirected to the next page by 'header()' function.-->
<?//----------------------------------------------------------------------------------------------------------------------------?>

<!--This file generates the reset account page front-end design::-->
<!DOCTYPE html>
<html>
<head>
	<title>Reset account</title>

	<!--CSS design::-->
	<style type="text/css">
		#textId{
			padding-left: 22%;
			color: indigo;
		}

		#tableId{
			width: 65%;
			height: 400px;
			background-color: #f2f2f2;
			margin-left: 250px;
			padding-top: 20px;
			padding-bottom: 5px;
			border-radius: 25px;
		}

		#td1{
			padding-left: 5%;
		}

		#td2{

		}

		#error
		{
			color: red;
		}

		#footerId{
			text-align: center;
			margin-top: 100px;
			padding-top: 5px;
			height: 25px;
			width: 100%;
			background-color: grey;
		}

		#inputId{
			height: 25px; 
			width: 50%; 
			border-radius: 3px;
		}

		#pass_message{
			font-size: x-small;
			font-style: oblique;
		}
	</style>

</head>

<body>
	<!--The following part needs to be loaded before the form section to use the variables declared and assigned in the file-->
	

	<?php 
		//Declaring necessary variables with certain messages to show the user about the different characteristics that the input password should have::[default color of the messages is blue]
	    $pass_size = "<div style='color: blue;'>*Password should be atleast 8 characters!</div>";
	    $pass_char_lower = "<div style='color: blue;'>*Password should contain atleast one lowercase character!</div>";
	    $pass_char_upper = "<div style='color: blue;'>*Password should contain atleast one uppercase character!</div>";
	    $pass_char_num = "<div style='color: blue;'>*Password should contain atleast one number!</div>";
	    $pass_char_spe = "<div style='color: blue;'>*No special character is permitted except (_)!</div>";
	?>


	<div style="color: blue; float: right;"><?php  echo $eMail; ?></div><br>
	<h4 id="textId">The account reset code has been sent to your email address. Use the code to reset your username and/or password.</h4>

	
	<!--'POST' method prevents data from exposing on the url bar-->
	<!--Don't use $_SERVER['PHP_SELF'] as it is vulnerable to Cross-Site Scripting(XSS)-->
	<!--If you have to use $_SERVER['PHP_SELF'], then use it as htmlspecialchars($_SERVER['PHP_SELF'])-->
	<form method="POST" action="" >
	
		<table id="tableId">
			<tr>
				<td id="td1">Student ID: </td>
				<td id="td2">
					<small><small style="color: blue;">* Only letters, numbers and underscore(_) allowed!</small></small><br>
					<input id="inputId" type="text" name="userName" value="<?php echo $stdId; ?>" required><!--Username input area-->
					<span id="error"><?php echo $stdIdErr; ?></span><!--Error messages related to username-->
				</td>
			</tr>
<?//---------------------------------------------------------------------------------------------------------------------------?>

			<tr>
				<td id="td1">Reset password: </td>
				<td id="td2">
					<input id="inputId" type="password" name="password" required><!--Password input area-->
					<span id="error"><?php echo $passwordErr; ?></span><!--Error messages related to password-->
				</td>
			</tr>
			<?//---------------------------------------------------------------------------------------------------------------?>

			<tr><td></td>
				<td>
					<span id="pass_message"><?php echo $pass_size; ?></span>
                    <span id="pass_message"><?php echo $pass_char_lower; ?></span>
                    <span id="pass_message"><?php echo $pass_char_upper; ?></span>
                    <span id="pass_message"><?php echo $pass_char_num; ?></span>
                    <span id="pass_message"><?php echo $pass_char_spe; ?></span>
				</td>
			</tr>
<?//---------------------------------------------------------------------------------------------------------------------------?>

			<tr>
				<td id="td1">Confirm password: </td>
				<td id="td2">
					<input id="inputId" type="password" name="conPassword" required><!--Confirmation password input area-->
					<span id="error"><?php echo $conPasswordErr; ?></span><!--Error messages related to confirmation password-->
				</td>
			</tr>
<?//---------------------------------------------------------------------------------------------------------------------------?>

			<tr>
				<td id="td1">Enter account reset code: </td>
				<td id="td2">
					<input id="inputId" type="text" name="resetCode" required><!--Account reset code input area-->
					<span id="error"><?php echo $resetCodeErr; ?></span><!--Error messages related to account reset code-->
				</td>
			</tr>
<?//---------------------------------------------------------------------------------------------------------------------------?>

			<tr>
				<td id="td1"><img src="captcha.php"></td><!--Captcha image area-->
				<td id="td2"> <span id="error"><?php echo $captchaErr; ?></span></td><!--Error messages related to captcha code-->
			</tr>
			<?//---------------------------------------------------------------------------------------------------------------?>

			<tr>
				<td id="td1">Enter Captcha: </td>
				<td id="td2"><input id="inputId" type="text" name="vercode" required/></td><!--Captcha code input area-->
			</tr>
<?//---------------------------------------------------------------------------------------------------------------------------?>

			<tr>
				<td></td>
				<td id="td2">
					<input type="submit" name="Submit" style="height: 40px; width: 80px; border-radius: 3px; margin-left: 34vh;">
				</td><!--Submit button-->
			</tr>
		</table>

		<footer id="footerId">Back to <a href="loginPage.php"><strong>login page</strong></a></footer><!--Link to the login page-->
	</form>
</body>
</html>

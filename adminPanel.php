<?php require 'adminPanel2.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
</head>
<body>
	<form>
		<div style="text-align: center; color: indigo;">
			<?php echo "Total ".$num_labelled_tweets." row(s) are labelled!"; ?>
		</div>
		<br>
		<div>
			<a href="authenticatedUser.php"><strong><-Back</strong></a>
		</div>
		<br>
		<footer id="footerId"><a href="logOut.php"><strong>Logout</strong></a></footer> <!--Log-out link-->
	</form>
</body>
</html>
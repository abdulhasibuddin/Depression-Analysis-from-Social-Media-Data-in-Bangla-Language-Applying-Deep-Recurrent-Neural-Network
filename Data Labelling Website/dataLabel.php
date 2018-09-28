<?php require 'dataLabel2.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Data Labeling</title>
</head>
<body style="font-size: xx-large;">
	<form method="post" action="">
		<br><br>

		<?php
		$rowcount = $result->num_rows;
		$_SESSION['rowcount'] = $rowcount;
		
		echo '<div style="text-align: center; color: blue;"><strong>'.$rowcount.' tweet(s) loaded!</strong></div><br>';
		if ($rowcount<=0) {
			echo '<div style="text-align: center; color: red;"><strong>No unlabelled tweet(s) found!</strong></div><br>';
		}

		if($rowcount > 0) {
			while ($row = $result->fetch_assoc()) {
				$tweet = $row['tweet'];
				$tweet_no = $row['tweet_id'];
				
				$string .=
				'
				<div>
					<label><strong>'.$tweet_no.'.</strong> "'.$tweet.'" <strong>- বাক্যটি-</strong></label>
				</div>
				<br>
				<div>
					<input type="radio" name="label'.$tweet_no.'" value="positive" style="margin-left: 20%; height:80px; width:80px;" required><strong>&nbsp;&nbsp;&nbsp;
					ভালো আবেগ প্রকাশ করে ।</strong>
					<br><br>
					<input type="radio" name="label'.$tweet_no.'" value="depressive" style="margin-left: 20%; height:80px; width:80px;"><strong>&nbsp;&nbsp;&nbsp;
					হতাশাব্যঞ্জক আবেগ প্রকাশ করে ।</strong>
					<br><br>
					<input type="radio" name="label'.$tweet_no.'" value="simple_negative" style="margin-left: 20%; height:80px; width:80px;"><strong>&nbsp;&nbsp;&nbsp;
					খারাপ কিন্তু হতাশাব্যঞ্জক নয় - এমন আবেগ প্রকাশ করে।</strong>
					<br><br>
					<input type="radio" name="label'.$tweet_no.'" value="unclassified_emotion" style="margin-left: 20%; height:80px; width:80px;" required><strong>&nbsp;&nbsp;&nbsp;
					আবেগ প্রকাশ করে, যা উপরের কোন শ্রেনীর অন্তর্ভুক্ত নয়।</strong>
					<br><br>
					<input type="radio" name="label'.$tweet_no.'" value="neutral" style="margin-left: 20%; height:80px; width:80px;"><strong>&nbsp;&nbsp;&nbsp;
					কোন আবেগ প্রকাশ করে না ।<strong>
					<br><br>
					<input type="radio" name="label'.$tweet_no.'" value="ambiguous" style="margin-left: 20%; height:80px; width:80px;"><strong>&nbsp;&nbsp;&nbsp;
					কোন ধরনের আবেগ প্রকাশ করে কি-না তা বোঝা যাচ্ছে না ।</strong>
					<br><br>
					<input type="radio" name="label'.$tweet_no.'" value="incomplete" style="margin-left: 20%; height:80px; width:80px;"><strong>&nbsp;&nbsp;&nbsp;অসম্পূর্ণ বাক্য ।</strong>
				</div>
				<div style="text-align: center;">---------- ---------- ----------<br><br></div>
				';
			}
			$_SESSION['tweet_no'] = $tweet_no;
		}
		echo $string;
		?>

		<input style="float: right; margin-right: 5%; padding: 1% 2%; font-size: xx-large;" type="submit" name="labels_submit" value="Submit">

		<br>
		<div style="font-size: xx-large;">
			<a href="authenticatedUser.php"><strong><-Back</strong></a>
		</div>
		<br><br>
		<footer id="footerId" style="font-size: xx-large;"><a href="logOut.php"><strong>Logout</strong></a></footer>
		<br><br><br><br>
	</form>
</body>
</html>

<?php require 'dataLabel2.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Data Labeling</title>
</head>
<body>
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
					<input type="radio" name="label'.$tweet_no.'" value="positive" required>পজেটিভ ।
					<br>
					<input type="radio" name="label'.$tweet_no.'" value="neutral">নিরপেক্ষ ।
					<br>
					<input type="radio" name="label'.$tweet_no.'" value="depressive">হতাশাব্যঞ্জক ।
					<br>
					<input type="radio" name="label'.$tweet_no.'" value="sim_negative">নেগেটিভ কিন্তু হতাশাব্যঞ্জক নয় ।
					<br>
					<input type="radio" name="label'.$tweet_no.'" value="ambiguous">দুর্বোধ্য ।
					<br>
					<input type="radio" name="label'.$tweet_no.'" value="incomplete">অসম্পূর্ণ ।
				</div>
				<div style="text-align: center;">---------- ---------- ----------<br><br></div>
				';
			}
			$_SESSION['tweet_no'] = $tweet_no;
		}
		echo $string;
		?>

		<input style="float: right; margin-right: 5%; padding: 1% 2%;" type="submit" name="labels_submit" value="Submit">

		<br>
		<div>
			<a href="authenticatedUser.php"><strong><-Back</strong></a>
		</div>
		<footer id="footerId"><a href="logOut.php"><strong>Logout</strong></a></footer>
	</form>
</body>
</html>

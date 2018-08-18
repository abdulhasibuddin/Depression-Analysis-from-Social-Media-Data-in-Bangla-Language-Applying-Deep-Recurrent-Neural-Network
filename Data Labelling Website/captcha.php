<?php
	//This file generates captcha image to display on webpages::
	session_start(); //Start session
	$height = 25; //Image height
	$width = 100; //Image width

	$image = imagecreate($width, $height); //Creating image area
	$back_color = imagecolorallocate($image, 255, 255, 255); //Allocating background of the image area

	//Generate random dots::
	$pixel_color = imagecolorallocate($image, 153, 153, 153); //Allocating color of the dots
	for ($i=0; $i<1000; $i++) { //Loopng thousand times to generate thousand dots on the image area
		imagesetpixel($image, rand(0, 100), rand(0, 35), $pixel_color); //Randomly generating horizontal and vertical position of each dot with allocated color
	}

	$text_color = imagecolorallocate($image, 0, 0, 0); //Allocating text color
	$font_size = 20; //Font size of the text

 	//Generating random code for captcha::
	$letters = '0123456789'; //String containing characters to be used to generate the captcha code [english letter can also be used]
	$len = strlen($letters); //Getting the length (i.e. total number of characters) of the string to be used
	$text = ''; //Declaring an empty variable to hold the randomly generated characters
	
	for ($i=0; $i<6; $i++) { //Looping 6 times to generate 6 characters long captcha code
		$text .= $letters[rand(0, $len - 1)]; //Appending every randomly generated character to the variable $text
	}
	//After the end of the looping, $text holds the randomly generated captcha code

	/*$image-> the image area to set the captcha code.
	 *$font_size-> font size of the captcha code.
	 *Next two numbers indicates the horizontal & vertical position of the captcha code on the image area.
	 *$text_color-> color of the captcha code string.
	*/
	imagestring($image, $font_size, 15, 5, $text, $text_color); //imagestring() draws the string(s) in the image identified by image with the upper-left corner at coordinates x , y (top left is 0, 0) in color column
	$_SESSION["vercode"] = $text; //Assigning the captcha string into the session, it is lately used to compare user captcha input

	imagejpeg($image); //Outputs a JPEG standard image
?>

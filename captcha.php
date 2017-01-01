<?php
session_start();
function generateCode($characters=4) {
	/* list all possible characters, similar looking characters and vowels have been removed */
	$possible = '23456789bcdghjkmnpqrstvwyz';
	$code = '';
	for ($i=0;$i < $characters;$i++) { 
		$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
	}          
	return $code;
}

function create($characters=4,$width='120',$height='35') {
        /*get random string */
		$code = generateCode($characters);
		$font = 'alam_font.ttf';
		
        /* font size will be 75% of the image height */
        $font_size = $height * 0.75;
        $image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
        
		/* set the colours */
        $background_color = imagecolorallocate($image, 220, 220, 220);
        $text_color = imagecolorallocate($image, 10, 30, 80);
        $noise_color = imagecolorallocate($image, 150, 180, 220);
        
		/* generate random dots in background */
        for( $i=0; $i<($width*$height)/3; $i++ ) {
                imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
        }
        
		/* generate random lines in background */
        for( $i=0; $i<($width*$height)/150; $i++ ) {
                imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
        }
        
		/* create textbox and add text */
        $textbox = imagettfbbox($font_size, 0, $font, $code) or die('Error in imagettfbbox function');
        $x = ($width - $textbox[4])/2;
        $y = ($height - $textbox[5])/2;
        $y -= 5;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');
        
		/* output captcha image to browser */
        header('Content-Type: image/jpeg');
        imagejpeg($image);
        imagedestroy($image);

        $_SESSION['alam_captcha']=$code;
    }
	
create();
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Captcha by Alam</title>
	</head>
	<body>
		<?php if($_POST): ?>
		<div style="background:#DDD;">
			<?php
				if($_POST['user']=='admin' 
				&& $_POST['password']=='admin' 
				&& $_POST['captcha']==$_SESSION['alam_captcha']){
					echo '<h2 style="color:green;">Logged in sussessfully.</h2>';
				}else{
					if($_POST['captcha']==$_SESSION['alam_captcha']){
						echo '<h2 style="color:red;">Invalid Username or Password.</h2>';
					}else{
						echo '<h2 style="color:red;">Wrong Captcha entered.</h2>';
					}
				}
			?>
		</div>
		<?php endif; ?>
		
		<form action method="POST">
			<label>Username</label>
			<input type="text" name="user" placeholder="admin" />
			<br />
			<label>Password</label>
			<input type="text" name="password" placeholder="admin" />
			<br /><br />
			<label>Enter captcha</label>
			<img alt="catcha" src="captcha.php" /><br>
			<input type="text" name="captcha" />
			<br /><br />
			<input type="submit" />
		</form>
	</body>
</html>
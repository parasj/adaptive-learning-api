<?php
include "lib/mysql.php";
include "lib/email.php";
if($_POST['submit']) {
	if (($_POST['user']=='')||($_POST['pass']=='')||($_POST['fname']=='')||($_POST['lname']=='')||($_POST['email']=='')) {
		$err = "<ul data-role='listview' data-theme='b'><li><span style='color:#e46657'><img src='img/icons/exclamation.png'> Required Field Empty</span></li></ul><br />";
	} else {
		// check no username exists
		$query = "SELECT * FROM user_login WHERE uname='".$_POST['user']."'";
		$result = mysql_query($query) or die(mysql_error());
		if(mysql_num_rows($result) == 0) {
			$query = "SELECT * FROM user_info WHERE email='".$_POST['email']."'";
			$result = mysql_query($query) or die(mysql_error());
			if(mysql_num_rows($result) == 0) {
				// No user exists
				// Validate Email
				if(validEmail($_POST['email']) == true) {
					// Valid Info
					$insert = "INSERT INTO user_login(uname,pword) VALUES ('".$_POST['user']."','".$_POST['pass']."')";
					mysql_query($insert);
					$insert = "INSERT INTO  user_info (fname,lname,email) VALUES ('".$_POST['fname']."',  '".$_POST['lname']."',  '".$_POST['email']."')";
					mysql_query($insert);
					// Redirect to Login Page
					header('Location: login.php');
				} else {
					// Email Invalid
					$err = "<ul data-role='listview' data-theme='b'><li><span style='color:#e46657'><img src='img/icons/exclamation.png'> Email invalid</span></li></ul><br />";
				}
			} else {
				// Email Exists
				$err = "<ul data-role='listview' data-theme='b'><li><span style='color:#e46657'><img src='img/icons/exclamation.png'> Email in use</span></li></ul><br />";
			}
		} else {
			// User Exists
			$err = "<ul data-role='listview' data-theme='b'><li><span style='color:#e46657'><img src='img/icons/exclamation.png'> Username exists</span></li></ul><br />";
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="apple-touch-icon" href="jm/images/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="jm/images/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="jm/images/apple-touch-icon-114x114.png" />
		<title>Radioactive - Register</title>
		<link rel="stylesheet" href="jm/valencia.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.js"></script>
	</head>
	<body>
		<div data-role="page" id="home" data-add-back-btn="true" data-theme="a">
			<div data-role="header" data-position="fixed">
				<h1>Register</h1>
				<a href="portal.php" data-icon="arrow-l" data-direction="reverse">Login</a>
			</div>
			
			<div data-role="content">
				<p>
					<form action="register.php" method="post">
						<span style="color:#e46657"><?=$err;?></span>
						<input type="text" name="user" placeholder="Username" x-webkit-speech speech value="<?=$_POST['user'];?>"/>
						<input type="password" name="pass" placeholder="Password"/>
						<hr />
						<input type="text" name="fname" placeholder="First Name" x-webkit-speech speech value="<?=$_POST['fname'];?>"/>
						<input type="text" name="lname" placeholder="Last Name" x-webkit-speech speech value="<?=$_POST['lname'];?>"/>
						<hr />
						<input type="text" name="email" placeholder="Email" x-webkit-speech speech value="<?=$_POST['email'];?>"/>
						<input type="submit" value="Register" name="submit" data-theme="b"/>
					</form>
				</p>
			</div>
			
			<div data-role="footer">
				<h4>Radioactive</h4>
			</div>
		</div>
	</body>
</html>
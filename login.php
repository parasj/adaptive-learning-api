<?php
include "lib/mysql.php";
$ref=false;
if (isset($_GET['logout'])) {
	setcookie("uid", "", time()-3600);
	$ref=true;
}
if (isset($_COOKIE["uid"]) && $ref == false) {
	header('Location: portal.php');
}
if($_POST['submit']) {
	// check login data
	$query = "SELECT * FROM user_login WHERE uname='".$_POST['user']."' AND pword='".$_POST['pass']."'";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result)==1) {
		// redirect to portal
		session_start();
		$user = mysql_fetch_array($result);
		setcookie("uid", $user['id'], time()+3600);
		header('Location: portal.php');
	} else {
		// error
		$err = "<ul data-role='listview' data-theme='b'><li><span style='color:#e46657'><img src='img/icons/exclamation.png'> Incorrect username or password - please try again</span></li></ul><br />";
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
		<title>Radioactive - Login</title>
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="jm/valencia.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.js"></script>
	</head>
	<body>
		<div data-role="page" id="home" data-theme="a">
			<div data-role="header" data-position="fixed">
				<h1>Login</h1>
			</div>
			
			<div data-role="content">
				<p>
					<form action="login.php" method="post">
						<?=$err;?>
						<input type="text" name="user" placeholder="Username" x-webkit-speech speech />
						<input type="password" name="pass" placeholder="Password"/>
						<input type="submit" value="Login" name="submit" data-theme="a"/>
						<a href="register.php" data-role="button" data-theme="b">Register Me</a>
					</form>
				</p>
			</div>
			
			<div data-role="footer">
				<h4>Radioactive</h4>
			</div>
		</div>
	</body>
</html>
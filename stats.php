<?php
include "lib/mysql.php";
include "lib/user.php";

if(!(isset($_COOKIE['uid']))) {
	header('Location: login.php');
}

$query = "SELECT * FROM  `test_scores` WHERE uid = '".$_COOKIE['uid']."'";
$result = mysql_query($query);
$qans = mysql_num_rows($result);

$query = "SELECT * FROM  `test_scores` WHERE uid = '".$_COOKIE['uid']."' AND tries = 1";
$result = mysql_query($query);
$qans_corr = mysql_num_rows($result);

$avg = 0;
while($row = mysql_fetch_array($result)) {
	$avg = $avg+$row['difficulty'];
}
if ($qans == 0) {
	$qans_valid=1;
} else {
	$qans_valid=$qans;
}
$avg = $avg/$qans_valid
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
		<title>Radioactive - Portal</title>
		<link rel="stylesheet" href="jm/valencia.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.js"></script>
	</head>
	<body>
		<div data-role="page" id="home" data-theme="a">
			<div data-role="header" data-position="fixed">
				<a href="portal.php" data-icon="arrow-l" data-direction="reverse">Portal</a>
				<h1>Biology Statistics</h1>
				<a href="login.php?logout" data-icon="delete" class="ui-btn-right">Logout</a>
			</div>
			
			<div data-role="content">
				<ul data-role="listview" data-inset="true"> 
					<li data-role="list-divider">Statistics</li>
					<li>Questions Answered: <?=$qans;?></li>
					<li>Questions Correct: <?=$qans_corr;?></li>
					<li>Your Difficulty Rating: <?=$avg;?></li>
				</ul> 
			</div>
			
			<div data-role="footer">
				<h4>Radioactive</h4>
			</div>
		</div>
	</body>
</html>
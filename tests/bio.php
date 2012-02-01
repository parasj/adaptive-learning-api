<?php
include "../lib/mysql.php";
include "../lib/user.php";

if(!(isset($_COOKIE['uid']))) {
	header('Location: login.php');
}

if (isset($_GET['q'])) {
	// Grade Response
	if ($_GET['a'] == $_GET['ac']) {
		// Correct Answer, enter in database
		$resp = "<li style='color:#0A0'><img src='../img/icons/accept.png' class='ui-li-icon' style='position:absolute;margin:auto;'> Good Job!</li>";

		$query = "INSERT INTO  `radioactive`.`test_scores` (`uid` ,`subject` ,`qid` ,`difficulty` ,`tries` ,`time`) VALUES ('".$_COOKIE['uid']."',  '1', '".$_GET['q']."',  '".$_GET['diff']."',  '".$_GET['tries']."', CURRENT_TIMESTAMP);
";
		mysql_query($query);
		$tries = 1;
	} else {
		$tries = $_GET['tries']+1;
		$resp = "<li style='color:#e46657'><img src='../img/icons/exclamation.png' class='ui-li-icon' style='position:absolute;margin:auto;'>Close! Try again.</li>";
	}
} else {
	$tries = 1;
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
		<title>Radioactive - Portal</title>
		<!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.css" /-->
		<link rel="stylesheet" href="../jm/valencia.css" />
		<link rel="stylesheet" href="../css/style.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.js"></script>
	</head>
	<body>
		<?php

		$query = "SELECT qid FROM test_scores WHERE subject='1' AND uid='".$_COOKIE['uid']."' ORDER BY qid DESC";
		$result = mysql_query($query);
		$qans_corr = mysql_num_rows($result);
		if(mysql_num_rows($result)==0){
			$id = 1;
		} else {
			$row = mysql_fetch_array($result);
			$id = $row['qid']+1;
		}

		$query = "SELECT * FROM  `questiondb_bio` WHERE id = '".$id."'";
		$result = mysql_query($query);
		$qans_corr = mysql_num_rows($result);

		if (mysql_num_rows($result) == 0) {
			// No Questions or all Questions Finished
		?>

		<div data-role="page" id="home" data-theme="a">
			<div data-role="header" data-position="fixed">
				<a href="../test.php" data-icon="arrow-l" data-direction='reverse'>Testing</a>
				<h1>Biology</h1>
				<a href="../login.php?logout" data-icon="delete" class="ui-btn-right">Logout</a>
			</div>
			
			<div data-role="content">
				<p>
					<ul data-role='listview' data-theme='b'>
						<?=$resp;?>
						<li>You finished all questions! Try another subject or check out your statistics back at the portal.</li>
				</p>
			</div>
			
			<div data-role="footer">
				<h4>Radioactive</h4>
			</div>
		</div>
	</body>
</html>

		<?
		} else {
			// Handle Questions like Normal
			while($row = mysql_fetch_array($result)) {
				$question = $row['question'];
				$ans[a] = $row['ans_a'];
				$ans[b] = $row['ans_b'];
				$ans[c] = $row['ans_c'];
				$ans[d] = $row['ans_d'];
				$ans_corr = $row['ans_correct'];
				$difficulty = $row['difficulty'];
			}
		?>
			<div data-role="page" id="home" data-theme="a">
				<div data-role="header" data-position="fixed">
					<a href="../test.php" data-icon="arrow-l" data-direction='reverse'>Testing</a>
					<h1>Biology - Q #<?=$id;?></h1>
					<a href="../login.php?logout" data-icon="delete" class="ui-btn-right">Logout</a>
				</div>
				<center><div data-role="controlgroup" data-type="horizontal">
					<?
					/*
					$n1 = $n-1;
					$n2 = $n+1; 
					if($n != "0") {
						echo "<a href='bio.php?q=astro&n=$n1' data-icon='arrow-l' data-direction='reverse' data-role='button'>Prev. Q</a>";
					}
					if($n != ($tq-1)) {
						echo "<a href='bio.php?q=astro&n=$n2' data-icon='arrow-r' class='ui-btn-right' data-role='button' data-iconpos='right'>Next Q</a>";
					}
					*/
					?>
				</div></center>
				<?
				$a = $ans_corr;
				echo "<ul data-role='listview' data-theme='b'>";
				if (isset($resp)) {
					echo "$resp";
				}
				echo "<li>".$question."</li>";
				echo "<ol type='A'></ul>";
				foreach($ans as $key => $value) {
					echo "<a href='bio.php?q=$id&a=$key&ac=$ans_corr&tries=$tries&diff=$difficulty' data-role='button' style='white-space:normal'>".strtoupper($key).". $value</a>";
				}
				echo "</ol>";
				?>
				<!--div data-role="footer">
					<h4>Radioactive</h4>
				</div--	>
			</div>
		</body>
	</html>
<?
	}
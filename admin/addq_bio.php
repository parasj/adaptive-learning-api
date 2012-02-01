<?php
include "../lib/mysql.php";
include "../lib/email.php";
if($_POST['submit']) {
	if ($_POST['ans_c']=='') $_POST['ans_c'] = 'N/A';
	if ($_POST['ans_d']=='') $_POST['ans_d'] = 'N/A';
	if (!(($_POST['question']=='')||($_POST['ans_a']=='')||($_POST['ans_b']=='')||($_POST['ans_c']=='')||($_POST['ans_d']=='')||($_POST['a_corr']=='')||($_POST['diff']==''))) {
		$query = "INSERT INTO  `radioactive`.`questiondb_bio` (`question` ,`ans_a` ,`ans_b` ,`ans_c` ,`ans_d` ,`ans_correct` ,`difficulty`) VALUES ('".$_POST['question']."',  '".$_POST['ans_a']."',  '".$_POST['ans_b']."',  '".$_POST['ans_c']."',  '".$_POST['ans_d']."',  '".$_POST['a_corr']."',  '".$_POST['diff']."')";
		if(mysql_query($query)) {
			$err = "<ul data-role='listview' data-theme='b'><li style='color:#0A0'><img src='../img/icons/accept.png' class='ui-li-icon' style='position:absolute;margin:auto;'> Success!</li></ul><br>";
		}	
	} else {
		$err = "<ul data-role='listview' data-theme='b'><li style='color:#0A0'><img src='../img/icons/exclamation.png' class='ui-li-icon' style='position:absolute;margin:auto;'> Field Empty!</li></ul><br>";
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
		<title>Radioactive Admin - Enter Question in Biology</title>
		<link rel="stylesheet" href="../jm/valencia.css" />
		<link rel="stylesheet" href="../css/style.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.js"></script>
	</head>
	<body>
		<div data-role="page" id="home" data-add-back-btn="true" data-theme="a">
			<div data-role="header" data-position="fixed">
				<h1>Admin - Enter Question for Biology</h1>
				<a href="portal.php" data-icon="arrow-l" data-direction="reverse">Login</a>
			</div>
			
			<div data-role="content">
				<p>
					
					<form action="addq_bio.php" method="post">
						<span style="color:#e46657"><?=$err;?></span>
						<input type="text" name="question" placeholder="Question" x-webkit-speech speech value="<?=$_POST['question'];?>"/>
						<input type="text" name="ans_a" placeholder="Option A" x-webkit-speech speech value="<?=$_POST['ans_a'];?>"/>
						<input type="text" name="ans_b" placeholder="Option B" x-webkit-speech speech value="<?=$_POST['ans_b'];?>"/>
						<input type="text" name="ans_c" placeholder="Option C" x-webkit-speech speech value="<?=$_POST['ans_c'];?>"/>
						<input type="text" name="ans_d" placeholder="Option D" x-webkit-speech speech value="<?=$_POST['ans_d'];?>"/>
						<div data-role="fieldcontain">
						    <fieldset data-role="controlgroup" data-type="horizontal">
						    	<legend>Correct Answer:</legend>
						         	<input type="radio" name="a_corr" id="radio-choice-1" value="a" checked="checked" />
						         	<label for="radio-choice-1">A</label>

						         	<input type="radio" name="a_corr" id="radio-choice-2" value="b"  />
						         	<label for="radio-choice-2">B</label>

						         	<input type="radio" name="a_corr" id="radio-choice-3" value="c"  />
						         	<label for="radio-choice-3">C</label>

						         	<input type="radio" name="a_corr" id="radio-choice-4" value="d"  />
						         	<label for="radio-choice-4">D</label>
						    </fieldset>
							<div data-role="fieldcontain">
								<label for="slider">Difficulty:</label>
							 	<input type="range" name="diff" id="diff" value="1" min="1" max="10"  />
							</div>
						</div>
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
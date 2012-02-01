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
	<title>Radioactive</title>
	<link rel="stylesheet"  href="jm/valencia.css" />
	<script src="jm/jquery-1.6.1.min.js"></script>
	<script src="jm/jquery.mobile-1.0b1.min.js"></script>
</head>
<body>
<?php
$n = $_GET['n'];
if ($_GET['q'] == "astro") {
	$q = array(
		 0 => array("q" => "Inflation began at ______ seconds after the Big Bang", "a" => array("10^-35", "10^-24"), "s" => 0),
		 1 => array("q" => "A galaxy is RED SHIFTED if it is:", "a" => array("moving toward us", "not moving", "moving away from us"), "s" => 2)
		 );
} elseif ($_GET['q'] == "bio") {
	$q = array(
		 0 => array("q" => "Which of the following describes the major difference between
bryophytes (pron: bry-oh-fites) and tracheophytes (pron: tray-key-o-fites)?", "a" => array("tracheophytes can survive on land", "tracheophytes have seeds inside fruits", "tracheophytes can make their own food", "tracheophytes have vessels to transport material"), "s" => 0),
		 1 => array("q" => "A galaxy is RED SHIFTED if it is:", "a" => array("moving toward us", "not moving", "moving away from us"), "s" => 2)
		 );
} elseif ($_GET['q'] == "chem") {
	$q = array(
		 0 => array("q" => "Inflation began at ______ seconds after the Big Bang", "a" => array("10^-35", "10^-24"), "s" => 0),
		 1 => array("q" => "A galaxy is RED SHIFTED if it is:", "a" => array("moving toward us", "not moving", "moving away from us"), "s" => 2)
		 );
}

$tq = count($q);
?>
<div data-role="page" data-theme="a" id="home">

	<div data-role="header">
		<?
		$n1 = $n-1;
		$n2 = $n+1; 
		if($n != "0") {
			echo "<a href='genq.php?q=astro&n=$n1' data-icon='arrow-l' data-direction='reverse'>Prev. Q</a>";
		}
		?>
		<h1>Radioactive - Q #<?=$n+1;?></h1>
		<? 
		if($n != ($tq-1)) {
			echo "<a href='genq.php?q=astro&n=$n2' data-icon='arrow-r' class='ui-btn-right'>Next Q</a>";
		}
		?>
	</div><!-- /header -->
		<div data-role="content">
<?php 
if ($_GET['q'] == "astro") {
	$a = $q_astro[0]["s"];
	echo "<p><b>".$q_astro[0]["q"]."</b><p><ol type='A'>";
	foreach($q_astro[$n]['a'] as $value) {
		echo "<li>".$value."</li>";
	}
	echo "</ol>
		<div data-role='collapsible' data-collapsed='true'>
		<h3>Answer</h3>
		".$q_astro[$n]["a"][$a]."
		</div>";
}

?>
	</div><!-- /content -->

</body>
</html>
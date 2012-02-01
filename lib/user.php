<?
// user.php
// base user funcs

include "mysql.php";

function checklogin($user, $pass) {
	$result = mysql_query("SELECT * FROM user_login WHERE uname='$user' AND pword='$pass'");
	if(mysql_num_rows($result)==1) {
		return true;
	} else {
		return false;
	}
}

function getfname($uid) {
	$result = mysql_query("SELECT * FROM user_info WHERE id='$uid'");
	$user = mysql_fetch_array($result);
	return $user['fname'];
}
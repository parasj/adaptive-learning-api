<?php

$dbinfo_path = "dbinfo.dat";
$dbinfo_path_1 = "../dbinfo.dat";
$dbinfo_path_2 = "../../dbinfo.dat";

if (file_exists($dbinfo_path)) {
    $handle = fopen($dbinfo_path, "r");
    $dbinfo = fread($handle, filesize($dbinfo_path));
    fclose($handle);
    $mysql = json_decode($dbinfo, true);
} elseif (file_exists($dbinfo_path_1)) {
	$handle = fopen($dbinfo_path_1, "r");
    $dbinfo = fread($handle, filesize($dbinfo_path_1));
    fclose($handle);
    $mysql = json_decode($dbinfo, true);
} elseif (file_exists($dbinfo_path_2)) {
    $handle = fopen($dbinfo_path_2, "r");
    $dbinfo = fread($handle, filesize($dbinfo_path_2));
    fclose($handle);
    $mysql = json_decode($dbinfo, true);
} else {
    $mysql['server'] = "localhost";
    $mysql['username'] = "root";
    $mysql['password'] = "";
    $mysql['database'] = "radioactive";
}

mysql_connect($mysql['server'], $mysql['username'], $mysql['password']) or die(mysql_error());
mysql_select_db($mysql['database']) or die(mysql_error());

?>
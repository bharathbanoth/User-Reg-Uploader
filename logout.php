<?php
	require_once("db.php");
	mysql_connect($dbURL, $user, $pass);
	mysql_select_db("NoteshareLogin");
	mysql_query("DELETE FROM Sessions WHERE sesID='".$_COOKIE['SesID']."'");
	setcookie("SesID", "", time()-86400);
	header('Location: index.php?lo');
	die();
?>

<?php
	require_once("db.php");
	$username=mysql_real_escape_string($_POST['username']);
	$password=mysql_real_escape_string($_POST['password']);
	mysql_connect($dbURL, $user, $pass);
	mysql_select_db("NoteshareLogin");
	$q=mysql_query("SELECT passwordHash FROM Users WHERE username='".$username."'");
	if(mysql_num_rows($q)>0)
	{
		$res=mysql_fetch_row($q);
		$dbpass=$res[0];
	}
	else
		$dbpass="";
	if(md5($password)==$dbpass)
	{
		$sesID=md5(mt_rand());
		mysql_query("INSERT INTO Sessions VALUES('".$username."', '".$sesID."')");
		setcookie("SesID", $sesID, time()+86400);
		header('Location: home.php');
		die();
	}
	else
	{
		header('Location: index.php?wc');
		die();
	}
?>

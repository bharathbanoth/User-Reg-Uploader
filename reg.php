<?php
	require_once("db.php");
	$username=mysql_real_escape_string($_POST['username']);
	$password=mysql_real_escape_string($_POST['password']);
	$email=mysql_real_escape_string($_POST['email']);
	$name=mysql_real_escape_string($_POST['name']);
	mysql_connect($dbURL, $user, $pass);
	mysql_select_db("NoteshareLogin");
	$q=mysql_query("SELECT * FROM Users WHERE username='".$username."' OR email='".$email."'");
	if(mysql_num_rows($q)==0)
	{
		$sesID=md5(mt_rand());
		mysql_query("INSERT INTO Sessions VALUES('".$username."', '".$sesID."')");
		setcookie("SesID", $sesID, time()+86400);
		mysql_query("INSERT INTO Users VALUES('".$name."', '".$username."', '".md5($password)."', '".$email."')");
		header('Location: home.php');
		die();
	}
	else
	{
		header('Location: index.php');
		die();
	}
?>

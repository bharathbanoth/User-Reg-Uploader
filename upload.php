<?php
	require("db.php");
	mysql_connect($dbURL, $user, $pass);
	mysql_select_db("NoteshareLogin");
	$sesID=$_COOKIE["SesID"];
	$q=mysql_query("SELECT ID FROM Sessions WHERE sesID='".mysql_real_escape_string($sesID)."'");
	$res=mysql_fetch_row($q);
	mkdir("files/".$res[0]);
	$fpath="files/".$res[0]."/".basename($_FILES["loc"]["name"]);
	if(basename($_FILES["loc"]["name"])=="")
	{
		header('Location: home.php?nf');
		die();
	}
	if (file_exists($fpath))
	{
		header('Location: home.php?fe');
		die();
	}
    if (move_uploaded_file($_FILES["loc"]["tmp_name"], $fpath))
	{
		mysql_query("INSERT INTO Files VALUES('".$res[0]."', '".$fpath."', '".md5($res[0].":".$fpath)."')");
		header('Location: home.php?suc&fn='.basename($_FILES["loc"]["name"]));
		die();
	}
    else
	{
		header('Location: home.php?se');
		die();
	}
?>

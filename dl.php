<?php
	require_once("db.php");
	mysql_connect($dbURL, $user, $pass);
	mysql_select_db("NoteshareLogin");
	$q=mysql_query("SELECT loc FROM Files WHERE fhash='".mysql_real_escape_string($_GET['h'])."'");
	$res=mysql_fetch_row($q);
	$file=$res[0];

	if(file_exists($file))
	{
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename='.basename($file));
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    readfile($file);
	    exit;
	}
?>

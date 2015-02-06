<?php
	function p($s)
	{
		print $s;
		print "\xA";
	}

	function isValidSesID()
	{
		if(!isset($_COOKIE["SesID"]))
			return 0;
		$sesID=$_COOKIE["SesID"];
		require("db.php");
		mysql_connect($dbURL, $user, $pass);
		mysql_select_db("NoteshareLogin");
		$q=mysql_query("SELECT ID FROM Sessions WHERE sesID='".mysql_real_escape_string($sesID)."'");
		return mysql_num_rows($q);
	}

	function getTitle()
	{
		if(isset($_COOKIE["SesID"]))
		{
			if(isValidSesID($_COOKIE["SesID"])>0)
				return "Welcome";
		}
		return "Login or create an account";
	}

	function pHeader($t)
	{
		p('<html>');
		p('<title>'.$t.'</title>');
		p('<div id="title" align="center"><b><a href="index.php"><font size="+3" color="#4d90fe">FileUpload</font></a><b></div>');
		p('<link rel="stylesheet" type="text/css" href="style.css">');
	}

	function pFooter()
	{
		p('</html>');
	}
?>

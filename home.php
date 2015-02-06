<?php
	require_once("db.php");
	require_once("include.php");
	mysql_connect($dbURL, $user, $pass);
	mysql_select_db("NoteshareLogin");
	if(isValidSesID()>0)
		$sesID=$_COOKIE["SesID"];
	else
	{
		setcookie("SesID", "", time()-86400);
		header('Location: index.php?wc');
		die();
	}
	$q=mysql_query("SELECT ID FROM Sessions WHERE sesID='".mysql_real_escape_string($sesID)."'");
	$res=mysql_fetch_row($q);
	$username=$res[0];
	$q=mysql_query("SELECT name, email FROM Users WHERE username='".$username."'");
	$res=mysql_fetch_row($q);
	$name=$res[0];
	$email=$res[1];
	pHeader("Welcome");
?>

<div id="regForm" align="center">
	<br />
	Welcome back <b><?php print $name ?></b>!<br /><br />
	(<?php print $username ?>)<br />(<?php print $email ?>)
	<br /><br />
	<form action='logout.php' method="POST">
		<input type="submit" value="Logout">
	</form>
</div>

<div id="loginForm" align="center">
	Upload a file<br /><br />
	<form action="upload.php" method="POST" enctype="multipart/form-data">
	    <input type="file" name="loc"><br /><br />
	    <input type="submit" value="Upload">
	    <br /><br /><font size="-2">Note: Max file size is 2 MB. Change this in <b>php.ini</b></font>
	</form>
</div>

<div id="cenText">
	<br />&nbsp; Your files:<br />
	<?php
		$q=mysql_query("SELECT fhash, loc FROM Files WHERE username='".$username."'");
		if(mysql_num_rows($q)>0)
		{
		    while($row=mysql_fetch_array($q))
		    {
		    	print("&nbsp; &nbsp; &nbsp; &nbsp; <a href=dl.php?h=".$row[0]." title='".basename($row[1])."'>".substr(basename($row[1]), 0, 30))	;
		    	if(strlen(basename($row[1]))>30)
		    		print("...");
		    	print("</a><br />");
		    }
		}
	?>
	<br />
</div>

<div id='notif' align='center'>
<?php
	if(isset($_GET['fe']))
		print '<font color="red" size="-1"><b>A file with the same name already exists.</b></font>';
	if(isset($_GET['nf']))
		print '<font color="red" size="-1"><b>Please upload a valid file</b></font>';
	if(isset($_GET['se']))
		print '<font color="red" size="-1"><b>An error occured.</b></font>';
	if(isset($_GET['suc']))
		print '<font color="green" size="-1"><b>'.$_GET['fn'].' was successfully uploaded.</b></font>';
?>
</div>

<?php
	pFooter();
?>

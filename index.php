<?php
	require_once("include.php");
	if(isValidSesID()>0)
	{
		header('Location: home.php');
		die();
	}
	pHeader(getTitle());
?>

<div id="loginForm" align="center">
	<br />
	Login with an existing account
	<br /><br />
	<form action="login.php" method="POST">
		<input type="text" name="username" placeholder="Username" length="20%"><br /><br />
		<input type="password" name="password" placeholder="Password"><br /><br />
		<input type="submit" value="Login"><br /><br />
	</form>
</div>

<div id="regForm" align="center">
	<br />
	Create a new account
	<br /><br />
	<form action="reg.php" method="POST">
		<input type="text" name="name" placeholder="Name"><br /><br />
		<input type="text" name="username" placeholder="Username"><br /><br />
		<input type="password" name="password" placeholder="Password"><br /><br />
		<input type="password" name="passworda" placeholder="Password again"><br /><br />
		<input type="text" name="email" placeholder="Email Address"><br /><br />
		<input type="submit" value="Register"><br /><br />
	</form>
</div>

<div id="cenText" align="center">
	<br /><b>Login or Register to continue</b><br /><br />
</div>

<div id='notif' align='center'>
<?php
	if(isset($_GET['wc']))
		print '<font color="red" size="-1"><b>Wrong username or password</b></font>';
	if(isset($_GET['lo']))
		print '<font color="green" size="-1"><b>Logged out successfully</b></font>';
?>
</div>

<?php
	pFooter();
?>

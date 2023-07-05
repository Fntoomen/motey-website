<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login/Register</title>
		<link rel="stylesheet" href="login.css" type="text/css">
		<link rel="icon" type="image/png" href='favicon.png'/>
	</head>
    <body>
	<div class="menu">
	    <form action="login-action.php" method="post" enctype="multipart/form-data">
		<div style="position: absolute; left: 5%; bottom: 5%; width: 90%;">
				    <input class="button" style="width: 100%; font-size: 150%; background-color: rgb(0, 48, 37);" type="submit" value="Login/Register">
		</div>
		<div style="position: absolute; left: 5%; bottom: 39%; width: 90%;">
		    <input style="width: 97%; font-size: 150%;" class="input" type="password" placeholder="Password" name="password">
		</div>
		<div style="position: absolute; left: 5%; bottom: 73%; width: 90%;">
		    <input style="width: 97%; font-size: 150%;" class="input" type="text" placeholder="Username" name="username">
		</div>
	    </form>
	</div>
<?php
session_start();
if(isset($_SESSION["error"]))
{
	unset($_SESSION["error"]);
	echo '<span style="color:red">Incorrect login or password</span>';
}
?>
    </body>
</html>

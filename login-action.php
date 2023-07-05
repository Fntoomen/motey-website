<?php
session_start();
require_once "config.php";
$conn = @new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($conn->connect_errno!=0)
{
	echo "There was an error";
}
else
{
	$login = $_POST['username'];
	$password = $_POST['password'];
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	$stmt = $conn->prepare("SELECT password FROM users WHERE login=?");
	$stmt->bind_param("s", $login);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows==0)
	{
		$stmt = $conn->prepare("INSERT INTO users (login, password) VALUES (?, ?)");
		$stmt->bind_param("ss", $login, $hashed_password);
		$stmt->execute();
		$_SESSION["username"] = $login;
		header('Location: index.php'); 
	}
	else
	{
		$row = $result->fetch_assoc();
		if(password_verify($password, $row['password']))
		{
			$_SESSION["username"] = $login;
			header('Location: index.php');
		}
	}

	$result->free_result();
	$_SESSION["error"] = true;
	unset($_SESSION["username"]);
	header('Location: login.php');
	$conn->close();
}
?> 

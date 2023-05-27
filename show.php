<?php

$username = "root";
$password = "passwd";
$dbname = "emotebot";


$conn = new mysqli("localhost", $username, $password, $dbname);
$sql = "SELECT image FROM emotes WHERE image_id=0";
$result = mysqli_query($conn, $sql);
header("Content-type: image/jpeg");
echo $result->fetch_row()[0] ?? false;

?>

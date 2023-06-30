<?php
chdir(__DIR__);

const DB_HOSTNAME = "localhost";
const DB_USERNAME = "root";
const DB_PASSWORD = "passwd";
const DB_NAME = "emote";

$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sql = "SELECT * FROM emotes;";
$result = mysqli_query($conn, $sql);

echo "<table>
	<tr>
	<th>Name</th>
	<th>Emote</th>
	</tr>";
while($row = mysqli_fetch_assoc($result)) {
	echo sprintf("<tr>
		<td><strong>%s</strong></td>
		<td><img src='%s' style='max-width:100px;width:100%%'></td>
		</tr>", $row['name'], $row['location']);
}
echo "</table>";

$conn -> close();
?>

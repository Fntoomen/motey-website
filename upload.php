<?php
const MAX_FILE_SIZE = 5000000; # 5MB

const DB_HOSTNAME = "localhost";
const DB_USERNAME = "root";
const DB_PASSWORD = "passwd";
const DB_NAME = "emotebot";

const EMOTE_NAME = $_POST["emotename"];
const TARGET_DIR = "emotes/";
const FILE_EXTENSION = strtolower(pathinfo($_FILES["emote"]["name"], PATHINFO_EXTENSION));
const TARGET_FILE = TARGET_DIR . EMOTE_NAME . FILE_EXTENSION;
const TMP_FILE = $_FILES["emote"]["tmp_name"];
const FILE_SIZE = $_FILES["emote"]["size"];


$required = array(EMOTE_NAME, TARGET_FILE);
foreach($required as $field) {
	if (empty($field)) {
		die(nl2br("\nYou need to fill all the fields."));
	}
}

// Check if image file is a actual image or fake image
if($check == getimagesize(TMP_FILE)) {
	die(nl2br("\nFile is not an image or gif."));
}

// Check if file already exists
if (file_exists(TARGET_FILE)) {
	die(nl2br("\nFile name already exists.")); // You should also configure the database so that the name and location fields are unique
}

// Check file size
if (FILE_SIZE > MAX_FILE_SIZE) {
	die(nl2br("\nFile is too large. Max file size is 5MB."));
}

// Allow certain file formats
if(FILE_EXNTENSION != "jpg" && FILE_EXNTENSION != "png" && FILE_EXNTENSION != "jpeg"
&& FILE_EXNTENSION != "gif" && FILE_EXNTENSION != "webp") {
	die(nl2br("\nOnly WEBP, JPG, JPEG, PNG & GIF extensions are allowed."));
}

if (move_uploaded_file(TMP_FILE, TARGET_FILE)) {
	echo nl2br("\nEmote has been uploaded.");
	echo sprintf("<br><img src='%s'>", TARGET_FILE);
} else {
	die(nl2br("\nThere was an error."));
}

$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

$conn->set_charset("utf8mb4");
$stmt = $conn->prepare("INSERT INTO emotes (name, location) VALUES (?, ?)");
$stmt->bind_param("ss", EMOTE_NAME, TARGET_FILE);
$stmt->execute();
$stmt->close();

$conn -> close();
?>

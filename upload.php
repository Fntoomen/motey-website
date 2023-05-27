<?php

$target_dir = "emotes/";
$target_file = $target_dir . basename($_FILES["emote"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["emote"]["tmp_name"]);
  if($check !== false) {
    echo "\nFile is an emote - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "\nFile is not an emote.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "\nSorry, emote with this name already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["emote"]["size"] > 5000000) {
  echo "\nSorry, your emote is too large. Max size emote is 5MB";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "\nSorry, only JPG, JPEG, PNG & GIF emotes are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "\nSorry, your emote was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["emote"]["tmp_name"], $target_file)) {
    echo "\nThe file ". htmlspecialchars( basename( $_FILES["emote"]["name"])). " has been uploaded.";
  } else {
    echo "\nSorry, there was an error uploading your file.";
  }
}



$username = "root";
$password = "passwd";
$dbname = "emotebot";

$conn = new mysqli("localhost", $username, $password, $dbname);
$sql = sprintf("INSERT INTO emotes
    (name, location)
    VALUES
    ('%s', '%s')",
    $conn -> mysqli_real_escape_string( $_POST['emotename'] ),
    $conn -> mysqli_real_escape_string( $target_file ),
    );

if ( $conn -> query( $sql ) === TRUE ) {
  echo "\nNew emote created successfully";
} else {
  echo "\nError: " . $sql . "<br>" . $conn->error;
}


$conn -> close();

?>

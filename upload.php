<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["userfile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["userfile"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["userfile"]["size"] > 4294967295) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["userfile"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

$username = "root";
$password = "passwd";
$dbname = "emotebot";

$imgData = file_get_contents($target_file);

$conn = new mysqli("localhost", $username, $password, $dbname);
$sql = sprintf("INSERT INTO emotes
    (image_type, image, image_size, image_name)
    VALUES
    ('%s', '%s', '%d', '%s')",
    /***
     * For all mysqli_ functions below, the syntax is:
     * mysqli_whartever($link, $functionContents);
     ***/
    mysqli_real_escape_string($conn, $imageFileType),
    mysqli_real_escape_string($conn, $imgData),
    $_FILES["userfile"]["size"],
    mysqli_real_escape_string($conn, basename($_FILES["userfile"]["name"]))
    );

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>

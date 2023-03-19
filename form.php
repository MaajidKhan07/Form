<?php
// Get the form inputs
$name = $_POST['name'];
$contact = $_POST['contact'];
$location = $_POST['location'];
$picture = $_FILES['picture']['name'];

// Connect to the MySQL database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Insert the form inputs into the database
$sql = "INSERT INTO animal_rescue (name, contact, location, picture)
        VALUES ('$name', '$contact', '$location', '$picture')";

if (mysqli_query($conn, $sql)) {
  echo "Record added successfully.";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Upload the picture to the server
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);

if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
  echo "The file " . basename($_FILES["picture"]["name"]) . " has been uploaded.";
} else {
  echo "Sorry, there was an error uploading your file.";
}

mysqli_close($conn);
?>

//2nd 

<?php
// Define database connection variables
$host = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form inputs
  $name = $_POST["name"];
  $contact = $_POST["contact"];
  $location = $_POST["location"];

// Upload image file to server
$target_dir = "uploads/";
$target_file = $target_dir . basename($image);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false) {
$uploadOk = 1;
} else {
echo "File is not an image.";
$uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
echo "Sorry, file already exists.";
$uploadOk = 0;
}

// Check file size
if ($_FILES["image"]["size"] > 5000000) {
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
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
// Insert form data into database
$sql = "INSERT INTO animals (name, contact, location, image)
VALUES ('$name', '$contact', '$location', '$image')";
if (mysqli_query($conn, $sql)) {
echo "New record created successfully.";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
} else {
echo "Sorry, there was an error uploading your file.";
}
}

// Close database connection
mysqli_close($conn);
}
?>
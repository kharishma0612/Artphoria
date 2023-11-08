<?php
header("Content-Type: image/jpeg"); // Set the content type to JPEG (change if your images are in a different format)

// Define your database connection details.
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "trial";

// User ID for the user whose image you want to retrieve (replace with the actual user ID).
$userID = 123;

// Attempt to connect to the database.
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    // Handle database connection error (e.g., return a default image).
    // You can customize this part to return a default image or show an error message.
    exit();
}

// Prepare and execute a query to retrieve the image data for the specified user.
$stmt = $conn->prepare("SELECT image_data FROM drawings WHERE user_id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($imageData);
    $stmt->fetch();
    echo $imageData; // Output the image data.
} else {
    // Handle case when no image is found for the user (e.g., return a default image).
    // You can customize this part to return a default image or show an error message.
}

$stmt->close();
$conn->close();
?>

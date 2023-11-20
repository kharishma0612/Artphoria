<?php
header("Content-Type: image/jpeg"); 
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "trial";
$userID = 123;
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    exit();
}
$stmt = $conn->prepare("SELECT image_data FROM drawings WHERE user_id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($imageData);
    $stmt->fetch();
    echo $imageData;
} else {
}

$stmt->close();
$conn->close();
?>

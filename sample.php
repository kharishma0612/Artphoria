<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trial";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if (isset($_SESSION["user_id"])) {
    $userid = $_SESSION["user_id"];
    $sql = "SELECT content FROM notes WHERE user_id = $userid";

    $result = mysqli_query($conn, $sql);
    $noteNumber = 1;
    echo "<div class='note-container'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='note-box'>";
        echo "<p>Note $noteNumber</p>";
        echo "<p>" . $row['content'] . "</p>";
        echo "</div>";
        $noteNumber++;
    }
    echo "</div>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["artworkImage"]["name"]);

        if (move_uploaded_file($_FILES["artworkImage"]["tmp_name"], $targetFile)) {
            $insertDrawingSQL = "INSERT INTO drawings (user_id, image_data) VALUES ('$userid', '$targetFile')";
            if ($conn->query($insertDrawingSQL) === TRUE) {
                echo "Drawing saved successfully.";
                header("Location: note.php");
                exit();
            } else {
                echo "Error: " . $insertDrawingSQL . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $sql = "SELECT image_data FROM drawings WHERE user_id = $userid";
    $result = mysqli_query($conn, $sql);
    echo "<div class='note-container'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='note-box'>";
        echo "<p><img src='" . $row['image_data'] . "' alt='Drawing' style = 'width:100px;'></p>";
        echo "</div>";
    }
} else {
    echo "User ID is not set in the session.";
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .note-container {
            width :400px;
            flex-direction: column;
            align-items: center;
        }

        .note-box {
            background-color:#fff;
            border: 1px solid #000;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
</body>
</html>
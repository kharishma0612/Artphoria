<?php
header("Content-Type: application/json");

// Define your database connection details.
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "trial";

// Attempt to connect to the database.
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    $response = ["success" => false, "error" => "Database connection failed"];
    echo json_encode($response);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        if (isset($data["user_id"]) && isset($data["action"]) && $data["action"] === "retrieve") {
            $userID = $data["user_id"];
            
            // Retrieve notes from the database for the specific user.
            $notes = [];
            $notesResult = $conn->prepare("SELECT content FROM notes WHERE user_id = ?");
            $notesResult->bind_param("i", $userID);
            $notesResult->execute();
            $notesResult->bind_result($noteContent);

            while ($notesResult->fetch()) {
                $notes[] = ["content" => $noteContent];
            }

            // Retrieve drawings from the database for the specific user.
            $drawings = [];
            $drawingsResult = $conn->prepare("SELECT image_data FROM drawings WHERE user_id = ?");
            $drawingsResult->bind_param("i", $userID);
            $drawingsResult->execute();
            $drawingsResult->bind_result($imageData);

            while ($drawingsResult->fetch()) {
                $drawings[] = ["image_data" => $imageData];
            }

            $response = ["success" => true, "notes" => $notes, "drawings" => $drawings];
            echo json_encode($response);
        } else {
            $response = ["success" => false, "error" => "Invalid data or action"];
            echo json_encode($response);
        }
    } else {
        $response = ["success" => false, "error" => "Invalid data"];
        echo json_encode($response);
    }
}

$conn->close();
?>

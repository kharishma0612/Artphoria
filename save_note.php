<?php
header("Content-Type: application/json");

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "trial";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    $response = ["success" => false, "error" => "Database connection failed"];
    echo json_encode($response);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        if (isset($data["note"]) && isset($data["user_id"])) {
            $note = $data["note"];
            $userID = $data["user_id"];
            $stmt = $conn->prepare("INSERT INTO notes (user_id, content) VALUES (?, ?)");
            $stmt->bind_param("is", $userID, $note);

            if ($stmt->execute()) {
                $response = ["success" => true, "message" => "Note saved successfully"];
                echo json_encode($response);
            } else {
                $response = ["success" => false, "error" => "Error saving the note"];
                echo json_encode($response);
            }

            $stmt->close();
        } else {
            $response = ["success" => false, "error" => "Note data or user ID not provided"];
            echo json_encode($response);
        }
    } else {
        $response = ["success" => false, "error" => "Invalid data"];
        echo json_encode($response);
    }
}

$conn->close();
?>


